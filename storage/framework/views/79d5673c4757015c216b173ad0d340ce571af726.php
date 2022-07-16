
<?php $__env->startSection('content'); ?>
    <section class="section">
      <section class="header"><h1>Input Work Order</h1></section>
      
      <section class="body mt-3">
        <form action="#" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">No Sales Order</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NamaClient" placeholder="No Sales Order" id="inputNamaClient">
          </div>
        </div>
        <div class="mb-2 row">
          <label class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Tanggal Sales Order</label>
          <div class="col-sm-10">
            <input type="date" name="Date" class="form-control date">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Sales</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NamaClient" placeholder="Nama Sales" id="inputNamaClient">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Institusi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NamaClient" placeholder="Nama Institusi" id="inputNamaClient">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NamaClient" placeholder="Nama Project" id="inputNamaClient">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">HPS</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NamaClient" placeholder="HPS" id="inputNamaClient">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sign to WO</label>
          <div class="col-sm-10">
            <select class="form-control" id="inputNamaClient">
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
            </select>  
          </div>
        </div>
        
        

        <div class="text-right">
          <button class="btn btn-primary">Simpan</button>
          <a href="#" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </section>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\backupprjk\aridz\app_aridz\resources\views/inputwo.blade.php ENDPATH**/ ?>