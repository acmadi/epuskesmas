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
 	function get_data_row($id){
		$data = array();
		$options = array('a.id_inv_permohonan_barang' => $id);
		$this->db->select("$this->tabel.*,b.value,c.nama_ruangan");
		$this->db->from("$this->tabel a");
		$this->db->join('cl_phc b', "a.code_cl_phc = b.code");
		$this->db->join('mst_inv_ruangan c', "a.id_mst_inv_ruangan = c.id_mst_inv_ruangan");
		$query = $this->db->get_where($this->tabel,$options);
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
   function insert_entry()
    {
    	$data['tanggal_permohonan']=date("Y-m-d",strtotime($this->input->post('tgl')));
		$data['keterangan']=$this->input->post('keterangan');
		$data['code_cl_phc']=$this->input->post('codepus');
		$data['id_mst_inv_ruangan']=$this->input->post('ruangan');
		$data['app_users_list_username']=$this->input->post('userdata'); 
		$data['waktu_dibuat']=date('Y-m-d');
		$data['jumlah_unit']=0;

		
			if($this->db->insert($this->tabel, $data)){
				return $this->db->insert_id();
			}else{
				return mysql_error();
			}
		/*
		*/

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
		$this->db->where('code',$kode);

		return $this->db->delete($this->tabel);
	}
}