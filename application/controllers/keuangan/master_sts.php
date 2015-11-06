<?php
class Master_sts extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('keuangan/sts_model');
	}

	function index(){
		header("location:master_sts/anggaran");
	}

	function api_data(){
		$data['ambildata'] = $this->sts_model->get_data();
		foreach($data['ambildata'] as $d){
			$txt = $d["id_anggaran"]." \t ".$d["sub_id"]." \t ".$d["kode_rekening"]." \t ".$d["kode_anggaran"]." \t ".$d["uraian"]." \t ".$d["type"]." \n";
			
			echo $txt;
		}
	}
	function anggaran(){
		$this->authentication->verify('keuangan','edit');
		$data['title_group'] = "Anggaran";
		$data['title_form'] = "Master Data - Keuangan";
		$data['ambildata'] = $this->sts_model->get_data();
		$data['content'] = $this->parser->parse("keuangan/anggaran",$data,true);		
						
		
		$this->template->show($data,"home");
	}
	function anggaran_add(){
		$this->authentication->verify('keuangan','add');
		$this->sts_model->add_anggaran();				
	}
	function anggaran_update(){
		$this->authentication->verify('keuangan','edit');
		$this->sts_model->update_anggaran();				
	}
	function anggaran_delete(){
		$this->authentication->verify('keuangan','del');
		$this->sts_model->delete_anggaran();				
	}




}
