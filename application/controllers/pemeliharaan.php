<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeliharaan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_pemeliharaan');
		$this->load->helper(array('form','url'));
		$this->load->library('Pdf');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	// public function get_dropdown()
	// {
	// 	$data['dropdown'] = $this->m_pemeliharaan->tampil_data();
	// 	$this->load->view('add_pemeliharaan', $data);
	// }

	public function cetak_pemeliharaan()
    {
        $data['pemeliharaan'] = $this->m_pemeliharaan->joinpemeliharaan();
        $this->load->view('cetak_pemeliharaan', $data);
	}   


	public function index()
	{	
		if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Pemeliharaan Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'pemeliharaan/cetak?filter=1&tanggal='.$tgl;
                $pemeliharaan = $this->m_pemeliharaan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Pemeliharaan Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'pemeliharaan/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $pemeliharaan = $this->m_pemeliharaan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Pemeliharaan Tahun '.$tahun;
                $url_cetak = 'pemeliharaan/cetak?filter=3&tahun='.$tahun;
                $pemeliharaan = $this->m_pemeliharaan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = '';
            $url_cetak = 'pemeliharaan/cetak';
            $pemeliharaan = $this->m_pemeliharaan->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
		$data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data['pemeliharaan'] = $pemeliharaan;
		$data['option_tahun'] = $this->m_pemeliharaan->option_tahun();/*
		$data['pemeliharaan'] = $this->m_pemeliharaan->joinpemeliharaan();*/
		$data['content'] = "pemeliharaan/v_pemeliharaan";
		$this->load->view('template/template', $data);
	}

	public function cetak(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Pemeliharaan Tanggal '.date('d-m-y', strtotime($tgl));
                $pemeliharaan = $this->m_pemeliharaan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Pemeliharaan Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $pemeliharaan = $this->m_pemeliharaan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Pemeliharaan Tahun '.$tahun;
                $pemeliharaan = $this->m_pemeliharaan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Pemeliharaan';
            $pemeliharaan = $this->m_pemeliharaan->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
        $data['pemeliharaan'] = $pemeliharaan;

		ob_start();
		/*$data['content'] = "pemeliharaan/printPemeliharaan";
		$this->load->view('template/template', $data);*/
		/*$this->load->view('print', $data);*/
		$this->load->view('cetak_pemeliharaan', $data);
		/*$html = ob_get_contents();
        ob_end_clean();

        require_once('./assets/html2pdf/html2pdf.class.php');
		$pdf = new HTML2PDF('P','A4','en');
		$pdf->WriteHTML($html);
		$pdf->Output('Data Pemeliharaan.pdf', 'D');*/
	}

	// belum
	public function add()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				// $platno['platno'] = $this->m_pemeliharaan->checkplat($platKendaraan);

				
				$lastId = $this->m_pemeliharaan->getLastId()+1;
				// ==============================================
				$idPemeliharaan	= $this->input->post('idPemeliharaan');
				$tglPrint		= $this->input->post('tglPrint');
				$platKendaraan	= $this->input->post('platKendaraan');
				$kondisiOli 	= $this->input->post('oliMesin');
				$kondisiAR 		= $this->input->post('airRadiator');
				$kondisiRem		= $this->input->post('kondisiRem');
				$kondisiAccu	= $this->input->post('kondisiAccu');
				$kondisiLampu	= $this->input->post('kondisiLampu');
				$cekMobil		= $this->input->post('cekMobil');
				// $statusMobil	= $this->input->post('statusMobil');
				// $statusMobil	= if ($kondisiOli || $kondisiAR || $kondisiRem || $kondisiAccu || $kondisiLampu === 'Tidak') 
				// 	{
				// 		$statusMobil = echo "Tidak";

				// 	}
				// 	else
				// 	{
				// 		$statusMobil = echo "Ya";
				// 	}
				$where = array(
					'platKendaraan' => $platKendaraan
				);
				$cek = $this->m_pemeliharaan->cekplat("pemeliharaan",$where)->num_rows();

				//disini nih kasi if sama kek di v_pemeliharaan, jadi kalau hasilnya servercie

				if($kondisiOli == "TIDAK" || $kondisiAR == "TIDAK" || $kondisiRem == "TIDAK" || $kondisiAccu =="TIDAK" || $kondisiLampu=="TIDAK"){
						$field = array (
							'idPemeliharaan'	 	=> $lastId,
							'platKendaraan'			=> $platKendaraan,
						    'oliMesin' 				=> $kondisiOli,
						    'airRadiator' 		 	=> $kondisiAR,
						    'kondisiRem'			=> $kondisiRem,
						    'kondisiAccu'			=> $kondisiAccu,
						    'kondisiLampu'			=> $kondisiLampu,
						    'cekMobil'				=> $cekMobil,
						    'statusMobil'			=> 2 ,
						    'tglPrint'				=> $tglPrint
						    // 'statusMobil'			=> $statusMobil
						);

					}else {
						$field = array (
							'idPemeliharaan'	 	=> $lastId,
							'platKendaraan'			=> $platKendaraan,
						    'oliMesin' 				=> $kondisiOli,
						    'airRadiator' 		 	=> $kondisiAR,
						    'kondisiRem'			=> $kondisiRem,
						    'kondisiAccu'			=> $kondisiAccu,
						    'kondisiLampu'			=> $kondisiLampu,
						    'cekMobil'				=> $cekMobil,
						    'statusMobil'			=> 1,
						    'tglPrint'				=> $tglPrint

						   );
					}

						if($cek >0)
						{
							$this->session->set_flashdata('info','Data gagal disimpan');
							redirect('pemeliharaan');
						}else{

						$this->db->insert('pemeliharaan', $field);
						}

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil disimpan');
							redirect('pemeliharaan');
						} else {
							$this->session->set_flashdata('info', 'Data gagal disimpan');
							redirect('pemeliharaan');
						}
					

			}
 				else {
						$id = $this->uri->segment(3);
						$data['edit'] = $this->m_pemeliharaan->GetData($id);
						$data['list'] = $this->m_pemeliharaan->GetPemeliharaan();
						$data['dropdown'] = $this->m_pemeliharaan->tampil_data();
						$data['content'] = "pemeliharaan/add_pemeliharaan";
						$this->load->view('template/template', $data);
				}
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{
				// var_dump($this->input->post());
				
				$id				= $this->input->post('idPemeliharaan');
				$kondisiOli 	= $this->input->post('oliMesin');
				$kondisiAR 		= $this->input->post('airRadiator');
				$kondisiRem		= $this->input->post('kondisiRem');
				$kondisiAccu	= $this->input->post('kondisiAccu');
				$kondisiLampu	= $this->input->post('kondisiLampu');
				$cekMobil		= $this->input->post('cekMobil');

						$field = array (
							'idPemeliharaan'	 	=> $id,
						    'oliMesin' 				=> $kondisiOli,
						    'airRadiator' 		 	=> $kondisiAR,
						    'kondisiRem'			=> $kondisiRem,
						    'kondisiAccu'			=> $kondisiAccu,
						    'kondisiLampu'			=> $kondisiLampu,
						    'cekMobil'				=> $cekMobil,
						    'statusMobil' 			=> 1
						);

				$this->db->where('idPemeliharaan', $id);
				$this->db->update('pemeliharaan', $field);

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('pemeliharaan');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('pemeliharaan');
				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->m_pemeliharaan->GetData($id);
				$data['test'] = $this->m_pemeliharaan->joinpemeliharaan();
				$data['dropdown'] = $this->m_pemeliharaan->tampil_data();
				$data['content'] = "pemeliharaan/edit_pemeliharaan";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->m_pemeliharaan->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('pemeliharaan');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('pemeliharaan');
		}
	}

	
	public function lihat($id)
	{

		if($this->input->post('submit')) 
			{
				$data['pemeliharaan'] = $this->m_pemeliharaan->joinpemeliharaan();
				$data['content'] = "pemeliharaan/v_pemeliharaan";
				$this->load->view('template/template', $data);
			}
			else {
				$data['edit'] = $this->m_pemeliharaan->GetData($id);
				$data['test'] = $this->m_pemeliharaan->joinpemeliharaan();
				$data['dropdown'] = $this->m_pemeliharaan->tampil_data();
				$data['content'] = "pemeliharaan/lihat_pemeliharaan";
				$this->load->view('template/template', $data);
			}

	}

	// public function checkplat($platKendaraan)
	// {
	// 	$platno = $this->m_pemeliharaan->checkplat($platKendaraan);

	// 	if($platno > 0)
	// 	{
	// 		echo "<script>window.alert('NO PLAT SUDAH TERDAFTAR')window.location='pemeliharaan'</script>";
	// 	}
	// 	else{

	// 	}
	// }




}
