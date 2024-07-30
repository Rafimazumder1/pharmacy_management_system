<!DOCTYPE html>
<html class="loading @if (\App\Models\Shop::where('id', Auth::user()->shop_id)->first()->theme == 'dark') dark-layout @endif" lang="{{ session()->get('locale') }}"
    data-layout="dark-layout" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta name="language" content="English">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{ \App\Models\Shop::setting('name') }}">
    <meta name="description" content="{{ \App\Models\Shop::setting('site_title') }}">
    <meta name="keywords" content="{{ \App\Models\Shop::setting('site_title') }}">
    <meta name="author" content="{{ \App\Models\Shop::setting('name') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io/">
    <meta property="og:title" content="{{ \App\Models\Shop::setting('name') }}">
    <meta property="og:description" content="{{ \App\Models\Shop::setting('site_title') }}">
    <meta property="og:image"
        content='{{ asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo')) }}'>

    <title>Admin | {{ \App\Models\Shop::setting('name') }} - @yield('title')</title>

    <link rel="apple-touch-icon"
        href="{{ asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo')) }}">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('storage/images/admin/favicon/' . \App\Models\Shop::setting('site_logo')) }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <!-- Vendor CSS -->
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}?time={{ time() }}">

    <link href="{{ asset('dashboard/app-assets/fontawesome/css/all.css') }}" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/charts/apexcharts.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/extensions/toastr.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="/public/dashboard/app-assets/vendors/css/extensions/toastr.min.css">


    {{-- updated --}}
    <link rel="stylesheet" href="/public/dashboard/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" href="/public/dashboard/app-assets/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/public/dashboard/app-assets/vendors/css/charts/apexcharts.css">

    <!-- Datatable assets -->
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}"> --}}

    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">

    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}"> --}}

    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/bootstrap.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/bootstrap-extended.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/colors.min.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/components.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/themes/dark-layout.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/themes/bordered-layout.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/themes/semi-dark-layout.css?time={{ time() }}">

    <!-- Page CSS -->
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/core/menu/menu-types/vertical-menu.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/pages/dashboard-ecommerce.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/plugins/charts/chart-apex.css?time={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="/public/dashboard/app-assets/css/plugins/extensions/ext-component-toastr.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/public/dashboard/assets/css/style.css?time={{ time() }}">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    @yield('custom-css')

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
    @php
        $setting = Auth::user()->shop;
    @endphp
    <!-- Header -->
    @include('layouts.elements.header')

    <!-- Sidebar -->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-4">
            <ul class="nav navbar-nav flex-row justify-content-between">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <span class="brand-logo">
                            @if ($setting && $setting->site_logo)
                                <img height="40" src="<?php echo '/storage/images/admin/site_logo/' . $setting->site_logo; ?>" alt="Logo" />
                            @endif
                        </span>
                        @if ($setting)
                            <h4 class="brand-text">{{ Str::limit($setting->name, 9) }}</h4>
                        @endif
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
            @if (Auth::user()->role_id == 1)
                @include('layouts.menus.shop_admin_route')
            @else
                @include('layouts.menus.shop_user_route')
            @endif
        </div>
    </div>

    <!-- End Sidebar -->

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
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
    <script type="text/javascript" src="/public/front/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/dashboard/app-assets/morris-chart/popper.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/vendors.min.js"></script>

    <!-- Datatable assets -->
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/public/dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>

    <!-- Page Vendor JS -->
    <script src="/public/dashboard/app-assets/vendors/js/extensions/toastr.min.js"></script>

    <!-- Theme JS -->
    <script src="/public/dashboard/app-assets/js/core/app-menu.js"></script>
    <script src="/public/dashboard/app-assets/js/core/app.js"></script>

    @yield('custom-js')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <script>
        jQuery(function() {
            // Add edit Attribute
            var maxField = 15; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                '<div class="field_wrapper"><div class="col-md-6"><div class="form-group"><label class="form-label" for="first-name-column">{{ translate('Feature Name') }}</label><input type="text" class="form-control"  name="features[]"></div></div><a href="javascript:void(0);" class="remove_button btn btn-danger my-3" title="Delete Field">Delete</a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        // document.onkeydown = (keyDownEvent) => {
        //
        //     isKeyPressed[keyDownEvent.key] = true;
        //     if (isKeyPressed[18] && isKeyPressed[80]) {
        //         window.location = "urltest.html";
        //     }
        // };
    </script>

    {!! Toastr::message() !!}

    <script type="text/javascript">
        // function googleTranslateElementInit() {
        //     new google.translate.TranslateElement({
        //         pageLanguage: 'en',
        //         layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        //     }, 'google_translate_element');
        // }
    </script>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    {{-- bootstrap js --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>

</html>
