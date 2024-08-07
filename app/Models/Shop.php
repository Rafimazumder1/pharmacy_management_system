<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    protected $table = "SHOPS";
    protected $primaryKey = 'ID';
    public $incrementing = false; // Assuming your ID is not auto-incrementing
    protected $fillable = [
        'NAME',
        'PHONE',
        'ADDRESS',
        'CURRENCY',
        'SITE_TITLE',
        'SITE_LOGO',
        'EMAIL',
        'USERNAME',
        'NEXT_PAY',
        // Add more fields as necessary
    ];

    // Optional: Disable timestamps if the table does not have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    /**
     * Get a specific setting for the current authenticated user.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function setting($key, $default = null)
    {
        $userId = Auth::id();
        if ($userId) {
            $shop = self::where('SHOP_ID', $userId)->first();
            if ($shop) {
                return $shop->$key ?? $default;
            }
        }
        return $default;
    }

    /**
     * Define a relationship with the Package model.
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'PACKAGE_ID', 'ID');
    }

    /**
     * Define a relationship with the User model.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'SHOP_ID', 'ID');
    }

    /**
     * Define a relationship with the District model.
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'DISTRICT_ID', 'ID');
    }

    /**
     * Define a relationship with the Division model.
     */
    public function division()
    {
        return $this->belongsTo(Division::class, 'DIVISION_ID', 'ID');
    }

    /**
     * Define a relationship with the Thana model.
     */
    public function thana()
    {
        return $this->belongsTo(Thana::class, 'THANA_ID', 'ID');
    }

    /**
     * Get a specific setting for the shop.
     *
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    public static function shopSetting($field, $default = null)
    {
        return self::setting($field, $default);
    }
}
