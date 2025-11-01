        

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Absensi</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.index')); ?>">Dashboard Admin</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Absensi
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
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center">Tanggal Absensi</h5>
                    </div>
                    <form action="<?php echo e(route('admin.employees.attendance')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="input-group mx-auto" style="width:70%">
                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="text" name="date" id="date" class="form-control text-center" >
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-flat btn-primary" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php echo $__env->make('messages.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title text-center">
                            <?php if($date): ?>
                            Absensi Karyawan berdasarkan rentang tanggal <?php echo e($date); ?>                                
                            <?php else: ?>
                            Absensi Karyawan Hari ini
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <?php if($employees->count()): ?>
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Riwayat Database</th>
                                    <th class="none">Riwayat Awal Absensi</th>
                                    <th>Riwayat Absensi</th>
                                    <th class="none">Riwayat Akhir Absensi</th>
                                    <th>Lokasi</th>
                                    <th>Jabatan</th>
                                    <th class="none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($employee->first_name.' '.$employee->last_name); ?></td>
                                    <?php if($employee->attendanceToday): ?>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-success">Terekam</span></h6></td>
                                        <td>
                                            Terekam sejak <?php echo e($employee->attendanceToday->created_at->format('H:i:s')); ?> dari <?php echo e($employee->attendanceToday->entry_location); ?> dengan alamat IP <?php echo e($employee->attendanceToday->entry_ip); ?>

                                        </td>
                                        <?php if($employee->attendanceToday->time<=9 && $employee->attendanceToday->time>=7): ?>
                                            <td><h6 class="text-center"><span class="badge badge-pill badge-success">Hadir Tepat Waktu</span></h6></td>
                                        <?php elseif($employee->attendanceToday->time>9 && $employee->attendanceToday->time<=17): ?>
                                            <td><h6 class="text-center"><span class="badge badge-pill badge-warning">Hadir Terlambat</span></h6></td>
                                        <?php else: ?>
                                           ?><td><h6 class="text-center"><span class="badge badge-pill badge-danger">Absensi Tidak Valid</span></h6></td>
                                        <?php endif; ?>

                                        <?php if(!empty($employee->attendanceToday->exit_location)): ?>
                                            <td>
                                                Terekam sejak <?php echo e($employee->attendanceToday->updated_at->format('H:i:s')); ?> dari <?php echo e($employee->attendanceToday->exit_location); ?> dengan alamat IP <?php echo e($employee->attendanceToday->exit_ip); ?>

                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <h6 class="text-center"><span class="badge badge-pill badge-danger">Belum Ada Riwayat</span></h6></td>
                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">Belum Ada Riwayat</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">Belum Ada Riwayat</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">Belum Ada Riwayat</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">Belum Ada Riwayat</span></h6></td>
                                    <?php endif; ?>
                                    <td><?php echo e($employee->attendanceToday->entry_location ?? '-'); ?></td>
                                    <td><?php echo e($employee->desg); ?></td>
                                    <td>
                                        <?php if($employee->attendanceToday): ?>
                                        <button 
                                        class="btn btn-flat btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteModalCenter<?php echo e($employee->attendanceToday->id); ?>"
                                        >Hapus Riwayat</button>
                                        <?php else: ?> 
                                        Aksi Tidak Tersedia
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php for($i = 1; $i < $employees->count()+1; $i++): ?>
                                <!-- Modal -->
                                <?php if($employees->get($i-1)->attendanceToday): ?>
                                <div class="modal fade" id="deleteModalCenter<?php echo e($employees->get($i-1)->attendanceToday->id); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1<?php echo e($employees->get($i-1)->attendanceToday->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Yakin ingin dihapus?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">
                                                    
                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">Tidak</button>
                                                    
                                                    <form 
                                                    action="<?php echo e(route('admin.employees.attendance.delete', $employees->get($i-1)->attendanceToday->id)); ?>"
                                                    method="POST"
                                                    >
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Aksi tidak tersedia</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php else: ?>
                        <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                            <h4>Belum Ada Riwayat</h4>
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
                    buttons: ['copy','excel', 'csv', 'pdf'],
                }
            ]
        });
        $('#date').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "locale": {
                "format": "DD-MM-YYYY"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/admin/employees/attendance.blade.php ENDPATH**/ ?>