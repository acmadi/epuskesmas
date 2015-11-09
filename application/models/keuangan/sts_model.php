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
	
	function get_data_type_filter($type)
    {
 		$this->db->select('*');		
		$this->db->where('type', $type);
		$this->db->order_by('kode_anggaran','asc');
		$query = $this->db->get($this->tb);		
		return $query->result_array();
    }
	
	function get_data_puskesmas_filter($pus)
    {				
 		$this->db->select('*');		
		
		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){			
			$this->db->join('keu_anggaran_tarif', "keu_anggaran_tarif.id_keu_anggaran=keu_anggaran.id_anggaran and keu_anggaran_tarif.code_cl_phc= '".$this->session->userdata('puskes')."' where keu_anggaran.type='kec'",'left');
			//kecamatan
		}else{
			$this->db->join('keu_anggaran_tarif', "keu_anggaran_tarif.id_keu_anggaran=keu_anggaran.id_anggaran and keu_anggaran_tarif.code_cl_phc= '".$this->session->userdata('puskes')."' where keu_anggaran.type='kel'",'left');
			//kelurahan
		}
		$this->db->order_by('kode_anggaran','asc');
		$query = $this->db->get('keu_anggaran');		
		return $query->result_array();
    }
	
	function get_data_puskesmas(){
		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas,0,7));
			//kecamatan
		}else{
			$this->db->like('code','P'.$kodepuskesmas);
			//kelurahan
		}
		
		$query = $this->db->get('cl_phc');
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
	
	function get_new_id_keu_anggaran(){
		$this->db->select('max(id_anggaran) as n');
		$query = $this->db->get($this->tb);
		
		foreach($query->result() as $q){
				return $q->n+1;
		}
	}
	
	function get_new_id_keu_anggaran_tarif(){
		$this->db->select('max(id) as n');
		$query = $this->db->get("keu_anggaran_tarif");
		
		foreach($query->result() as $q){
				return $q->n+1;
		}
	}
	
	function add_anggaran(){
					
		$data = array(
		   'id_anggaran' => $this->get_new_id_keu_anggaran(),
		   'sub_id' => $this->input->post('sub_id') ,
		   'kode_rekening' => $this->input->post('kode_rekening'),
		   'kode_anggaran' => $this->input->post('kode_anggaran'),
		   'uraian' => $this->input->post('uraian'),
		   'type' => $this->session->userdata('tipe')
		);
		
		return $this->db->insert($this->tb, $data);				
	}
	
	function cek_tarif($id_anggaran){
		$this->db->select('count(id) as n, id');
		$this->db->where('id_keu_anggaran',$id_anggaran);
		$this->db->where('code_cl_phc',$this->session->userdata('puskes'));
		$query = $this->db->get('keu_anggaran_tarif');
		
		foreach($query->result() as $q){
				if($q->n > 0){
					return $q->id;
				}else{
					return 0;
				}
		}
	}
	
	function add_tarif(){
		$data = array(
		   'id' => $this->get_new_id_keu_anggaran_tarif(),		   		   
		   'id_keu_anggaran' => $this->input->post('id_anggaran'),
		   'tarif' => $this->input->post('tarif'),
		   'code_cl_phc' => $this->session->userdata('puskes')
		);
		if($this->cek_tarif($data['id_keu_anggaran']) > 0){
			$this->db->where('keu_anggaran_tarif.id_keu_anggaran', $data['id_keu_anggaran']);
			$this->db->where('keu_anggaran_tarif.code_cl_phc', $data['code_cl_phc']);
			return $this->db->update('keu_anggaran_tarif', $data);
		}else{
			return $this->db->insert('keu_anggaran_tarif', $data);
		}
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
