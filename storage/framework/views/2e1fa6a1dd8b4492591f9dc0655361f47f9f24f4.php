<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item <?php echo e(active_if_full_match('dashboard')); ?>">
        <a class="d-flex align-items-center" href="<?php echo e(route('dashboard')); ?>">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards"><?php echo e(__('pages.dashboard')); ?></span>
        </a>
    </li>
    <li class=" nav-item <?php echo e(active_if_match('customer/add')); ?> || <?php echo e(active_if_match('customer/list')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-users"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                <?php echo e(__('pages.customer')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('customer/add')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('customer.add')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(__('pages.customer_add')); ?>

                    </span>
                </a>
            </li>
            <li
                class="<?php echo e(active_if_full_match('customer/list')); ?> <?php echo e(active_if_full_match('customer/edit/*')); ?> <?php echo e(active_if_full_match('customer/view/*')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('customer.list')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        <?php echo e(__('pages.customer_list')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>

    
    <li class="nav-item <?php echo e(active_if_match('shops')); ?>">
        <a class="d-flex align-items-center" href="<?php echo e(route('shops')); ?>">
            <i class="fa-solid fa-shop"></i>
            <span class="menu-title text-truncate" data-i18n="Shops">
                <?php echo e(__('Shops')); ?>

            </span>
        </a>
    </li>

    <li
        class=" nav-item <?php echo e(active_if_match('in_stock')); ?> || <?php echo e(active_if_match('emergency-stock')); ?> || <?php echo e(active_if_match('medicines/stockout')); ?> || <?php echo e(active_if_match('upcoming')); ?> || <?php echo e(active_if_match('medicines/expired')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-pills"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                <?php echo e(translate('Medicine Stock')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('in_stock')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('instock')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('In Stock')); ?>

                    </span>
                </a>
            </li>
            
            <li class="<?php echo e(active_if_full_match('medicines/lowstock')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('lowstock')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Low Stock')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/stockout')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('stockout')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Stockout')); ?>

                    </span>
                </a>
            </li>


            <li class="<?php echo e(active_if_full_match('upcoming')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('upcoming')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Upcoming Expired')); ?>

                    </span>
                </a>
            </li>

            <li class="<?php echo e(active_if_full_match('medicines/expired')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('expired')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Already Expired')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>

    <!--Systems menus -->
    <li class=" nav-item <?php echo e(active_if_match('admin/admin')); ?> || <?php echo e(active_if_match('admin/role')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-cogs"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                <?php echo e(translate('Systems')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('admin/admin')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('admin.index')); ?>">
                    <i class="fas fa-user"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Admin User')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('admin/role')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('role.index')); ?>">
                    <i class="fas fa-lock"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Roles')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('admin/config/mail-sms')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('admin.mail_sms_config')); ?>">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(translate('Config. Mail ')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>

    <!--Requisitions menus -->
    

    <?php
    $userRole = Auth::user()->role; // Assuming 'role' is the attribute that stores the user's role
?>

<?php
    // Assuming $allowedRoleIds is an array of role IDs that should have access
    $allowedRoleIds = [1,2]; // Replace these with the actual role IDs for 'Admin' and 'Operator'
?>

<?php if(in_array(auth()->user()->role_id, $allowedRoleIds)): ?>
    <li class="nav-item <?php echo e(active_if_match('requisitions/add')); ?> || <?php echo e(active_if_match('requisitions/details')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-circle-plus"></i>
            <span class="menu-title text-truncate" data-i18n="Requisitions">
                <?php echo e(__('Requisitions')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('requisitions/add')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('requisitions')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Add Requisition">
                        <?php echo e(__('Add Requisition')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('requisitions/details')); ?>">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Details Requisition">
                        <?php echo e(__('Details Requisition')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>


    
    

    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Support\Facades\File;
    ?>
    <!-- Ecommerce Setup -->
    <?php if(Schema::hasTable('settings') && Schema::hasTable('products')): ?>
        <li class=" nav-item <?php echo e(active_if_match('ecommerce/*')); ?>">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-shopping-bag"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    <?php echo e(__('pages.Ecommerce Management')); ?>

                </span>
            </a>
            
        </li>
    <?php endif; ?>

    <!-- HRM -->
    <?php if(Schema::hasTable('attendances') && Schema::hasTable('departments')): ?>
        <li class="nav-item <?php echo e(active_if_match('hrm/*')); ?>">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-address-book"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    <?php echo e(__('pages.HR Management')); ?>

                </span>
            </a>
            <ul class="menu-content">
                <li class="<?php echo e(active_if_full_match('hrm/employee/designation')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('hrm.department.index')); ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Departments')); ?>

                        </span>
                    </a>
                </li>
                <li class="<?php echo e(active_if_full_match('hrm/employee/designation')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('hrm.designation.index')); ?>">
                        <i class="fas fa-user-cog"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Designations')); ?>

                        </span>
                    </a>
                </li>
                <li class="<?php echo e(active_if_full_match('hrm/employee')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('hrm.employee.index')); ?>">
                        <i class="fas fa-user-friends"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Employees')); ?>

                        </span>
                    </a>
                </li>
                <li
                    class="<?php echo e(active_if_full_match('hrm/attendance')); ?> || <?php echo e(active_if_full_match('hrm/attendance/*')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('hrm.attendance.index')); ?>">
                        <i class="fas fa-user-check"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Attendance')); ?>

                        </span>
                    </a>
                </li>
                <li class="<?php echo e(active_if_match('hrm/payroll/*')); ?>">
                    <a class="d-flex align-items-center" href="#">
                        <i class="fas fa-pager"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Payroll')); ?>

                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="<?php echo e(active_if_full_match('hrm/payroll/benefit')); ?>">
                            <a class="d-flex align-items-center" href="<?php echo e(route('hrm.benefit.index')); ?>">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">
                                    <?php echo e(__('pages.Benefits')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="<?php echo e(active_if_full_match('hrm/payroll/salary-setup')); ?>">
                            <a class="d-flex align-items-center" href="<?php echo e(route('hrm.salarysetup.index')); ?>">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    <?php echo e(__('pages.Salary Setup')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="<?php echo e(active_if_full_match('hrm/payroll/salary-sheet/generate')); ?>">
                            <a class="d-flex align-items-center" href="<?php echo e(route('hrm.salarysheet.generate')); ?>">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    <?php echo e(__('pages.Salary Generate')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="<?php echo e(active_if_full_match('hrm/payroll/salary-sheet')); ?>">
                            <a class="d-flex align-items-center" href="<?php echo e(route('hrm.salarysheet.index')); ?>">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    <?php echo e(__('pages.Salary Sheet')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo e(active_if_full_match('hrm/expense')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('hrm.expense.index')); ?>">
                        <i class="fas fa-wallet"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            <?php echo e(__('pages.Expense')); ?>

                        </span>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    <li class=" nav-item <?php echo e(active_if_match('supplier/*')); ?>"><a class="d-flex align-items-center"
            href="#"><i class="fa-solid fa-people-carry-box"></i><span class="menu-title text-truncate"
                data-i18n="Invoice"><?php echo e(__('pages.supplier')); ?></span></a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('supplier/add')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('supplier.add')); ?>"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        <?php echo e(__('pages.supplier_add')); ?>

                    </span>
                </a>
            </li>
            <li
                class="<?php echo e(active_if_full_match('supplier/list*')); ?> <?php echo e(active_if_full_match('supplier/edit/*')); ?> <?php echo e(active_if_full_match('supplier/view/*')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('supplier.list')); ?>"><i
                        data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        <?php echo e(__('pages.supplier_list')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>

    <!-- Vendors Routes -->
    <li class=" nav-item <?php echo e(active_if_match('vendor/*')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-store"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice"><?php echo e(__('pages.vendors')); ?></span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('vendor/create')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('vendor.create')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List"><?php echo e(__('pages.vendor_add')); ?></span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('vendor/list')); ?> <?php echo e(active_if_full_match('vendor/*/view')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('vendor.index')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(__('pages.vendor_list')); ?></span></a>
            </li>
        </ul>
    </li>


    <li
        class=" nav-item <?php echo e(active_if_match('medicines/add')); ?> || <?php echo e(active_if_match('medicines/list')); ?> || <?php echo e(active_if_match('medicines/import')); ?> || <?php echo e(active_if_match('medicines/categories')); ?> || <?php echo e(active_if_match('medicines/unit')); ?> || <?php echo e(active_if_match('medicines/leaf')); ?> || <?php echo e(active_if_match('medicines/types')); ?>">
        <a class="d-flex align-items-center" href="#"><i class="fas fa-pills"></i><span
                class="menu-title text-truncate" data-i18n="Invoice"><?php echo e(__('pages.medicine')); ?></span></a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('medicines/add')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('medicine.add')); ?>"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="List"><?php echo e(__('pages.medicine_add')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/list')); ?> <?php echo e(active_if_match('medicines/edit/*')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('medicine.list')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(__('pages.medicine_list')); ?></span></a>
            </li>

            <li class="<?php echo e(active_if_full_match('medicines/categories')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('category')); ?>"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Add"><?php echo e(__('pages.categories')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/unit')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('units')); ?>"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add"><?php echo e(__('pages.units')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/leaf')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('leaf')); ?>"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add"><?php echo e(__('pages.leaf')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/type*')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('types')); ?>"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add"><?php echo e(__('pages.types')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('medicines/import')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('medicines.import')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Medicine Import">
                        <?php echo e(__('pages.Medicine Import')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>


    <li class=" nav-item <?php echo e(active_if_match('purchase/*')); ?> "><a class="d-flex align-items-center"
            href="#"><i class="fas fa-cart-shopping"></i><span class="menu-title text-truncate"
                data-i18n="Invoice"><?php echo e(__('pages.purchase')); ?></span></a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('purchase/create')); ?> <?php echo e(active_if_match('purchase/create')); ?>"><a
                    class="d-flex align-items-center" href="<?php echo e(route('purchase.create')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="List"><?php echo e(__('pages.new_purchase')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('purchase/index')); ?> <?php echo e(active_if_match('purchase/index')); ?>"><a
                    class="d-flex align-items-center" href="<?php echo e(route('purchase.index')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(__('pages.purchase_history')); ?></span></a>
            </li>
            <li class="<?php echo e(active_if_full_match('purchase/return-history')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('purchase.return')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(translate('Return History')); ?></span></a>
            </li>
        </ul>
    </li>

    <li class=" nav-item <?php echo e(active_if_match('invoice*')); ?> || <?php echo e(active_if_match('returned_history')); ?>"><a
            class="d-flex align-items-center" href="#"><i class="fa-solid fa-file-invoice"></i><span
                class="menu-title text-truncate" data-i18n="Invoice"><?php echo e(translate('Sales')); ?></span></a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('invoice/new*')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('pos.index')); ?>"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="List"><?php echo e(translate('New Invoice')); ?></span></a>
            </li>
            <li class="active_if_full_match('invoice/reports*') }} <?php echo e(active_if_match('invoice/reports')); ?>"><a
                    class="d-flex align-items-center" href="<?php echo e(route('invoice.reports')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(translate('Invoice History')); ?></span></a>
            </li>
            <li class="active_if_full_match('returned_history') }} <?php echo e(active_if_match('returned_history')); ?>"><a
                    class="d-flex align-items-center" href="<?php echo e(route('return.history')); ?>"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview"><?php echo e(translate('Return History')); ?></span></a>
            </li>
        </ul>
    </li>
    <li
        class=" nav-item <?php echo e(active_if_match('report/medicine/topsell')); ?> || <?php echo e(active_if_match('report/customer-due')); ?> || <?php echo e(active_if_match('report/supplier/due')); ?> || <?php echo e(active_if_match('reports')); ?> || <?php echo e(active_if_match('profit')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-chart-line"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                <?php echo e(translate('Reports')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('report/customer/due')); ?>"><a class="d-flex align-items-center"
                    href="<?php echo e(route('report.customer_due')); ?>"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="List"><?php echo e(__('pages.customer_due')); ?></span></a>
            </li>
            <li
                class="<?php echo e(active_if_full_match('report/supplier/due')); ?> <?php echo e(active_if_match('report/supplier/due')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('report.supplier_due')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Add"><?php echo e(translate('Payable Manufacturer')); ?>

                    </span>
                </a>
            </li>
            <li class="active_if_full_match('reports') }} <?php echo e(active_if_match('reports')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('reports')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        <?php echo e(translate('Sells & Purchase Reports')); ?>

                    </span>
                </a>
            </li>
            <li
                class="active_if_full_match('report/medicine/topsell') }} <?php echo e(active_if_match('report/medicine/topsell')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('report.topsell_medicine')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        <?php echo e(translate('Top Sell Medicine')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('profit')); ?> <?php echo e(active_if_match('profit')); ?>">
                <a class="d-flex align-items-center" href="<?php echo e(route('profit')); ?>">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        <?php echo e(translate('Medicine Profit & Loss')); ?>

                    </span>
                </a>
            </li>
            <?php if(Schema::hasTable('expenses')): ?>
                <li
                    class="<?php echo e(active_if_full_match('report/business/profit-loss')); ?> <?php echo e(active_if_match('report/business/profit-loss')); ?>">
                    <a class="d-flex align-items-center" href="<?php echo e(route('report.businessprofitloss')); ?>">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="Preview">
                            <?php echo e(translate('Business Profit & Loss')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li
        class=" nav-item <?php echo e(active_if_match('doctor')); ?> || <?php echo e(active_if_match('patient')); ?> || <?php echo e(active_if_match('test')); ?> || <?php echo e(active_if_match('prescription')); ?>">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-prescription"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                <?php echo e(translate('Prescription')); ?>

            </span>
        </a>
        <ul class="menu-content">
            <li class="<?php echo e(active_if_full_match('doctor/index')); ?>">
                <a class="d-flex align-items-center " href="<?php echo e(route('doctor.index')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        <?php echo e(translate('Doctors')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('patient/*')); ?>">
                <a class="d-flex align-items-center " href="<?php echo e(route('patient.index')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        <?php echo e(translate('Patients')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('test/*')); ?>">
                <a class="d-flex align-items-center " href="<?php echo e(route('test.index')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        <?php echo e(translate('Diagnosis & Tests')); ?>

                    </span>
                </a>
            </li>
            <li class="<?php echo e(active_if_full_match('prescription/*')); ?>">
                <a class="d-flex align-items-center " href="<?php echo e(route('prescription.index')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        <?php echo e(translate('Prescriptions')); ?>

                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item <?php echo e(active_if_full_match('payment_methdod')); ?>">
        <a class="d-flex align-items-center" href="<?php echo e(route('payment.method')); ?>">
            <i class="fa-solid fa-money-bill-wave"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards">
                <?php echo e(__('pages.payment_method')); ?>

            </span>
        </a>
    </li>

    <li class=" nav-item <?php echo e(active_if_full_match('settings')); ?>">
        <a class="d-flex align-items-center" href="<?php echo e(route('settings')); ?>">
            <i class="fa-solid fa-cog"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards">
                <?php echo e(__('pages.site_setting')); ?>

            </span>
        </a>
    </li>
</ul>
<?php /**PATH E:\xampp\htdocs\PHARMACY\resources\views/layouts/menus/shop_admin_route.blade.php ENDPATH**/ ?>