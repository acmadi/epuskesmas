<?php
class Pbk extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('sms','show');
		$data['title_group'] = "Buku Telepon";
		$data['title_form'] = "Nomor Terdaftar";

		$data['content'] = $this->parser->parse("sms/pbk/show",$data,true);
		$this->template->show($data,'home');
	}
}
