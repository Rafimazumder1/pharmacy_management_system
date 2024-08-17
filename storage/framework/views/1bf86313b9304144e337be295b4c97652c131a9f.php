

<?php $__env->startSection('content'); ?>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Requisitions List
            </div>
            <div class="card-body">
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


                <table id="requisitionsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Requisition ID</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = session()->get('temporary_requisitions', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($requisition['medicines'])): ?>
                                <?php $__currentLoopData = $requisition['medicines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <!-- Display the req_id only for the first medicine in the group -->
                                        <?php if($index == 0): ?>
                                            <td rowspan="<?php echo e(count($requisition['medicines'])); ?>">
                                                <?php echo e($requisition['req_id']); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($medicines->find($medicine['medicine_id'])->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($medicine['qty']); ?></td>
                                        <!-- Action buttons only for the first medicine row -->
                                        <?php if($index == 0): ?>
                                            <td rowspan="<?php echo e(count($requisition['medicines'])); ?>">
                                                <!-- Edit Button -->
                                                <a href="<?php echo e(route('requisitions.edit', ['req_id' => $requisition['req_id']])); ?>"
                                                    class="btn btn-primary">Edit</a>

                                                <!-- Delete Button -->
                                                <form
                                                    action="<?php echo e(route('requisitions.destroy', ['req_id' => $requisition['req_id']])); ?>"method="POST" style="display:inline-block;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>


                <!-- Form to finalize requisitions -->
                <form action="<?php echo e(route('requisitions.finalize')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">Finalize Requisitions</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/detail.blade.php ENDPATH**/ ?>