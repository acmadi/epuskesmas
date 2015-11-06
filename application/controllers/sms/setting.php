<?php
class Setting extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "SMS";
		$data['title_form'] = "Setting";

		$data['content'] = $this->parser->parse("sms/setting",$data,true);
		$this->template->show($data,'home');
	}
}
