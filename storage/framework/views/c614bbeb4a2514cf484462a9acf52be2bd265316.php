

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <table id="shopsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Next Pay</th>
                            <th>Phone</th>
                            <th>Site Logo</th>
                            <th>Site Title</th>
                            <th>Status</th>
                            <th>Upazilla ID</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($shop->id); ?></td>
                                <td><img src="<?php echo e(asset('storage/images/shops/' . $shop->image)); ?>" alt="Image" width="50"></td>
                                <td><?php echo e($shop->name); ?></td>
                                <td><?php echo e($shop->next_pay); ?></td>
                                <td><?php echo e($shop->phone); ?></td>
                                <td><img src="<?php echo e(asset('storage/images/shops/' . $shop->site_logo)); ?>" alt="Site Logo" width="50"></td>
                                <td><?php echo e($shop->site_title); ?></td>
                                <td><?php echo e($shop->status); ?></td>
                                <td><?php echo e($shop->upazilla_id); ?></td>
                                <td><?php echo e($shop->username); ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="<?php echo e(route('shop.edit', $shop->id)); ?>" class="btn btn-primary">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="<?php echo e(route('shop.delete', $shop->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this shop?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#shopsTable').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/shop/list.blade.php ENDPATH**/ ?>