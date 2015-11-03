<?php
class Komoditi extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('disbun_model');
	}
	
	function index(){
		$data = array();

		$data['sert'] = $this->disbun_model->get_komoditi_sertifikat(); 
		// $data['komoditi'] = $this->disbun_model->get_komoditi();

		$data['penangkar'] = $this->disbun_model->get_penangkar(); 
		$kelompok = $this->disbun_model->get_kelompok_komoditi();
		$komoditi_tab = array();
		$komoditi_content = array();
		foreach ($kelompok as $row) {
			$tab = array();
			$tab['label'] = $row->nama;
			$tab['label_id'] = "#komoditi_".$row->kode_kelompok;
			$komoditi_tab[] = $tab;
			$content = array();
			$content['tab_id'] = "komoditi_".$row->kode_kelompok;
			$content['tab_content'] = $this->disbun_model->get_komoditi_by_kelompok($row->kode_kelompok);
			$komoditi_content[] = $content;		
		}

		$data['tab'] = $komoditi_tab;
		$data['tab_content'] = $komoditi_content;

		$data['content']=$this->parser->parse("disbun/komoditi",$data,true);

		$this->template->show($data,'home_guest',1);
	}

	function detail($kode=""){
		$data = array();

		$data['komoditi'] = $this->disbun_model->get_komoditi_detail($kode); 

		$data['content']=$this->parser->parse("disbun/komoditi_detail",$data,true);

		$this->template->show($data,'home_guest',1);
	}

}
