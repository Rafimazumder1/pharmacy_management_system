

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Approval Requisitions</h1>

        <?php if($requisitions->isEmpty()): ?>
            <p>No requisitions found for approval.</p>
        <?php else: ?>
            <form method="POST" action="<?php echo e(route('requisitions.updateApproval')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Master dropdown to set all approval statuses -->
                <div class="form-group d-flex align-items-center">
                    <label for="masterApprovalStatus" class="mr-2">Set All Approval Status:</label>
                    <select id="masterApprovalStatus" class="form-control mr-2" onchange="setAllApprovalStatuses(this.value)">
                        <option value="">Set All Approval Status...</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                        <option value="C">Cancel</option>
                    </select>
                    
                    <!-- Save All button -->
                    <button type="button" class="btn btn-success" onclick="saveAllStatuses()">Save All</button>
                </div>

                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Requisition ID</th>
                            <th>Approval Status (APPR_1)</th>
                            <th>Details</th>
                            <th>Save</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($requisition->id); ?></td>

                                <td>
                                    <select name="approval_status[<?php echo e($requisition->id); ?>]" class="form-control approval-status">
                                        <option value="Y" <?php echo e($requisition->appr_1 == 'Y' ? 'selected' : ''); ?>>Yes</option>
                                        <option value="N" <?php echo e($requisition->appr_1 == 'N' ? 'selected' : ''); ?>>No</option>
                                        <option value="C" <?php echo e($requisition->appr_1 == 'C' ? 'selected' : ''); ?>>Cancel</option>
                                    </select>
                                </td>

                                <td>
                                    <a href="<?php echo e(route('requisitions.details', ['id' => $requisition->id])); ?>" class="btn btn-primary">Details</a>
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // JavaScript function to set all approval statuses
        function setAllApprovalStatuses(value) {
            // Get all dropdowns with the class 'approval-status'
            const approvalDropdowns = document.querySelectorAll('.approval-status');
            // Loop through each dropdown and set its value to the selected one
            approvalDropdowns.forEach(function(dropdown) {
                dropdown.value = value;
            });
        }

        // JavaScript function to submit the form when "Save All" is clicked
        function saveAllStatuses() {
            // Find the form element
            const form = document.querySelector('form');
            // Submit the form
            form.submit();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/approval.blade.php ENDPATH**/ ?>