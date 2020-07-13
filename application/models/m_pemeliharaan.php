<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Pemeliharaan extends CI_Model {
 
		public function joinpemeliharaan() 
		{
		 	$this->db->select('*');
		 	$this->db->from('pemeliharaan');
		 	// fungsi join ini untuk menggabungkan dari table kendaraan dengan kolom platkendaraan yang akan dijoinkan nilainya dengan row platKendaraan yang ada pada table Pemeliharaan
		 	// kalo ingin join fungsi idkendaraan, maka kendaraa.idKendaraan = pemeliharaan.idKendaraan
		 	$this->db->join('kendaraan','kendaraan.platKendaraan=pemeliharaan.platKendaraan');
		 	$query = $this->db->get();
		 	return $query->result();
		}

		// public function get_pemeliharaan()
  //   	{
  //       	$query = $this->db->get('pemeliharaan');
  //       	return $query->result_array();
  //   	}

		public function view_all(){
			return $this->db->get('pemeliharaan')->result(); // Tampilkan semua data pemeliharaan
		}

		public function view_by_date($date){
        $this->db->where('DATE(tglPrint)', $date); // Tambahkan where tanggal nya
        
		return $this->db->get('pemeliharaan')->result();// Tampilkan data pemeliharaan sesuai tanggal yang diinput oleh user pada filter
		}
	    
		public function view_by_month($month, $year){
	        $this->db->where('MONTH(tglPrint)', $month); // Tambahkan where bulan
	        $this->db->where('YEAR(tglPrint)', $year); // Tambahkan where tahun
	        
			return $this->db->get('pemeliharaan')->result(); // Tampilkan data pemeliharaan sesuai bulan dan tahun yang diinput oleh user pada filter
		}
	    
		public function view_by_year($year){
	        $this->db->where('YEAR(tglPrint)', $year); // Tambahkan where tahun
	        
			return $this->db->get('pemeliharaan')->result(); // Tampilkan data pemeliharaan sesuai tahun yang diinput oleh user pada filter
		}

    	public function getLastId()
		{
			return $this->db->select('MAX(idPemeliharaan) as id')
			->get('pemeliharaan')
			->row()->id;
		}
		
		public function GetData($id) 
		{
    		$id = $this->uri->segment(3);
    		return $this->db->get_where('pemeliharaan', array('idPemeliharaan'=> $id))->row();
    	}

    	public function GetPemeliharaan() 
    	{
        //$this->db->get('mobil');
        //return $this->db->order_by('type','ASC')->result();
        	$this->db->from("pemeliharaan");
			$this->db->order_by("oliMesin", "ASC");
			$query = $this->db->get(); 
			return $query->result();
    	}
    	public function delete($param) 
    	{
			return $this->db->delete('pemeliharaan', array('idPemeliharaan' => $param));
		}

		public function option_tahun(){
        $this->db->select('YEAR(tglPrint) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('pemeliharaan'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tglPrint)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tglPrint)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    	}

		public function tampil_data()
		{
			$query = $this->db->get('kendaraan');
			return $query;
			

			// $result = new($query);
		}

		public function cekplat($table,$where)
		{
			return $this->db->get_where($table,$where);
		}

		// public function modal_detail()
		// {

		// 	return $this->db->get_where('pemeliharaan',array('idPemeliharaan'=>$id))->row();
		// }



		// public function checkplat($platKendaraan)
		// {
		// 	$platKendaraan =$this->uri->segment(3);
		// 	return $this->db->get_where('pemeliharaan',array('platKendaraan' => $platKendaraan));
		// }
		

}



/* End of file model_keuangan.php */
/* Location: ./application/model/model_keuangan.php */