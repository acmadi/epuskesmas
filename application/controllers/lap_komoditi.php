<?php
class Lap_komoditi extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('disbun_model');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	
	function index($tahun=""){
		$this->authentication->verify('user','show');
		$data['title_group']	="Laporan";
		$data['title_form']		="Daftar Komoditi";

		$data['tahun_option'] = $this->disbun_model->get_sertifikat_tahun_option($tahun);
		$data['sert'] = $this->disbun_model->get_komoditi_sertifikat($tahun); 
		// $data['komoditi'] = $this->disbun_model->get_komoditi();

		// $data['penangkar'] = $this->disbun_model->get_penangkar(); 
		$kelompok = $this->disbun_model->get_kelompok_komoditi();
		$komoditi_tab = array();
		$komoditi_content = array();
		foreach ($kelompok as $row) {
			$tab = array();
			$tab['label'] = $row->nama;
			$tab['label_id'] = "#komoditi_".$row->kode_kelompok;
			$komoditi_tab[] = $tab;
			$content = array();
			$content['kode_kelompok'] = $row->kode_kelompok;
			$content['tab_id'] = "komoditi_".$row->kode_kelompok;
			$content['tab_content'] = $this->disbun_model->get_komoditi_by_kelompok($row->kode_kelompok);
			$komoditi_content[] = $content;		
		}

		$data['tab'] = $komoditi_tab;
		$data['tab_content'] = $komoditi_content;
		$data['tahun'] = $tahun;
		$data['content'] = $this->parser->parse("laporan/komoditi",$data,true);

		$this->template->show($data,"home");
	}

	function excel($kelompok,$tahun)
	{
		$POST = array();

		$sert = $this->disbun_model->get_komoditi_sertifikat($tahun); 
		$komoditi = $this->disbun_model->get_list_komoditi($kelompok);

		$komoditi_array = array();
		$kelompok_komoditi = "";

		foreach ($komoditi as $row) {
			$komoditi_sert = array();
			$komoditi_sert['nama'] = $row->nama;
			$komoditi_sert['kelompok'] = $row->kelompok; $kelompok_komoditi = $row->kelompok;
			$komoditi_sert['SMB'] = isset($sert[$row->kode_komoditi]['SMB']) ? $sert[$row->kode_komoditi]['SMB'] : 0;
			$komoditi_sert['SKMB'] = isset($sert[$row->kode_komoditi]['SKMB']) ? $sert[$row->kode_komoditi]['SKMB'] : 0;
			$komoditi_sert['SKHPP'] = isset($sert[$row->kode_komoditi]['SKHPP']) ? $sert[$row->kode_komoditi]['SKHPP'] : 0;
			$komoditi_sert['SMKP'] = isset($sert[$row->kode_komoditi]['SMKP']) ? $sert[$row->kode_komoditi]['SMKP'] : 0;
			$komoditi_sert['SMSB'] = isset($sert[$row->kode_komoditi]['SMSB']) ? $sert[$row->kode_komoditi]['SMSB'] : 0;
			$komoditi_sert['SMKE'] = isset($sert[$row->kode_komoditi]['SMKE']) ? $sert[$row->kode_komoditi]['SMKE'] : 0;
			$komoditi_array[] = $komoditi_sert;
			$data['kelompok'] = $komoditi_sert['kelompok'];
		}
		
		// $data['query'] = $this->admin_users_model->get_list(); 
		$komoditilist = $komoditi_array;

		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = dirname(__FILE__).'/../../public/files/excel/daftar_komoditi.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('a,b', $komoditilist);
		$output_file_name = 'daftar_komoditi-'.$kelompok_komoditi.'.xlsx';
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);

	}


}
