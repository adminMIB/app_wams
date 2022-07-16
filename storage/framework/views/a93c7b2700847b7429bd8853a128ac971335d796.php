
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
          <div class="card-header">
            <h1>Create Sales Order</h1>
          </div>
          <div class="card-body">
            <form action="<?php echo e(route('simpan-data')); ?>" method="POST" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <div class="row">
                <div class="column col-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">No Sales Order</label>
                      <input type="text" class="form-control" name="no_so" id="exampleInputEmail1" value="<?php echo e(date('d/m/Y').'/'.$kd); ?>" readonly>
                  </div>
                  <div class="form-group">
                      <label>Tanggal Sales Order</label>
                      <div class="input-group date">
                          <input type="date" class="form-control datetimepicker-input" name="tgl_order" data-target="#reservationdate"/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label>Upload File Quotation</label>
                    <input type="file" class="form-control" name="file_quotation">
                  </div>
                  
                </div>
                <div class="column col-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Institusi</label>
                      <input type="text" class="form-control" name="institusi" id="exampleInputEmail1" placeholder="Institusi">
                  </div>
                  <div class="form-group">
                      <label>HPS</label>
                      <select class="form-control select2" style="width: 100%;" name="hps">
                        <option value="Dok PO">Dok PO</option>
                        <option selected="selected" value="Dok Penawaran">Dok Penawaran</option>
                        <option value="Dok BAST">Dok BAST</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Upload File PO</label>
                    <input type="file" class="form-control" name="file_po">
                  </div>
                  
                </div>
                <div class="column col-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Project</label>
                      <input type="text" class="form-control" name="project" id="exampleInputEmail1" placeholder="Project">
                  </div>
                  <div class="form-group">
                    <label>status</label>
                    <select class="form-control select2" style="width: 100%;" name="status">
                      <option selected="selected" value="Approve">Approve</option>
                      <option value="Reject">Reject</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Upload File SPK</label>
                    <input type="file" class="form-control" name="file_spk">
                  </div>
                  
                </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="<?php echo e(route('slsorder')); ?>" class="btn btn-secondary">Back</a>
            </form>
          </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\althafrp\postgreProject\app_wams2\resources\views/create.blade.php ENDPATH**/ ?>