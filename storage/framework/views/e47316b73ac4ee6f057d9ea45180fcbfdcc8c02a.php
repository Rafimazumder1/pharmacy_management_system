

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Requisition
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

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                       
                        <form action="<?php echo e(route('requisitions.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                        
                            <div class="mb-3">
                                <label for="req_id" class="form-label">Requisition ID</label>
                                <input type="text" class="form-control" id="req_id" name="req_id" value="<?php echo e($req_id ?? old('req_id')); ?>" required>
                            </div>
                        
                            <div id="medicine-wrapper">
                                <div class="medicine-item mb-3">
                                    <label for="medicine" class="form-label">Medicine</label>
                                    <select class="form-control" name="medicines[0][medicine_id]" required>
                                        <option value="">Select Medicine</option>
                                        <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                        
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="medicines[0][qty]" required>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                        <!-- Button to reset req_id -->
                        
                        
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const reqIdInput = document.getElementById('req_id');
                                const resetButton = document.querySelector('.btn-warning');
                                
                                resetButton.addEventListener('click', function () {
                                    reqIdInput.removeAttribute('readonly');
                                });
                            });
                        </script>
                        
                        
                        
                       
                        
                        
                        

                        <script>
                            let medicineIndex = 1;

                            function addMedicineField() {
                                const wrapper = document.getElementById('medicine-wrapper');
                                const newMedicineItem = document.createElement('div');
                                newMedicineItem.classList.add('medicine-item', 'mb-3');

                                newMedicineItem.innerHTML = `
                                    <label for="medicine" class="form-label">Medicine</label>
                                    <select class="form-control" name="medicines[${medicineIndex}][medicine_id]" required>
                                        <option value="">Select Medicine</option>
                                        <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                        
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="medicines[${medicineIndex}][qty]" required>
                                `;

                                wrapper.appendChild(newMedicineItem);
                                medicineIndex++;
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>




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
                            
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = session()->get('temporary_requisitions', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($requisition['medicines'])): ?>
                                <?php $__currentLoopData = $requisition['medicines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <!-- Display medicine name -->
                                        <td><?php echo e($medicines->find($medicine['medicine_id'])->name ?? 'N/A'); ?></td>
                                        <!-- Display quantity -->
                                        <td><?php echo e($medicine['qty']); ?></td>
                                        <!-- Action buttons -->
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="<?php echo e(route('requisitions.edit', ['req_id' => $requisition['req_id']])); ?>"
                                                class="btn btn-primary">Edit</a>

                                            <!-- Delete Button -->
                                            <form
                                                action="<?php echo e(route('requisitions.destroy', ['req_id' => $requisition['req_id']])); ?>"
                                                method="POST" style="display:inline-block;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <!-- Form to finalize requisitions -->
                <form action="<?php echo e(route('requisitions.finalize')); ?>" method="POST" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">Finalize Requisitions</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
    <script>
        $(document).ready(function() {
            $('#requisitionsTable').DataTable();
        });

        // Clear requisition list from session storage on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Clear session storage
            // sessionStorage.removeItem('temporary_requisitions'); // Uncomment if using sessionStorage
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/requisitions/index.blade.php ENDPATH**/ ?>