<?php
class Inventory extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->helper('html');
	}
	
	function index(){
		$this->authentication->verify('inventory','show');

		$data['content'] = $this->parser->parse("inventory/show",$data,true);
		$this->template->show($data,'home');
	}
}
