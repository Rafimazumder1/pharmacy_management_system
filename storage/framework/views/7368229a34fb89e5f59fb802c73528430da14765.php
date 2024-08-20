
<?php $__env->startSection('title', __('pages.customer_list')); ?>

<?php $__env->startSection('custom-css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="sms-sender">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4 class="card-title">Configure your email & SMS Setting.</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.mail_sms_config')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 ">
                            <h4>Email Setting</h4>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL DRIVER</label>
                                <input type="text" name="MAIL_DRIVER" value="<?php echo e($config['MAIL_DRIVER']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL HOST</label>
                                <input type="text" name="MAIL HOST" value="<?php echo e($config['MAIL_HOST']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL PORT</label>
                                <input type="text" name="MAIL_PORT" value="<?php echo e($config['MAIL_PORT']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL USERNAME</label>
                                <input type="text" name="MAIL_USERNAME" value="<?php echo e($config['MAIL_USERNAME']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL PASSWORD</label>
                                <input type="text" name="MAIL_PASSWORD" value="<?php echo e($config['MAIL_PASSWORD']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL ENCRYPTION</label>
                                <input type="text" name="MAIL_ENCRYPTION" value="<?php echo e($config['MAIL_ENCRYPTION']); ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL FROM ADDRESS</label>
                                <input type="text" name="MAIL_FROM_ADDRESS" value="<?php echo e($config['MAIL_FROM_ADDRESS']); ?>"
                                    class="form-control" placeholder="info@companyname.com">
                            </div>
                            <div class="form-group mb-2">
                                <label class="">MAIL FROM NAME</label>
                                <input type="text" name="MAIL_FROM_NAME" value="<?php echo e($config['MAIL_FROM_NAME']); ?>"
                                    class="form-control" placeholder="Company name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/systems/mail_sms_config.blade.php ENDPATH**/ ?>