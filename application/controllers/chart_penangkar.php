<?php
class Chart_penangkar extends CI_Controller {

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
		$data['title_form']		="Rekapitulasi Lokasi Produsen Benih";

		$data['tahun_option'] = $this->disbun_model->get_sertifikat_tahun_option($tahun);

		$bln = (int) date('m');
		$thn = date('Y');
		$value_pie = array();
		$lokasi_sertifikat = $this->permohonan_model->get_chart_sertifikat($tahun);
		foreach ($lokasi_sertifikat as $row) {
			$daerah = $this->permohonan_model->get_daerah_sertifikat($row->kode_permohonan,$row->kode_varietas,$row->kode_komoditi);
			if ($daerah != null) {
				if (!isset($value_pie[$daerah->nama_kota])) {
					$value_pie[$daerah->nama_kota] = 0;
				}
				$value_pie[$daerah->nama_kota]++;
			}
		}

		arsort($value_pie);

		$chart_label = array();
		$chart_value = array();		
		$label_txt = "";
		$value_txt = "";
		$idx = 1;
		$com = false;
		foreach ($value_pie as $key => $value) {
			
			if ($idx <= 10) {
				$chart_label[$idx] = $key;
				$chart_value[$idx] = $value;

				if ($com) {
					$label_txt .= ", ";
					$value_txt .= ", ";
				}
				$label_txt .= '"'.$key.'"';
				$value_txt .= $value;
				$com = true;
			}
			$idx++;
		}

		$data['label'] = $chart_label;
		$data['value'] = $chart_value;
		$data['label_txt'] = $label_txt;
		$data['value_txt'] = $value_txt;

		$data['content'] = $this->parser->parse("chart/penangkar",$data,true);

		$this->template->show($data,"home");
	}


}
