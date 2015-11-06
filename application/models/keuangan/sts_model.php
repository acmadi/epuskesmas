<?php
class Sts_model extends CI_Model {

    var $tb    = 'keu_anggaran';
	var $lang	  = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    
    function get_data()
    {
 		$this->db->select('*');		
		$query = $this->db->get($this->tb);		
		return $query->result_array();
    }	
	
	function cek_duplicate(){
		$this->db->select('count(id_anggaran) as n');
		$query = $this->db->get($this->tb);
		
		foreach($query->result() as $q){
				if($q->n > 0){
					return true;
				}else{
					return false;
				}
		}
	}
	
	function add_anggaran(){
		
		$data = array(
		   'id_anggaran' => $this->input->post('id_anggaran') ,
		   'sub_id' => $this->input->post('sub_id') ,
		   'kode_rekening' => $this->input->post('kode_rekening'),
		   'kode_anggaran' => $this->input->post('kode_anggaran'),
		   'uraian' => $this->input->post('uraian'),
		   'type' => $this->input->post('type')
		);
		
		return $this->db->insert($this->tb, $data);				
	}
	
	function update_anggaran(){
		
		$data = array(
		   'id_anggaran' => $this->input->post('id_anggaran') ,
		   'sub_id' => $this->input->post('sub_id') ,
		   'kode_rekening' => $this->input->post('kode_rekening'),
		   'kode_anggaran' => $this->input->post('kode_anggaran'),
		   'uraian' => $this->input->post('uraian'),
		   'type' => $this->input->post('type')
		);
		$this->db->where('id_anggaran', $this->input->post('id_anggaran_awal'));
		return $this->db->update($this->tb, $data);				
	}
			
	function delete_anggaran(){		
		$this->db->where('id_anggaran', $this->input->post('id_anggaran'));
		$this->db->delete($this->tb);
				
		$this->db->where('sub_id', $this->input->post('id_anggaran'));
		return $this->db->delete($this->tb);
	}
}
