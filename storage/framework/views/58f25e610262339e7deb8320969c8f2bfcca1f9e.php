

<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Penggajian</h1>
            </div><div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Halaman Utama</a></li>
                    <li class="breadcrumb-item active">Penggajian</li>
                </ol>
            </div></div></div></div>
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Gaji Karyawan</h3>
                <div class="card-tools">
                    <a href="<?php echo e(route('admin.penggajian.create')); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data Gaji
                    </a>
                </div>
            </div>
            <div class="card-body">

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penggajian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gaji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                
                                <td><?php echo e($gaji->employee ? $gaji->employee->name : 'Karyawan Dihapus'); ?></td> 
                                <td>Rp <?php echo e(number_format($gaji->gaji_pokok, 0, ',', '.')); ?></td>
                                <td>Rp <?php echo e(number_format($gaji->tunjangan, 0, ',', '.')); ?></td>
                                <td>Rp <?php echo e(number_format($gaji->gaji_pokok + $gaji->tunjangan, 0, ',', '.')); ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data penggajian.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div></section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/admin/penggajian/index.blade.php ENDPATH**/ ?>