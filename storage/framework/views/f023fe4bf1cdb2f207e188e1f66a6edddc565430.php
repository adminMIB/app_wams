
<?php $__env->startSection('style'); ?>
  <style>
    #number_Q {
      display: none;
    }
    #number_A {
      display: none;
    }
    #number_B {
      display: none;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
          <div class="card-header">
            <h1>Upload Document</h1>
          </div>
          <div class="card-body">
            <form action="<?php echo e(route ('simpan-up')); ?>" method="post" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              
              <div class="form-group row">
                <label for="inputTimeline" class="col-sm-3 col-form-label" style="color:black;font-weight:bold">Timeline</label>
                <div class="col-sm-9">
                  <select class="form-control" id="timeline" name="no_so">
                    <option value="" for="angka" selected readonly>-=- Timeline -=-</option>
                    <?php $__currentLoopData = $au; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->no_so); ?></option>    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                    <div class="form-group pt-3" id="number_Q">
                      <label>
                        Tanggal Upload <strong id="title_Q"></strong>
                      </label>
                      <input type="text" class="form-control" value="<?php echo e($item->tgl_order); ?>" readonly>
                    </div>
                    <div class="form-group pt-3" id="number_A">
                      <label>
                        Nama Institusi <strong id="title_A"></strong>
                      </label>
                      <input type="text" class="form-control" value="<?php echo e($item->institusi); ?>" readonly>
                    </div>
                    <div class="form-group pt-3" id="number_B">
                      <label>
                        Nama Project <strong id="title_B"></strong>
                      </label>
                      <input type="text" class="form-control" value="<?php echo e($item->project); ?>" readonly>
                    </div>
                  </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail5" class="col-sm-3 col-form-label">Jenis Dokumen</label>
                <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" name="jenis_doc" id="inputEmail5">
                    <option value="Dok PO">Dok PO</option>
                    <option selected="selected" value="Dok Penawaran">Dok Penawaran</option>
                    <option value="Dok BAST">Dok BAST</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail5" class="col-sm-3 col-form-label">File</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="up_doc" id="inputEmail5">
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Upload</button>
            </form>
          </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
  $( document ).ready(function() {
    $('#timeline').on('change', function() {
      $('#number_Q').css('display', 'block')
      $('#title_Q').text(this.value)
      $('#number_A').css('display', 'block')
      $('#title_A').text(this.value)
      $('#number_B').css('display', 'block')
      $('#title_B').text(this.value)
    })
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\postgreProject\app_wams2\resources\views/upload.blade.php ENDPATH**/ ?>