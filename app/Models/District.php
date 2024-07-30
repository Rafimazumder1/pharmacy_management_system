<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'DISTRICTS';

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    // public function division()
    // {
    //     return $this->belongsTo(Division::class, 'id');
    // }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
