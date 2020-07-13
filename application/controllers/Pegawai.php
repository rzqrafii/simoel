<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

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
		$this->load->model('pegawaimodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	

		$data['pegawai'] = $this->pegawaimodel->GetPegawai();
		$data['content'] = "pegawai/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				//cek upload foto atau tidak
				// if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name']))
				// {

				// $lastId = $this->supirmodel->getLastId()+1;

				// $lastId		= $this->input->post('idDriver');
				// $namaDriver = $this->input->post('namaDriver');
				// $ktp 		= $this->input->post('ktp');
				
				// $config['upload_path']          = './img/';
    //             $config['allowed_types']        = 'gif|jpg|png';
    //             //$config['max_size']             = 100;
    //             //$config['max_width']            = 1024;
    //             //$config['max_height']           = 768;
    //             $this->load->library('upload', $config);

				// $image_info = $this->upload->data();
				// $file_name 	= $image_info['file_name'];


				// 		$field = array (
				// 			'idDriver'	 => $lastId,
				// 		    'namaDriver' => $namaDriver,
				// 		    'ktp' 		 => $ktp,
				// 		    'foto'		 => $_FILES['foto']['name']
				// 		);

				//                 if (!$this->upload->do_upload('foto')) {
				// 	                // jika validasi file gagal, kirim parameter error ke index
				// 	                $error = array('error' => $this->upload->display_errors());
				// 	                $this->index($error);
				// 	            } else {
				// 						$this->db->insert('driver', $field);

				// 						if($this->db->affected_rows()) {
				// 							$this->session->set_flashdata('info', 'Data berhasil disimpan');
				// 							redirect('supir');
				// 						} else {
				// 							$this->session->set_flashdata('info', 'Data gagal disimpan');
				// 							redirect('supir');
				// 						}
				// 				}

				// } else {

				$lastId = $this->pegawaimodel->getLastId()+1;

				$lastId		= $this->input->post('idPegawai');
				$namaPegawai = $this->input->post('namaPegawai');
				$jabatanPegawai 		= $this->input->post('jabatanPegawai');
				$statusPegawai 		= $this->input->post('statusPegawai');
						$field = array (
							'idPegawai'	 => $lastId,
						    'namaPegawai' => $namaPegawai,
						    'jabatanPegawai'=> $jabatanPegawai,
						    'statusPegawai'=> $statusPegawai
						);

						$this->db->insert('pegawai', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil disimpan');
							redirect('pegawai');
						} else {
							$this->session->set_flashdata('info', 'Data gagal disimpan');
							redirect('pegawai');
						}

				// }

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->pegawaimodel->GetData($id);
				$data['list'] = $this->pegawaimodel->GetPegawai();
				$data['content'] = "pegawai/add";
				$this->load->view('template/template', $data);
			}
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{
				//var_dump($this->input->post());
				$id 		= $this->input->post('id');
				$namaPegawai = $this->input->post('namaPegawai');/*
				$tgllahir 	= $this->input->post('tgllahir');*/
				$jabatanPegawai 	= $this->input->post('jabatanPegawai');
				$statusPegawai 		= $this->input->post('statusPegawai');

						$field = array (
						    'namaPegawai' 	=> $namaPegawai,
						    'jabatanPegawai' => $jabatanPegawai,
						    'statusPegawai' => $statusPegawai
						);

				$this->db->where('idPegawai', $id);
				$this->db->update('pegawai', $field);

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('pegawai');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('pegawai');
				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->pegawaimodel->GetData($id);
				$data['content'] = "pegawai/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->pegawaimodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('pegawai');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('pegawai');
		}
	}

}
