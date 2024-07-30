<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Comment\Doc;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class,'referred_to','id');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d',strtotime($value));
    }
}
