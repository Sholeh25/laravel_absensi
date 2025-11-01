<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
                ><i class="fas fa-bars"></i
            ></a>
        </li>

    </ul>


    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <?php if(Auth::user()->employee && Auth::user()->employee->photo): ?>
                    
                    <img src="<?php echo e(asset('storage/employee_photos/' . Auth::user()->employee->photo)); ?>" class="user-image img-circle elevation-2" alt="User Image">
                <?php else: ?>
                    
                    <img src="<?php echo e(asset('dist/img/firyanul.png')); ?>" class="user-image img-circle elevation-2" alt="User Image">
                <?php endif; ?>
                <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                <?php if(Auth::user()->employee && Auth::user()->employee->photo): ?>
                    
                    <img  src="<?php echo e(asset('storage/employee_photos/' . Auth::user()->employee->photo)); ?>"
                    class="img-circle elevation-2" alt="User Image">
                <?php else: ?>
                    
                    <img src="<?php echo e(asset('dist/img/user2-160x160.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
                <?php endif; ?>
        
                <p>
                    <?php echo e(Auth::user()->name); ?>

                    <?php if( Auth::user()->employee ): ?>
                    - <?php echo e(Auth::user()->employee->desg); ?>, <?php echo e(Auth::user()->employee->department->name); ?>

                    <?php endif; ?> 
                </p>
                </li>
                <li class="user-body text-center">
                    <?php if( Auth::user()->employee ): ?>
                    <small>Terdaftar Sejak <?php echo e(Auth::user()->employee->join_date->format('d M, Y')); ?></small>
                    <?php endif; ?> 
                </li>
                <li class="user-footer">
                <div class="pull-left">
                    <?php if( Auth::user()->roles[0]['id'] == 2 ): ?>
                    <a href="<?php echo e(route('employee.profile')); ?>" class="btn btn-default btn-flat">Profil Karyawan</a>
                    <?php elseif(Auth::user()->roles[0]['id'] == 1): ?>
                    
                    <a href="<?php echo e(route('admin.profile', Auth::user()->employee->id)); ?>" class="btn btn-default btn-flat">Profil Admin</a>
                    <?php endif; ?>
                </div>
                <div class="pull-right">
                    <a href="<?php echo e(route('logout')); ?>" 
                    class="btn btn-default btn-flat"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >Sign out</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/includes/navbar.blade.php ENDPATH**/ ?>