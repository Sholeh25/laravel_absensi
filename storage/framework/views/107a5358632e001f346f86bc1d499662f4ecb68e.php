        

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Karyawan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.index')); ?>">Dashboard Admin</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Daftar Karyawan
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php echo $__env->make('messages.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title text-center">
                            Karyawan
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <?php if($employees->count()): ?>
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Department</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Gaji</th>
                                    <th class="none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($employee->first_name.' '.$employee->last_name); ?></td>
                                    <td><?php echo e($employee->department->name); ?></td>
                                    <td><?php echo e($employee->desg); ?></td>
                                    <td><?php echo e($employee->join_date->format('d M, Y')); ?></td>
                                    <td><?php echo e($employee->salary); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.employees.profile', $employee->id)); ?>" class="btn btn-flat btn-info">Lihat Profil</a>
                                        <button 
                                        class="btn btn-flat btn-danger"
                                        data-toggle="modal" 
                                        data-target="#deleteModalCenter<?php echo e($index + 1); ?>"
                                        >Hapus Karyawan</button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                            <?php for($i = 1; $i < $employees->count()+1; $i++): ?>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter<?php echo e($i); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1<?php echo e($i); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Yakin ingin dihapus?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">
                                                    
                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">Tidak</button>
                                                    
                                                    <form 
                                                    action="<?php echo e(route('admin.employees.delete', $employees->get($i-1)->id)); ?>"
                                                    method="POST"
                                                    >
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Aksi ini tidak bisa dilakukan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            <?php endfor; ?>
                        <?php else: ?>
                        <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                            <h4>Tidak Ada Data</h4>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <!-- general form elements -->
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra-js'); ?>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: ['copy','excel', 'csv', 'pdf']
                }
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/admin/employees/index.blade.php ENDPATH**/ ?>