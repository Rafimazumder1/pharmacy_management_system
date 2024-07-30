<?php

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('uniqueOrderId')) {
    function uniqueOrderId($offerNo, $prefix, $table, $column)
    {

        $offerNo = $prefix;
        $numberLen = 10 - strlen($offerNo);
        $order_id = $offerNo . strtoupper(substr(str_shuffle("0123456789"), -$numberLen));

        $check_path = DB::table($table)->select($column)->where($column, 'like', $order_id . '%')->get();
        if (count($check_path) > 0) {
            //find slug until find not used.
            for ($i = 1; $i <= 99; $i++) {
                $new_order_id = $offerNo . strtoupper(substr(str_shuffle("0123456789"), -$numberLen));
                if (!$check_path->contains($column, $new_order_id)) {
                    return $new_order_id;
                }
            }
        } else {
            return $order_id;
        }
    }
}


function active_if_full_match($path)
{
    return Request::is($path) ? 'active' : '';
}

function active_if_match($path)
{
    return Request::is($path . '*') ? 'sidebar-group-active open' : '';
}


function list_days_old($date_from, $date_to)
{
    $period = new DatePeriod(
        new DateTime('2010-10-01'),
        new DateInterval('P1D'),
        new DateTime('2010-10-05')
    );
    return $period;
}

function list_days($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
{

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while ($current <= $last) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

function remove_invalid_charcaters($str)
{
    return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
}

function translate($key)
{
    if (session()->get('local')) {
        $local = session()->get('local');
    } else {
        $local = 'en';
    }
    App::setLocale($local);

    $lang_array = include(base_path('resources/lang/' . $local . '/pages.php'));
    $processed_key = ucfirst(str_replace('_', ' ', remove_invalid_charcaters($key)));

    if (!array_key_exists($key, $lang_array)) {
        $lang_array[$key] = $processed_key;
        $str = "<?php return " . var_export($lang_array, true) . ";";
        file_put_contents(base_path('resources/lang/' . $local . '/pages.php'), $str);
        $result = $processed_key;
    } else {
        $result = __('pages.' . $key);
    }
    return $result;
}


function generateRandomString($length = 5)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if (!function_exists('overWriteEnvFile')) {
    function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)
                ));
            } else {
                file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
            }
        }
    }
}

if (!function_exists('setting')) {
    function setting($name, $default = null)
    {
        $setting = DB::table('settings')->where('name', $name)->first();
        if ($setting) {
            return $setting->value;
        }
        return $default;
    }
}
if (!function_exists('setting')) {
    function setting($name, $default = null)
    {
        $setting = DB::table('settings')->where('name', $name)->first();
        if ($setting) {
            return $setting->value;
        }
        return $default;
    }
}