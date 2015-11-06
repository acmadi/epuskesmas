<?php
class Inv_ruangan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('mst/inv_ruangan_model');
	}

	function json(){
		$this->authentication->verify('mst','show');


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

		$rows = $this->inv_ruangan_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_mst_inv_ruangan'	=> $act->id_mst_inv_ruangan,
				'nama_ruangan'			=> $act->nama_ruangan,
				'keterangan'			=> $act->keterangan,
				'code_cl_phc'			=> $act->code_cl_phc,
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
		$this->authentication->verify('mst','edit');
		$data['title_group'] = "Parameter";
		$data['title_form'] = "Master Data - Inventory Ruangan";

		$this->db->like('code','p'.substr($this->session->userdata('puskesmas'),0,7));

		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas, 0,7));
		}else {
			$this->db->like('code','P'.$kodepuskesmas);
		}

		$data['puskesmas'] 	= $this->inv_ruangan_model->get_data_puskesmas();
		$data['content'] = $this->parser->parse("mst/inv_ruangan/show",$data,true);
		// var_dump($data['puskesmas']);
		// exit();
		$this->template->show($data,"home");
	}


	function add(){
		$this->authentication->verify('mst','add');

        $this->form_validation->set_rules('id_mst_inv_ruangan', 'Id', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('code_cl_phc', 'Nama', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['code_cl_phc']	 	= $this->session->userdata('puskesmas');
			$data['id_mst_inv_ruangan']	= $this->inv_ruangan_model->get_ruangan_id();
			$data['title_group'] 		= "Parameter";
			$data['title_form']  		= "Tambah Inventori Ruangan";
			$data['action']      		= "add";
			$data['kode']				= "";

		
			$data['content'] = $this->parser->parse("mst/inv_ruangan/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->inv_ruangan_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url()."mst/inv_ruangan/");
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."mst/inv_ruangan/add");
		}
	}

	function edit($kode=0)
	{
		$this->authentication->verify('mst','add');

        $this->form_validation->set_rules('id_mst_inv_ruangan', 'Id', 'trim|required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('code_cl_phc', 'Nama Puskesmas', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->inv_ruangan_model->get_data_row($kode); 
			// var_dump($data);
			// exit();
			
			$data['title_group'] = "Parameter";
			$data['title_form']="Ubah Inventory Ruangan";
			$data['action']="edit";
			$data['kode']=$kode;

			$data['content'] = $this->parser->parse("mst/inv_ruangan/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->inv_ruangan_model->update_entry($kode)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."mst/inv_ruangan/");
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."mst/inv_ruangan/edit/".$kode);
		}
	}

	function dodel($kode=0){
		$this->authentication->verify('mst','del');

		if($this->inv_ruangan_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."mst/inv_ruangan");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."mst/inv_ruangan");
		}
	}
}
