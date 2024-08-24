

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Requisitions</h1>

        <?php if($requisitions->isEmpty()): ?>
            <p>No requisitions found for your shop with APPR_1 = 'N'.</p>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Requisition ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($requisition->id); ?></td>
                            <td>
                                <a href="<?php echo e(route('requisitions.details', ['id' => $requisition->id])); ?>" class="btn btn-primary">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/detail.blade.php ENDPATH**/ ?>