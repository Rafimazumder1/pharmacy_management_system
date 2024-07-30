<?php
$role_permissions = App\Models\Permission::where('role_id', Auth::user()->role_id)->first();
$permissions = [];
if (!empty($role_permissions)) {
$permissions = json_decode($role_permissions->permissions, true);
}
?>

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
                        <?php if(Auth::user()->role_id == 1): ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('medicine.add')); ?>">
                                <i class="fas fa-pills"></i> Add Medicine
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('supplier.add')); ?>">
                                <i class="fa-solid fa-people-carry-box"></i> Add Manufacture
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('purchase.create')); ?>">
                                <i class="fas fa-cart-shopping"></i> Add Purchase
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('vendor.create')); ?>">
                                <i class="fa-solid fa-store"></i> Add Vendor
                            </a>
                        </li>
                        <?php else: ?>
                        <?php if(array_key_exists('medicine_add', $permissions)): ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('medicine.add')); ?>">
                                <i class="fas fa-pills"></i> Add Medicine
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(array_key_exists('manufacturers_add', $permissions)): ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('supplier.add')); ?>">
                                <i class="fa-solid fa-people-carry-box"></i> Add Manufacture
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(array_key_exists('new_purchase', $permissions)): ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('purchase.create')); ?>">
                                <i class="fas fa-cart-shopping"></i> Add Purchase
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(array_key_exists('vendor_add', $permissions)): ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('vendor.create')); ?>">
                                <i class="fa-solid fa-store"></i> Add Vendor
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav align-items-center px-2 m-auto">
            <li class="nav-item">
                <h5 class="m-0 fw-bold date">
                    <i class="ficon" data-feather="calendar"></i> <?php echo e(date('l, F j, Y')); ?>

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
            <?php
            use Illuminate\Support\Facades\Schema;
            use App\Models\Ecommerce\Order;
            ?>
            <!-- Ecommerce order notification -->
            <?php if(Schema::hasTable('orders')): ?>
            <?php
            $now = \Illuminate\Support\Carbon::now();
            $orders = [];
            $query = Order::with('orderDetails', 'orderDetails.product')->whereDate('created_at', $now->toDateString());
            $orders = $query
            ->latest()
            ->take(10)
            ->get();
            ?>

            <li class="nav-item">
                <a target="_blank" href="<?php echo e(url('/')); ?>" title="<?php echo e(__('pages.Go to Website')); ?>" class="nav-link me-2">
                    <i class="ficon text-dark" data-feather="globe"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link me-4" title="<?php echo e(__('pages.Ecommerce orders')); ?>" href="#" data-bs-toggle="dropdown">
                    <i class="ficon text-dark" data-feather="package"></i>
                    <span class="badge rounded-pill bg-danger badge-up">
                        <?php echo e(count($query->where('notification_status', 'unread')->get())); ?>

                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0 notification-dropdown"
                    aria-labelledby="dropdown-user">
                    <div class="list-group  list-group-flush">
                        <div class="list-group-item">
                            <span class="text-warning"><i class="ficon text-dark" data-feather="bell"></i>
                                <?php echo e(__('pages.Order Notication Inbox')); ?></span>
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="list-group  list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('ecommerce.order.details', $order->id)); ?>"
                                class="list-group-item <?php if($order->notification_status == 'unread'): ?> list-group-item-warning <?php endif; ?>">
                                <div class="fw-bold">
                                    <span class="text-dark"><?php echo e(__('pages.An order has been placed')); ?>.</span><br>
                                    <strong>Invoice Id: <?php echo e($order->invoice_id); ?></strong>
                                    <br> <small class="text-success">
                                        <?php echo e($order->created_at->diffForHumans()); ?>

                                    </small>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <h5 class="text-center my-5"><?php echo e(__('pages.You don\'t have any notification')); ?>

                                !</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <li class="nav-item dropdown dropdown-language">
                <?php
                $langact = \App\Models\Language::where('iso', session()->get('locale'))->first();

                $languages = \App\Models\Language::all();

                //where('iso', '!=', session()->get('locale'))->get();

                $date = date('Y-m-d', time());

                $expire_medicine = \App\Models\Batch::where('shop_id', Auth::user()->shop_id)
                ->where('expire', '<=', $date) ->count();

                    $stockout_medicine = \App\Models\Medicine::whereHas('batch', function ($query) {
                    $query->where('qty', '<', 1); })->count();

                        ?>


                        

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item" href="<?php echo e(route('language.change', $lang->iso)); ?>"
                                data-language="en"><i class="flag-icon flag-icon-<?php echo e($lang->iso); ?>"></i>
                                <?php echo e($lang->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
            </li>

            <li class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link h5 fw-bold mb-0" href="<?php echo e(route('pos.index')); ?>">(POS)
                    &nbsp;<i class="fas fa-print"></i></a>
            </li>

            <?php if($expire_medicine > 0): ?>
            <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="<?php echo e(route('expired')); ?>"><i
                        class="fas fa-exclamation-triangle"></i><span
                        class="badge rounded-pill bg-danger badge-up cart-item-count"><?php echo e($expire_medicine); ?></span></a>
            </li>
            <?php endif; ?>


            <?php if($stockout_medicine > 0): ?>
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="<?php echo e(route('stockout')); ?>">
                    <i class="ficon text-dark" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-danger badge-up">
                        <?php echo e($stockout_medicine); ?>

                    </span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder"><?php echo e(Auth::user()->name); ?></span>
                        <span class="user-status"><?php echo e(Auth::user()->role ? Auth::user()->role->name : 'Admin'); ?></span>
                        <span class="shop-id">
                            Shop: <?php echo e(Auth::user()->shop ? Auth::user()->shop->name : 'No Shop Assigned'); ?>

                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round" <?php if(!empty(Auth::user()->image)): ?>
                        src="<?php echo e(asset('storage/images/profile/' . Auth::user()->image)); ?>" <?php else: ?>
                        src="<?php echo e(asset('dashboard/app-assets/images/f2.jpg')); ?>" <?php endif; ?> alt="avatar" height="40"
                        width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0"
                    aria-labelledby="dropdown-user">

                    <a class="dropdown-item" href="<?php echo e(route('profile.setting')); ?>"><i class="me-50 fas fa-th"></i>
                        <?php echo e(__('Dashboard')); ?></a>
                    <a class="dropdown-item py-1" href="<?php echo e(route('profile.setting')); ?>"><i class="me-50"
                            data-feather="lock"></i> <?php echo e(__('Change Password')); ?>

                    </a>

                    <a class="dropdown-item py-1" href="<?php echo e(route('profile.info.setting')); ?>"><i class="me-50"
                            data-feather="eye"></i> <?php echo e(__('Change Info')); ?>

                    </a>
                    <a class="dropdown-item py-1" href="<?php echo e(route('settings')); ?>"><i class="me-50"
                            data-feather="settings"></i> <?php echo e(__('Settings')); ?>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-1" href="<?php echo e(route('logout')); ?>"><i class="me-50"
                            data-feather="power"></i> <?php echo e(__('Logout')); ?>

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
        <?php
        $user = Auth::user();
        $my_pack = null;
        if ($user && $user->shop) {
        $my_pack = \App\Models\Package::where('id', optional($user->shop)->package_id)->first();
        }
        ?>

        <ul id="mul" class="nav navbar-nav align-items-center">
            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="<?php echo e(route('profit')); ?>">
                    <i class="fas fa-file-text"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="<?php echo e(route('pos.index')); ?>">
                    <i class="fas fa-print"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="<?php echo e(route('profile.info.setting')); ?>">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link" href="<?php echo e(route('logout')); ?>">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>


<!-- END: Header--><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/layouts/elements/header.blade.php ENDPATH**/ ?>