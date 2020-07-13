<?php
class Cetak_pemeliharaan extends TCPDF {
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
            $pdf->SetTitle('Daftar Pemeliharaan');
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
                            <th width="15%" align="center">Tanggal</th>
                            <th width="15%" align="center">No Plat</th>
                            <th width="10%" align="center">Kondisi Oli Mesin</th>
                            <th width="10%" align="center">Kondisi Air Radiator</th>
                            <th width="10%" align="center">Kondisi Rem</th>
                            <th width="10%" align="center">Kondisi Accu</th>
                            <th width="10%" align="center">Kondisi Lampu</th>
                            <th width="10%" align="center">Status Mobil</th>
                        </tr>';
            foreach ($pemeliharaan as $row) 
                {
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td style="text-align: center">'.$row->tglPrint.'</td>
                            <td style="text-align: center">'.$row->platKendaraan.'</td>
                            <td style="text-align: center">'.$row->oliMesin.'</td>
                            <td style="text-align: center">'.$row->airRadiator.'</td>
                            <td style="text-align: center">'.$row->kondisiRem.'</td>
                            <td style="text-align: center">'.$row->kondisiAccu.'</td>
                            <td style="text-align: center">'.$row->kondisiLampu.'</td>
                            <td style="text-align: center">'.$row->statusMobil.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->Output('data_pemeliharaan.pdf', 'I');
?>