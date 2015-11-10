<?php
class Peggolongan_model extends CI_Model {

    var $tabel    = 'mst_peg_golruang';
	var $lang	  = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    

    function get_data($start=0,$limit=999999,$options=array())
    {
		$this->db->order_by('id_golongan','asc');
        $query = $this->db->get($this->tabel,$limit,$start);
        return $query->result();
    }

 	function get_data_row($id_golongan){
		$data = array();
		$options = array('id_golongan' => $id_golongan);
		$query = $this->db->get_where($this->tabel,$options);
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}

	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, array('id_golongan'=>$data));
    }

    function insert_entry()
    {
		$data['id_golongan']=$this->input->post('id_golongan');
		$data['ruang']=$this->input->post('ruang');

		if($this->getSelectedData($this->tabel,$data['tar_id_golongan'])->num_rows() > 0) {
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

    function update_entry($id_golongan)
    {
		$data['id_golongan']=$this->input->post('id_golongan');
		$data['ruang']=$this->input->post('ruang');

		if($this->db->update($this->tabel, $data, array("id_golongan"=>$id_golongan))){
			return true;
		}else{
			return mysql_error();
		}
    }

	function delete_entry($id_golongan)
	{
		$this->db->where('id_golongan',$id_golongan);

		return $this->db->delete($this->tabel);
	}
}