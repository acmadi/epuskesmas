<?php

class Evaluator extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('evaluator_model');
		$this->load->model('users_model');
		$this->load->model('permohonan_model');
		$this->load->model('sendmail_model');
		$this->load->helper('html');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	function json_belumdiperiksa(){
		die(json_encode($this->evaluator_model->json_belumdiperiksa()));
	}

	function json_lengkap(){
		die(json_encode($this->evaluator_model->json_evaluator('lengkap')));
	}

	function json_rekomendasi(){
		die(json_encode($this->evaluator_model->json_rekomendasi('rekomendasi')));
	}

	function json_tidakrekomendasi(){
		die(json_encode($this->evaluator_model->json_rekomendasi('tidak')));
	}

	function json_tindaklanjut(){
		die(json_encode($this->evaluator_model->json_tindaklanjut('tindaklanjut')));
	}

	function json_tidaktindaklanjut(){
		die(json_encode($this->evaluator_model->json_tindaklanjut('tidak')));
	}

	function json_tidaklengkap(){
		die(json_encode($this->evaluator_model->json_evaluator('tidak')));
	}
	
	function json_produk_cfs($id_sertifikasi){
		die(json_encode($this->evaluator_model->json_produk_cfs($id_sertifikasi)));
	}

	function json_persyaratan_cfs($id_sertifikasi,$id_product){
		die(json_encode($this->evaluator_model->json_persyaratan_cfs($id_sertifikasi,$id_product)));
	}
	function json_lampiran_cfs($id_sertifikasi){
		die(json_encode($this->evaluator_model->json_lampiran_cfs($id_sertifikasi)));
	}

	function belumdiperiksa(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Belum dipreriksa";
		$data['content'] = $this->parser->parse("evaluator/belumdiperiksa",$data,true);
		$this->template->show($data,"home");
	}
	
	function rekomendasi(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Rekomendasi";
		$data['content'] = $this->parser->parse("evaluator/rekomendasi",$data,true);
		$this->template->show($data,"home");
	}

	function tidakrekomendasi(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Tidak Rekomendasi";
		$data['content'] = $this->parser->parse("evaluator/tidakrekomendasi",$data,true);
		$this->template->show($data,"home");
	}

	function tindaklanjut(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Tindak Lanjut";
		$data['content'] = $this->parser->parse("evaluator/tindaklanjut",$data,true);
		$this->template->show($data,"home");
	}

	function tidaktindaklanjut(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Tidak Tindak Lanjut";
		$data['content'] = $this->parser->parse("evaluator/tidaktindaklanjut",$data,true);
		$this->template->show($data,"home");
	}

	function lengkap(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Lengkap";
		$data['content'] = $this->parser->parse("evaluator/lengkap",$data,true);
		$this->template->show($data,"home");
	}

	function tidaklengkap(){
		$this->authentication->verify('evaluator','edit');
		$data['title'] = "Daftar Permohonan: Tidak Lengkap";
		$data['content'] = $this->parser->parse("evaluator/tidaklengkap",$data,true);
		$this->template->show($data,"home");
	}

	function kelengkapan($id_sertifikasi){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->users_model->get_data_row($this->session->userdata('id')); 
		$data['title'] = "Daftar Permohonan: Tidak Lengkap";
		$data['id_sertifikasi'] = $id_sertifikasi;
		$this->parser->parse("evaluator/kelengkapan",$data);
	}

	function kelengkapan_benar($id_sertifikasi){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->users_model->get_data_row($this->session->userdata('id')); 
		$data['title'] = "Daftar Permohonan: Lengkap";
		$data['id_sertifikasi'] = $id_sertifikasi;
		$this->parser->parse("evaluator/kelengkapan_benar",$data);
	}

	function kelengkapan_bayar($id_sertifikasi){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->users_model->get_data_row($this->session->userdata('id')); 
		$data['title'] = "Daftar Permohonan: Pembayaran Salah";
		$data['id_sertifikasi'] = $id_sertifikasi;
		$this->parser->parse("evaluator/kelengkapan_bayar",$data);
	}

	function html_lengkap(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_evaluator('lengkap');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}
	
	function html_tidaklengkap(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_evaluator('tidak');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}
	
	function html_tindaklanjut(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_tindaklanjut('tindaklanjut');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}
	
	function html_tidaktindaklanjut(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_tidaktindaklanjut('tidak');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}
	
	function html_rekomendasi(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_rekomendasi('rekomendasi');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}
	
	function html_tidakrekomendasi(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_tidakrekomendasi('tidak');
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}

	function html_belumdiperiksa(){
		$this->authentication->verify('evaluator','edit');		
		$data = $this->evaluator_model->json_belumdiperiksa();
		$data['Rows'] = $data[0]['Rows'];
		$this->parser->parse("evaluator/html",$data);
	}

	function dodownload_spblp($id_sertifikasi){
		$data = $this->evaluator_model->get_pembayaran($id_sertifikasi); 
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
		$output_file_name = 'spblp_'.$id_sertifikasi.'.docx';
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

	function excel_lengkap(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_evaluator('lengkap');
        
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
		$output_file_name = 'report_evaluator_lengkap.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}

	function excel_tidaklengkap(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_evaluator('tidak');
        
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Tidak Lengkap";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_tidaklengkap.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}

	function excel_belumdiperiksa(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_belumdiperiksa();
        
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Belum Diperiksa";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_belumdiperiksa.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_tindaklanjut(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_tindaklanjut('tindaklanjut');
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Tindak Lanjut";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_tindaklanjut.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_tidaktindaklanjut(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_tidaktindaklanjut('tidak');
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Tindak Lanjut";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_tidaktindaklanjut.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_rekomendasi(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_rekomendasi('rekomendasi');
        
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Tindak Lanjut";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_rekomendasi.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	
	function excel_tidakrekomendasi(){
		$this->authentication->verify('evaluator','edit');

		$data = $this->evaluator_model->json_tidakrekomendasi('tidak');
        
        $rows = $data[0]['Rows'];
		$data['title'] = "Permohonan : Tindak Lanjut";

		$path = dirname(__FILE__).'/../../public/doc_xls_';
		$TBS = new clsTinyButStrong;
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$TBS->ResetVarRef(false);
		$TBS->VarRef =  &$data;		
		$template = $path.'templates/evaluator_permohonan.xlsx';
		$TBS->LoadTemplate($template);

		$TBS->MergeBlock('data', $rows);
		$output_file_name = $path.'export/report_evaluator_tidakrekomendasi.xlsx';
		$TBS->Show(OPENTBS_FILE, $output_file_name);
		echo $output_file_name;
	}
	

	function detail($id=0)
	{ 
		
		$this->authentication->verify('evaluator','edit');

		$permohonan			= $this->evaluator_model->get_data_row($id); 
		$data				= $this->users_model->get_data_row($permohonan['uid']); 
		$negarax            = $this->evaluator_model->get_data_negara($id); 
		$jenis              = $this->evaluator_model->get_izin_jenis($id);
		$data['title']		= "Evalutor &raquo; Detail";
		$pembayaran			= $this->evaluator_model->get_pembayaran($id); 
		$jenis_permohonan	= $this->evaluator_model->get_jenis_permohonan($id,$permohonan['id_jenis_permohonan']);
		$data				= array_merge($data,$permohonan, $jenis);
		$data				= array_merge($data,$jenis_permohonan);
		$data				= array_merge($data,$pembayaran);
		$data['id']			= $id;
		$data['no_fplp']	= $permohonan['no_fplp'];
		
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
		$data['tagih_total']= $this->evaluator_model->get_tagih_total($id); 

		$data['kantor_provinsi']	= $this->crud->get_propinsi_span_session($data['kantor_kode_provinsi'],"style='background:white;border:1px solid #CCCCCC'");
		$data['kantor_kota']		= $this->crud->get_kota_span($data['kantor_kode_provinsi'],$data['kantor_kode_kota'],"style='background:white;border:1px solid #CCCCCC'");
		$data['pabrik_provinsi']	= $this->crud->get_propinsi_span_session($data['pabrik_kode_provinsi'],"style='background:white;border:1px solid #CCCCCC'");
		$data['pabrik_kota']		= $this->crud->get_kota_span($data['pabrik_kode_provinsi'],$data['pabrik_kode_kota'],"style='background:white;border:1px solid #CCCCCC'");
		$data['option_balai']		= $this->crud->get_balai_span($data['kode_balai']);
		$data['option_komoditi']	= $this->crud->get_komoditi_span($data['id_jenis_komoditi']);
		$data['option_sertifikat']	= $this->crud->get_sertifikat_span($data['id_jenis_permohonan']);

		$data['form_produk']		= $this->parser->parse("evaluator/form_".strtolower($jenis_permohonan['kode'])."_lock",$data,true);		
		$data['produk']				= $this->evaluator_model->get_produk($id,$data['id_jenis_permohonan']);
		$data['lampiran_produk']	= $this->parser->parse("evaluator/form_lampiran_produk",$data,true);
 		$data['lampiran']			= $this->evaluator_model->get_lampiran($id,$data['id_jenis_permohonan']);
 		/* $kode=$jenis_permohonan['kode'];
		if($kode=="CFS")
		{
			$data['formulir']	    = $this->parser->parse("evaluator/formulir_cfs",$data,true);
		}
		elseif($kode=="CoPP")
		{
			$data['formulir']	    = $this->parser->parse("evaluator/formulir_copp",$data,true);
		}
		elseif($kode=="COH")
		{
			$data['formulir']	    = $this->parser->parse("evaluator/formulir_coh",$data,true);
		}
		else
		{
			$data['formulir']	    = $this->parser->parse("evaluator/formulir_tw",$data,true);
		} */
		 
		$data['form_lampiran']		= $this->parser->parse("evaluator/form_lampiran_lock",$data,true);
 		$kelengkapan				= $this->evaluator_model->get_catatan($id); 
 		if($data['status_lengkap']=="tidak"){
			$data['form_catatan']	= $this->parser->parse("evaluator/kelengkapan_lock",$kelengkapan,true);
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
				$data['form_perintahbayar']	= $this->parser->parse("evaluator/form_perintahbayar_lock",$data,true);
			}else{
				$data['form_perintahbayar']	= $this->parser->parse("evaluator/form_perintahbayar",$data,true);
			}
			$data['form_catatan']	= $this->parser->parse("evaluator/kelengkapan_lock",$data,true);
			
		}
		
		echo $this->parser->parse("evaluator/form_lock",$data,true);
		
	}
	
	
	function get_formulir($id_sertifikasi,$id_formulir=""){
		
		$permohonan			= $this->permohonan_model->get_data_row($id_sertifikasi); 
 		$data				= $this->permohonan_model->get_formulir($id_sertifikasi,$id_formulir); 
		$tipe				= $this->permohonan_model->formulir($permohonan['id_jenis_permohonan'], $data['tipe']); 
	  	$jenis_komoditi	    = $this->permohonan_model->get_data_komoditi($permohonan['id_jenis_komoditi']);
		$data['formulir_select'] = $this->permohonan_model->formulir_select($data['tipe'], $permohonan['id_jenis_permohonan'],$data['id_formulir']);
		$jenis	 = $this->permohonan_model->get_jenis_permohonan($id_sertifikasi,$permohonan['id_jenis_permohonan']);
		if($jenis['tanggal']==""){
			$data['tanggal']	="";
		}
		else{
			$data['tanggal'] =$jenis['tanggal'];
		}
		
		if($jenis['tanggal_valid']==""){
			$data['tanggal_valid']	="";
		}
		else{
			$data['tanggal_valid'] =$jenis['tanggal_valid'];
		}
		
 		$data['kode'] = strtolower($jenis['kode']);
		$data['nomor_sertifikasi'] =$jenis['nomor_sertifikasi'];	
		$data['signature'] =$jenis['signature'];
		$data['nip'] =$jenis['nip'];
		
		
		$data['status_rekomendasi']	= $permohonan['status_rekomendasi'];
		$data['status_lengkap']		= $permohonan['status_lengkap'];
		$data['status_permohonan']	= $permohonan['status_permohonan'];
		$data['status_lanjut']		= $permohonan['status_lanjut'];
		if(strtolower($jenis['kode'])=="copp"){
			$data['status_lisensi'] 		 =$jenis['status_lisensi'];
			$data['status_export'] 			 =$jenis['status_export'];
			$data['status_resmi'] 			 =$jenis['status_resmi'];
			$data['status_pemasaran'] 		 =$jenis['status_pemasaran'];
			$data['id_sertifikasi']  		 =$id_sertifikasi;
			$data['date_issue'] = $this->permohonan_model->get_statusproduk_copp($id_sertifikasi); 
			$data['date_issuex'] =$this->parser->parse("permohonan/status_dateissue",$data,true);
 		
		}
 		echo  $this->parser->parse("evaluator/formulir_evaluator",$data,true);
		
		
 		
	}
	
	function doformulir($id_sertifikasi=0)
	{
		$this->authentication->verify('permohonan','edit');
 		if($this->evaluator_model->doformulir($id_sertifikasi)){
			$permohonan	= $this->permohonan_model->get_data_row($id_sertifikasi); 
 			$data		= $this->permohonan_model->get_formulir($id_sertifikasi); 

			$filename	= $id_sertifikasi.".pdf";
			$pdfFilePath = dirname(__FILE__).'/../../public/files/permohonan/sertifikat/'.$filename;
			
			ini_set('memory_limit','32M');
			$html = $this->load->view("permohonan/laporan_pdf", $data,true); // render the view into HTML
			 
			$this->load->library('pdf');
			$pdf = $this->pdf->load(); 
			//$pdf->SetFooter('|{PAGENO}|'); 
			$pdf->WriteHTML($html); 
			$pdf->Output($pdfFilePath, 'F');
			echo "OK_1";
		}else{
			echo "ERROR_2";
		}
	}

	function doedit_spblp($id_sertifikasi=0)
	{
		$this->authentication->verify('evaluator','edit');

		$no_spb = substr_count($this->input->post('no_spb'),"#");	
		if($no_spb >0){
			echo "Nomor SPB-LB tidak benar";
		}else{
			if($this->evaluator_model->doedit_spblp($id_sertifikasi)){
				echo "1";
			}else{
				echo "Error";
			}
		}
	}

	function check_nomor_spb($srt){
		echo $str;
		if(preg_match("[#]",$str)){
			return FALSE;
		}else{
			return true;
		}
	}
	
	function doedit_status_lengkap($id_sertifikasi=0, $status="Lengkap")
	{
		$this->authentication->verify('evaluator','edit');
		if(strtolower($status)!="lengkap"){
			$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
			$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required');

			if($this->form_validation->run()== FALSE){
				echo validation_errors();
			}else{
				if($this->evaluator_model->insert_catatan($id_sertifikasi,'Evaluator',$status)){

					//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

					$this->evaluator_model->update_status_lengkap($id_sertifikasi, $status);
					echo "1";
				}else{
					echo "Error";
				}
			}
		}else{
			if($this->evaluator_model->update_status_lengkap($id_sertifikasi, $status)){

				//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

				echo "1";
			}else{
				echo "Error";
			}
		}
	}
	
	function doedit_status_lanjut($id_sertifikasi=0)
	{
		$this->authentication->verify('tindaklanjut','edit');
		$this->evaluator_model->update_status_lanjut($id_sertifikasi);
		echo "1";
	}
	
	function doedit_status_pembayaran($id_sertifikasi=0, $status="lunas")
	{
		$this->authentication->verify('evaluator','edit');
		//if(strtolower($status)!="lunas"){
			$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
			$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required');

			if($this->form_validation->run()== FALSE){
				echo validation_errors();
			}else{
				if($this->evaluator_model->insert_catatan($id_sertifikasi,"Evaluator",$status)){

					//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

					$this->evaluator_model->doedit_status_pembayaran($id_sertifikasi, $status);
					echo "1";
				}else{
					echo "Error";
				}
			}
		/*}else{
			if($this->evaluator_model->doedit_status_pembayaran($id_sertifikasi, $status)){

				//disini kirim email pemberitahuan tidak lengkap dan perintah bayar

				echo "1";
			}else{
				echo "Error";
			}
		}*/
	}
	
}
?>