<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css">

<script src="<?=base_url()?>assets/bootstrap/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                $('#tglPajak').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose:true
                });
            });
        </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>

  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Mobil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('mobil/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="merk">Nama Kendaraan</label>
                  <input type="text" name="namaKendaraan" id="namaKendaraan" class="form-control" placeholder="Nama Kendaraan" value="<?php echo set_value('namaKendaraan'); ?>" required>
                </div>
                <div class="form-group">
                <label>Merk Kendaraan</label>
                <input type="text" name="merkKendaraan" id="merkKendaraan" class="form-control" placeholder="Merk Kendaraan" value="<?php echo set_value('merkKendaraan'); ?>" required>
              </div>
              <div class="form-group">
                  <label for="merk">Bahan Bakar Kendaraan</label>
                  <input type="text" name="bahanBakar" id="bahanBakar" class="form-control" placeholder="Bahan Bakar" 
                  value="<?php echo set_value('bahanBakar'); ?>" required>
                </div>
              <div class="form-group">
                  <label for="merk">No. Plat Kendaraan</label>
                  <input type="text" name="platKendaraan" id="platKendaraan" class="form-control" placeholder="No. Plat Kendaraann" value="<?php echo set_value('platKendaraan'); ?>" required>
                </div>
                <div class="form-group">
                  <label for="merk">Tanggal Pajak Exp.</label>
                  <input type="text" name="tglPajak" id="tglPajak" class="form-control" placeholder="Tanggal Pajak Exp." required>
                </div>
               
                <!-- <div class="form-group">
                  <label for="merk">Tarif Sewa /Jam</label>
                  <input type="text" name="tarif" id="tarif" class="form-control" placeholder="Tarif Sewa /Jam" value="<?php echo set_value('tarif'); ?>">
                </div> -->
               <!--  <div class="form-group">
                  <label for="merk">Tarif Overtime /Jam</label>
                  <input type="text" name="lembur" id="lembur" class="form-control" placeholder="Tarif Overtime /Jam" value="<?php echo set_value('lembur'); ?>">
                </div> -->
               <!--  <div class="form-group">
                  <label for="merk">No. Rangka Mobil</label>
                  <input type="text" name="rangka" id="rangka" class="form-control" placeholder="No. Rangka Mobil" value="<?php echo set_value('rangka'); ?>">
                </div> -->
                <!-- GAUSAH PAKE FOTO -->
                <!-- <div class="form-group">
                  <label for="exampleInputFile">Foto Mobil</label>
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