<?php
class Sms extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->model('sms/sms_model');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data = $this->sms_model->get_data(); 
		$data['title_group'] = "SMS";
		$data['title_form'] = "Dashboard";

		$data['sms_kategori'] = $this->sms_model->get_sms_kategori();
		// var_dump($data['sms_kategori']);
		// exit();

		$data['content'] = $this->parser->parse("sms/show",$data,true);
		$this->template->show($data,'home');
	}

}
