






<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <!-- Add Shop Form -->
            <div class="col-md-8">
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

                        <form action="<?php echo e(route('shops.store')); ?>" method="POST" enctype="multipart/form-data">
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
                            <!-- Thana -->
                            <div class="mb-3">
                                <label for="Thanas" class="form-label">Thana</label>
                                <select class="form-control" id="Thanas" name="Thanas" required>
                                    <option value="">Select Thana</option>
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
                        
                            <button type="submit" class="btn btn-primary">Add Shop</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Shop List
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <table id="shopsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Site Title</th>
                                    <th>Status</th>
                                    <th>Upazilla ID</th>
                                    <th>Shop ID</th>
                                    <th>Action</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($shop->id); ?></td>
                                        <td><?php echo e($shop->name); ?></td>
                                        <td><?php echo e($shop->phone); ?></td>
                                        <td><?php echo e($shop->site_title); ?></td>
                                        <td><?php echo e($shop->status); ?></td>
                                        <td><?php echo e($shop->upazilla_id); ?></td>
                                        <td><?php echo e($shop->SHOP_ID); ?></td>

                                        <td>
                                            <a href="<?php echo e(route('shop.edit', $shop->id)); ?>" class="btn btn-primary"
                                                style="color:white;">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


    <!-- Include jQuery if not already included -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    

<script>
    $(document).ready(function() {
        $('#division').on('change', function() {
            var divisionId = $(this).val();
            console.log('Selected Division ID:', divisionId); // Debug line
            if (divisionId) {
                $.ajax({
                    url: '<?php echo e(route('get-districts', '')); ?>/' + divisionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Received Data:', data); // Debug line
                        $('#district').empty();
                        $('#district').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus); // Debug line
                    }
                });
            } else {
                $('#district').empty();
                $('#district').append('<option value="">Select District</option>');
            }
        });

        $('#district').on('change', function() {
            var districtId = $(this).val();
            console.log('Selected District ID:', districtId); // Debug line
            if (districtId) {
                $.ajax({
                    url: '<?php echo e(route('get-thanas', '')); ?>/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Received Data:', data); // Debug line
                        $('#Thanas').empty();
                        $('#Thanas').append('<option value="">Select Thana</option>');
                        $.each(data, function(key, value) {
                            $('#Thanas').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus); // Debug line
                    }
                });
            } else {
                $('#Thanas').empty();
                $('#Thanas').append('<option value="">Select Thana</option>');
            }
        });
    });
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/shop/shops.blade.php ENDPATH**/ ?>