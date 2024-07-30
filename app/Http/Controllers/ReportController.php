<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Customer;
use App\Models\hrm\Expense;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Method;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{

    public function customerDue(Request $request)
    {
        $shop_id = Auth::user()->shop_id;
        if ($request->ajax()) {
            $data = Customer::select('id', 'name', 'address', 'phone', 'due')->where('shop_id', Auth::user()->shop_id)->where('due', '>', 0)->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('invoice_due', function ($row) {
                    return $invoice_due = Invoice::where('customer_id', $row->id)->where('due_price', '>', 0)->sum('due_price') ?? 00;
                })
                ->make(true);
        }
        // $total_invoice_dues = DB::table('customers')
        // ->join('invoices', 'customers.id', '=','invoices.customer_id')
        // ->select(DB::raw('sum(due_price) as total_invoice_due_price'))->get();
        $total_dues = DB::select(DB::raw("
        SELECT
        SUM(customer.due) AS previous_due,
        SUM(invoice.due_price) AS invoice_due
        FROM
            customers AS customer
        JOIN invoices AS invoice
        ON
            customer.id = invoice.customer_id
        WHERE
            customer.shop_id = $shop_id
        "));

        $total_previous_due = $total_dues[0]->previous_due;
        $total_invoice_due = $total_dues[0]->invoice_due;

        $customer = Customer::where('shop_id', Auth::user()->shop_id)->get();

        return view('reports.customer_due', compact('customer', 'total_invoice_due', 'total_previous_due'));
    }

    public function supplierDue(Request $request)
    {
        $shop_id = Auth::user()->shop_id;
        if ($request->ajax()) {
            $data = Purchase::where('shop_id', Auth::user()->shop_id)->groupBy('supplier_id')->selectRaw('sum(due_price) as invoice_due, supplier_id, id')->having('invoice_due', '>', 0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('previous_due', function ($row) {
                    return Supplier::where('id', $row->supplier_id)->where('due', '>', 0)->sum('due') ?? 00;
                })
                ->addColumn('name', function ($row) {
                    return $row->supplier->name;
                })
                ->addColumn('phone', function ($row) {
                    return $row->supplier->phone;
                })
                ->make(true);
        }
        $total_dues = DB::select(DB::raw("
            SELECT 
            SUM(purchase.due_price) AS invoice_payable,
            SUM(supplier.due) AS previous_payable 
            FROM
                purchases AS purchase
            JOIN suppliers AS supplier
            ON
               supplier.id = purchase.supplier_id 
            WHERE
                purchase.shop_id = $shop_id
            "));
        $total_previous_payable = $total_dues[0]->previous_payable;
        $total_invoice_payable = $total_dues[0]->invoice_payable;
        $suppliers = Supplier::where('shop_id', Auth::user()->shop_id)->get();

        return view('reports.supplier_due', compact('suppliers', 'total_previous_payable', 'total_invoice_payable'));
    }


    public function topSellMedicine(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $from_date = '';
        $to_date = '';
        if (!empty($request->from) && !empty($request->to)) {
            $from_date = $request->from;
            $to_date = $request->to;
        } else {
            $from_date = date('Y-m-d', strtotime("-7 day", time()));
            $to_date = date('Y-m-d');
        }
        $dates = list_days($from_date, $to_date);
        $medicineIds = [];
        $query = Invoice::select('id', 'medicines')->where('shop_id', Auth::user()->shop_id)->whereIn('date', $dates);
        $sells = $query->limit(10)->latest()->get();
        $medicines = array();
        foreach ($sells as $sell) {
            $sold_medicines = json_decode($sell->medicines, true);
            foreach ($sold_medicines as $key => $medicine) {
                if (is_array($medicine)) {
                    $mquery = Medicine::where('id', $medicine['id'])->select('name', DB::raw('count(*) as total', 'id', 'generic_name'))
                        ->groupBy('name');
                    $mData = $mquery->get();
                    foreach ($mData as $data) {
                        $report['total_sale'] = $data['total'];
                        $report['id'] = $data['id'];
                        $report['name'] = $data['name'];
                        $report['generic_name'] = $data['generic_name'];
                    }
                    array_push($medicines, $report);
                }
            }
        }

        return view('reports.topsell_medicine', compact('medicines', 'keyword', 'from_date', 'to_date'));

    }


    // Business Profit & Loss
    public function businessProfitLoss(Request $request)
    {

        $year = now()->year;
        if (!empty($request->year)) {
            $year = $request->year;
        }

        $totalSale = Invoice::sum('total_price');
        $totalSaleQuantity = Invoice::sum('qty');

        $totalPurchase = Purchase::sum('total_price');
        $totalPurchaseQuantity = Purchase::sum('qty');

        $balanceInhand = Method::sum('balance');
        $totalExpenses = Expense::sum('amount');



        $salesData = $this->getData('sales','invoices','total_price', $year);
        $purchasesData = $this->getData('purchases','purchases','total_price', $year);
        $expensesData = $this->getData('expenses','expenses','amount', $year);

        $monthlyData = [];

        foreach ($salesData as $sales) {
            $month = $sales->month;

            $monthlyData[$month]['month'] = date('F', mktime(0, 0, 0, $month, 1));
            $monthlyData[$month]['total_sales'] = $sales->total_sales;

            $monthlyData[$month]['total_purchases'] = 0;
            foreach ($purchasesData as $purchases) {
                if ($purchases->month == $month) {
                    $monthlyData[$month]['total_purchases'] = $purchases->total_purchases;
                    break;
                }
            }

            $monthlyData[$month]['total_expenses'] = 0;
            foreach ($expensesData as $expenses) {
                if ($expenses->month == $month) {
                    $monthlyData[$month]['total_expenses'] = $expenses->total_expenses;
                    break;
                }
            }
            $monthlyData[$month]['profit_loss'] = $monthlyData[$month]['total_sales'] - ($monthlyData[$month]['total_purchases'] + $monthlyData[$month]['total_expenses']);
        }
        return view('reports.business_profitloss',
            compact('totalSale','totalSaleQuantity','totalPurchase','totalPurchaseQuantity'
                ,'totalExpenses','balanceInhand','monthlyData','year'));
    }

    private function getData($field,$table,$amount_field, $year)
    {
        return DB::table($table)
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM('.$amount_field.') as total_' . $field))
            ->whereYear('date', $year)
            ->groupBy('month')
            ->get();
    }

}