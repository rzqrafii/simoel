<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

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
		$this->load->model('mobilmodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		$data['mobil'] = $this->mobilmodel->GetKendaraan();
		$data['content'] = "mobil/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				//cek upload foto atau tidak
				if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name']))
				{

				$lastId = $this->mobilmodel->getLastId()+1;

				$idKendaraan	= $this->input->post('idKendaraan');
				$namaKendaraan 	= $this->input->post('namaKendaraan');
				$merkKendaraan 	= $this->input->post('merkKendaraan');
				$platKendaraan 	= $this->input->post('platKendaraan');
				$bahanBakar 	= $this->input->post('bahanBakar');
				$tglPajak 		= $this->input->post('tglPajak');
				// $radiobut		= $this->input->post('radiobut');
				
				$config['upload_path']          = './img/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload', $config);

				$image_info = $this->upload->data();
				$file_name 	= $image_info['file_name'];


						$field = array (
							'idKendaraan'	=> $lastId,
						    'namaKendaraan' => $namaKendaraan,
						    'merkKendaraan' => $merkKendaraan,
						    'platKendaraan' => $platKendaraan,
						    'bahanBakar'	=> $bahanBakar,
						    'tglPajak'		=> $tglPajak,
						    // 'radiobut'		=> $radiobut,
						    'foto'			=> $_FILES['foto']['name']
						);

				                if (!$this->upload->do_upload('foto')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
										$this->db->insert('kendaraan', $field);

										if($this->db->affected_rows()) {
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('mobil');
										} else {
											$this->session->set_flashdata('info', 'Data gagal disimpan');
											redirect('mobil');
										}
								}

				} else {

				$lastId = $this->mobilmodel->getLastId()+1;

				$idKendaraan	= $this->input->post('idKendaraan');
				$namaKendaraan 	= $this->input->post('namaKendaraan');
				$merkKendaraan 	= $this->input->post('merkKendaraan');
				$bahanBakar 	= $this->input->post('bahanBakar');
				$platKendaraan 	= $this->input->post('platKendaraan');
				$tglPajak 		= $this->input->post('tglPajak');
				
						$field = array (
							'idKendaraan'	=> $lastId,
						    'namaKendaraan' => $namaKendaraan,
						    'merkKendaraan' => $merkKendaraan,
						    'platKendaraan' => $platKendaraan,
						    'bahanBakar'	=> $bahanBakar,
						    'tglPajak'		=> $tglPajak,
						);

						$this->db->insert('kendaraan', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil disimpan');
							redirect('mobil');
						} else {
							$this->session->set_flashdata('info', 'Data gagal disimpan');
							redirect('mobil');
						}

				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->mobilmodel->GetData($id);
				$data['list'] = $this->mobilmodel->GetKendaraan();
				$data['content'] = "mobil/add";
				$this->load->view('template/template', $data);
			}
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				//cek upload foto atau tidak
				if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name']))
				{

				$id 			= $this->input->post('idKendaraan');
				$namaKendaraan 	= $this->input->post('namaKendaraan');
				$merkKendaraan 	= $this->input->post('merkKendaraan');
				$bahanBakar 	= $this->input->post('bahanBakar');
				$plat 			= $this->input->post('platKendaraan');
				$tglPajak 		= $this->input->post('tglPajak');
				// $radiobut		= $this->input->post('radiobut');
				
				$config['upload_path']          = './img/';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $this->load->library('upload', $config);

				$image_info = $this->upload->data();
				$file_name 	= $image_info['file_name'];


						$field = array (
						    'namaKendaraan' => $namaKendaraan,
						    'merkKendaraan' => $merkKendaraan,
						    'platKendaraan' => $platKendaraan,
						    'foto'			=> $_FILES['foto']['name']
						);

				                if (!$this->upload->do_upload('foto')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
						                $this->db->where('idKendaraan', $id);
										$this->db->update('kendaraan', $field);

										if($this->db->affected_rows()) {
											$this->session->set_flashdata('info', 'Data berhasil diupdate');
											redirect('mobil');
										} else {
											$this->session->set_flashdata('info', 'Data gagal diupdate');
											redirect('mobil');
										}
								}

				} else {

				$id 			= $this->input->post('idKendaraan');
				$namaKendaraan 	= $this->input->post('namaKendaraan');
				$merkKendaraan 	= $this->input->post('merkKendaraan');
				$bahanBakar 	= $this->input->post('bahanBakar');
				$platKendaraan 	= $this->input->post('platKendaraan');
				$tglPajak 		= $this->input->post('tglPajak');
				// $radiobut		= $this->input->post('radiobut');
						$field = array (
						    'namaKendaraan' => $namaKendaraan,
						    'merkKendaraan' => $merkKendaraan,
						    'platKendaraan' => $platKendaraan
						);

						$this->db->where('idKendaraan', $id);
						$this->db->update('kendaraan', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil diupdate');
							redirect('mobil');
						} else {
							$this->session->set_flashdata('info', 'Data gagal diupdate');
							redirect('mobil');
						}

				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->mobilmodel->GetData($id);
				$data['list'] = $this->mobilmodel->GetKendaraan();
				$data['content'] = "mobil/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->mobilmodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('mobil');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('mobil');
		}
	}

}
