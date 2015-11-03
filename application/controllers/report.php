<?php

class Report extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('rekomendasi_model');
		$this->load->model('users_model');
		$this->load->model('permohonan_model');
		$this->load->model('report_model');
		$this->load->model('sendmail_model');
		$this->load->helper('html');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	function json_monitoring(){
		die(json_encode($this->report_model->json_monitoring()));
	}

	function json_timeline($id_sertifikasi){
		die(json_encode($this->report_model->json_timeline($id_sertifikasi)));
	}

	function monitoring(){
		$this->authentication->verify('monitoring','edit');
		$data['title'] = "Report: Monitoring";
		$data['content'] = $this->parser->parse("report/monitoring",$data,true);
		$this->template->show($data,"home");
	}

	

	function html_monitoring(){
		$this->authentication->verify('monitoring','edit');		
		$data = $this->report_model->json_monitoring();
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("rekomendasi/html",$data);
	}
	
	
	
	function excel_monitoring(){
		$this->authentication->verify('monitoring','edit');

		$data = $this->report_model->json_monitoring();
        
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Lengkap";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_monitoring_permohonan.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}

	function detail($id=0)
	{ 
		
		$this->authentication->verify('monitoring','edit');

		$data				= $this->users_model->get_data_row($this->session->userdata('id')); 
		$negarax            = $this->rekomendasi_model->get_data_negara($id); 
		$jenis              = $this->rekomendasi_model->get_izin_jenis($id);
		$data['title']		= "Evalutor &raquo; Detail";
		$permohonan			= $this->rekomendasi_model->get_data_row($id); 
		$pembayaran			= $this->rekomendasi_model->get_pembayaran($id); 
		$jenis_permohonan	= $this->rekomendasi_model->get_jenis_permohonan($id,$permohonan['id_jenis_permohonan']);
		$data				= array_merge($data,$permohonan, $jenis);
		$data				= array_merge($data,$jenis_permohonan);
		$data				= array_merge($data,$pembayaran);
		$data['id']			= $id;
		
		$get_user_lengkap	= $this->report_model->get_user_lengkap($id);
		$get_user_lanjut	= $this->report_model->get_user_lanjut($id);
		$get_user_rekomendasi	= $this->report_model->get_user_rekomendasi($id);
		
		
		
		 
	 
		$data['id_str']		= substr($id,0,6)."-".substr($id,-5,1)."-".substr($id,-4);
		$tgl_permohonan		= explode("/",$data['tgl_permohonan']);
		$data['tanggal']	= date("d M Y",mktime(0,0,0,$tgl_permohonan[1],$tgl_permohonan[2],$tgl_permohonan[0]));
 		$data['kode_jenis'] = strtolower($jenis_permohonan['kode']);
		$data['nama_negara']= implode(",",$negarax);
		$data['tagih_tgl']	= date("d M Y");
		$data['tagih_total']= $this->rekomendasi_model->get_tagih_total($id); 

		$data['kantor_provinsi']	= $this->crud->get_propinsi_span_session($data['kantor_kode_provinsi'],"style='background:white;border:1px solid #CCCCCC'");
		$data['kantor_kota']		= $this->crud->get_kota_span($data['kantor_kode_provinsi'],$data['kantor_kode_kota'],"style='background:white;border:1px solid #CCCCCC'");
		$data['pabrik_provinsi']	= $this->crud->get_propinsi_span_session($data['pabrik_kode_provinsi'],"style='background:white;border:1px solid #CCCCCC'");
		$data['pabrik_kota']		= $this->crud->get_kota_span($data['pabrik_kode_provinsi'],$data['pabrik_kode_kota'],"style='background:white;border:1px solid #CCCCCC'");
		$data['option_balai']		= $this->crud->get_balai_span($data['kode_balai']);
		$data['option_komoditi']	= $this->crud->get_komoditi_span($data['id_jenis_komoditi']);
		$data['option_sertifikat']	= $this->crud->get_sertifikat_span($data['id_jenis_permohonan']);
		
		
		$dtime_permohonan=$permohonan['tgl_permohonan'];
		
		$time = strtotime($dtime_permohonan);
		$newformat = date('d M Y',$time);
		if($dtime_permohonan==""){
			$data['tgl_permohonan']="-";
		}
		else{
			$data['tgl_permohonan']=$newformat;
		}
		
		$dtime_lengkap=$permohonan['status_lengkap_dtime'];
		if($dtime_lengkap==""){
			$data['status_lengkap_dtime']="-";
		}
		else{
			$data['status_lengkap_dtime']=date("d M Y", $dtime_lengkap);
		}
		
 		$dtime_lanjut=$permohonan['status_lanjut_dtime'];
		if($dtime_lanjut==""){
			$data['status_lanjut_dtime']="-";
		}
		else{
			$data['status_lanjut_dtime']=date("d M Y", $dtime_lanjut);
		}
		
		$dtime_rekomendasi=$permohonan['status_rekomendasi_dtime'];
		if($dtime_rekomendasi==""){
			$data['status_rekomendasi_dtime']="-";
		}
		else{
			$data['status_rekomendasi_dtime']=date("d M Y", $dtime_rekomendasi);
		}
 	
		if($permohonan['status_lengkap_user']==""){
			$data['user_lengkap']="-";
		}
		else{
			$data['user_lengkap']=$get_user_lengkap['nama'];
		}
		
		if($permohonan['status_lanjut_user']==""){
			$data['user_lanjut']="-";
		}
		else{
			$data['user_lanjut']=$get_user_lanjut['nama'];
		}
		
		if($permohonan['status_rekomendasi_user']==""){
			$data['user_rekomendasi']="-";
		}
		else{
			$data['user_rekomendasi']=$get_user_rekomendasi['nama'];
		}
 
 		$data['lampiran']			= $this->rekomendasi_model->get_lampiran($id,$data['id_jenis_permohonan']);
		$data['form_lampiran']		= $this->parser->parse("report/form_lampiran_lock",$data,true);
		$data['form_monitoring']	= $this->parser->parse("report/form_monitoring",$data,true);
		$data['form_timeline']	= $this->parser->parse("report/form_timeline",$data,true);
		
		echo $this->parser->parse("report/form_lock",$data,true);
	}
	
	
	
	
	
	
}
?>