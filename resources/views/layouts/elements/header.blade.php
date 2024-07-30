@php
$role_permissions = App\Models\Permission::where('role_id', Auth::user()->role_id)->first();
$permissions = [];
if (!empty($role_permissions)) {
$permissions = json_decode($role_permissions->permissions, true);
}
@endphp

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light  container-xxl navBar"
    id="desktopmenu">
    <div class="navbar-container d-flex content align-items-center  ">
        <ul class="nav navbar-nav align-items-center px-2">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-primary border-r20" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Add New <i class="fa fa-plus-circle"></i>
                    </button>

                    <ul class="dropdown-menu border-r20 border-0 shadow-lg overflow-hidden"
                        aria-labelledby="dropdownMenuButton1">
                        @if (Auth::user()->role_id == 1)
                        <li>
                            <a class="dropdown-item" href="{{ route('medicine.add') }}">
                                <i class="fas fa-pills"></i> Add Medicine
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('supplier.add') }}">
                                <i class="fa-solid fa-people-carry-box"></i> Add Manufacture
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('purchase.create') }}">
                                <i class="fas fa-cart-shopping"></i> Add Purchase
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('vendor.create') }}">
                                <i class="fa-solid fa-store"></i> Add Vendor
                            </a>
                        </li>
                        @else
                        @if (array_key_exists('medicine_add', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('medicine.add') }}">
                                <i class="fas fa-pills"></i> Add Medicine
                            </a>
                        </li>
                        @endif
                        @if (array_key_exists('manufacturers_add', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('supplier.add') }}">
                                <i class="fa-solid fa-people-carry-box"></i> Add Manufacture
                            </a>
                        </li>
                        @endif
                        @if (array_key_exists('new_purchase', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('purchase.create') }}">
                                <i class="fas fa-cart-shopping"></i> Add Purchase
                            </a>
                        </li>
                        @endif
                        @if (array_key_exists('vendor_add', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('vendor.create') }}">
                                <i class="fa-solid fa-store"></i> Add Vendor
                            </a>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav align-items-center px-2 m-auto">
            <li class="nav-item">
                <h5 class="m-0 fw-bold date">
                    <i class="ficon" data-feather="calendar"></i> {{ date('l, F j, Y') }}
                </h5>
            </li>
        </ul>

        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
        </div>

        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item">
                <div id="google_translate_element" lang="en" aria-label="Language (English‎)"></div>
            </li>
            @php
            use Illuminate\Support\Facades\Schema;
            use App\Models\Ecommerce\Order;
            @endphp
            <!-- Ecommerce order notification -->
            @if (Schema::hasTable('orders'))
            @php
            $now = \Illuminate\Support\Carbon::now();
            $orders = [];
            $query = Order::with('orderDetails', 'orderDetails.product')->whereDate('created_at', $now->toDateString());
            $orders = $query
            ->latest()
            ->take(10)
            ->get();
            @endphp

            <li class="nav-item">
                <a target="_blank" href="{{ url('/') }}" title="{{ __('pages.Go to Website') }}" class="nav-link me-2">
                    <i class="ficon text-dark" data-feather="globe"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link me-4" title="{{ __('pages.Ecommerce orders') }}" href="#" data-bs-toggle="dropdown">
                    <i class="ficon text-dark" data-feather="package"></i>
                    <span class="badge rounded-pill bg-danger badge-up">
                        {{ count($query->where('notification_status', 'unread')->get()) }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0 notification-dropdown"
                    aria-labelledby="dropdown-user">
                    <div class="list-group  list-group-flush">
                        <div class="list-group-item">
                            <span class="text-warning"><i class="ficon text-dark" data-feather="bell"></i>
                                {{ __('pages.Order Notication Inbox') }}</span>
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="list-group  list-group-flush">
                            @forelse($orders as $order)
                            <a href="{{ route('ecommerce.order.details', $order->id) }}"
                                class="list-group-item @if ($order->notification_status == 'unread') list-group-item-warning @endif">
                                <div class="fw-bold">
                                    <span class="text-dark">{{ __('pages.An order has been placed') }}.</span><br>
                                    <strong>Invoice Id: {{ $order->invoice_id }}</strong>
                                    <br> <small class="text-success">
                                        {{ $order->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                            @empty
                            <h5 class="text-center my-5">{{ __('pages.You don\'t have any notification') }}
                                !</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>
            @endif
            <li class="nav-item dropdown dropdown-language">
                @php
                $langact = \App\Models\Language::where('iso', session()->get('locale'))->first();

                $languages = \App\Models\Language::all();

                //where('iso', '!=', session()->get('locale'))->get();

                $date = date('Y-m-d', time());

                $expire_medicine = \App\Models\Batch::where('shop_id', Auth::user()->shop_id)
                ->where('expire', '<=', $date) ->count();

                    $stockout_medicine = \App\Models\Medicine::whereHas('batch', function ($query) {
                    $query->where('qty', '<', 1); })->count();

                        @endphp


                        {{-- @if ($langact != null)
                <a class="nav-link dropdown-toggle" id="dropdown-flag"
                    href="{{ route('language.change', $langact->iso) }}" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="flag-icon flag-icon-{{ $langact->iso }}"></i><span
                            class="selected-language">{{ $langact->name }}</span></a>
                        @endif --}}

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                            @foreach ($languages as $lang)
                            <a class="dropdown-item" href="{{ route('language.change', $lang->iso) }}"
                                data-language="en"><i class="flag-icon flag-icon-{{ $lang->iso }}"></i>
                                {{ $lang->name }}</a>
                            @endforeach
                        </div>
            </li>

            <li class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link h5 fw-bold mb-0" href="{{ route('pos.index') }}">(POS)
                    &nbsp;<i class="fas fa-print"></i></a>
            </li>

            @if ($expire_medicine > 0)
            <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="{{ route('expired') }}"><i
                        class="fas fa-exclamation-triangle"></i><span
                        class="badge rounded-pill bg-danger badge-up cart-item-count">{{ $expire_medicine }}</span></a>
            </li>
            @endif


            @if ($stockout_medicine > 0)
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="{{ route('stockout') }}">
                    <i class="ficon text-dark" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-danger badge-up">
                        {{ $stockout_medicine }}
                    </span>
                </a>
            </li>
            @endif
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                        <span class="user-status">{{ Auth::user()->role ? Auth::user()->role->name : 'Admin' }}</span>
                        <span class="shop-id">
                            Shop: {{ Auth::user()->shop ? Auth::user()->shop->name : 'No Shop Assigned' }}
                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round" @if (!empty(Auth::user()->image))
                        src="{{ asset('storage/images/profile/' . Auth::user()->image) }}" @else
                        src="{{ asset('dashboard/app-assets/images/f2.jpg') }}" @endif alt="avatar" height="40"
                        width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0"
                    aria-labelledby="dropdown-user">

                    <a class="dropdown-item" href="{{ route('profile.setting') }}"><i class="me-50 fas fa-th"></i>
                        {{ __('Dashboard') }}</a>
                    <a class="dropdown-item py-1" href="{{ route('profile.setting') }}"><i class="me-50"
                            data-feather="lock"></i> {{ __('Change Password') }}
                    </a>

                    <a class="dropdown-item py-1" href="{{ route('profile.info.setting') }}"><i class="me-50"
                            data-feather="eye"></i> {{ __('Change Info') }}
                    </a>
                    <a class="dropdown-item py-1" href="{{ route('settings') }}"><i class="me-50"
                            data-feather="settings"></i> {{ __('Settings') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-1" href="{{ route('logout') }}"><i class="me-50"
                            data-feather="power"></i> {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->


<!--Mobile Menu-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light container-xxl navBar"
    id="mobilemenu">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li id="mm" class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </div>
        @php
        $user = Auth::user();
        $my_pack = null;
        if ($user && $user->shop) {
        $my_pack = \App\Models\Package::where('id', optional($user->shop)->package_id)->first();
        }
        @endphp

        <ul id="mul" class="nav navbar-nav align-items-center">
            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="{{ route('profit') }}">
                    <i class="fas fa-file-text"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="{{ route('pos.index') }}">
                    <i class="fas fa-print"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="{{ route('profile.info.setting') }}">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>


<!-- END: Header-->