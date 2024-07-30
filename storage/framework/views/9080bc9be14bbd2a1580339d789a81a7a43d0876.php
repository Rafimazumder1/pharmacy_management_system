<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('dashboard/app-assets/morris-chart/morris.css')); ?>">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
    .statistic .icon-box {
        width: 60px;
        text-align: center;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
        border-radius: 13px;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', __('pages.dashboard')); ?>
<?php $__env->startSection('content'); ?>
<div class="row my-2">
    <div class="col-lg-8">
        <div class="card border-0 border-r20 py-2 mb-3">
            <div class="card-header bg-transparent border-0">
                <h4><?php echo e(__('pages.Reports')); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 px-2 mb-1 col-6">
                        <div class="small-box first">
                            <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                <div class="icon">
                                    <i class="fas fa-pills fa-2xl"></i>
                                </div>
                                <div class="inner">
                                    <h3><?php echo e(number_format($medicine, 0, '.', ',')); ?></h3>
                                </div>
                            </div>
                            <a href="<?php echo e(route('instock')); ?>" class="small-box-footer">
                                <span><?php echo e(__('Stock Medicine')); ?></span> <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2 mb-1 col-6">
                        <div class="small-box second">
                            <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                <div class="icon">
                                    <i class="fas fa-usd fa-2xl"></i>
                                </div>
                                <div class="inner">
                                    <h3><?php echo e(number_format($invoice_amt, 2, '.', ',')); ?></h3>
                                </div>
                            </div>
                            <a href="<?php echo e(route('invoice.reports')); ?>" class="small-box-footer">
                                <span><?php echo e(__('Total Sales')); ?></span> <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2 mb-1 col-6">
                        <div class="small-box third">
                            <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                <div class="icon">
                                    <i class="fas fa-hourglass-end fa-2xl"></i>
                                </div>
                                <div class="inner">
                                    <h3><?php echo e($expire->count()); ?></h3>
                                </div>
                            </div>
                            <a href="<?php echo e(route('expired')); ?>" class="small-box-footer">
                                <span><?php echo e(__('pages.expired_medicine')); ?></span> <i
                                    class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2 mb-1 col-6">
                        <div class="small-box fourth">
                            <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                <div class="icon">
                                    <i class="fa-brands fa-product-hunt fa-2xl"></i>
                                </div>
                                <div class="inner">
                                    <h3><?php echo e($stockout->count()); ?></h3>
                                </div>
                            </div>
                            <a href="<?php echo e(route('stockout')); ?>" class="small-box-footer">
                                <span><?php echo e(__('pages.stock_out_medicine')); ?></span> <i
                                    class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 border-r20 mb-3">
            <div class="card-header bg-transparent border-0">
                <h4 class="card-title"><?php echo e(__('pages.Purchases & Sales')); ?></h4>
            </div>
            <div class="card-body">
                <div id="line-example" style="height: 180px;color: red" class="line-atl morris-chart"></div>
            </div>
        </div>
    </div>
</div>
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="row">
                <div class="col-lg-6 col-12 statistic">
                    <div class="card border-0 border-r20">
                        <div class="card-body d-flex gap-2 align-items-center">
                            <div class="icon-box bg-warning">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="text">
                                <h3 class="count"><?php echo e(App\Models\Customer::count()); ?></h3>
                                <h5 class="mb-0"><?php echo e(__('Total Customer')); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 statistic">
                    <div class="card border-0 border-r20">
                        <div class="card-body d-flex gap-2 align-items-center">
                            <div class="icon-box bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="text">
                                <h3 class="count"><?php echo e(App\Models\Supplier::count()); ?></h3>
                                <h5 class="mb-0"><?php echo e(__('Total Manufacturer')); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="basic-table">
                <div class="col-md-6 col-sm-12">
                    <div class="card border-0 border-r20">
                        <div class="card-header bg-primary border-0">
                            <h4 class="card-title Titlee">Today's sell</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('pages.title')); ?></th>
                                        <th><?php echo e(__('pages.amount')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo e(__('pages.today_invoice')); ?>

                                        </td>
                                        <td><?php echo e($invoice); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(__('pages.sold_amount')); ?>

                                        </td>
                                        <td><?php echo e($invoice_amt); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(__('pages.received_amount')); ?>

                                        </td>
                                        <td><?php echo e($received); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">

                    <div class="card border-0 border-r20">
                        <div class="card-header bg-success border-0">
                            <h4 class="card-title Titlee"><?php echo e(__('Today\'s Purchase')); ?> </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('pages.title')); ?></th>
                                        <th><?php echo e(__('pages.amount')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('pages.today_purchase')); ?></td>
                                        <td><?php echo e($purchase); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('pages.purchase_amount')); ?></td>
                                        <td><?php echo e($purchase_amt); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('pages.paid_amount')); ?></td>
                                        <td><?php echo e($paid); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-5 col-sm-12">
            <div class="card border-0 border-r20">
                <div class="card-header bg-transparent border-0">
                    <div class="header-left">
                        <h4 class="card-title" style="color:#000; font-weight:600;"><?php echo e(__('pages.Purchases & Sales')); ?>

                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div id="piChart"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="stockmodal" class="modal fade show" role="dialog" style="padding-right: 15px; display: none;"
    aria-modal="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div>
                    <h4>
                        <center><?php echo e(__('pages.expired_medicine')); ?></center>
                    </h4>
                </div>
                <table id="" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo e(__('pages.name')); ?></th>
                            <th class="text-center"><?php echo e(__('pages.batch')); ?></th>
                            <th class="text-center"><?php echo e(__('pages.Expired on')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $expire_medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            $medicine = \App\Models\Medicine::where('id', $batch->medicine_id)->first();
                                                        ?>
                                                        <?php if($medicine != null): ?>
                                                            <?php echo e($medicine->name); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($batch->name); ?></td>

                                                    <td><?php echo e($batch->expire); ?></td>
                                                </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div>
                    <h4>
                        <center><?php echo e(__('pages.stock_out')); ?></center>
                    </h4>
                </div>
                <table id="" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo e(__('pages.name')); ?></th>

                            <th class="text-center"><?php echo e(__('Qauntity')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $stockout_medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo e($medicine->name); ?>

                                </td>
                                <td class="text-center">
                                    <?php echo e($medicine->total_quantity); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-js'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#stockmodal').modal('show');
    });
