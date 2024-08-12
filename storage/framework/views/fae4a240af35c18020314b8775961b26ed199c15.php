
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('requisitions.update', $requisition->id)); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="form-group">
                        <label for="medicine_id">Medicine</label>
                        <input type="text" class="form-control"
                            value="<?php echo e($requisition->medicine ? $requisition->medicine->name : 'N/A'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="new_medicine_id">Select New Medicine</label>
                        <select name="new_medicine_id" id="new_medicine_id" class="form-control">
                            <option value="">Select Medicine</option>
                            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Requisition No</label>
                        <input type="text" name="qty" id="qty" class="form-control"
                            value="<?php echo e($requisition->qty); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/edit.blade.php ENDPATH**/ ?>