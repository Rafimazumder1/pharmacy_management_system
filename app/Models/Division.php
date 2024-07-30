<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'DIVISIONS';

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    // public function districts()
    // {
    //     return $this->hasMany(District::class, 'division_id');
    // }

    public function districts()
    {
        return $this->hasMany(District::class, 'division_id', 'id');
    }
}
