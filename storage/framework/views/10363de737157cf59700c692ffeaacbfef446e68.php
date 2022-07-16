
<?php $__env->startSection('content'); ?>
    <section class="section">
      <h1>Report Project</h1>

      <div class="text-md-right"><button class="btn btn-primary">Export Excel</button></div>
      <table class="table table-hover mt-2">
        <tr class="bg-primary">
            <th class="text-white">ID</th>
            <th class="text-white">Nama Institusi</th>
            <th class="text-white">Nama Project</th>
            <th class="text-white">Nilai Project</th>
            <th class="text-white">Nama AM</th>
            <th class="text-white">Nama PM</th>
            <th class="text-white">Nama Technical</th>
            <th class="text-white">Status Pekerjaan</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
      </table>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\backupprjk\aridz\app_aridz\resources\views/reportp.blade.php ENDPATH**/ ?>