<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css">
  <!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
     //Date picker
    $('#datepicker').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd' });
      //dateFormat: 'yy-mm-dd'
//}{
     //// autoclose: true,
     // dateFormat: 'yy-mm-dd'
    //});
  });
</script>

  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Supir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('supir/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="supir">Nama Supir</label>
                  <input type="text" name="namaDriver" id="namaDriver" class="form-control" placeholder="Nama Driver" value="<?php echo set_value('namaDriver'); ?>" required="">
                </div>
              <div class="form-group">
                  <label for="supir">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo set_value('alamat'); ?>" required="">
                </div>
                <div class="form-group">
                  <label for="supir">No. KTP</label>
                  <input type="text" name="ktp" id="ktp" class="form-control" placeholder="No. KTP" value="<?php echo set_value('ktp'); ?>" required="">
                </div>
                <div class="form-group">
                  <label for="supir">Kondisi Supir</label><br>
                    <input type="radio" name="kondisiSupir" id="kondisiSupir"  value="Baik" checked="">Baik
                    <input type="radio" name="kondisiSupir" id="kondisiSupir"  value="Sakit">Sakit
                </div>
                <div class="form-group">
                  <label for="supir">Cek Supir</label><br>
                    <input type="radio" name="cekSupir" id="cekSupir"  value="Ada" checked="">Ada
                    <input type="radio" name="cekSupir" id="cekSupir"  value="TidakAda">Tidak Ada
                </div>
               <!--  <div class="form-group">
                  <label for="exampleInputFile">Foto Supir</label>
                  <input type="file" id="foto" name="foto">
                </div> -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
          
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
        <!--/.col (right) -->
      </div>