<aside class="main-sidebar sidebar-dark-primary elevation-4" style = "z-index: 1040 !important;">
    <a 
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-access')): ?>
        href="<?php echo e(route('admin.index')); ?>"
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-access')): ?>
        href="<?php echo e(route('employee.index')); ?>"
    <?php endif; ?>
    class="brand-link text-center">
        
        <span class="brand-text font-weight-light ">Website Absensi</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if(Auth::user()->employee && Auth::user()->employee->photo): ?>
                <img
                    src="<?php echo e(asset('storage/employee_photos/' . Auth::user()->employee->photo)); ?>"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                <?php else: ?>
                
                <img
                    src="<?php echo e(asset('dist/img/firyanul.png')); ?>"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                <?php endif; ?>
                
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo e(Auth::user()->name); ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-access')): ?>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard Admin
                        </p>
                    </a>
                </li>
                <?php echo $__env->make('includes.admin.sidebar_items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee-access')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('employee.index')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard Karyawan
                        </p>
                    </a>
                </li>
                <?php echo $__env->make('includes.employee.sidebar_items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </ul>
        </nav>
        </div>
    </aside><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/includes/main_sidebar.blade.php ENDPATH**/ ?>