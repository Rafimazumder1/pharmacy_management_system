<?php


namespace App\Http\Controllers;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicineImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Medicine|null
     */
    public function model(array $row)
    {
        return new Medicine([
            'qr_code'       => $row['qr_code'],
            'strength'      => $row['strength'],
            'leaf_id'       => $row['leaf_id'],
            'shelf'         => $row['shelf'],
            'category_id'   => $row['category_id'],
            'type_id'       => $row['type_id'],
            'supplier_id'   => $row['supplier_id'],
            'vendor_id'     => $row['vendor_id'],
            'vat'           => $row['vat'],
            'status'        => $row['status'],
            'name'          => $row['name'],
            'generic_name'  => $row['generic_name'],
            'unit_id'       => $row['unit_id'],
            'des'           => $row['des'],
            'price'         => $row['price'],
            'buy_price'     => $row['buy_price'],
            'igta'          => $row['igta'],
            'hot'           => $row['hot'],
            'global'        => $row['global'],
        ]);
    }
}