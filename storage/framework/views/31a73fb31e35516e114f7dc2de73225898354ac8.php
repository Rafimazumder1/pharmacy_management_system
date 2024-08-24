

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('shop.update', $shop->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" name="id" id="id" class="form-control" value="<?php echo e($shop->id); ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <?php if($shop->image): ?>
                            <img src="<?php echo e(asset('storage/images/shops/' . $shop->image)); ?>" alt="shop image" height="50">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo e($shop->name); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo e($shop->phone); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="site_logo">Site Logo</label>
                        <input type="file" name="site_logo" id="site_logo" class="form-control">
                        <?php if($shop->site_logo): ?>
                            <img src="<?php echo e(asset('storage/images/shops/' . $shop->site_logo)); ?>" alt="site logo"
                                height="50">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" name="site_title" id="site_title" class="form-control"
                            value="<?php echo e($shop->site_title); ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" class="form-control"
                            value="<?php echo e($shop->status); ?>">
                    </div>


                    <button type="submit" class="btn btn-primary">Update Shop</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/shop/edit.blade.php ENDPATH**/ ?>