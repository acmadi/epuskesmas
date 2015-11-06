<?php
class Inbox extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "Inbox";
		$data['title_form'] = "SMS Diterima";

		$data['content'] = $this->parser->parse("sms/inbox/show",$data,true);
		$this->template->show($data,'home');
	}
}
