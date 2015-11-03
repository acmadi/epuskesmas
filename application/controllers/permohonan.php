<?php

class Permohonan extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('permohonan_model');
		$this->load->model('users_model');
		$this->load->model('sendmail_model');
		$this->load->model('disbun_model');
		$this->load->helper('html');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	function index(){
		$this->authentication->verify('user','show');
		$data['title_group']	="Dashboard";
		$data['title_form']		="Permohonan Baru (draft)";

		$data['query'] = $this->users_model->get_data(0,9999999,array("status_aproved"=>"0")); 

		$permohonan_array = array();
		$permohonan = $this->permohonan_model->get_all_permohonan(array("draft"));
		
		foreach ($permohonan as $row) {
			$komoditi = $this->permohonan_model->get_komoditi_permohonan($row->kode_permohonan);
			$komoditi_array = array();
			$sertifikat_array = array();
			$komoditi_array = array();
			foreach ($komoditi as $key => $row2) {
				$sertifikat = $this->permohonan_model->get_sertifikat_by_id($row2->kode_sertifikat)->kode_sertifikat;
				$komoditi = $this->permohonan_model->get_komoditi_by_id($row2->kode_komoditi)->nama;
				if (!in_array($sertifikat,$sertifikat_array)) {
					$sertifikat_array[] = $sertifikat;
				}
				if (!in_array($komoditi,$komoditi_array)) {
					$komoditi_array[] = $komoditi;
				}
			}

			$sertifikat_text = ""; $del = false;
			foreach ($sertifikat_array as $value) {
				if ($del) $sertifikat_text .= ", ";
				$sertifikat_text .= $value; 
				$del = true;
			}

			$komoditi_text = ""; $del = false;
			foreach ($komoditi_array as $value) {
				if ($del) $komoditi_text .= ", ";
				$komoditi_text .= $value; 
				$del = true;
			}

			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['tgl_permohonan'] = $row->tgl_permohonan;
			$temp['nomor_permohonan'] = $row->nomor_permohonan;
			$temp['nama'] = $row->nama;
			$temp['address'] = $row->address;
			$temp['komoditi'] = $komoditi_text;
			$temp['sertifikat'] = $sertifikat_text;
			$permohonan_array[] = $temp;

		}
		
		$data['permohonan'] = $permohonan_array;

		$data['content'] = $this->parser->parse("permohonan/baru",$data,true);

		$this->template->show($data,"home");
	}

	function detail($kode_permohonan=""){
		$this->authentication->verify('user','show');
		$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($permohonan->username); 
		$data['kode_permohonan'] = $kode_permohonan;
		$data['nomor_permohonan'] = $permohonan->nomor_permohonan;
		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Permohonan Baru (draft)"; 

		$komoditi = $this->permohonan_model->get_komoditi_permohonan($kode_permohonan);
		$komoditi_array = array();
		foreach ($komoditi as $key => $row) {
			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['kode_varietas'] = $row->kode_varietas;
			$temp['kode_komoditi'] = $row->kode_komoditi;
			// $temp['sertifikat'] = $this->permohonan_model->get_sertifikat_by_id($row->kode_sertifikat)->nama;
			$temp['sertifikat'] = $row->kode_sertifikat;
			$temp['komoditi'] = $this->permohonan_model->get_komoditi_by_id($row->kode_komoditi)->nama;
			$temp['varietas'] = $this->permohonan_model->get_varietas_by_id($row->kode_varietas)->nama;
			$temp['bentuk_benih'] =  $this->permohonan_model->get_bentukbenih_by_id($row->kode_bentuk)->nama;
			$temp['satuan'] =  $this->permohonan_model->get_satuan_by_id($row->kode_satuan)->nama;
			$temp['jml'] = $row->jml;
			$temp['asal'] = $row->asal;
			$komoditi_array[] = $temp;
		}
		$data['komoditi'] = $komoditi_array;
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		$data['content'] = $this->parser->parse("permohonan/detail",$data,true);

		$this->template->show($data,"home");
	}

	function add(){
		$this->authentication->verify('user','show');
		$data = $this->disbun_model->get_profile(); 
		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
		$data['title_group']	="Dashboard";
		$data['title_form']		="Tambah Permohonan Baru (draft)";

		$data['query'] = $this->users_model->get_data(0,9999999,array("status_aproved"=>"0")); 

		$data['content'] = $this->parser->parse("permohonan/form",$data,true);

		$this->template->show($data,"home");
	}

	function permohonan_simpan() {
		// $this->form_validation->set_rules('tgl_permohonan', 'Tanggal Permohonan', 'trim|required');
		
		// if($this->form_validation->run()== FALSE){
		// 	echo validation_errors();
		// }elseif($this->permohonan_model->dosimpan()){
		// 	echo "Data berhasil disimpan";
		// }else{
		// 	echo "Penyimpanan data gagal dilakukan";
		// }

		$kode = $this->permohonan_model->dosimpan();
		if ($kode) {
			redirect(base_url()."permohonan/detail/".$kode."?tab=tab_2");
		}
	}

	function permohonan_update($kode_permohonan) {
		$this->form_validation->set_rules('tgl_permohonan', 'Tanggal Permohonan', 'trim|required');
		
		if($this->form_validation->run()== FALSE){
			echo validation_errors();
		}elseif($this->permohonan_model->permohonan_update($kode_permohonan)){
			echo "Data berhasil disimpan";
		}else{
			echo "Penyimpanan data gagal dilakukan";
		}

		// $kode = $this->permohonan_model->permohonan_update($kode_permohonan);
		// if ($kode) {
		// 	redirect(base_url()."permohonan/");
		// }
	}

	function add_komoditi($kode_permohonan=""){
		$this->authentication->verify('user','show');
		$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($permohonan->username); 
		$data['nomor_permohonan'] = $permohonan->nomor_permohonan;
		$data['kode_permohonan'] = $permohonan->kode_permohonan;
		$data['nama_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['nama_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['nama_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		$komoditi = $this->permohonan_model->get_komoditi_permohonan($kode_permohonan);
		if(count($komoditi)>0) $lock = 1;
		else $lock = 0;
		$kode_retribusi = 0;
		$kode_spesifikasi = 0;
		$kode_satuan = "";
		$kode_bentuk = 0;
		foreach ($komoditi as $row) {
			$kode_retribusi = $row->kode_retribusi;
			$kode_spesifikasi = $row->kode_spek;
			$kode_satuan = $row->kode_satuan;
			$kode_bentuk = $row->kode_bentuk;
		}

		$data['provinsi_option']	= $this->crud->provinsi_option($data['propinsi']);
		$data['komoditi_selected'] = $this->permohonan_model->get_komoditi_id_permohonan($kode_permohonan);
		$data['jenistanaman_option'] = $this->crud->jenistanaman_option($data['komoditi_selected'],$lock);
		$data['retribusi_option'] = $this->crud->retribusi_option($kode_retribusi,$lock);
		$data['spesifikasi_option'] = $this->crud->spesifikasi_option($kode_spesifikasi,$lock);
		$data['satuan_option'] = $this->crud->satuan_option($kode_satuan,$lock);
		$data['bentukbenih_option'] = $this->crud->bentukbenih_option($kode_bentuk,$lock);
		$data['varietas_option']	= $this->crud->varietas_option_nonselected($this->permohonan_model->get_varietas_selected($kode_permohonan));
		// $data['bentukbenih_option']	= $this->crud->bentukbenih_option();
		$data['sertifikat_option']	= $this->crud->sertifikat_option();

		$data['title_group']	="Dashboard";
		$data['title_form']		="Data Komoditi Permohonan Sertifikasi";

		$data['content'] = $this->parser->parse("permohonan/form_komoditi",$data,true);

		$this->template->show($data,"home");
	}

	function detail_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('user','show');
		$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($permohonan->username); 
		$data['nomor_permohonan'] = $permohonan->nomor_permohonan;
		$data['kode_permohonan'] = $permohonan->kode_permohonan;
		$data['nama_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['nama_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['nama_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		$komoditi = $this->permohonan_model->get_komoditi($kode_permohonan,$kode_varietas,$kode_komoditi);
		foreach ($komoditi as $key => $row) {
			$data[$key] = $row;
		}
		// $data['id'] = $id;
		$data['provinsi_option']	= $this->crud->provinsi_option($data['id_propinsi']);
		$data['jenistanaman_option']	= $this->crud->jenistanaman_option($data['kode_komoditi'],1);
		$data['varietas_option']	= $this->crud->varietas_option_nonselected($this->permohonan_model->get_varietas_selected($kode_permohonan),$data['kode_varietas']);
		$data['bentukbenih_option']	= $this->crud->bentukbenih_option($data['kode_bentuk']);
		$data['sertifikat_option']	= $this->crud->sertifikat_option($data['kode_sertifikat']);
		$data['kode_varietas'] = $kode_varietas;
		$data['kode_komoditi'] = $kode_komoditi;

		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Komoditi Permohonan Sertifikasi";

		$data['content'] = $this->parser->parse("permohonan/detail_komoditi",$data,true);

		$this->template->show($data,"home");
	}

	function komoditi_simpan() {
		$this->form_validation->set_rules('kode_permohonan', 'Kode Permohonan', 'trim|required');
		$this->form_validation->set_rules('komoditi', 'Komoditi', 'trim|required');
		$this->form_validation->set_rules('retribusi', 'Retribusi', 'trim|required');
		$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('varietas', 'Varietas', 'trim|required');
		$this->form_validation->set_rules('bentuk_benih', 'Bentuk Benih', 'trim|required');
		$this->form_validation->set_rules('sertifikat', 'Sertifikat', 'trim|required');
		$this->form_validation->set_rules('address', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('propinsi', 'Propinsi', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('desa', 'Desa', 'trim|required');
		$this->form_validation->set_rules('asal_benih', 'Asal Benih', 'trim|required');
		$this->form_validation->set_rules('kelas_benih', 'Kelas Benih', 'trim|required');
		$this->form_validation->set_rules('umur_benih', 'Umur Benih', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');

		
		if($this->form_validation->run()== FALSE){
			echo validation_errors();
		}elseif($this->permohonan_model->komoditi_simpan()){
			echo "Data berhasil disimpan";
		}else{
			echo "Penyimpanan data gagal dilakukan";
		}

		// $kode = $this->permohonan_model->komoditi_simpan();
		// if ($kode) {
		// 	redirect(base_url()."permohonan/detail/".$kode."?tab=tab_2");
		// }
	}

	function komoditi_update($kode_permohonan,$kode_varietas,$kode_komoditi) {
		// $this->form_validation->set_rules('kode_permohonan', 'Kode Permohonan', 'trim|required');
		$this->form_validation->set_rules('komoditi', 'Komoditi', 'trim|required');
		$this->form_validation->set_rules('retribusi', 'Retribusi', 'trim|required');
		$this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('varietas', 'Varietas', 'trim|required');
		$this->form_validation->set_rules('bentuk_benih', 'Bentuk Benih', 'trim|required');
		$this->form_validation->set_rules('sertifikat', 'Sertifikat', 'trim|required');
		$this->form_validation->set_rules('address', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('propinsi', 'Propinsi', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
		$this->form_validation->set_rules('desa', 'Desa', 'trim|required');
		$this->form_validation->set_rules('asal_benih', 'Asal Benih', 'trim|required');
		$this->form_validation->set_rules('kelas_benih', 'Kelas Benih', 'trim|required');
		$this->form_validation->set_rules('umur_benih', 'Umur Benih', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');
		
		if($this->form_validation->run()== FALSE){
			echo validation_errors();
		}elseif($this->permohonan_model->komoditi_update($kode_permohonan,$kode_varietas,$kode_komoditi)){
			echo "Data berhasil disimpan";
		}else{
			echo "Penyimpanan data gagal dilakukan";
		}

		// $kode = $this->permohonan_model->komoditi_update($id);
		// if ($kode) {
		// 	// redirect(base_url()."permohonan/");
		// 	echo "Data berhasil disimpan";
		// } else {
		// 	echo "Penyimpanan data gagal dilakukan";
		// }
	}

	function retribusi($komoditi="",$koderetribusi=""){
		$data['retribusi'] = "<option>-</option>";
		$retribusi = $this->crud->get_retribusi($komoditi);		
		foreach($retribusi as $x=>$y){
			$data['retribusi'] .= "<option value='".$x."' ";
			if($koderetribusi == $x) $data['retribusi'] .="selected";
			$data['retribusi'] .=">".$y."</option>";
		}

		header('Content-type: text/X-JSON');
		echo json_encode($data);
		exit;
	}

	function spesifikasi($komoditi="", $retribusi="",$kodespesifikasi=""){
		$data['spesifikasi'] = "<option>-</option>";
		$spesifikasi = $this->crud->get_spesifikasi($komoditi,$retribusi);		
		foreach($spesifikasi as $x=>$y){
			$data['spesifikasi'] .= "<option value='".$x."' ";
			if($kodespesifikasi == $x) $data['spesifikasi'] .="selected";
			$data['spesifikasi'] .=">".$y."</option>";
		}

		header('Content-type: text/X-JSON');
		echo json_encode($data);
		exit;
	}

	function satuan($komoditi="", $retribusi="",$spesifikasi="",$kodesatuan=""){
		$data['satuan'] = "<option>-</option>";
		$satuan = $this->crud->get_satuan($komoditi,$retribusi,$spesifikasi);		
		foreach($satuan as $x=>$y){
			$data['satuan'] .= "<option value='".$x."' ";
			if($kodesatuan == $x) $data['satuan'] .="selected";
			$data['satuan'] .=">".$y."</option>";
		}

		header('Content-type: text/X-JSON');
		echo json_encode($data);
		exit;
	}

	function kirim_permohonan($id=0) {
		// if($this->permohonan_model->kirim_permohonan($id)){
		// 	// echo "Permohonan berhasil dikirim";
		// 	echo "1";
		// }else{
		// 	echo "Pengiriman permohonan gagal dilakukan";
		// }
		$this->permohonan_model->kirim_permohonan($id);
		redirect(base_url()."permohonan/");
	}

	function delete(){
		$this->permohonan_model->delete_permohonan();
		redirect(base_url()."permohonan/");
	}

	function delete_komoditi($kode_permohonan){
		$this->permohonan_model->delete_permohonan_komoditi();
		redirect(base_url()."permohonan/detail/".$kode_permohonan."?tab=tab_2");
	}


}
