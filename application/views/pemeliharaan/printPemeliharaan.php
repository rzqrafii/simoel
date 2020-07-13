<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse;
			table-layout:fixed;width: 630px;
		}
		table td {
			word-wrap:break-word;
			width: 20%;
		}
	</style>
</head>
<body>
    <b><?php echo $ket; ?></b><br /><br />
    
	<table id="example1" class="table table-bordered table-striped">
                <thead style="text-align: center">
                <tr>
                  <th>No.</th>
                  <th>No Plat</th>
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
                  <th>Action</th>
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
</body>
</html>
