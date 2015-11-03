<?php
class Lap_penangkar extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('disbun_model');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	
	function index(){
		$this->authentication->verify('user','show');
		$data['title_group']	="Laporan";
		$data['title_form']		="Daftar Produsen Benih";

		$data['penangkar'] = $this->disbun_model->get_penangkar(); 

		$data['content'] = $this->parser->parse("laporan/penangkar",$data,true);

		$this->template->show($data,"home");
	}

	function excel() {
		$POST = array();
		
		$data['query'] = $this->disbun_model->get_list_produsen_benih(); 
		$penangkarlist = $data['query'];

		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = dirname(__FILE__).'/../../public/files/excel/daftar_produsen_benih.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('a,b', $penangkarlist);
		$output_file_name = 'daftar_produsen_benih.xlsx';
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);

	}


}
