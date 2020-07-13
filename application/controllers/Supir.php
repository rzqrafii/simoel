<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends CI_Controller {

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
		$this->load->model('supirmodel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{	
		$data['supir'] = $this->supirmodel->GetDriver();
		$data['content'] = "supir/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{


				$lastId = $this->supirmodel->getLastId()+1;

				$lastId			= $this->input->post('idDriver');
				$namaDriver 	= $this->input->post('namaDriver');
				$ktp 			= $this->input->post('ktp');
				$alamat 		= $this->input->post('alamat');
				$kondisiSupir	= $this->input->post('kondisiSupir');
				$cekSupir		= $this->input->post('cekSupir');


						$field = array (
							'idDriver'	 	=> $lastId,
						    'namaDriver' 	=> $namaDriver,
						    'ktp' 		 	=> $ktp,
						    'alamat' 		=> $alamat,
						    'kondisiSupir'	=> $kondisiSupir,
						    'cekSupir'		=> $cekSupir
						);

						$this->db->insert('driver', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil disimpan');
							redirect('supir');
						} else {
							$this->session->set_flashdata('info', 'Data gagal disimpan');
							redirect('supir');
						}

				// }

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->supirmodel->GetData($id);
				$data['list'] = $this->supirmodel->GetDriver();
				$data['content'] = "supir/add";
				$this->load->view('template/template', $data);
			}
	}

	public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				$id 			= $this->input->post('id');
				$namaDriver 	= $this->input->post('namaDriver');
				$alamat 		= $this->input->post('alamat');
				$ktp 			= $this->input->post('ktp');
				$kondisiSupir 	= $this->input->post('kondisiSupir');
				$cekSupir		= $this->input->post('cekSupir');

						$field = array (
						    'namaDriver' 	=> $namaDriver,
						    'alamat'  		=> $alamat,
						    'ktp' 			=> $ktp,
						    'kondisiSupir'	=> $kondisiSupir,
						    'cekSupir'		=> $cekSupir

						);

				$this->db->where('idDriver', $id);
				$this->db->update('driver', $field);

				if($this->db->affected_rows()) {
					$this->session->set_flashdata('info', 'Data berhasil diupdate');
					redirect('supir');
				} else {
					$this->session->set_flashdata('info', 'Data gagal diupdate');
					redirect('supir');
				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->supirmodel->GetData($id);
				$data['content'] = "supir/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->supirmodel->delete($id);
		
		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('supir');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('supir');
		}
	}

}
