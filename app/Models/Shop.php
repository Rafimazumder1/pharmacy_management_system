<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    protected $table = "SHOPS";
    protected $primaryKey = 'ID';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'currency',
        'site_title',
        'site_logo',
        'email',
        'username',
        'next_pay'
    ];

    // Optional: Disable timestamps if the table does not have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    public static function setting($key, $default = null)
    {
        $userId = Auth::id();
        if ($userId) {
            $shop = self::where('shop_id', $userId)->first();
            if ($shop) {
                $shopArray = $shop->toArray();
                return array_key_exists($key, $shopArray) ? $shopArray[$key] : $default;
            }
        }
        return $default;
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // public function user()
    // {
    //     return $this->hasMany(User::class);
    // }

    public function user()
    {
        return $this->hasMany(User::class, 'shop_id', 'ID');
    }


    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public static function shopSetting($field, $default = null)
    {
        return self::setting($field, $default);
    }
}
