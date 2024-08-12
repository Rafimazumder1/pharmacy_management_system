<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisitions extends Model
{
    use HasFactory;

    protected $table = 'REQUISITION';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    protected $fillable = [
        
        'SHOP_ID',
        'medicine_id',
        'qty',

    ];
    public $timestamps = false;

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
