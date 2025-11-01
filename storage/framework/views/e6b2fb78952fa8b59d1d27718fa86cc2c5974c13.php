<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-address-card"></i>
        <p>
            Karyawan
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">3</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.employees.create')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Karyawan</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.employees.index')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Karyawan</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.employees.attendance')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Absensi Karyawan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-check-o"></i>
        <p>
            Daftar Cuti Karyawan
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">1</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.leaves.index')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Cuti</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-clock"></i>
        <p>
            Kelola Lembur
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.expenses.setting_index')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Setting Lembur</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.expenses.index')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Lembur</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Hari Libur
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.holidays.create')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Hari Libur</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="<?php echo e(route('admin.holidays.index')); ?>"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Hari Libur</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="<?php echo e(route('admin.penggajian.index')); ?>" class="nav-link <?php echo e((request()->is('admin/penggajian*')) ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-money-bill-wave"></i>
        <p>
            Penggajian Karyawan
        </p>
    </a>
</li><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/includes/admin/sidebar_items.blade.php ENDPATH**/ ?>