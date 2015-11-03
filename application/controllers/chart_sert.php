<?php
class Chart_sert extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
        $this->load->library('email');
        $this->load->model('permohonan_model');
        $this->load->model('disbun_model');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	
	function index($tahun=""){
		$this->authentication->verify('user','show');
		$data['title_group']	="Chart";
		$data['title_form']		="Rekapitulasi Sertifikat";

		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bln = (int) date('m');
		$thn = $tahun;
		$now = date('Y');
		if ($tahun == "") {
			$thn = $now;
		}
		if ((int)$thn < (int)$now) {
			$bln = 12;
		}
		$jml_permohonan = array();
		$jml_sertifikat = array();
		for ($i=1; $i <= $bln ; $i++) { 
			$permohonan = $this->permohonan_model->get_jumlah_permohonan($i,$thn);
			if ($permohonan != null) {
				$jml_permohonan[$i] = $permohonan->jumlah;
			} else {
				$jml_permohonan[$i] = 0;
			}
			$sertifikat = $this->permohonan_model->get_jumlah_sertifikat($i,$thn);
			if ($sertifikat != null) {
				$jml_sertifikat[$i] = $sertifikat->jumlah;
			} else {
				$jml_sertifikat[$i] = 0;
			}
		}

		$label = "";
		$value_permohonan = "";
		$value_sertifikat = "";
		$com = false;
		foreach ($jml_permohonan as $key => $value) {
			if ($com) {
				$label .= ", ";
				$value_permohonan .= ", ";
			}
			$label .= '"'.$BulanIndo[$key-1].'"';
			$value_permohonan .= $value;
			$com = true;
		}
		$com = false;
		foreach ($jml_sertifikat as $key => $value) {
			if ($com) {
				$value_sertifikat .= ", ";
			}
			$value_sertifikat .= $value;
			$com = true;
		}

		$value_pie = array();
		$value_pie['SMB'] = 0;		
		$value_pie['SKMB'] = 0;
		$value_pie['SKHP'] = 0;
		$value_pie['SMKP'] = 0;
		$value_pie['SMSB'] = 0;
		$value_pie['SMKE'] = 0;


		$jenis_sertifikat = $this->permohonan_model->get_chart_sertifikat($thn);
		foreach ($jenis_sertifikat as $row) {
			$jenis = $this->permohonan_model->get_jenis_sertifikat($row->kode_permohonan,$row->kode_varietas,$row->kode_komoditi);
			if ($jenis != null) {
				$value_pie[$jenis->kode_sertifikat]++;
			}
		}

		foreach ($value_pie as $key => $value) {
			$data[$key] = $value;
		}

		$noall = true;
		$data['tahun_option'] = $this->disbun_model->get_sertifikat_tahun_option($thn,$noall);
		$data['chart'] = $jml_permohonan;
		$data['label'] = $label;
		$data['value_permohonan'] = $value_permohonan;
		$data['value_sertifikat'] = $value_sertifikat;
		$data['content'] = $this->parser->parse("chart/rekap",$data,true);

		$this->template->show($data,"home");
	}


}