</script>

<script src="<?php echo e(asset('dashboard/app-assets/morris-chart/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/morris-chart//raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/morris-chart/morris.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php
    $user = Auth::user();
    $dfrom = date('Y-m-d', strtotime('-7 day', time()));
    $dto = date('Y-m-d');
    $datelist = list_days($dfrom, $dto);
    $i = 0;
    $data = [];
?>

<?php if($user && $user->shop): ?>
    <?php $__currentLoopData = $datelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($user->shop->email != env('SUPERUSER')): ?>
            <?php
                $data[$i]['y'] = $date;
                $data[$i]['a'] = \App\Models\Invoice::where('shop_id', $user->shop_id)
                    ->where('date', $date)
                    ->count();
                $data[$i]['b'] = \App\Models\Purchase::where('shop_id', $user->shop_id)
                    ->where('date', $date)
                    ->count();
                $i++;
            ?>
        <?php else: ?>
            <?php
                $data[$i]['y'] = $date;
                $data[$i]['a'] = \App\Models\Income::where('shop_id', $user->shop_id)
                    ->where('n_date', $date)
                    ->count();
                $data[$i]['b'] = \App\Models\Income::where('shop_id', $user->shop_id)
                    ->where('n_date', $date)
                    ->where('status', 1)
                    ->count();
                $data[$i]['c'] = \App\Models\Income::where('shop_id', $user->shop_id)
                    ->where('n_date', $date)
                    ->where('status', 1)
                    ->sum('amount');
                $i++;
            ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if($user && $user->shop): ?>
    <script>
        Morris.Line({
            element: 'line-example',
            data: <?php echo json_encode($data) ?>,
        xkey: 'y',
            labelColor: '#000000',
                <?php if($user->shop->email != env('SUPERUSER')): ?>
                    ykeys: ['a', 'b'],
                        labels: ['Sales', 'Purchase']
                <?php else: ?>
                    ykeys: ['a', 'b', 'c'],
                        labels: ['Total Order', 'Approved Order', 'Received Amount']
                <?php endif; ?>
            });
    </script>

    <?php if($user->shop->email != env('SUPERUSER')): ?>
        <?php
            $sales = \App\Models\Invoice::where('shop_id', $user->shop_id)->sum('total_price');
            $purchase = \App\Models\Purchase::where('shop_id', $user->shop_id)->sum('total_price');
        ?>
    <?php else: ?>
        <?php
            $expired = \App\Models\Shop::whereBetween('next_pay', [$dfrom, $dto])->count();
            $active_order = \App\Models\Income::where('shop_id', $user->shop_id)
                ->where('status', 1)
                ->whereBetween('n_date', [$dfrom, $dto])
                ->count();
        ?>
    <?php endif; ?>
<?php endif; ?>

<script>
    var options = {
        series: [<?php echo e($purchase ?? ''); ?>, <?php echo e($sales ?? ''); ?>],
        chart: {
            width: 380,
            type: 'pie',
        },
        colors: ['#0088ff', '#f8bf15'],
        labels: ['Purchase', 'Sales'],
        legend: {
            position: 'bottom',
            show: true,
            showForSingleSeries: false,
            showForNullSeries: true,
            showForZeroSeries: true,
        },
    };

    var chart = new ApexCharts(document.querySelector("#piChart"), options);
    chart.render();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/dashboard.blade.php ENDPATH**/ ?>