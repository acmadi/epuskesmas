<?php
class Sms extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');

		$data['content'] = $this->parser->parse("sms/show",$data,true);
		$this->template->show($data,'home');
	}
}
