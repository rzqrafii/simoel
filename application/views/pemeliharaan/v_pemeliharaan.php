<link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?=base_url()?>assets/jquery-ui/jquery-ui.min.css" /> <!-- Load file css jquery-ui -->
    <script src="<?=base_url()?>assets/jquery.min.js"></script>

<script src="<?=base_url()?>assets/jquery-ui/jquery-ui.min.js"></script> <!-- Load file plugin js jquery-ui -->
    
    <script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>


<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pemeliharaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="get" action="">
              <label>Filter Berdasarkan</label><br>
              <select name="filter" id="filter" class="btn btn-info">
                  <option value="">Pilih</option>
                  <option value="1">Per Tanggal</option>
                  <option value="2">Per Bulan</option>
                  <option value="3">Per Tahun</option>
              </select>
              <br /><br />

              <div id="form-tanggal">
                  <label>Tanggal</label><br>
                  <input type="text" name="tanggal" class="input-tanggal" />
                  <br /><br />
              </div>

              <div id="form-bulan">
                  <label>Bulan</label><br>
                  <select class="btn btn-info" name="bulan">
                      <option value="">Pilih</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                  </select>
                  <br /><br />
              </div>

              <div id="form-tahun">
                  <label>Tahun</label><br>
                  <select class="btn btn-info" name="tahun">
                      <option value="">Pilih</option>
                      <?php
                      foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
                          echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
                      }
                      ?>
                  </select>
                  <br /><br />
              </div>

              <button type="submit" class="btn btn-info">Tampilkan</button>
              <a class="btn btn-info" href="<?=base_url()?>pemeliharaan">Reset Filter</a> <br/><br/>

              <!-- <button type="submit" class="btn btn-info" onclick="window.location.href='<?=base_url()?>pemeliharaan/cetak_pemeliharaan';"><i class="fa fa-fw fa fa-print"></i>Print</button> -->

              <!-- <button type="submit" class="btn btn-info" onclick="window.location.href='<?php echo $url_cetak; ?>';"><i class="fa fa-fw fa fa-print"></i>Print</button> -->
              <a class="btn btn-info" href="<?php echo $url_cetak; ?>"><i class="fa fa-fw fa fa-print"></i>Print</a>
          </form>
            <?php if($this->session->flashdata('info')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('info'); ?>
              </div>
            <?php } ?>
            <b><?php echo $ket; ?></b><br /><br />
              <table id="example1" class="table table-bordered table-striped">
                <thead style="text-align: center">
                <tr>
                  <th>No.</th>
                  <th>Plat Nomor</th>
                  <th>Kondisi Oli</th>
                  <th>Kondisi Air Radiator</th>
                  <th>Kondisi Rem</th>
                  <th>Kondisi Accu</th>
                  <th>Kondisi Lampu</th>
                  <th>Tgl Pemeliharaan</th>
                  <th>Status</th>

                <!--   <th>Rem</th>
                  <th>Rem Tangan</th>
                  <th>Accu</th>
                  <th>Lampu</th>
                  <th>Transmisi</th>
                  <th>Kopling</th>
                  <th>Interior</th>
                  <th>Shockabsorber</th>
                  <th>Pumpsteering</th> -->
                  <?php if ($this->session->userdata('username') == 'kabeng') {?>
                  <th>Action</th>
                  <?php }?>
                </tr>
                </thead>
                <tbody>
                <?php
                if(! empty($pemeliharaan)){
                  $no = 1;
                  foreach($pemeliharaan as $row) {
                  ?>         
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td style="text-align: center"><?php echo $row->platKendaraan?></td>
                      <td style="text-align: center"><?php echo $row->oliMesin; ?></td>
                      <td style="text-align: center"><?php echo $row->airRadiator; ?></td>
                      <td style="text-align: center"><?php echo $row->kondisiRem; ?></td>
                      <td style="text-align: center"><?php echo $row->kondisiAccu; ?></td>
                      <td style="text-align: center"><?php echo $row->kondisiLampu; ?></td>
                      <td style="text-align: center;"><?php echo $row->tglPrint;?></td>
                      <td style="text-align: center">
                      <!-- untuk menampilkan status pada pemeliharaan, jadi jika salah satu ada yang tidak maka status Service -->
                          <?php 
                            if ($row->oliMesin=="TIDAK"   || 
                              $row->airRadiator=="TIDAK"  || 
                              $row->kondisiRem=="TIDAK"   || 
                              $row->kondisiAccu=="TIDAK"  || 
                              $row->kondisiLampu=="TIDAK")
                            {
                          ?>
                              <button class="btn btn-warning btn-sm" >Service</button>
                          <?php 
                            }
                          else{
                            ?>
                            <button class="btn btn-success btn-sm" >Available</button>
                          <?php
                           }
                          ?>
                      </td>
                      <!-- button -->
                      <?php if ($this->session->userdata('username') == 'kabeng') {?>
                      <td>
                        <button type="submit" class="btn btn-primary" onclick="location.href='<?=base_url()?>pemeliharaan/edit/<?php echo $row->idPemeliharaan; ?>'"><i class="fa fa-fw fa-edit"></i></button>

                        <button type="submit" class="btn btn-danger" onclick="if(confirm('Apakah anda yakin akan menghapus <?php echo $row->platKendaraan; ?>?')) window.location.href='<?=base_url()?>pemeliharaan/hapus/<?php echo $row->idPemeliharaan; ?>';"><i class="fa fa-fw fa-trash-o"></i></button>

                        
                        <button type="submit" class="btn btn-success" onclick="location.href='<?=base_url()?>pemeliharaan/lihat/<?php echo $row->idPemeliharaan; ?>'"><i class="fa fa-fw fa-eye"></i></button>
                        <!-- <button type="submit" class="btn btn-info"><i class="fa fa-info-circle" aria-hidden="true  "></i></button> -->
                       
                      </td>
                      <?php }?>
                          
                    </tr>
                <?php
                  $no++; 
                }
              }
                ?> 
                
                </tbody>
                <!-- <tfoot>
                <tr>
                 <th>No.</th>
                  <th>Nama Merk</th>
                  <th>Action</th>
                </tr>
                </tfoot> -->
              </table>
               
            </div>
            <!-- /.box-body -->
          </div>

<script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });

        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }

            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>