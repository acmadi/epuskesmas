<?php
class Inv_ruangan_model extends CI_Model {

    var $tabel     = 'mst_inv_ruangan';
    var $t_puskesmas = 'cl_phc';
	var $lang	   = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    

    function get_data($start=0,$limit=999999,$options=array())
    {
		$this->db->order_by('nama_ruangan','asc');
        $query = $this->db->get($this->tabel,$limit,$start);
        return $query->result();
    }

    function get_data_puskesmas($start=0,$limit=999999,$options=array())
    {
    	$this->db->order_by('value','asc');
    	// $this->db->where(code)
        $query = $this->db->get($this->t_puskesmas,$limit,$start);
        return $query->result();
    }

    function get_ruangan_id()
    {
    	
    	$this->db->where('code_cl_phc',$this->session->userdata('puskesmas'));
    	$query  = $this->db->query("SELECT max(id_mst_inv_ruangan) as id from mst_inv_ruangan ");

    	
    	if (empty($query->result()))
    	{
    		return 1;
    	}else {
    		foreach ($query->result() as $jum ) {
    			return $jum->id+1;
    		}
    	}

	}

 	function get_data_row($id){
		$data = array();
		$options = array('code_cl_phc' => $id);
		$query = $this->db->get_where($this->table,$options);
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}

	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, array('code_cl_phc'=>$data));
    }

    function insert_entry()
    {
    	$data['id_mst_inv_ruangan'] = $this->input->post('id_mst_inv_ruangan');
		$data['nama_ruangan']		= $this->input->post('nama_ruangan');
		$data['keterangan']			= $this->input->post('keterangan');
		$data['code_cl_phc']		= $this->input->post('code_cl_phc');

		if($this->getSelectedData($this->tabel,$data['id_mst_inv_ruangan'])->num_rows() > 0) {
			return 0;
		}else{
			if($this->db->insert($this->tabel, $data)){
			//$id= mysql_insert_id();
				return 1;
			}else{
				return mysql_error();
			}
		}
    }

    function update_entry($kode)
    {
		$data['id_mst_inv_ruangan'] = $this->input->post('id_mst_inv_ruangan');
		$data['nama']				= $this->input->post('nama_ruangan');
		$data['keterangan']			= $this->input->post('keterangan');
		$data['code_cl_phc']		= $this->input->post('code_cl_phc');

		if($this->db->update($this->tabel, $data, array("code_cl_phc"=>$kode))){
			return true;
		}else{
			return mysql_error();
		}
    }

	function delete_entry($kode)
	{
		$this->db->where('code_cl_phc',$kode);

		return $this->db->delete($this->tabel);
	}
}