<!DOCTYPE html>
<html class="loading <?php if(\App\Models\Shop::where('id', Auth::user()->shop_id)->first()->theme == 'dark'): ?> dark-layout <?php endif; ?>" lang="<?php echo e(session()->get('locale')); ?>"
    data-layout="dark-layout" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta name="language" content="English">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="<?php echo e(\App\Models\Shop::setting('name')); ?>">
    <meta name="description" content="<?php echo e(\App\Models\Shop::setting('site_title')); ?>">
    <meta name="keywords" content="<?php echo e(\App\Models\Shop::setting('site_title')); ?>">
    <meta name="author" content="<?php echo e(\App\Models\Shop::setting('name')); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io/">
    <meta property="og:title" content="<?php echo e(\App\Models\Shop::setting('name')); ?>">
    <meta property="og:description" content="<?php echo e(\App\Models\Shop::setting('site_title')); ?>">
    <meta property="og:image"
        content='<?php echo e(asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo'))); ?>'>

    <title>Admin | <?php echo e(\App\Models\Shop::setting('name')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

   <!-- Favicon -->
<link rel="apple-touch-icon" href="<?php echo e(asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo'))); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo'))); ?>">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

<!-- Vendor CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/vendors.min.css')); ?>?time=<?php echo e(time()); ?>">
<link href="<?php echo e(asset('dashboard/app-assets/fontawesome/css/all.css')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/charts/apexcharts.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/extensions/toastr.min.css')); ?>">


<!-- Datatable CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')); ?>">

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/bootstrap.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/bootstrap-extended.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/colors.min.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/components.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/themes/dark-layout.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/themes/bordered-layout.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/themes/semi-dark-layout.css')); ?>?time=<?php echo e(time()); ?>">

<!-- Page CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/core/menu/menu-types/vertical-menu.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/pages/dashboard-ecommerce.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/plugins/charts/chart-apex.css')); ?>?time=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/app-assets/css/plugins/extensions/ext-component-toastr.css')); ?>">

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dashboard/assets/css/style.css')); ?>?time=<?php echo e(time()); ?>">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <?php echo $__env->yieldContent('custom-css'); ?>

    <style>
        .main-menu.menu-dark .navigation>li ul .open>a,
        .main-menu.menu-dark .navigation>li ul .sidebar-group-active>a {
            background: linear-gradient(118deg, #7367f0, rgba(115, 103, 240, 0.7)) !important;
            box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%) !important;
            color: #fff !important;
            font-weight: 400;
            border-radius: 4px;
        }

        .py-1 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .dropdown-item {
            padding: 1rem 1rem !important;
        }

        .notification-dropdown {
            width: 310px !important;
        }

        .notification-box {
            height: 500px;
            overflow: hidden;
            overflow-y: scroll;
        }

        /* Hide the Google Translate bar */
        .goog-te-banner-frame {
            display: none !important;
        }

        /* Hide the Google Translate label */
        .goog-te-gadget {
            font-size: 0 !important;
        }

        /* Hide the Google Translate dropdown arrow */
        .goog-te-combo {
            display: none !important;
        }

        .goog-te-gadget-simple {
            width: 100%;
            border-radius: 7px;
            padding: 4px 6px !important;
            border: 1px solid #7367f0 !important;
        }

        div#google_translate_element {
            margin: 0 20px;
            max-width: 170px;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <?php
        $setting = Auth::user()->shop;
    ?>
    <!-- Header -->
    <?php echo $__env->make('layouts.elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sidebar -->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-4">
            <ul class="nav navbar-nav flex-row justify-content-between">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                        <span class="brand-logo">
                            <?php if($setting && $setting->site_logo): ?>
                                <img height="40" src="<?php echo '/storage/images/admin/site_logo/' . $setting->site_logo; ?>" alt="Logo" />
                            <?php endif; ?>
                        </span>
                        <?php if($setting): ?>
                            <h4 class="brand-text"><?php echo e(Str::limit($setting->name, 9)); ?></h4>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary"
                            data-feather="disc" data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <?php if(Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('layouts.menus.shop_admin_route', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.menus.shop_user_route', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- End Sidebar -->

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
            <div class="content-body">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- Vendor JS -->
    <!-- jQuery -->
<!-- jQuery -->
<script type="text/javascript" src="<?php echo e(asset('front/js/jquery.min.js')); ?>"></script>

<!-- Popper.js -->
<script type="text/javascript" src="<?php echo e(asset('dashboard/app-assets/morris-chart/popper.min.js')); ?>"></script>

<!-- Vendor JS -->
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/vendors.min.js')); ?>"></script>

<!-- Datatable assets -->
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')); ?>"></script>

<!-- Page Vendor JS -->
<script src="<?php echo e(asset('dashboard/app-assets/vendors/js/extensions/toastr.min.js')); ?>"></script>

<!-- Theme JS -->
<script src="<?php echo e(asset('dashboard/app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/app-assets/js/core/app.js')); ?>"></script>

<!-- Custom JS -->
<?php echo $__env->yieldContent('custom-js'); ?>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>

<script>
    jQuery(function() {
        // Add edit Attribute
        var maxField = 15; // Input fields increment limitation
        var addButton = $('.add_button'); // Add button selector
        var wrapper = $('.field_wrapper'); // Input field wrapper
        var fieldHTML =
            '<div class="field_wrapper"><div class="col-md-6"><div class="form-group"><label class="form-label" for="first-name-column"><?php echo e(translate('Feature Name')); ?></label><input type="text" class="form-control" name="features[]"></div></div><a href="javascript:void(0);" class="remove_button btn btn-danger my-3" title="Delete Field">Delete</a></div>'; // New input field html
        var x = 1; // Initial field counter is 1

        // Once add button is clicked
        $(addButton).click(function() {
            // Check maximum number of input fields
            if (x < maxField) {
                x++; // Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });

        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); // Remove field html
            x--; // Decrement field counter
        });
    });
</script>

<?php echo Toastr::message(); ?>


<script type="text/javascript">
    // Google Translate Element Initialization
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyyP05DROj8pB1slkFFeU8HE7fGehfG7WqD/JT3F" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha384-7/2nZV93IetRHDcMM+8KkfhpMA3pD8Wb+9k8BzG08J5ovzFJmW9OV9O+qOS9Bd4w" crossorigin="anonymous"></script>


</body>

</html>
<?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/layouts/app.blade.php ENDPATH**/ ?>