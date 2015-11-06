<?php
class Autoreply extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "SMS Balasan Otomatis";
		$data['title_form'] = "Kata Kunci";

		$data['content'] = $this->parser->parse("sms/autoreply/show",$data,true);
		$this->template->show($data,'home');
	}
}
