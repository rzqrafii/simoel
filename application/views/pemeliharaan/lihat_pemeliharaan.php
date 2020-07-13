<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>

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
              <h3 class="box-title"><strong>Plat Kendaraan <?php echo $edit->platKendaraan;?> </strong></h3>
               <!--  <?php echo $edit->platKendaraan; ?> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('pemeliharaan/lihat'); ?>
              <input type="hidden" name="idPemeliharaan" value="<?php echo $edit->idPemeliharaan; ?>">
              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                    <label for="pemeliharaan">Kondisi Oli : </label> <?php echo $edit->oliMesin ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Kondisi Air Radiator : </label> <?php echo $edit->airRadiator ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Kondisi Rem : </label> <?php echo $edit->kondisiRem ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Kondisi Accu : </label> <?php echo $edit->kondisiAccu ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Kondisi Lampu : </label> <?php echo $edit->kondisiLampu ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Status Mobil : </label> <?php echo $edit->statusMobil ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>

                <div class="form-group">
                    <label for="pemeliharaan">Ketersediaan : </label> <?php echo $edit->cekMobil ?><br>
                    <!-- KONDISI IF MANUAL KETIKA SALAH SATU ROW DI PILIH UNTUK DI EDIT MAKA RADIO BUTTON HARUS MENGIKUTI APA YG SUDAH DIINPUT SEBELUMNYA -->
                </div>  
                <!-- <div class="form-group">
                    <label for="pemeliharaan">Air Radiator</label><br>
                    <?php 
                          if ($edit->airRadiator=="YA")
                          {
                    ?>
                            <input type="radio" name="airRadiator" id="airRadiator"  value="YA"  checked="">
                            YA
                            <input type="radio" name="airRadiator" id="airRadiator"  value="TIDAK"  >TIDAK
                          <?php 
                            }
                          else{
                            ?>
                            <input type="radio" name="airRadiator" id="airRadiator"  value="YA" >YA
                            <input type="radio" name="airRadiator" id="airRadiator"  value="TIDAK" checked="" >TIDAK
                          <?php
                           }
                          ?>
                </div>
                <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Rem dalam Keadaan Baik?</label><br>
                    <?php 
                          if ($edit->kondisiRem=="YA")
                          {
                          ?>
                             <input type="radio" name="kondisiRem" id="kondisiRem"  value="YA"  checked="">
                             YA
                             <input type="radio" name="kondisiRem" id="kondisiRem"  value="TIDAK"  >TIDAK
                          <?php 
                            }
                          else{
                            ?>
                            <input type="radio" name="kondisiRem" id="kondisiRem"  value="YA" >YA
                            <input type="radio" name="kondisiRem" id="kondisiRem"  value="TIDAK" checked="" >TIDAK
                          <?php
                           }
                          ?>
                </div>
              <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Accu dalam Keadaan Baik?</label><br>
                  <?php 
                            if ($edit->kondisiAccu=="YA")
                            {
                          ?>
                             <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="YA"  checked="">
                             YA
                             <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="TIDAK"  >TIDAK
                          <?php 
                            }
                          else{
                            ?>
                            <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="YA" >YA
                            <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="TIDAK" checked="" >TIDAK
                          <?php
                           }
                          ?>
                </div>
                <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Lampu dalam Keadaan Baik?</label><br>
                 <?php 
                            if ($edit->kondisiLampu=="YA")
                            {
                          ?>
                             <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="YA"  checked="">
                             YA
                             <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="TIDAK"  >TIDAK
                          <?php 
                            }
                          else{
                            ?>
                            <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="YA" >YA
                            <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="TIDAK" checked="" >TIDAK
                          <?php
                           }
                          ?>
                </div>
                <div class="form-group">
                  <label for="pemeliharaan">Apakah Mobil Tersedia di Kantor?</label><br>
                 <?php 
                            if ($edit->cekMobil=="Tersedia")
                            {
                          ?>
                             <input type="radio" name="cekMobil" id="cekMobil"  value="Tersedia"  checked="">
                             TERSEDIA
                             <input type="radio" name="cekMobil" id="cekMobil"  value="TidakTersedia"  >TIDAK TERSEDIA
                          <?php 
                            }
                          else{
                            ?>
                            <input type="radio" name="cekMobil" id="cekMobil"  value="Tersedia" >TERSEDIA
                            <input type="radio" name="cekMobil" id="cekMobil"  value="TidakTersedia" checked="" >TIDAK TERSEDIA
                          <?php
                           }
                          ?>
                </div> -->
            <!--   <div class="form-group">
                  <label for="merk">Tahun Mobil</label>
                  <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun Mobil" 
                  value="<?php echo $edit->tahunproduksi; ?>">
                </div> -->
                <!-- <div class="form-group">
                  <label for="merk">No. Plat Mobil</label>
                  <input type="text" name="platKendaraan" id="platKendaraan" class="form-control" placeholder="No. Plat Mobil" value="<?php echo $edit->platKendaraan; ?>">
                </div> -->
                <!-- <div class="form-group">
                  <label for="merk">Jumlah Kursi</label>
                  <input type="text" name="kursi" id="kursi" class="form-control" placeholder="Jumlah Kursi" value="<?php echo $edit->kursi; ?>">
                </div> -->
                <!-- <div class="form-group">
                  <label for="merk">Tarif Sewa /Jam</label>
                  <input type="text" name="tarif" id="tarif" class="form-control" placeholder="Tarif Sewa /Jam" value="<?php echo $edit->tarif; ?>">
                </div> -->
                <!-- <div class="form-group">
                  <label for="merk">Tarif Overtime /Jam</label>
                  <input type="text" name="lembur" id="lembur" class="form-control" placeholder="Tarif Overtime /Jam" value="<?php echo $edit->lembur; ?>">
                </div> -->
                <!-- <div class="form-group">
                  <label for="merk">No. Rangka Mobil</label>
                  <input type="text" name="rangka" id="rangka" class="form-control" placeholder="No. Rangka Mobil" value="<?php echo $edit->norangka; ?>">
                </div> -->
                
                  <!-- Kurang FOTO, BAHAN BAKAR, TANGGAL PAJAK YA NANTI DITAMBAHIN DI EDIT JANGAN LUPA -->
                  <!-- Kurang FOTO, BAHAN BAKAR, TANGGAL PAJAK YA NANTI DITAMBAHIN DI EDIT JANGAN LUPA -->
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Back</button>
                
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
      </div>x`x`