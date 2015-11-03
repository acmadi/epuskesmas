<?php
class Agama extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('mst/agama_model');
	}
	
	function index(){
		$this->authentication->verify('mst','edit');
		$data['title_group'] = "Parameter";
		$data['title_form'] = "Master Data - Agama";

		$data['query'] = $this->agama_model->get_data(); 
		$data['content'] = $this->parser->parse("mst/agama/show",$data,true);

		$this->template->show($data,"home");
	}


	function add(){
		$this->authentication->verify('mst','add');


        $this->form_validation->set_rules('kode', 'Kode Agama', 'trim|required');
        $this->form_validation->set_rules('value', 'Nama Agama', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['title_group'] = "Parameter";
			$data['title_form']="Tambah Agama";
			$data['action']="add";
			$data['kode']="";

		
			$data['content'] = $this->parser->parse("mst/agama/form",$data,true);
			$this->template->show($data,"home");
		}elseif($id=$this->agama_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url()."mst/agama/");
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."mst/agama/add");
		}
	}

	function edit($kode=0)
	{
		$this->authentication->verify('mst','add');

        $this->form_validation->set_rules('value', 'Nama Agama', 'trim|required');
        $this->form_validation->set_rules('kode', 'Kode Agama', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->agama_model->get_data_row($kode); 

			$data['title_group'] = "Parameter";
			$data['title_form']="Ubah Agama";
			$data['action']="edit";
			$data['kode']=$kode;

		
			$data['content'] = $this->parser->parse("mst/agama/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->agama_model->update_entry($kode)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."mst/agama/edit/".$kode);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."mst/agama/edit/".$kode);
		}
	}

	function dodel($kode=0){
		$this->authentication->verify('mst','del');

		if($this->agama_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."mst/agama");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."mst/agama");
		}
	}

	function dodel_multi(){
		$this->authentication->verify('mst','del');

		if(is_array($this->input->post('id'))){
			foreach($this->input->post('id') as $data){
				$this->agama_model->delete_entry($data);
			}
			$this->session->set_flashdata('alert', 'Delete ('.count($this->input->post('id')).') data successful...');
		}else{
			$this->session->set_flashdata('alert', 'Nothing to delete.');
		}

		redirect(base_url()."mst/agama");
	}
}
