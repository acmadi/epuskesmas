<?php
class Drh_model extends CI_Model {

    var $tabel    = 'pegawai';
    var $t_puskesmas = 'cl_phc';
    var $t_alamat = 'pegawai_alamat';
	var $lang	  = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    

    // function get_data($start=0,$limit=999999,$options=array())
    // {
    // 	$this->db->select('*');
	   //  $this->db->from('pegawai');
	   //  $this->db->join('mst_agama', 'pegawai.kode_mst_agama = mst_agama.kode', 'inner');
	   //  $this->db->join('mst_peg_nikah', 'pegawai.kode_mst_nikah = mst_peg_nikah.kode', 'inner');
	   //  $this->db->join('cl_phc', 'pegawai.code_cl_phc = cl_phc.code_cl_phc', 'inner');
	   //  $this->db->limit($limit,$start); 
	   //  $query = $this->db->get();
    // 	return $query->result();

    // }

    function get_data($start=0,$limit=999999,$options=array())
    {
		$this->db->order_by('nip_nit','asc');
        $query = $this->db->get($this->tabel,$limit,$start);
        return $query->result();
    }

    function get_data_alamat($id,$start=0,$limit=999999,$options=array())
    {
    	$this->db->where('nip_nit',$id);
		// $this->db->order_by('nip_nit','asc');
        $query = $this->db->get($this->t_alamat,$limit,$start);
        return $query->result();
    }

 	function get_data_row($id){
		$data = array();
		$options = array('nip_nit' => $id);
		$query = $this->db->get_where($this->tabel,$options);
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}

	function get_kode_agama($kode_ag){
		$this->db->select('*');
		$this->db->from('mst_agama');
		$query = $this->db->get();
		return $query->result();
	}

	function get_kode_nikah($kode_nk){
		$this->db->select('*');
		$this->db->from('mst_peg_nikah');
		$query = $this->db->get();
		return $query->result();
	}

	function get_data_puskesmas($start=0,$limit=999999,$options=array())
    {
    	$this->db->order_by('value','asc');
    	// $this->db->where(code)
        $query = $this->db->get($this->t_puskesmas,$limit,$start);
        return $query->result();
    }

	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, array('nip_nit'=>$data));
    }

    function insert_entry()
    {
    	$data['nip_nit']		= $this->input->post('nip_nit');
    	$data['nip_lama']		= $this->input->post('nip_lama');
    	$data['nip_baru']		= $this->input->post('nip_baru');
    	$data['nrk']			= $this->input->post('nrk');
    	$data['karpeg']			= $this->input->post('karpeg');
    	$data['nit']			= $this->input->post('nit');
    	$data['nit_phl']		= $this->input->post('nit_phl');
    	$data['gelar']			= $this->input->post('gelar');
    	$data['nama']			= $this->input->post('nama');
    	$data['tar_sex']		= $this->input->post('tar_sex');
    	$data['tgl_lhr']		= $this->input->post('tgl_lhr');
    	$data['tmp_lahir']		= $this->input->post('tmp_lahir');
    	$data['kode_mst_agama']	= $this->input->post('kode_mst_agama');
    	$data['kode_mst_nikah']	= $this->input->post('kode_mst_nikah');
    	$data['tar_npwp']		= $this->input->post('tar_npwp');
    	$data['tar_npwp_tgl']	= $this->input->post('tar_npwp_tgl');
    	$data['ktp']			= $this->input->post('ktp');
    	$data['goldar']			= $this->input->post('goldar');
    	$data['code_cl_phc']	= $this->input->post('code_cl_phc');
    	$data['status_masuk']	= $this->input->post('status_masuk');

		if($this->getSelectedData($this->tabel,$data['nip_nit'])->num_rows() > 0) {
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

    function update_entry($id)
    {
		$data['nip_nit']		= $this->input->post('nip_nit');
    	$data['nip_lama']		= $this->input->post('nip_lama');
    	$data['nip_baru']		= $this->input->post('nip_baru');
    	$data['nrk']			= $this->input->post('nrk');
    	$data['karpeg']			= $this->input->post('karpeg');
    	$data['nit']			= $this->input->post('nit');
    	$data['nit_phl']		= $this->input->post('nit_phl');
    	$data['gelar']			= $this->input->post('gelar');
    	$data['nama']			= $this->input->post('nama');
    	$data['tar_sex']		= $this->input->post('tar_sex');
    	$data['tgl_lhr']		= $this->input->post('tgl_lhr');
    	$data['tmp_lahir']		= $this->input->post('tmp_lahir');
    	$data['kode_mst_agama']	= $this->input->post('kode_mst_agama');
    	$data['kode_mst_nikah']	= $this->input->post('kode_mst_nikah');
    	$data['tar_npwp']		= $this->input->post('tar_npwp');
    	$data['tar_npwp_tgl']	= $this->input->post('tar_npwp_tgl');
    	$data['ktp']			= $this->input->post('ktp');
    	$data['goldar']			= $this->input->post('goldar');
    	$data['code_cl_phc']	= $this->input->post('code_cl_phc');
    	$data['status_masuk']	= $this->input->post('status_masuk');

		if($this->db->update($this->tabel, $data, array("nip_nit"=>$id))){
			return true;
		}else{
			return mysql_error();
		}
    }

	function delete_entry($id)
	{
		$this->db->where('nip_nit',$id);

		return $this->db->delete($this->tabel);
	}
}