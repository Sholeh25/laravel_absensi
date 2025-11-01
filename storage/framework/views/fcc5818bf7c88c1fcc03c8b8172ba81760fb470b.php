<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="<?php echo e(Session::token()); ?>">
        <title>Web Absensi | Dashboard</title>
        
        <link rel="icon" href="<?php echo e(asset('img/partner.png')); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
        />
        
        <link rel="stylesheet" href="<?php echo e(asset('dist/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>"
        />

        <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.css')); ?>" />
        <link
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
            rel="stylesheet"
        />
    <link
    rel="stylesheet"
    href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>"
    />
    <link
    rel="stylesheet"
    href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>"
    />
    <link
    rel="stylesheet"
    href="<?php echo e(asset('DataTables/Buttons-1.6.3/css/buttons.dataTables.min.css')); ?>"
    />
    <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
    
    <style>
        .hide-input {
            display: none;
        }
        .proftable tr td:first-child {
            font-weight: bold;
            color: rgb(11, 72, 138);
        }
    </style>
    </head>
        <?php if(auth()->guard()->guest()): ?>

        <body class="hold-transition login-page">
            
            <?php echo $__env->yieldContent('content'); ?>

        <?php else: ?>
        <?php if(Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset' || Route::currentRouteName() == 'password.confirm'): ?>
        <body class="hold-transition login-page">
            
            <?php echo $__env->yieldContent('content'); ?>
        <?php else: ?>
        <body class="hold-transition sidebar-mini layout-fixed">

            <div class="wrapper">
                
                <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('includes.main_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="content-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
                </div>
                <footer class="main-footer">
                    <strong
                        >Dibuat &copy; Oktober 2025, oleh
                        <a href=>Solehhudin</a>.</strong
                    >
                   
                    </div>
                </footer>
                <aside class="control-sidebar control-sidebar-dark">
                    </aside>
                </div>
            <?php endif; ?>

        <?php endif; ?>


        <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
        <script>
            $.widget.bridge("uibutton", $.ui.button);
        </script>
        <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

        <script src="<?php echo e(asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
        <script src="<?php echo e(asset('dist/js/adminlte.js')); ?>"></script>
        
        
        
        <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-colreorder/js/dataTables.colReorder.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/jszip/jszip.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/pdfmake/pdfmake.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/pdfmake/vfs_fonts.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
        
        
        <?php echo $__env->yieldContent('extra-js'); ?>
    </body>
</html><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/layouts/app.blade.php ENDPATH**/ ?>