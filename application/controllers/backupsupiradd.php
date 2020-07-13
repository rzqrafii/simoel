<?php public function edit()
	{	
		$this->load->library('fungsi');

		if($this->input->post('submit')) 
			{

				//cek upload foto atau tidak
				if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name']))
				{

				$idDriver	    = $this->input->post('idDriver');
				$namaDriver 	= $this->input->post('namaDriver');
				$ktp 			= $this->input->post('ktp');
				
				$config['upload_path']          = './img/';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $this->load->library('upload', $config);

				$image_info = $this->upload->data();
				$file_name 	= $image_info['file_name'];


						$field = array (
						    'namaDriver' => $namaDriver,
						    'ktp'		 => $ktp,
						    'foto'		 => $_FILES['foto']['name']
						);

				                if (!$this->upload->do_upload('foto')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
						                $this->db->where('idDriver', $id);
										$this->db->update('driver', $field);

										if($this->db->affected_rows()) {
											$this->session->set_flashdata('info', 'Data berhasil diupdate');
											redirect('supir');
										} else {
											$this->session->set_flashdata('info', 'Data gagal diupdate');
											redirect('supir');
										}
								}

				} else {

				$idDriver 		= $this->input->post('idDriver');
				$namaDriver 	= $this->input->post('namaDriver');
				$ktp 			= $this->input->post('ktp');
				
						$field = array (
						    'namaDriver' => $namaDriver,
						    'ktp'		 => $ktp,
						    'alamat'	 => $alamat
						);

						$this->db->where('idDriver', $idDriver);
						$this->db->update('driver', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil diupdate');
							redirect('supir');
						} else {
							$this->session->set_flashdata('info', 'Data gagal diupdate');
							redirect('supir');
						}

				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->supirmodel->GetData($id);
				$data['list'] = $this->supirmodel->GetDriver();
				$data['content'] = "supir/edit";
				$this->load->view('template/template', $data);
			}

	}

?>