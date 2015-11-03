<?php

class Rekomendasi extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('rekomendasi_model');
		$this->load->model('users_model');
		$this->load->model('permohonan_model');
		$this->load->model('sendmail_model');
		$this->load->helper('html');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	function json_tindaklanjut(){
		die(json_encode($this->rekomendasi_model->json_tindaklanjut('tindaklanjut')));
	}

	function json_rekomendasi(){
		die(json_encode($this->rekomendasi_model->json_rekomendasi('rekomendasi')));
	}

	function json_tidakrekomendasi(){
		die(json_encode($this->rekomendasi_model->json_rekomendasi('tidak')));
	}

	function json_produk_cfs($id_sertifikasi){
		die(json_encode($this->rekomendasi_model->json_produk_cfs($id_sertifikasi)));
	}

	function json_persyaratan_cfs($id_sertifikasi,$id_product){
		die(json_encode($this->rekomendasi_model->json_persyaratan_cfs($id_sertifikasi,$id_product)));
	}
	function json_lampiran_cfs($id_sertifikasi){
		die(json_encode($this->rekomendasi_model->json_lampiran_cfs($id_sertifikasi)));
	}

	function tindaklanjut(){
		$this->authentication->verify('rekomendasi','edit');
		$data['title'] = "Daftar Permohonan: Tindak Lanjut";
		$data['content'] = $this->parser->parse("rekomendasi/tindaklanjut",$data,true);
		$this->template->show($data,"home");
	}

	function rekom(){
		$this->authentication->verify('rekomendasi','edit');
		$data['title'] = "Daftar Permohonan: Rekomendasi";
		$data['content'] = $this->parser->parse("rekomendasi/rekomendasi",$data,true);
		$this->template->show($data,"home");
	}

	function tidakrekomendasi(){
		$this->authentication->verify('rekomendasi','edit');
		$data['title'] = "Daftar Permohonan: Tidak Rekomendasi";
		$data['content'] = $this->parser->parse("rekomendasi/tidakrekomendasi",$data,true);
		$this->template->show($data,"home");
	}

	function lengkap(){
		$this->authentication->verify('rekomendasi','edit');
		$data['title'] = "Daftar Permohonan: Lengkap";
		$data['content'] = $this->parser->parse("rekomendasi/lengkap",$data,true);
		$this->template->show($data,"home");
	}

	function kelengkapan($id_sertifikasi){
		$this->authentication->verify('rekomendasi','edit');		
		$data = $this->users_model->get_data_row($this->session->userdata('id')); 
		$data['title'] = "Daftar Permohonan: Tidak Tindak Lanjut";
		$data['id_sertifikasi'] = $id_sertifikasi;
		$this->parser->parse("rekomendasi/kelengkapan",$data);
	}

	function html_lengkap($status="tindaklanjut"){
		$this->authentication->verify('rekomendasi','edit');		
		$data = $this->rekomendasi_model->json_rekomendasi($status);
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("rekomendasi/html",$data);
	}
	
	function html_tindaklanjut(){
		$this->authentication->verify('rekomendasi','edit');		
		$data = $this->rekomendasi_model->json_tindaklanjut('tindaklanjut');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("rekomendasi/html",$data);
	}
	
	function html_tidakrekomendasi(){
		$this->authentication->verify('rekomendasi','edit');		
		$data = $this->rekomendasi_model->json_tidakrekomendasi('tidak');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("rekomendasi/html",$data);
	}
	function html_rekomendasi(){
		$this->authentication->verify('rekomendasi','edit');		
		$data = $this->rekomendasi_model->json_rekomendasi('rekomendasi');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("rekomendasi/html",$data);
	}
	
	function dodownload_spblp($id_sertifikasi){
		$data = $this->rekomendasi_model->get_pembayaran($id_sertifikasi); 
		$data['jenis'] = str_replace(".","\n",$data['jenis']);
		$data['total'] = number_format($data['total'],2);

		$tgl_surat			= explode("/",$data['tgl_surat']);
		$data["tgl_surat"]	= $this->authentication->indonesian_date(mktime(0,0,0,$tgl_surat[1],$tgl_surat[2],$tgl_surat[0]),'j F Y','');
		$tgl_spb			= explode("/",$data['tgl_spb']);
		$data["tgl_spb"]	= $this->authentication->indonesian_date(mktime(0,0,0,$tgl_spb[1],$tgl_spb[2],$tgl_spb[0]),'j F Y','');

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/pembayaran.docx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('a', $data['product']);
		$output_file_name = $path.'export/spblp_'.$id_sertifikasi.'.docx';
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

	function excel_lengkap($status="tindaklanjut"){
		$this->authentication->verify('rekomendasi','edit');

		$data = $this->rekomendasi_model->json_rekomendasi($status);
        
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
		$output_file_name = $path.'export/report_evaluator_permohonan.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_tindaklanjut(){
		$this->authentication->verify('rekomendasi','edit');

		$data = $this->rekomendasi_model->json_tindaklanjut('tindaklanjut');
        
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
		$output_file_name = $path.'export/report_rekomendasi_tindaklajut.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_tidakrekomendasi(){
		$this->authentication->verify('rekomendasi','edit');

		$data = $this->rekomendasi_model->json_tidakrekomendasi('tidak');
        
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
		$output_file_name = $path.'export/report_rekomendasi_tidakrekomendasi.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_rekomendasi(){
		$this->authentication->verify('rekomendasi','edit');

		$data = $this->rekomendasi_model->json_rekomendasi('rekomendasi');
        
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
		$output_file_name = $path.'export/report_rekomendasi_permohonan.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}

	function detail($id=0)
	{ 
		
		$this->authentication->verify('rekomendasi','edit');

		$permohonan			= $this->rekomendasi_model->get_data_row($id); 
		$data				= $this->users_model->get_data_row($permohonan['uid']); 
		$negarax            = $this->rekomendasi_model->get_data_negara($id); 
		$jenis              = $this->rekomendasi_model->get_izin_jenis($id);
		$data['title']		= "Evalutor &raquo; Detail";
		$pembayaran			= $this->rekomendasi_model->get_pembayaran($id); 
		$jenis_permohonan	= $this->rekomendasi_model->get_jenis_permohonan($id,$permohonan['id_jenis_permohonan']);
		$data				= array_merge($data,$permohonan, $jenis);
		$data				= array_merge($data,$jenis_permohonan);
		$data				= array_merge($data,$pembayaran);
		$data['id']			= $id;
		
		if(!isset($pembayaran['status_lunas'])){
			$data['status_lunas']="";
		}else{			
			$data['status_lunas']=$pembayaran['status_lunas'];
		}
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

		$data['form_produk']		= $this->parser->parse("rekomendasi/form_".strtolower($jenis_permohonan['kode'])."_lock",$data,true);		
		$data['produk']				= $this->rekomendasi_model->get_produk($id,$data['id_jenis_permohonan']);
		$data['lampiran_produk']	= $this->parser->parse("evaluator/form_lampiran_produk",$data,true);
 		$data['lampiran']			= $this->rekomendasi_model->get_lampiran($id,$data['id_jenis_permohonan']);
		$data['form_lampiran']		= $this->parser->parse("rekomendasi/form_lampiran_lock",$data,true);
		$kelengkapan				= $this->rekomendasi_model->get_catatan($id); 
		if($data['status_lengkap']=="tidak"){
			$data['form_catatan']	= $this->parser->parse("rekomendasi/kelengkapan_lock",$kelengkapan,true);
		}else{
			$pembayaran	= $this->permohonan_model->get_permbayaran($id);
 			if(isset($pembayaran['status_lunas'])==""){
				$data['status_lunas']="";
			}else{			 
				$data['status_lunas']=$pembayaran['status_lunas'];
			}
			$data['filename']	= isset($pembayaran['filename']) ? $pembayaran['filename']: "-";
			$data['filesize']	= isset($pembayaran['filesize']) ? number_format($pembayaran['filesize'],2) : 0;
			$data['total']		= isset($pembayaran['total']) ? number_format($pembayaran['total'],2) : 0;
			$tgl_tagih			= isset($pembayaran['tgl_tagih']) ? explode("/",$pembayaran['tgl_tagih']) : "-";
			$data['tgl_tagih']	= count($tgl_tagih) ==3 ? date("d M Y",mktime(0,0,0,$tgl_tagih[1],$tgl_tagih[2],$tgl_tagih[0])) : "-";
			$data['status_pembayaran']	= (isset($pembayaran['status']) && isset($pembayaran['status'])=="lunas") ? "Lunas" : (isset($pembayaran['status'])=="salah" ? "Salah" : "-");
			if(isset($pembayaran['status'])=="lunas"){
				$data['tgl_bayar']	= date("d M Y [ H:i:s ]",$pembayaran['tgl_bayar']);
			}else{
				$data['tgl_bayar']	= "-";
			}
			if($data['status_lengkap']=="lengkap"){
				$data['form_perintahbayar']	= $this->parser->parse("rekomendasi/form_perintahbayar_lock",$data,true);
			}else{
				$data['form_perintahbayar']	= $this->parser->parse("rekomendasi/form_perintahbayar",$data,true);
			}
			$data['form_catatan']	= $this->parser->parse("rekomendasi/kelengkapan_lock",$data,true);
		}
		echo $this->parser->parse("rekomendasi/form_lock",$data,true);
	}
	
	function get_formulir($id_sertifikasi,$id_formulir=""){
		
		$permohonan			= $this->permohonan_model->get_data_row($id_sertifikasi); 
 		$data				= $this->permohonan_model->get_formulir($id_sertifikasi,$id_formulir); 
		$tipe				= $this->permohonan_model->formulir($permohonan['id_jenis_permohonan'], $data['tipe']); 
	  	$jenis_komoditi	    = $this->permohonan_model->get_data_komoditi($permohonan['id_jenis_komoditi']);
		$data['formulir_select'] = $this->permohonan_model->formulir_select($data['tipe'], $permohonan['id_jenis_permohonan'],$data['id_formulir']);
		$jenis	 = $this->permohonan_model->get_jenis_permohonan($id_sertifikasi,$permohonan['id_jenis_permohonan']);	
		$data['status_rekomendasi']=$permohonan['status_rekomendasi'];
		$data['status_lanjut']=$permohonan['status_lanjut'];
	 
		if($jenis['tanggal']==""){
			$data['tanggal']	= "";		
		}
		else{
			$data['tanggal'] =$jenis['tanggal'];
		}
 		$data['kode'] = strtolower($jenis['kode']);
		$data['nomor_sertifikasi'] =$jenis['nomor_sertifikasi']; 
		$data['signature'] =$jenis['signature'];
		$data['nip'] =$jenis['nip'];
		
		
		if(strtolower($jenis['kode'])=="copp"){
			$data['status_lisensi'] 		 =$jenis['status_lisensi'];
			$data['status_export'] 			 =$jenis['status_export'];
			$data['status_resmi'] 			 =$jenis['status_resmi'];
			$data['status_pemasaran'] 		 =$jenis['status_pemasaran'];
			$data['id_sertifikasi']  		 =$id_sertifikasi;
			$data['date_issue'] = $this->permohonan_model->get_statusproduk_copp($id_sertifikasi); 
			$data['date_issuex'] =$this->parser->parse("permohonan/status_dateissue",$data,true);
 		
		}
 		echo  $this->parser->parse("rekomendasi/formulir_rekomendasi",$data,true);
		 
 		
	}
	
	
	function doedit_status_rekomendasi($id_sertifikasi=0, $status="rekomendasi")
	{
		$this->authentication->verify('rekomendasi','edit');
		if(strtolower($status)!="rekomendasi"){
			$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
			$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required');

			if($this->form_validation->run()== FALSE){
				echo validation_errors();
			}else{
				if($this->rekomendasi_model->insert_catatan($id_sertifikasi,"Rekomendasi",$status)){

					//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

					$this->rekomendasi_model->doedit_status_rekomendasi($id_sertifikasi, $status);
					echo "1";
				}else{
					echo "Error";
				}
			}
		}else{
			if($this->rekomendasi_model->doedit_status_rekomendasi($id_sertifikasi, $status)){
				$this->permohonan_model->update_signature($id_sertifikasi);
				$this->rekomendasi_model->insert_catatan($id_sertifikasi,"Rekomendasi",$status);

				//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

				echo "1";
			}else{
				echo "Error";
			}
		}
	}
	
}
?>