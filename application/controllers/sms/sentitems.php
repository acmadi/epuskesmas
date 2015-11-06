<?php
class Sentitems extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "Sent Items";
		$data['title_form'] = "SMS Dikirim";

		$data['content'] = $this->parser->parse("sms/sentitems/show",$data,true);
		$this->template->show($data,'home');
	}
}
