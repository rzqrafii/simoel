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
                $('#tglPrint').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose:true
                });
            });
        </script>

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
              <h3 class="box-title">Tambah Data Pemeliharaan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('pemeliharaan/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                
                <div class="form-group">
                  <label for="merk">Tanggal Pemeliharaan</label>
                  <input type="text" name="tglPrint" id="tglPrint" class="form-control" id="tglPrint" placeholder="Tanggal Pemeliharaan" required="">
                </div>

                <!-- COMBOBOX AREA KENDARAAN-->
                <div class="form-group">
                <?php
    
                    $result = $this->db->get('kendaraan');  
                    $jsArray = "var prdName = new Array();\n";  
                 
                      echo '<strong>Plat Kendaraan:</strong><br>
                            <select name="platKendaraan" onchange="changeValue(this.value)" required>';     
                      echo '<option value="">--No Plat--</option>'; 
                       //foreach ini mengambil baris dari row plat kendaraan , dan yang ditampilkan juga plat kendaraan , kalo mau id yg disimpan maka row pada sebelah kiri $row->plat kendaraan diubah menjadi $row->idKendaraan dengan nilai(tampilan) nya .$row->platKendaraan 

                      // jsarray menyimpan variable dari setiap input form (textbox) untuk ditampilkan secara otomatis ketika value pada option (combobox) dipilih
                      foreach($dropdown->result() as $row){  
                          echo '<option value="' . $row->platKendaraan . '">' . $row->platKendaraan . '</option>';  
                          $jsArray .= "prdName['" . $row->platKendaraan . "'] = 
                          {
                            name:'" . addslashes($row->namaKendaraan) . "',
                            merk:'".addslashes($row->merkKendaraan)."',
                            bbm:'".addslashes($row->bahanBakar)."',
                            tgl:'".addslashes($row->tglPajak)."'
                          };\n";  
                }  
                echo '</select>';  
                 
                 
                ?>

                  </div>

                <div class="form-group">
                    <label for="merk">Nama Kendaraan</label>
                    <input type="text" name="namaKendaraan" id="namaKendaraan" class="form-control" readonly="">
                </div>
                <div class="form-group">
                    <label>Merk Kendaraan</label>
                    <input type="text" name="merkKendaraan" id="merkKendaraan" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="merk">Bahan Bakar Kendaraan</label>
                    <input type="text" name="bahanBakar" id="bahanBakar" class="form-control"  readonly>
                </div>
                <div class="form-group">
                    <label for="merk">Tanggal Pajak Exp.</label>
                    <input type="text" name="tglPajak" id="tglPajak" class="form-control" readonly>
                </div>

                  <!-- END KENDARAAN -->
                <div class="form-group">
                    <label for="pemeliharaan">Apakah Oli Kendaraan dalam Keadaan Baik?</label><br>
                    <input type="radio" name="oliMesin" id="oliMesin"  value="YA" checked="">YA
                    <input type="radio" name="oliMesin" id="oliMesin"  value="TIDAK">TIDAK
                </div>
                <div class="form-group">
                <label for="pemeliharaan">Apakah Air Radiator dalam Keadaan Baik?</label><br>
                  <input type="radio" name="airRadiator" id="airRadiator"  value="YA" checked="">YA
                  <input type="radio" name="airRadiator" id="airRadiator"  value="TIDAK">TIDAK
                </div>
              <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Rem dalam Keadaan Baik?</label><br>
                    <input type="radio" name="kondisiRem" id="kondisiRem"  value="YA" checked="">YA
                    <input type="radio" name="kondisiRem" id="kondisiRem"  value="TIDAK">TIDAK
                </div>
              <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Accu dalam Keadaan Baik?</label><br>
                  <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="YA" checked="">YA
                  <input type="radio" name="kondisiAccu" id="kondisiAccu"  value="TIDAK">TIDAK
                </div>
                <div class="form-group">
                  <label for="pemeliharaan">Apakah Kondisi Lampu dalam Keadaan Baik?</label><br>
                  <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="YA" checked="">YA
                  <input type="radio" name="kondisiLampu" id="kondisiLampu"  value="TIDAK">TIDAK
                  <!-- <input type="text" name="tglPajak" id="tglPajak" class="form-control" placeholder="Tanggal Pajak Exp." value="<?php echo set_value('tglPajak'); ?>"> -->
                </div>
                <div class="form-group">
                  <label for="pemeliharaan">Apakah Mobil Tersedia di Kantor?</label><br>
                  <input type="radio" name="cekMobil" id="cekMobil"  value="Tersedia" checked="">TERSEDIA
                  <input type="radio" name="cekMobil" id="cekMobil"  value="TidakTersedia">TIDAK TERSEDIA
                </div>
                <!-- <div class="form-group"> -->
                <!-- <label for="merk">Status</label>
                <br>

                </div> -->
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
                <!-- <div class="form-group">
                  <label for="exampleInputFile">Foto Mobil</label>
                  <input type="file" id="foto" name="foto">
                </div>
              </div> -->
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



<script type="text/javascript">  
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('namaKendaraan').value = prdName[id].name;  
document.getElementById('merkKendaraan').value = prdName[id].merk;  
document.getElementById('bahanBakar').value = prdName[id].bbm;  
document.getElementById('tglPajak').value = prdName[id].tgl;  
};    
</script> 