<?php
class Lap_rekap extends CI_Controller {

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
		$data['title_form']		="Rekapitulasi Sertifikat";
		$data['tahun'] = $tahun;
		$data['tahun_option'] = $this->disbun_model->get_sertifikat_tahun_option($tahun);
		$data['sertifikat'] = $this->disbun_model->get_sertifikat($tahun); 

		$data['content'] = $this->parser->parse("laporan/rekap",$data,true);

		$this->template->show($data,"home");
	}

	function excel($tahun){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$POST = array();
		
		$data['query'] = $this->disbun_model->get_list_sertifikasi($tahun); 
		$sertifikasilist = $data['query'];
		// $labeltahun = "";
		// $data['labeltahun'] = $labeltahun;

		$no = 1;
		for ($i=0; $i < sizeof($sertifikasilist) ; $i++) { 
			$sertifikasilist[$i]['no'] = $no;
			$tgl_tmp = explode("-", $sertifikasilist[$i]['tgl_periksa']);
			$sertifikasilist[$i]['tgl_periksa'] = (int)$tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];
			$tgl_tmp = explode("-", $sertifikasilist[$i]['tgl_berlaku']);
			$sertifikasilist[$i]['tgl_berlaku'] = (int)$tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];
			$no++;
		}

		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

		if ($tahun == "" || $tahun == null) {
			$data['labeltahun'] = "";
		} else {
			$data['labeltahun'] = "Tahun ". $tahun;
		}

		// $TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = dirname(__FILE__).'/../../public/files/excel/rekapitulasi_sertifikasi.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('a,b', $sertifikasilist);
		$output_file_name = 'rekapitulasi_sertifikasi.xlsx';
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);

	}


}
