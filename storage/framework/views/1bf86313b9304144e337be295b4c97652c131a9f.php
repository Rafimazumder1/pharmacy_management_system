

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Requisitions</h1>

        <!-- Filter Form for Shop and APPR_1 -->
        <form method="GET" action="<?php echo e(route('requisitions.byShop')); ?>" class="form-inline mb-4">
            <div class="form-group mr-3">
                <label for="shop_id" class="mr-2">Select Shop:</label>
                <select name="shop_id" id="shop_id" class="form-control" onchange="this.form.submit()">
                    <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($shop->id); ?>" <?php echo e($shopId == $shop->id ? 'selected' : ''); ?>>
                            <?php echo e($shop->id); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="appr" class="mr-2">Filter by Approval Status (APPR_1):</label>
                <select name="appr" id="appr" class="form-control" onchange="this.form.submit()">
                    <option value="N" <?php echo e($approvalStatus == 'N' ? 'selected' : ''); ?>>Not Approved (N)</option>
                    <option value="Y" <?php echo e($approvalStatus == 'Y' ? 'selected' : ''); ?>>Approved (Y)</option>
                </select>
            </div>
        </form>

        <?php if($requisitions->isEmpty()): ?>
            <p>No requisitions found for the selected shop with APPR_1 = '<?php echo e($approvalStatus); ?>'.</p>
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