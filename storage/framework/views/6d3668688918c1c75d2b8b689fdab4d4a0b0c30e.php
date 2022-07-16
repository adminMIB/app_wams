
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
          <div class="card-header">
            <h1>Sales Order</h1>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <a href="<?php echo e(route('createodr')); ?>" class="btn btn-icon icon-left btn-primary mb-3"><i class="far fa-edit"></i> Create New Order</a>
              <table class="table table-bordered table-md">
                <tbody>
                <tr>
                  <th>No</th>
                  <th>No Sales Order</th>
                  <th>Nama Institusi</th>
                  <th>TGL Project</th>
                  <th>Jenis Dokumen</th>
                  <th>File</th>
                  <th>Editor</th>
                </tr>
                <?php $no = 1; ?>
                <?php $__currentLoopData = $odr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($no++); ?></td>
                  <td><?php echo e($item->no_so); ?></td>
                  <td><?php echo e($item->institusi); ?></td>
                  <td><?php echo e($item->tgl_order); ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody></table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\postgreProject\app_wams2\resources\views/slsorder.blade.php ENDPATH**/ ?>