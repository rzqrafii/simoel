<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

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
		$this->load->model('jadwalmodel');
		$this->load->library('Pdf');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Jadwal Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'jadwal/cetak?filter=1&tanggal='.$tgl;
                $jadwal = $this->jadwalmodel->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Jadwal Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'jadwal/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $jadwal = $this->jadwalmodel->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Jadwal Tahun '.$tahun;
                $url_cetak = 'jadwal/cetak?filter=3&tahun='.$tahun;
                $jadwal = $this->jadwalmodel->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = '';
            $url_cetak = 'jadwal/cetak';
            $where = "a.idJadwal IS NOT NULL";
            $jadwal = $this->jadwalmodel->view_all($where); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
		$data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data['option_tahun'] = $this->jadwalmodel->option_tahun();
		/*$where = "a.idJadwal IS NOT NULL";*/
		$data['jadwal'] = /*$this->jadwalmodel->getAll($where);*/$jadwal;
		$data['content'] = "jadwal/view";
		$this->load->view('template/template', $data);
		// $where = "a.idJadwal IS NOT NULL";
		// $data['jadwal'] = $this->jadwalmodel->getAll($where);
		// $data['content'] = "jadwal/view";
		// $this->load->view('template/template', $data);
	}
	public function cetak(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Jadwal Tanggal '.date('d-m-y', strtotime($tgl));
                $jadwal = $this->jadwalmodel->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Jadwal Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $jadwal = $this->jadwalmodel->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Jadwal Tahun '.$tahun;
                $jadwal = $this->jadwalmodel->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Jadwal';
            $where = "a.idJadwal IS NOT NULL";
            $jadwal = $this->jadwalmodel->view_all($where); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        /*$data['ket'] = $ket;
        $where = "a.idJadwal IS NOT NULL";
		$data['jadwal'] = $this->jadwalmodel->getAll($where);*/
		$data['ket'] = $ket;
        $data['jadwal'] = $jadwal;

		ob_start();
		/*$data['content'] = "pemeliharaan/printPemeliharaan";
		$this->load->view('template/template', $data);*/
		/*$this->load->view('print', $data);*/
		$this->load->view('cetak_jadwal', $data);
		/*$html = ob_get_contents();
        ob_end_clean();

        require_once('./assets/html2pdf/html2pdf.class.php');
		$pdf = new HTML2PDF('P','A4','en');
		$pdf->WriteHTML($html);
		$pdf->Output('Data Pemeliharaan.pdf', 'D');*/
	}


	public function add()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				$lastId = $this->jadwalmodel->getLastId()+1;

				$idJadwal			= $this->input->post('idJadwal');
				$namaPegawai		= $this->input->post('namaPegawai');
				$platKendaraan 		= $this->input->post('platKendaraan');
				$namaDriver 		= $this->input->post('namaDriver');
				$tujuan 			= $this->input->post('tujuan');
				$kepentingan 		= $this->input->post('Kepentingan');
				$tglBerangkat 		= $this->input->post('tglBerangkat');
				$lamaWaktu			= $this->input->post('lamaWaktu');
				$statusPerjalanan	= $this->input->post('statusPerjalanan');
				
						$field = array (
							'idJadwal'			=> $lastId,
							'idPegawai'			=> $namaPegawai,
						    'platKendaraan' 	=> $platKendaraan,
						    'idDriver' 			=> $namaDriver,
						    'tujuan' 			=> $tujuan,
						    'kepentingan'		=> $kepentingan,
						    'tglBerangkat'		=> $tglBerangkat,
						    'lamaWaktu'			=> $lamaWaktu,
						    'statusPerjalanan'	=> 'Terjadwal'
						);

						$updateDriver = array(
							'cekSupir' => 'Tidak Ada'
						);

						$updatePemeliharaan = array(
							'cekMobil' => 'Tidak Tersedia'
						);

						$this->db->insert('jadwal', $field);
						$this->db->update('driver', $updateDriver, array('idDriver' => $namaDriver));
						$this->db->update('pemeliharaan', $updatePemeliharaan, array('platKendaraan' => $platKendaraan));

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil disimpan');
							redirect('jadwal');
						} else {
							$this->session->set_flashdata('info', 'Data gagal disimpan');
							redirect('jadwal');
						}
			} else {
				$id = $this->uri->segment(3);
				$data['add'] = $this->jadwalmodel->GetData($id);
				$data['pemeliharaan'] = $this->jadwalmodel->getPemeliharaan();
				$data['driver'] = $this->jadwalmodel->getDriver();
				$data['pegawai'] = $this->jadwalmodel->getPegawai();
				/*$data['list'] = $this->jadwalmodel->GetJadwal();*/
				$data['content'] = "jadwal/add";
				$this->load->view('template/template', $data);
			}
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				// $lastId = $this->jadwalmodel->getLastId()+1;

				$id					= $this->input->post('idJadwal');
				$namaPegawai		= $this->input->post('idPegawai');
				$platKendaraan 		= $this->input->post('platKendaraan');
				$namaDriver 		= $this->input->post('idDriver');
				$tujuan 			= $this->input->post('tujuan');
				$kepentingan 		= $this->input->post('kepentingan');
				$tglBerangkat 		= $this->input->post('tglBerangkat');
				$lamaWaktu			= $this->input->post('lamaWaktu');
				$statusPerjalanan	= $this->input->post('statusPerjalanan');

				/*$id = $this->input->post('id');
				$merk = $this->input->post('merk');
				$merk_seo  = $this->fungsi->seo_title($merk);*/

				if($statusPerjalanan == "Terjadwal"){
					$field = array (
						'idJadwal'			=> $id,
					    'idPegawai'			=> $namaPegawai,
						'idDriver' 			=> $namaDriver,
						'tujuan' 			=> $tujuan,
						'kepentingan'		=> $kepentingan,
						'tglBerangkat'		=> $tglBerangkat,
						'lamaWaktu'			=> $lamaWaktu,
						'statusPerjalanan'	=> 'Terjadwal'
					);
						$updateDriver = array(
							'cekSupir' => 'Tidak Ada'
						);

						$updatePemeliharaan = array(
							'cekMobil' => 'Tidak Tersedia'
						);
				}else{
					$field = array (
						'idJadwal'			=> $id,
					    'idPegawai'			=> $namaPegawai,
						'idDriver' 			=> $namaDriver,
						'tujuan' 			=> $tujuan,
						'kepentingan'		=> $kepentingan,
						'tglBerangkat'		=> $tglBerangkat,
						'lamaWaktu'			=> $lamaWaktu,
						'statusPerjalanan'	=> 'Selesai'
					);

						$updateDriver = array(
							'cekSupir' => 'Ada'
						);

						$updatePemeliharaan = array(
							'cekMobil' => 'Tersedia'
						);
				}

				$this->db->where('idJadwal', $id);
				$this->db->update('jadwal', $field);

						$this->db->update('driver', $updateDriver, array('idDriver' => $namaDriver));
						$this->db->update('pemeliharaan', $updatePemeliharaan, array('platKendaraan' => $platKendaraan));

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('jadwal');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('jadwal');
				}

			} else {
				$id = $this->uri->segment(3);
				/*$data['pemeliharaan'] = $this->jadwalmodel->getPemeliharaan();
				$data['driver'] = $this->jadwalmodel->getDriver();
				$data['pegawai'] = $this->jadwalmodel->getPegawai($id);*/
				/*$data['edit'] = $this->jadwalmodel->GetData($id);*/
				$data['edit'] = $this->jadwalmodel->getEdit($id);
				$data['content'] = "jadwal/edit";
				$this->load->view('template/template', $data);
			}
	}

	public function hapus($id)
	{
		$this->jadwalmodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('jadwal');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('jadwal');
		}
	}

}
