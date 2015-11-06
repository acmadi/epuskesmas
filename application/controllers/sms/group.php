<?php
class Group extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "Grup Penerima";
		$data['title_form'] = "Grup Terdaftar";

		$data['content'] = $this->parser->parse("sms/group/show",$data,true);
		$this->template->show($data,'home');
	}
}
