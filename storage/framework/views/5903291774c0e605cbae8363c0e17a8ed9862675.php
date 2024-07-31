

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Shop
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('shops.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            <!-- Division -->
                            <div class="mb-3">
                                <label for="division" class="form-label">Division</label>
                                <select class="form-control" id="division" name="division" required>
                                    <option value="">Select Division</option>
                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <!-- District -->
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <select class="form-control" id="district" name="district" required>
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <!-- Upazilla -->
                            <div class="mb-3">
                                <label for="upazilla" class="form-label">Upazilla</label>
                                <select class="form-control" id="upazilla" name="upazilla" required>
                                    <option value="">Select Upazilla</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="site_title" class="form-label">Site Title</label>
                                <input type="text" class="form-control" id="site_title" name="site_title">
                            </div>
                            <div class="mb-3">
                                <label for="site_logo" class="form-label">Site Logo</label>
                                <input type="file" class="form-control" id="site_logo" name="site_logo">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="next_pay" class="form-label">Next Pay</label>
                                <input type="date" class="form-control" id="next_pay" name="next_pay">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Shop</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/shop/add.blade.php ENDPATH**/ ?>