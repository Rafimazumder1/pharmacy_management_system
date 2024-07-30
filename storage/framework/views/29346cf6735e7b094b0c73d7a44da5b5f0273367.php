<?php $__env->startSection('title', __('pages.medicines')); ?>
<?php $__env->startSection('custom-css'); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="app-user-list">
      <div class="card">
        <div class="card-body border-bottom">
            <h4 class="card-title"><?php echo e(__('pages.medicines')); ?></h4>
                
        </div>
        <div class="mx-2 card-datatable table-responsive pt-0">
            <table class="user-list-table table table-bordered border-dark">
                <thead class="table-light">
                    <tr>
                        <th><?php echo e(__('pages.sn')); ?></th>
                        <th><?php echo e(__('pages.medicine_name')); ?></th>
                        <th><?php echo e(__('pages.generic_name')); ?></th>
                        <th><?php echo e(__('pages.category')); ?></th>
                        <th><?php echo e(__('pages.supplier')); ?></th>
                        <th><?php echo e(__('pages.shelf')); ?></th>
                        <th><?php echo e(__('pages.price')); ?></th>
                        <th><?php echo e(__('pages.buy_price')); ?></th>
                        <th><?php echo e(__('pages.strength')); ?></th>
                        <th><?php echo e(__('pages.image')); ?></th>
                       <th><?php echo e(__('pages.option')); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
                          
      </div>
      <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in"></div>
     
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>


 <!-- BEGIN: Page Vendor JS-->
 

   
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')); ?>"></script>
   
    <!-- END: Page Vendor JS-->
     <script>
         $(function () {
    
    var table = $('.user-list-table').DataTable({
        processing: true,
        ajax: "<?php echo e(route('medicine.list')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'generic_name', name: 'generic_name'},
            {data: 'category', name: 'category',searchable: false},
            {data: 'supplier', name: 'supplier',searchable: false},
            {data: 'shelf', name: 'shelf'},
            {data: 'price', name: 'price'},
            {data: 'buy_price', name: 'buy_price'},
            {data: 'strength', name: 'strength'},
            {data: 'picture', name: 'picture',searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
       
        
    });
    
  });
     </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/medicine/index.blade.php ENDPATH**/ ?>