<?php
class Permohonanbarang_model extends CI_Model {

    var $tabel    = 'inv_permohonan_barang';
	var $lang	  = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    

    function get_data($start=0,$limit=999999,$options=array())
    {	
    	$this->db->select("$this->tabel.*,c.nama_ruangan");
		$this->db->join('mst_inv_ruangan c', "inv_permohonan_barang.id_mst_inv_ruangan = c.id_mst_inv_ruangan and inv_permohonan_barang.code_cl_phc = c.code_cl_phc ",'inner');
		$this->db->order_by('inv_permohonan_barang.id_inv_permohonan_barang','desc');
		$query =$this->db->get($this->tabel,$limit,$start);
        return $query->result();
    }
    public function getItem($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

 	function get_data_row($code_cl_phc,$kode){
		$data = array();
		$this->db->where("inv_permohonan_barang.code_cl_phc",$code_cl_phc);
		$this->db->where("inv_permohonan_barang.id_inv_permohonan_barang",$kode);
		$this->db->select("inv_permohonan_barang.*,cl_phc.value,mst_inv_ruangan.nama_ruangan");
		$this->db->join('cl_phc', "inv_permohonan_barang.code_cl_phc = cl_phc.code");
		$this->db->join('mst_inv_ruangan', "inv_permohonan_barang.id_mst_inv_ruangan = mst_inv_ruangan.id_mst_inv_ruangan");
		$query = $this->db->get("inv_permohonan_barang");
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}
	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, array('id_inv_permohonan_barang'=>$data));
    }

    function get_permohonan_id($puskesmas="")
    {
    	$this->db->select('MAX(id_inv_permohonan_barang)+1 as id');
    	$this->db->where('code_cl_phc',$puskesmas);
    	$permohonan = $this->db->get('inv_permohonan_barang')->row();
    	if (empty($permohonan->id)) {
    		return 1;
    	}else {
    		return $permohonan->id;
    	}
	}
	function get_permohonanbarangitem_id()
    {
    	$query  = $this->db->query("SELECT max(id_inv_permohonan_barang_item) as id from inv_permohonan_barang_item ");
    	if (empty($query->result()))
    	{
    		return 1;
    	}else {
    		foreach ($query->result() as $jum ) {
    			return $jum->id+1;
    		}
    	}

	}
   function insert_entry()
    {
    	$data['tanggal_permohonan']	= date("Y-m-d",strtotime($this->input->post('tgl')));
		$data['keterangan']			= $this->input->post('keterangan');
		$data['code_cl_phc']		= $this->input->post('codepus');
		$data['id_mst_inv_ruangan']	= $this->input->post('ruangan');

		$data['waktu_dibuat']		= date('Y-m-d');
		$data['jumlah_unit']      	= 0;
		$data['app_users_list_username'] 	= $this->session->userdata('username'); 
		$data['id_inv_permohonan_barang']	= $this->get_permohonan_id($this->input->post('codepus'));
		if($this->db->insert($this->tabel, $data)){
			return $data['id_inv_permohonan_barang'];
		}else{
			return mysql_error();
		}
    }

    function update_entry($kode)
    {
		echo $data['code']=$this->input->post('kode');
		echo $data['uraian']=$this->input->post('uraian');

		if($this->db->update($this->tabel, $data, array("code"=>$kode))){
			return true;
		}else{
			return mysql_error();
		}
    }

	function delete_entry($kode)
	{
		$this->db->where('id_inv_permohonan_barang',$kode);

		return $this->db->delete($this->tabel);
	}
	function get_databarang($start=0,$limit=999999)
    {
		$this->db->order_by('uraian','asc');
        $query = $this->db->get('mst_inv_barang',$limit,$start);
        return $query->result();
    }
}