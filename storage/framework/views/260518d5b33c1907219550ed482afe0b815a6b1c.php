<?php $__env->startSection('title', __('pages.payment_method')); ?>
<?php
    $setting = Auth::user()->shop;
?>

<?php $__env->startSection('content'); ?>
    <section class="app-user-list">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4 class="card-title"><?php echo e(__('pages.payment_method')); ?></h4>
                <a class="dt-button btn btn-primary btn-add-record ms-2" tabindex="0" aria-controls="DataTables_Table_0"
                    href="<?php echo e(route('payment.add')); ?>">
                    <span><?php echo e(__('pages.add_new')); ?></span>
                </a>
            </div>
            <div class="mx-2 card-datatable table-responsive pt-0">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th><?php echo e(__('pages.sn')); ?></th>
                            <th><?php echo e(__('pages.name')); ?></th>
                            <th><?php echo e(__('pages.balance')); ?></th>
                            <th><?php echo e(__('pages.option')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($method->name); ?></td>
                                <td><?php echo e($setting->currency); ?><?php echo e(number_format($method->balance, 2)); ?></td>
                                <td><a onclick="return confirm('Are you sure?')"
                                        href="<?php echo e(route('payment.delete', $method->id)); ?>" class="badge bg-danger"><i
                                            class="fas fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td></td>
                            <td class="text-end bg-warning fw-bold"><?php echo e(translate('Total Balance ')); ?></td>
                            <td><strong><?php echo e(number_format($total_balance, 2)); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/method/list.blade.php ENDPATH**/ ?>