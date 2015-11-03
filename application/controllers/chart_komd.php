<?php
class Chart_komd extends CI_Controller {

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
		$data['title_form']		="Rekapitulasi Komoditi";

		$data['tahun_option'] = $this->disbun_model->get_sertifikat_tahun_option($tahun);

		$bln = (int) date('m');
		$thn = date('Y');
		$value_pie = array();
		$komoditi_sertifikat = $this->permohonan_model->get_chart_sertifikat($tahun);
		foreach ($komoditi_sertifikat as $row) {
			$namakomoditi = $this->permohonan_model->get_namakomoditi_sertifikat($row->kode_permohonan,$row->kode_varietas,$row->kode_komoditi);
			if ($namakomoditi != null) {
				if (!isset($value_pie[$namakomoditi->nama_komoditi])) {
					$value_pie[$namakomoditi->nama_komoditi] = 0;
				}
				$value_pie[$namakomoditi->nama_komoditi]++;
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
				$chart_value[$idx] = number_format($value);

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

		$data['content'] = $this->parser->parse("chart/komoditi",$data,true);

		$this->template->show($data,"home");
	}


}
