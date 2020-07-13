<style type="text/css">
  .gambar {
    height: 100px !important;
    width: 130px !important;
  }
</style>

        <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Dashboard</h3>

                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">
                <div class="col-sm-1"></div> 
                <div class="col-sm-4">                
                  <ul class="users-list clearfix">
                      <li>
                        <p><i style="font-size: 40px;" class="fa fa-car"></i></p>
                        <h3 ><?php echo $countKendaraan ?></h3>
                        <h3 class="box-title">Total Kendaraan </h3>                        
                      </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <div class="col-sm-4">                
                  <ul class="users-list clearfix">
                      <li>
                        <p><i style="font-size: 40px;" class="fa fa-odnoklassniki"></i></p>
                        <h3 ><?php echo $countDriver ?></h3>
                        <h3 class="box-title">Total Driver </h3>                       
                      </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <div class="col-sm-3">                
                  <ul class="users-list clearfix">
                      <li> 
                        <p><i style="font-size: 40px;" class="fa fa-odnoklassniki"></i></p>                       
                        <h3 ><?php echo $countPegawai ?></h3>
                        <h3 class="box-title">Total Pegawai </h3>
                      </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer text-center">
                  <a href="<?=base_url()?>mobil" class="uppercase">Lihat Semua Mobil</a>
                </div> -->
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>