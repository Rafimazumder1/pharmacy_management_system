<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicePay;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use function App\CPU\purchaseVarification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function setEnv($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $lines = explode("\n", file_get_contents($path));
            $settings = collect($lines)
                ->filter()
                ->transform(function ($item) {
                    return explode("=", $item, 2);
                })->pluck(1, 0);
            $settings[$key] = $value;
            $rebuilt = $settings->map(function ($value, $key) {
                return "$key=$value";
            })->implode("\n");
            file_put_contents($path, $rebuilt);
        }
    }
}
