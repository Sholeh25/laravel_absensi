        

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Cuti Karyawan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.index')); ?>">Dashboard Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Cuti Karyawan
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
                <div class="col-lg-8 col-md-10 mx-auto">
                    <!-- general form elements -->
                    <?php echo $__env->make('messages.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger">
                            Pilih Opsi Valid
                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Cuti</h3>
                        </div>
                        <div class="card-body">
                            <?php if($leaves->count()): ?>
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Nama</th>
                                        <th>Department</th>
                                        <th>Jabatan</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th class="none">Setengah Jam Kerja</th>
                                        <th class="none">Tanggal Awal</th>
                                        <th class="none">Tanggal Akhir</th>
                                        <th class="none">Deskripsi</th>
                                        <td class="none">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($leave->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e($leave->employee->first_name.' '.$leave->employee->last_name); ?></td>
                                        <td><?php echo e($leave->employee->department); ?></td>
                                        <td><?php echo e($leave->employee->desg); ?></td>
                                        <td><?php echo e($leave->reason); ?></td>
                                        <td>
                                            <h5>
                                                <span 
                                                <?php if($leave->status == 'pending'): ?>
                                                    class="badge badge-pill badge-warning"
                                                <?php elseif($leave->status == 'ditolak'): ?>
                                                    class="badge badge-pill badge-danger"
                                                <?php elseif($leave->status == 'diterima'): ?>
                                                    class="badge badge-pill badge-success"
                                                <?php endif; ?>
                                                >
                                                    <?php echo e(ucfirst($leave->status)); ?>

                                                </span> 
                                            </h5>
                                        </td>
                                        <td><?php echo e(ucfirst($leave->half_day)); ?></td>
                                        <td><?php echo e($leave->start_date->format('d-m-Y')); ?></td>
                                        <?php if($leave->end_date): ?> 
                                        <td><?php echo e($leave->end_date->format('d-m-Y')); ?></td>
                                        <?php else: ?>
                                        <td>Sehari</td>
                                        <?php endif; ?>
                                        <td><?php echo e($leave->description); ?></td>
                                        <td>
                                            <button 
                                            class="btn btn-flat btn-info"
                                            data-toggle="modal"
                                            data-target="#deleteModalCenter<?php echo e($index + 1); ?>"
                                            >
                                            Ubah Status
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php for($i = 1; $i < $leaves->count()+1; $i++): ?>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter<?php echo e($i); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1<?php echo e($i); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Ubah Status Cuti</h5>
                                                </div>
                                                <form 
                                                    action="<?php echo e(route('admin.leaves.update', $leaves->get($i-1)->id)); ?>"
                                                    method="POST"
                                                >
                                                <div class="card-body">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                        <div class="form-group text-center">
                                                            <label for="">Pilih Status</label>
                                                            <select name="status" class="form-control text-center mx-auto" style="width:50%">
                                                                <option hidden disabled selected value> ---- </option>
                                                                <option value="pending">Pending</option>
                                                                <option value="diterima">Diterima</option>
                                                                <option value="ditolak">Ditolak</option>
                                                            </select>
                                                        </div>
                                                        
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button type="submit" class="btn flat btn-info">Update</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            <?php endfor; ?>
                            <?php else: ?>
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>Data Tidak Ada</h4>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-js'); ?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('#dataTable').DataTable({
        responsive:true,
        autoWidth: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 200000000000, targets: -1 }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy','excel', 'csv', 'pdf']
            }
        ]
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel_absensi\resources\views/admin/leaves/index.blade.php ENDPATH**/ ?>