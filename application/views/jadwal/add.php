<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>

<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css">
  <!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
<script type="text/javascript">
            $(document).ready(function () {
                $('#tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
        </script>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Jadwal </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('jadwal/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label>Nama Pegawai</label>
                  
                  <select class="form-control select2" name="namaPegawai" id="idPegawai" style="width: 100%;" required="">
                  <option value="" selected="selected"></option>
                    <?php
                    foreach($pegawai as $row) {
                    ?> 
                      <option value="<?php echo $row->idPegawai; ?>"><?php echo $row->namaPegawai; ?></option>
                    <?php 
                    }
                    ?> 
                  </select>
                </div>

                <div class="form-group">
                  <label for="merk">Tujuan Perjalanan</label>
                  <input type="text" name="tujuan" id="tujuan" class="form-control" id="tujuan" placeholder="Tujuan Perjalanan" required="">
                </div>
                
                <div class="form-group">
                  <label for="merk">Kepentingan Perjalanan</label>
                  <input type="text" name="Kepentingan" id="Kepentingan" class="form-control" id="Kepentingan" placeholder="Kepentingan Perjalanan" required="">
                </div>

                <div class="form-group">
                  <label for="merk">Tanggal Berangkat</label>
                  <input type="text" name="tglBerangkat" id="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Berangkat" required="">
                </div>

                <div class="form-group">
                  <label for="merk">Lama Perjalanan</label>
                  <input type="text" name="lamaWaktu" id="lamaWaktu" class="form-control" id="lamaWaktu" placeholder="Lama Waktu" required="">
                </div>

                <div class="form-group">
                  <label>Plat Kendaraan</label>
                  
                  <select class="form-control select2" name="platKendaraan" id="platKendaraan" style="width: 100%;" required="">
                  <option value="" selected="selected"></option>
                    <?php
                    $no = 1;
                    
                    foreach($pemeliharaan as $row) {
                    if ($row->cekMobil =="Tersedia" && $row->statusMobil=="Available")
                    {
                    ?>

                      <option value="<?php echo $row->platKendaraan; ?>"><?php echo $row->platKendaraan; ?></option>
                    <?php
                    
                    $no++; }
                    }
                    ?> 
                  </select>
                </div>
                <div class="form-group">
                  <label>Nama Driver</label>
                  
                  <select class="form-control select2" name="namaDriver" id="idDriver" style="width: 100%;" required="">
                  <option value="" selected="selected"></option>
                    <?php
                    $no =1;
                    foreach($driver as $row) {
                    if ($row->kondisiSupir =="Baik" && $row->cekSupir=="Ada")
                    {
                    ?> 
                      <option value="<?php echo $row->idDriver; ?>"><?php echo $row->namaDriver; ?></option>
                    <?php
                    $no++;}
                    }
                    ?> 
                  </select>
                </div>

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
