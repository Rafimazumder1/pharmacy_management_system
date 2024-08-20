

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Requisition Details for ID: <?php echo e($requisition->id); ?></h1>

        <!-- Display success or error messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Form to edit requisition details -->
        <form method="POST" action="<?php echo e(route('requisitions.updateDetails', $requisition->id)); ?>">
            <?php echo csrf_field(); ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $requisitionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <select name="details[<?php echo e($detail->medicine_id); ?>][medicine_id]" class="form-control">
                                    <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($medicine->id); ?>" <?php echo e($medicine->id == $detail->medicine_id ? 'selected' : ''); ?>>
                                            <?php echo e($medicine->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="details[<?php echo e($detail->medicine_id); ?>][qty]" value="<?php echo e($detail->qty); ?>" class="form-control" />
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success mt-3">Save Changes</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/details.blade.php ENDPATH**/ ?>