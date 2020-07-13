<link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css">

<script src="<?=base_url()?>assets/bootstrap/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                $('#tanggal').datepicker({
                    format: "dd-mm-yyyy",
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
              <h3 class="box-title">Edit Data Jadwal Mobil <strong><?php echo $edit[0]->platKendaraan; ?></strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('jadwal/edit'); ?>
              <input type="hidden" name="idJadwal" value="<?php echo $edit[0]->idJadwal; ?>">
              <input type="hidden" name="platKendaraan" value="<?php echo $edit[0]->platKendaraan; ?>">
              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="jadwal">Nama Pegawai</label>
                  <select class="form-control select2" name="idPegawai" >
                    <option value="<?php echo $edit[0]->idPegawai; ?>"><?php echo $edit[0]->namaPegawai?></option>
                  </select>
                  <!-- <option value="" selected="selected"></option>
                  <select class="form-control select2" name="namaPegawai" id="namaPegawai" style="width: 100%;">
                    <?php 
                      $no=1;
                      foreach($pegawai as $row)
                      {
                    ?>
                      <option value="<?php echo $row->idPegawai; ?>" 
                        <?php if($edit->idPegawai == $row->idPegawai) 
                        { 
                          ?>selected="selected"<?php 
                        } ?> ><?php echo $row->namaPegawai; ?></option>
                    <?php  
                      $no++;
                      }
                    ?>
                  </select> -->
                </div>

                <div class="form-group">
                  <label for="jadwal">Nama Driver</label>
                  <select class="form-control select2" name="idDriver" >
                    <option value="<?php echo $edit[0]->idDriver; ?>"><?php echo $edit[0]->namaDriver?></option>
                  </select>
                  <!-- <option value="" selected="selected"></option>
                  <select class="form-control select2" name="namaDriver" id="idDriver" style="width: 100%;">
                    <?php 
                      $no=1;
                      foreach($driver as $row)
                      { 
                    ?>
                      <option value="<?php echo $row->idDriver; ?>" 
                        <?php if($edit->idDriver == $row->idDriver) 
                        { 
                          ?>selected="selected"<?php 
                        } ?> ><?php echo $row->namaDriver; ?></option>
                    <?php  
                      $no++;
                    }
                    ?>
                  </select> -->
                </div>
                
                <div class="form-group">
                  <label for="jadwal">Tujuan</label>
                  <!-- <input type="text" name="tujuan" id="tujuan" class="form-control" placeholder="Tujuan" value="<?php echo $edit->tujuan; ?>"> -->
                  <select class="form-control select2" name="tujuan" >
                    <option value="<?php echo $edit[0]->tujuan; ?>"><?php echo $edit[0]->tujuan?></option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jadwal">Kepentingan</label>
                 <!--  <input type="text" name="Kepentingan" id="Kepentingan" class="form-control" placeholder="Kepentingan" value="<?php echo $edit->kepentingan; ?>"> -->
                 <select class="form-control select2" name="kepentingan" >
                    <option value="<?php echo $edit[0]->kepentingan; ?>"><?php echo $edit[0]->kepentingan?></option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jadwal">Tanggal Berangkat</label>
                  <!-- <input type="text" name="tglBerangkat" id="tanggal" class="form-control"  placeholder="Tanggal Berangkat" value="<?php echo $edit->tglBerangkat; ?>"> -->
                  <select class="form-control select2" name="tglBerangkat" >
                    <option value="<?php echo $edit[0]->tglBerangkat; ?>"><?php echo $edit[0]->tglBerangkat?></option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jadwal">Lama Perjalanan</label>
                  <!-- <input type="text" name="lamaWaktu" id="lamaWaktu" class="form-control"  placeholder="Lama Perjalanan" value="<?php echo $edit->lamaWaktu; ?>"> -->
                  <select class="form-control select2" name="lamaWaktu" >
                    <option value="<?php echo $edit[0]->lamaWaktu; ?>"><?php echo $edit[0]->lamaWaktu?></option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="pemeliharaan">Apakah Perjalanan Telah Selesai?</label><br>
                  <input type="radio" name="statusPerjalanan" id="statusPerjalanan"  value="Selesai" checked="">YA
                  <input type="radio" name="statusPerjalanan" id="statusPerjalanan"  value="Terjadwal">TIDAK
                </div>

              </div>
              <!-- /.end box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Update</button>
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