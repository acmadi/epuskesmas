<?php
class Inv_ruangan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('inventory/inv_ruangan_model');
		$this->load->model('inventory/permohonanbarang_model');
		$this->load->model('mst/puskesmas_model');
	}

	function filter(){
		if($_POST) {
			if($this->input->post('code_cl_phc') != '') {
				$this->session->set_userdata('filter_code_cl_phc',$this->input->post('code_cl_phc'));
			}
		}
	}

	function json(){
		$this->authentication->verify('inventory','show');

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		if($this->session->userdata('filter_code_cl_phc') != '') {
			$this->db->where('code_cl_phc',$this->session->userdata('filter_code_cl_phc'));
		}
		$rows_all = $this->inv_ruangan_model->get_data();


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		if($this->session->userdata('filter_code_cl_phc') != '') {
			$this->db->where('code_cl_phc',$this->session->userdata('filter_code_cl_phc'));
		}
		$rows = $this->inv_ruangan_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_mst_inv_ruangan'	=> $act->id_mst_inv_ruangan,
				'nama_ruangan'			=> $act->nama_ruangan,
				'keterangan'			=> $act->keterangan,
				'value'					=> $act->value,
				'edit'					=> 1,
				'delete'				=> 1
			);
		}

		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}



	function index(){
		$this->authentication->verify('inventory','edit');
		$data['title_group'] = "Inventory";
		$data['title_form'] = "Inventaris Ruangan";

		$this->db->like('code','p'.substr($this->session->userdata('puskesmas'),0,7));

		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas, 0,7));
		}else {
			$this->db->like('code','P'.$kodepuskesmas);
		}

		$data['datapuskesmas'] 	= $this->inv_ruangan_model->get_data_puskesmas();
		$data['content'] = $this->parser->parse("inventory/inv_ruangan/show",$data,true);
		// var_dump($data['puskesmas']);
		// exit();
		$this->template->show($data,"home");
	}


	function add(){
		$this->load->model('inventory/inv_ruangan_model');

		$this->authentication->verify('inventory','add');

        // $this->form_validation->set_rules('id_mst_inv_ruangan', 'Id', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('codepus', 'Nama', 'trim|required');

        $this->form_validation->set_rules('codepus', 'Kode', 'trim|required');

			// echo "string";
		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas,0,7));
		}else{
			$this->db->like('code','P'.$kodepuskesmas);
		}
		$data['kodepuskesmas'] = $this->puskesmas_model->get_data();

		if($this->form_validation->run()== FALSE){
			$data['code']		 		= $this->session->userdata('puskesmas');
			// $data['id_mst_inv_ruangan']	= $this->inv_ruangan_model->get_ruangan_id();
			$data['title_group'] 		= "Inventory";
			$data['title_form']  		= "Tambah Inventaris Ruangan";
			$data['action']      		= "add";
			$data['kode']				= "";

		
			$data['content'] = $this->parser->parse("inventory/inv_ruangan/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->inv_ruangan_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url()."inventory/inv_ruangan/");
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/inv_ruangan/add");
		}
	

}

	function edit($kode=0)
	{
		$this->authentication->verify('inventory','add');

        $this->form_validation->set_rules('id_mst_inv_ruangan', 'Id', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('codepus', 'Kode', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->inv_ruangan_model->get_data_row($kode); 

			$data['title_group'] = "Inventory";
			$data['title_form']="Ubah Inventory Ruangan";
			$data['action']="edit";
			$data['kode']=$kode;

			$kodepuskesmas = $this->session->userdata('puskesmas');
			if(substr($kodepuskesmas, -2)=="01"){
				$this->db->like('code','P'.substr($kodepuskesmas,0,7));
			}else{
				$this->db->like('code','P'.$kodepuskesmas);
			}
			$data['kodepuskesmas'] = $this->puskesmas_model->get_data();

		
			$data['content'] = $this->parser->parse("inventory/inv_ruangan/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->inv_ruangan_model->update_entry($kode)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."inventory/inv_ruangan/".$this->input->post('kode'));
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/inv_ruangan/edit/".$kode);
		}
	}

	function dodel($kode=0){
		$this->authentication->verify('inventory','del');

		if($this->inv_ruangan_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/inv_ruangan");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/inv_ruangan");
		}
	}
}
