<?php
class Pbk extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->model('sms/pbk_model');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "Buku Telepon";
		$data['title_form'] = "Nomor Terdaftar";

		$this->session->unset_userdata('filter_id_sms_grup');

		$data['grupoption'] 	= $this->pbk_model->get_grupoption();
		$data['content'] = $this->parser->parse("sms/pbk/show",$data,true);

		$this->template->show($data,"home");
	}

	function json(){
		$this->authentication->verify('sms','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'created_on') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->like("sms_pbk.created_on",$value);
				}
				elseif($field == 'nama') {
					$this->db->like("sms_pbk.nama",$value);
				}
				elseif($field == 'nama_grup') {
					$this->db->like("sms_grup.nama",$value);
				}else{
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_id_sms_grup') != '') {
			$this->db->where('sms_pbk.id_sms_grup',$this->session->userdata('filter_id_sms_grup'));
		}
		$rows_all = $this->pbk_model->get_data();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'created_on') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->like("sms_pbk.created_on",$value);
				}
				elseif($field == 'nama') {
					$this->db->like("sms_pbk.nama",$value);
				}
				elseif($field == 'nama_grup') {
					$this->db->like("sms_grup.nama",$value);
				}else{
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_id_sms_grup') != '') {
			$this->db->where('sms_pbk.id_sms_grup',$this->session->userdata('filter_id_sms_grup'));
		}
		$rows = $this->pbk_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		$no=1;
		foreach($rows as $act) {
			$data[] = array(
				'no'		=> $no++,
				'id'		=> $act->nomor,
				'nomor'		=> '+62 - '.$act->nomor,
				'nama' 		=> $act->nama,
				'nama_grup'	=> $act->nama_grup,
				'created_on'=> $act->created_on,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}

		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	function filter(){
		if($_POST) {
			if($this->input->post('id_sms_grup') != '') {
				$this->session->set_userdata('filter_id_sms_grup',$this->input->post('id_sms_grup'));
			}else{
				$this->session->unset_userdata('filter_id_sms_grup');
			}
		}
	}

	function add(){
		$this->authentication->verify('sms','add');

        $this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|callback_cekNomor');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('id_sms_grup', 'Grup', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['title_group'] = "Buku Telepon";
			$data['title_form']="Tambah Nomor Telepon";
			$data['action']="add";
			$data['nomor']="";

			$data['grupoption'] 	= $this->pbk_model->get_grupoption();
		
			$data['content'] = $this->parser->parse("sms/pbk/form",$data,true);
		}elseif($id = $this->pbk_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url().'sms/pbk/');
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."sms/pbk/add");
		}

		$this->template->show($data,"home");
	}

	function edit($nomor=""){
		$this->authentication->verify('sms','edit');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('id_sms_grup', 'Grup', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data 	= $this->pbk_model->get_data_row($nomor); 

			$data['title_group'] 	= "Buku Telepon";
			$data['title_form']		= "Ubah Nomor Telepon";
			$data['action']			= "edit";
			$data['nomor']			= $nomor;

			$data['grupoption'] 	= $this->pbk_model->get_grupoption();

			$data['content'] 	= $this->parser->parse("sms/pbk/form",$data,true);
		}elseif($this->pbk_model->update_entry($nomor)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."sms/pbk/edit/".$nomor);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."sms/pbk/edit/".$nomor);
		}

		$this->template->show($data,"home");
	}

	function dodel($kode=0,$code_cl_phc=""){
		$this->authentication->verify('sms','del');

		if($this->pbk_model->delete_entry($kode,$code_cl_phc)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
		}
	}


	function cekNomor(){
		$nomor = $this->input->post('nomor');
		$this->db->where('nomor',$nomor);
		$pbk = $this->db->get('sms_pbk')->row();
		if(!empty($pbk)){
			$this->form_validation->set_message('cekNomor', 'Nomor '.$nomor.' sudah terdaftar.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
