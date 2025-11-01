<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Admin</h1>
            </div><div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Halaman Utama</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div></div></div></div>
<section class="content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body text-center p-5">

                        <img src="<?php echo e(asset('img/LOGO FORESTHREE.jpg')); ?>" alt="Logo Foresthree" class="mb-4 d-block mx-auto" style="width: 90px; height: auto;">

                        <h1 class="display-5 text-primary font-weight-bold mb-3" style="font-size: 2.5rem;">
                            Selamat Datang di Panel Admin<br>Website Absensi
                        </h1>
                        <p class="lead mb-2" style="font-size: 1.1rem; color: #555;">
                            Sistem ini dibuat untuk mendukung operasional <strong>PT Foresthree Waralaba Indonesia</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div></section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/admin/index.blade.php ENDPATH**/ ?>