<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwalmodel extends CI_Model {
	private $jadwal = "jadwal";
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

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');

	}

	function getAll($where="") {
       $this->db->select('a.*, b.namaDriver, c.platKendaraan, e.namaPegawai')
		->join('driver b','b.idDriver = a.idDriver','INNER')
		->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
		->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
		->from('jadwal a')
		->where($where);
		$query = $this->db->get();
		return $query->result();
    }

    function getEdit($id="") {
       $this->db->select('a.*, b.namaDriver, c.platKendaraan, e.namaPegawai')
		->join('driver b','b.idDriver = a.idDriver','INNER')
		->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
		->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
		->from('jadwal a')
		->where('idJadwal', $id);
		$query = $this->db->get();
		return $query->result();
    }

    function updateJadwal($data="", $id="")
	{
		$this->db->where('idJadwal', $id);
		$query = $this->db->update($this->jadwal, $data);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

    function GetData($id) {
    	//return $this->db->where('idmerk', $id)->get('merk')->result_array();
    	$id=$this->uri->segment(3);
    	return $this->db->get_where('jadwal', array('idJadwal'=> $id))->row();
    }

    function getLastId()
	{
		return $this->db->select('MAX(idJadwal) as id')
		->get('jadwal')
		->row()->id;
	}

	public function getPemeliharaan()
	{
  		$this->db->from("pemeliharaan");
		$this->db->order_by("platKendaraan");
		$query = $this->db->get(); 
		return $query->result();
 	}

 	public function getDriver()
 	{
  		$this->db->from("driver");
		$this->db->order_by("namaDriver");
		$query = $this->db->get(); 
		return $query->result();
 	}

 	public function getPegawai()
	{
  		$this->db->from("pegawai");
		$query = $this->db->get(); 
		return $query->result();
 	}
	/*public function insert()
	{
		
		$merk = $this->input->post('merk');
		$merk_seo  = $this->fungsi->seo_title($merk);

		$input = array (
		    'namamerk' => $merk,
		    'namamerk_seo'  => $merk_seo
		);

		return $this->db->insert('merk', $input);
	}*/

	public function delete($param) {
		return $this->db->delete('jadwal', array('idJadwal' => $param));
	}

	public function view_all($where=""){
			/*return $this->db->get('jadwal')->result();*/ // Tampilkan semua data pemeliharaan
			$this->db->select('a.*, b.namaDriver, c.platKendaraan, e.namaPegawai')
			->join('driver b','b.idDriver = a.idDriver','INNER')
			->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
			->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
			->from('jadwal a')
			->where($where);
			$query = $this->db->get();
			return $query->result();
		}

		public function view_by_date($date){
			$this->db->select('a.*,YEAR(a.tglBerangkat), b.namaDriver, c.platKendaraan, e.namaPegawai')
			->join('driver b','b.idDriver = a.idDriver','INNER')
			->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
			->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
			->from('jadwal a')
        	->where('DATE(tglBerangkat)', $date); // Tambahkan where tanggal nya
        
			$query = $this->db->get();
			return $query->result();// Tampilkan data pemeliharaan sesuai tanggal yang diinput oleh user pada filter
		}
	    
		public function view_by_month($month, $year){
			$this->db->select('a.*,YEAR(a.tglBerangkat), b.namaDriver, c.platKendaraan, e.namaPegawai')
			->join('driver b','b.idDriver = a.idDriver','INNER')
			->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
			->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
			->from('jadwal a')
	        ->where('MONTH(tglBerangkat)', $month) // Tambahkan where bulan
	        ->where('YEAR(tglBerangkat)', $year); // Tambahkan where tahun
	        
			$query = $this->db->get();
			return $query->result(); // Tampilkan data pemeliharaan sesuai bulan dan tahun yang diinput oleh user pada filter
		}
	    
		public function view_by_year($year=""){
			$this->db->select('a.*,YEAR(a.tglBerangkat), b.namaDriver, c.platKendaraan, e.namaPegawai')
			->join('driver b','b.idDriver = a.idDriver','INNER')
			->join('pemeliharaan c','c.platKendaraan = a.platKendaraan','INNER')
			->join('pegawai e','e.idPegawai = a.idPegawai','INNER')
			->from('jadwal a')
	        ->where('YEAR(a.tglBerangkat)', $year); // Tambahkan where tahun
	        $query = $this->db->get();
			return $query->result();
			/*return $this->db->get('jadwal')->result();*/ // Tampilkan data pemeliharaan sesuai tahun yang diinput oleh user pada filter
		}

		public function option_tahun(){
        $this->db->select('YEAR(tglBerangkat) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('jadwal'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tglBerangkat)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tglBerangkat)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    	}

}
