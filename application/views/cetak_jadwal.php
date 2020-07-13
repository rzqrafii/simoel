<?php
class Cetak_jadwal extends TCPDF {
   //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'base.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}   
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Daftar Jadwal');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();

            
            $i=0;
            // $pdf->Write(5, 'LEMBAGA PENERBANGAN ANTARIKSA NASIONAL');
            $html=' <h3>Daftar '.$ket.'</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center">No</th>
                            <th width="15%" align="center">Nama Pegawai</th>
                            <th width="15%" align="center">Plat Kendaraan</th>
                            <th width="10%" align="center">Nama Driver</th>
                            <th width="10%" align="center">Tujuan</th>
                            <th width="10%" align="center">Kepentingan</th>
                            <th width="10%" align="center">Tanggal Berangkat</th>
                            <th width="10%" align="center">Lama Waktu Dinas</th>
                            <th width="10%" align="center">Status Perjalanan</th>
                        </tr>';
            foreach ($jadwal as $row) 
                {
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td style="text-align: center">'.$row->namaPegawai.'</td>
                            <td style="text-align: center">'.$row->platKendaraan.'</td>
                            <td style="text-align: center">'.$row->namaDriver.'</td>
                            <td style="text-align: center">'.$row->tujuan.'</td>
                            <td style="text-align: center">'.$row->kepentingan.'</td>
                            <td style="text-align: center">'.$row->tglBerangkat.'</td>
                            <td style="text-align: center">'.$row->lamaWaktu.'</td>
                            <td style="text-align: center">'.$row->statusPerjalanan.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->Output('data_jadwal.pdf', 'I');
?>