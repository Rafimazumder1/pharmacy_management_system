<?php

namespace App\Http\Controllers;

use App\Mail\SendCustomerMail;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoicePay;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {

            $custom = Customer::where('phone', $request->phone)->where('shop_id', Auth::user()->shop_id)->first();

            if ($custom != null) {
                Toastr::error('Customer Existes With Given Phone Number', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            }
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->address = $request->address;
            if ($request->filled('due')) {
                $customer->due = $request->due;
            }

            dd($customer);

            
            $customer->shop_id = Auth::user()->shop_id;
            $customer->district_id = Auth::user()->shop->district_id;
            $customer->thana_id = Auth::user()->shop->thana_id;
            if ($customer->save()) {
                Toastr::success('Customer successfully created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('customer.list');
            } else {
                Toastr::error('Something Went Wrong', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('customer.list');
            }
        } else {

            return view('customer.add');
        }
    }




    public function edit(Request $request, $id)
    {
        $customer = Customer::where('shop_id', Auth::user()->shop_id)->where('id', $id)->firstOrFail();
        if ($request->isMethod('post')) {



            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->address = $request->address;
            if ($request->filled('due')) {
                $customer->due = $request->due;
            }
            $customer->shop_id = Auth::user()->shop_id;
            $customer->thana_id = Auth::user()->shop->thana_id;
            $customer->district_id = Auth::user()->shop->district_id;
            if ($customer->save()) {
                Toastr::success('Customer successfully created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('customer.list');
            } else {
                Toastr::error('Something Went Wrong', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('customer.list');
            }
        } else {

            return view('customer.edit', compact('customer'));
        }
    }


    public function delete(Request $request, $id)
    {
        $customer = Customer::where('shop_id', Auth::user()->shop_id)->where('id', $id)->firstOrFail();

        if ($customer->delete()) {
            Toastr::success('Customer successfully Deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->route('customer.list');
        } else {
            Toastr::error('Something Went Wrong', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->route('customer.list');
        }
    }


    public function view(Request $request, $id)
    {
        $data['customer'] = Customer::where('shop_id', Auth::user()->shop_id)->where('id', $id)->firstOrFail();
        if ($request->ajax()) {
            if ($request->filled('from') && $request->filled('to')) {
                $data = Invoice::select('id', 'inv_id', 'total_price', 'due_price')->where('customer_id', $id)->whereBetween('date', [$request->from, $request->to]);
            } else {
                $data = Invoice::select('id', 'inv_id', 'total_price', 'due_price')->where('customer_id', $id);
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('invoice.view', $row->id) . '" class="badge bg-info"><i class="fas fa-eye"></i></a> <a onclick="return confirm(\'Are you sure?\')" href="' . route('invoice.delete', $row->id) . '" class="badge bg-danger"><i class="fas fa-trash"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['invoice'] = Invoice::where('customer_id', $id)->get();
        $data['transaction'] = InvoicePay::where('customer_id', $id)->get();
        return view('customer.view')->with($data);
    }
    public function due(Request $request)
    {

        if ($request->ajax()) {
            $data = Customer::select('id', 'name', 'address', 'phone', 'due')->where('shop_id', Auth::user()->shop_id)->where('due', '>', 0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('customer.edit', $row->id) . '" class="badge bg-primary"><i class="fas fa-edit"></i></a> <a href="' . route('customer.view', $row->id) . '" class="badge bg-info"><i class="fas fa-eye"></i></a> <a onclick="return confirm(\'Are you sure?\')" href="' . route('customer.delete', $row->id) . '" class="badge bg-danger"><i class="fas fa-trash"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $customer = Customer::where('shop_id', Auth::user()->shop_id)->get();

        return view('customer.due', compact('customer'));
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Customer::select('id', 'name', 'address', 'phone', 'due')->where('shop_id', Auth::user()->shop_id)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('customer.edit', $row->id) . '" class="badge bg-primary"><i class="fas fa-edit"></i></a> <a href="' . route('customer.view', $row->id) . '" class="badge bg-info"><i class="fas fa-eye"></i></a> <a onclick="return confirm(\'Are you sure?\')" href="' . route('customer.delete', $row->id) . '" class="badge bg-danger"><i class="fas fa-trash"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $customer = Customer::where('shop_id', Auth::user()->shop_id)->get();

        return view('customer.list', compact('customer'));
    }


    public function sendEmail(Request $request)
    {
        $customers = Customer::select('id', 'name', 'address', 'phone', 'email')->where('shop_id', Auth::user()->shop_id)->latest()->get();
        return view('customer.email_sender', compact('customers'));
    }

    public function sendEmailProcess(Request $request)
    {
        $request->validate([
            'customers'     => 'required',
            'email_subject'   => 'required',
            'email_body'   => 'required',
        ], [
            'customers.required' => 'Customers is required',
            'email_subject.required' => 'Subject field is required',
            'email_body.required' => 'Email body field is required',
        ]);
        try {
            $company = Auth::user()->shop;
            $user = Auth::user();
            $data = [
                'subject' => $request->email_subject . ' | ' . env('MAIL_FROM_NAME'),
                'company_owner' => $user->name,
                'company_name' => $company->name,
                'from_email' => env('MAIL_FROM_ADDRESS'),
                'body' => $request->email_body,
                'logo' => asset('storage/images/admin/site_logo/' . $company->site_logo),
                'site_name' => $company->site_title,
            ];
            foreach ($request->customers as $customer) {
                $cmr = Customer::where('email', $customer)->first();
                $data['customer_name'] = $cmr->name;
                Mail::to($customer)->send(new SendCustomerMail($data));
            }
            Toastr::success('Mail has been sent successfuly!', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return back();
        } catch (Exception $exception) {
            Toastr::error($exception->getMessage(), '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->back();
        }
    }
}