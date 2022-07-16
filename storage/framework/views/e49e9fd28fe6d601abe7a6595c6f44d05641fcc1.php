
<?php $__env->startSection('content'); ?>
    <section class="section">
      <h1>List Documnet</h1>

      <div class="text-right">
        <button class="btn btn-primary">Add New Document</button>
        <button class="btn btn-primary">Export Excel</button>
      </div>
      <table class="table table-hover mt-2">
        <tr class="bg-primary">
            <th class="text-white">No Dokumen</th>
            <th class="text-white">Nama Institusi</th>
            <th class="text-white">Nama Project</th>
            <th class="text-white">Jenis Dokumen</th>
            <th class="text-white">Nama File</th>
            <th class="text-white">Editor</th>
        </tr>
        <tr>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\backupprjk\aridz\app_aridz\resources\views/listdoc.blade.php ENDPATH**/ ?>