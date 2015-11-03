<?php

class Pemeriksaan extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('permohonan_model');
		$this->load->model('users_model');
		$this->load->model('sendmail_model');
		$this->load->model('disbun_model');
		$this->load->model('parameter_komoditi_model');
		$this->load->helper('html');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	function trup(){
		$this->authentication->verify('pemeriksaan','show');
		$data['title_group']	="Pemeriksaan";
		$data['title_form']		="Rekomendasi Tanda Registrasi Usaha Perbenihan";

		$data['query'] = $this->users_model->get_trup_list("ok"); 

		$data['content'] = $this->parser->parse("pemeriksaan/trup",$data,true);

		$this->template->show($data,"home");

	}

	function trup_detail($kode_trup="",$mode="")
	{
		$this->authentication->verify('user','edit');

		
		$this->form_validation->set_rules('status', 'Status TRUP', 'trim');
		if($this->input->post('status')=="aktif"){
			$this->form_validation->set_rules('pemeriksa', 'Petugas Pemeriksa', 'trim|required');
			$this->form_validation->set_rules('tgl_pemeriksaan', 'Tanggal Pemeriksaan', 'trim|required');
			$this->form_validation->set_rules('kesimpulan', 'Kesimpulan', 'trim|required');
			$this->form_validation->set_rules('tgl_aktif', 'Tanggal Aktif', 'trim|required');
			$this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'trim|required');
			$this->form_validation->set_rules('tenagakerja', 'Tenaga Kerja', 'trim|required');
			$this->form_validation->set_rules('benih_pupuk', 'Jenis Pupuk', 'trim|required');
			$this->form_validation->set_rules('benih_pengendalian', 'Pengendalian OPT', 'trim|required');
			$this->form_validation->set_rules('benih_penyiangan', 'Penyiangan Gulma', 'trim|required');
			$this->form_validation->set_rules('benih_dosis', 'Dosis', 'trim|required');
			$this->form_validation->set_rules('pembinaan', 'Pembinaan', 'trim|required');
			$this->form_validation->set_rules('pelatihan', 'Pelatihan', 'trim|required');
			$this->form_validation->set_rules('bidangusaha', 'Bidang Usaha', 'trim|required');
			$this->form_validation->set_rules('nomor_trup', 'Nomor TRUP', 'trim|required');

		}

		if($this->form_validation->run()== FALSE){
			$data = $this->users_model->get_trup($kode_trup); 

			$data['title_group']	="Pemeriksaan";
			$data['title_form']		="Pemeriksaan Rekomendasi TRUP";
			$id_kota_pemohon = $data['kota'];
			$id_kota_lokasi = $data['id_kota'];
			$data['nama_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
			$data['nama_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
			$data['nama_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
			$data['desa'] = $this->crud->get_desa_by_id($data['id_desa'])->nama_desa;
			$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['id_kecamatan'])->nama_kecamatan;
			$data['kota'] = $this->crud->get_kota_by_id($data['id_kota'])->nama_kota;
			if ($id_kota_pemohon[2] != "7") {
				$data['nama_kota'] = "Kabupaten " . $data['nama_kota'];
			}
			$data['nama_kecamatan'] = "Kecamatan " . $data['nama_kecamatan'];
			$data['nama_desa'] = "Desa " . $data['nama_desa'];

			if ($id_kota_lokasi[2] != "7") {
				$data['kota'] = "Kabupaten " . $data['kota'];
			}
			$data['kecamatan'] = "Kecamatan " . $data['kecamatan'];
			$data['desa'] = "Desa " . $data['desa'];

			if ($mode!="update")  {
				$pemeriksa = $data['pemeriksa'];
				$tgl_pemeriksaan = $data['tgl_pemeriksaan'];
				$kesimpulan = $data['kesimpulan'];
				$tgl_aktif = $data['tgl_aktif'];
				$tgl_akhir = $data['tgl_akhir'];
				$tenagakerja = $data['tenagakerja'];
				$benih_pupuk = $data['benih_pupuk'];
				$benih_pengendalian = $data['benih_pengendalian'];
				$benih_penyiangan = $data['benih_penyiangan'];
				$benih_dosis = $data['benih_dosis'];
				$pembinaan = $data['pembinaan'];
				$pelatihan = $data['pelatihan'];
				$bidangusaha = $data['bidangusaha'];
				$nomor_trup = $data['nomor_trup'];
			}

			if(!isset($pemeriksa)){
              	$data['pemeriksa']  = set_value('pemeriksa');
            } 
			if(!isset($tgl_pemeriksaan)){
              	$data['tgl_pemeriksaan']  = set_value('tgl_pemeriksaan');
            } 
			if(!isset($kesimpulan)){
              	$data['kesimpulan']  = set_value('kesimpulan');
            }
            if(!isset($tgl_aktif)){
              	$data['tgl_aktif']  = set_value('tgl_aktif');
            }
			if(!isset($tgl_akhir)){
              	$data['tgl_akhir']  = set_value('tgl_akhir');
            } 
			if(!isset($tenagakerja)){
              	$data['tenagakerja']  = set_value('tenagakerja');
            } 
            if(!isset($benih_pupuk)){
              	$data['benih_pupuk']  = set_value('benih_pupuk');
            } 
			if(!isset($benih_pengendalian)){
              	$data['benih_pengendalian']  = set_value('benih_pengendalian');
            } 
			if(!isset($benih_penyiangan)){
              	$data['benih_penyiangan']  = set_value('benih_penyiangan');
            }
			if(!isset($benih_dosis)){
              	$data['benih_dosis']  = set_value('benih_dosis');
            } 
			if(!isset($pembinaan)){
              	$data['pembinaan']  = set_value('pembinaan');
            } 
            if(!isset($pelatihan)){
              	$data['pelatihan']  = set_value('pelatihan');
            } 
			if(!isset($bidangusaha)){
              	$data['bidangusaha']  = set_value('bidangusaha');
            }
			if(!isset($nomor_trup)){
              	$data['nomor_trup']  = set_value('nomor_trup');
            } 


			$data['trup_rencana'] = $this->users_model->get_trup_rencana($kode_trup);
			$rencana_tr = array();
			$i = 0;
			foreach ($data['trup_rencana'] as $row) {
				$i++;

				if ($i == 1 ) {
					$rencana_tr[] = $i.".</td><td style='border-right:1px solid black;'>".$row->komoditi."</td><td style='border-right:1px solid black;text-align:left'>".$row->varietas."</td><td style='border-right:1px solid black;text-align:left'>".$row->jml."</td><td style='border-right:1px solid black;text-align:left'>".$row->umur."</td><td style='border-right:1px solid black;text-align:left'>".$row->asal."</td><td>".$row->penyaluran;
				} else {
					$rencana_tr[] = $i.".</td><td style='border-right:1px solid black;border-top:1px solid black'>".$row->komoditi."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->varietas."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->jml."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->umur."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->asal."</td><td style='border-top:1px solid black'>".$row->penyaluran;
				}
			
			}

			$data['rencana_tr'] = implode("</td></tr><tr><td style='border-right:1px solid black;border-top:1px solid black'>",$rencana_tr);
		
			$data['trup_eksisting'] = $this->users_model->get_trup_eksisting($kode_trup);
			$eksisting_tr = array();
			$i = 0;
			foreach ($data['trup_eksisting'] as $row) {
				$i++;

				if ($i == 1 ) {
					$eksisting_tr[] = $i.".</td><td style='border-right:1px solid black;'>".$row->komoditi."</td><td style='border-right:1px solid black;text-align:left'>".$row->varietas."</td><td style='border-right:1px solid black;text-align:left'>".$row->jml."</td><td style='border-right:1px solid black;text-align:left'>".$row->umur."</td><td style='border-right:1px solid black;text-align:left'>".$row->asal."</td><td>".$row->penyaluran;
				} else {
					$eksisting_tr[] = $i.".</td><td style='border-right:1px solid black;border-top:1px solid black'>".$row->komoditi."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->varietas."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->jml."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->umur."</td><td style='border-right:1px solid black;border-top:1px solid black;text-align:left'>".$row->asal."</td><td style='border-top:1px solid black'>".$row->penyaluran;
				}
			
			}

			$data['eksisting_tr'] = implode("</td></tr><tr><td style='border-right:1px solid black;border-top:1px solid black'>",$eksisting_tr);

			if ($data['tgl_aktif'] != null || $data['tgl_aktif'] != "") {
				
				$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
				if ($mode == "update") {
					$data['form_tgl_aktif'] = $data['tgl_aktif'];
					$tgl_tmp = explode("/", $data['tgl_aktif']);
					$data['tgl_aktif'] = $tgl_tmp[0]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[2];
				} else {
					$data['form_tgl_aktif'] = date_format(date_create($tgl_aktif),'d/m/Y');
					$tgl_tmp = explode("-", $data['tgl_aktif']);
					$data['tgl_aktif'] = $tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];
				}
				
			} else {
				$data['form_tgl_aktif'] = date('d/m/Y');
			}

			if ($data['tgl_akhir'] != null || $data['tgl_akhir'] != "") {
				if ($mode != "update") {
					$data['tgl_akhir'] = date_format(date_create($tgl_akhir),'d/m/Y');
				}
			} else {
				$data['tgl_akhir'] = date('d/m/Y', strtotime('+1 years'));
			}
			if ($data['tgl_pemeriksaan'] != null || $data['tgl_pemeriksaan'] != "") {
				if ($mode != "update") {
					$data['tgl_pemeriksaan'] = date_format(date_create($tgl_pemeriksaan),'d/m/Y');
				}
			} else {
				$data['tgl_pemeriksaan'] = date('d/m/Y');
			}
			
			$data['lokasi_desa'] = $data['desa'];
			$data['lokasi_kecamatan'] = $data['kecamatan'];
			$data['lokasi_kota'] = $data['kota'];
			$data['pemohon_desa'] = $data['nama_desa'];
			$data['pemohon_kecamatan'] = $data['nama_kecamatan'];
			$data['pemohon_kota'] = $data['nama_kota'];
			$data['modal_nilai'] = number_format($data['modal_nilai']);
			$data['namakelompok'] = $data['namapemohon'];

			if ($data['preview'] == null) {
				$data['preview'] = $this->permohonan_model->get_surat_template(2)['surat'];
				$data['saved_surat'] = false;
			} else {
				$data['saved_surat'] = true;
			}

			$data['content'] = $this->parser->parse("pemeriksaan/trup_detail",$data,true);
			$this->template->show($data,"home");
		}elseif($this->users_model->update_trup($kode_trup)){
			$this->session->set_flashdata('alert_form', 'Data TRUP berhasil disimpan...');
			redirect(base_url()."pemeriksaan/trup_detail/".$kode_trup);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."pemeriksaan/trup_detail/".$kode_trup);
		}
	}

	function baru(){
		$this->authentication->verify('pemeriksaan','show');
		$data['title_group']	="Dashboard";
		$data['title_form']		="Pemeriksaan Baru";

		$pemeriksaan_array = array();
		$pemeriksaan = $this->permohonan_model->get_all_permohonan(array("ok"));

		foreach ($pemeriksaan as $row) {
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
			$pemeriksaan_array[] = $temp;

		}

		$data['pemeriksaan'] = $pemeriksaan_array;

		$data['user_level'] = $this->session->userdata('level');

		$data['query'] = $this->users_model->get_data(0,9999999,array("status_aproved"=>"0")); 

		$data['content'] = $this->parser->parse("pemeriksaan/baru",$data,true);

		$this->template->show($data,"home");
	}

	function baru_detail($kode_permohonan=""){
		$this->authentication->verify('pemeriksaan','show');

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Permohonan Sertifikasi";
		$data['kode_permohonan'] = $kode_permohonan;
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['tgl_permohonan'] = "".date_format(date_create($pemeriksaan->tgl_permohonan),'d M Y');
		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		$komoditi = $this->permohonan_model->get_komoditi_permohonan($kode_permohonan);
		$komoditi_array = array();
		$sertifikat_array = array();
		foreach ($komoditi as $key => $row) {
			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['kode_varietas'] = $row->kode_varietas;
			$temp['kode_komoditi'] = $row->kode_komoditi;
			$temp['sertifikat'] = $row->kode_sertifikat;
			$temp['komoditi'] = $this->permohonan_model->get_komoditi_by_id($row->kode_komoditi)->nama;
			$temp['varietas'] = $this->permohonan_model->get_varietas_by_id($row->kode_varietas)->nama;
			$temp['bentuk_benih'] =  $this->permohonan_model->get_bentukbenih_by_id($row->kode_bentuk)->nama;
			$temp['satuan'] =  $this->permohonan_model->get_satuan_by_id($row->kode_satuan)->nama;
			$temp['jml'] = $row->jml;
			$temp['asal'] = $row->asal;
			$komoditi_array[] = $temp;

			$sertifikat = $row->kode_sertifikat;
			if (!in_array($sertifikat,$sertifikat_array)) {
				$sertifikat_array[] = $sertifikat;
			}
		}

		$sertifikat_text = ""; $del = false;
		foreach ($sertifikat_array as $value) {
			if ($del) $sertifikat_text .= ", ";
			$sertifikat_text .= $value; 
			$del = true;
		}
		$data['sertifikat'] = $sertifikat_text;
		$data['komoditi'] = $komoditi_array;

		$data['content'] = $this->parser->parse("pemeriksaan/baru_detail",$data,true);

		$this->template->show($data,"home");
	}

	function baru_detail_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('pemeriksaan','show');

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['kode_permohonan'] = $pemeriksaan->kode_permohonan;
		$data['profile_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['profile_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['profile_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
		$data['profile_propinsi'] = $this->crud->get_propinsi_by_id($data['propinsi'])->nama_propinsi;

		$komoditi = $this->permohonan_model->get_komoditi_pemeriksaan($kode_permohonan,$kode_varietas,$kode_komoditi);

		foreach ($komoditi as $key => $row) {
			$data[$key] = $row;
		}

		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Permohonan Sertifikasi";

		$data['content'] = $this->parser->parse("pemeriksaan/baru_detail_komoditi",$data,true);

		$this->template->show($data,"home");
	}



	function dibayar(){
		$this->authentication->verify('pemeriksaan','show');
		$data['title_group']	="Dashboard";
		$data['title_form']		="Pemeriksaan Status Pembayaran";

		$pemeriksaan_array = array();
		$pemeriksaan = $this->permohonan_model->get_all_permohonan(array("bayar","sertifikat"));

		foreach ($pemeriksaan as $row) {
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

			$pembayaran = $this->permohonan_model->get_pembayaran($row->kode_permohonan);
			if ($pembayaran->total_bayar != null)
				$temp['total_bayar'] = number_format($pembayaran->total_bayar);
			else $temp['total_bayar'] = 0;
			if ($pembayaran->tgl_bayar != null) {
				$temp['tgl_bayar'] = date_format(date_create($pembayaran->tgl_bayar),'d/m/Y');
			} else $temp['tgl_bayar'] = "-";

			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['tgl_permohonan'] = $row->tgl_permohonan;
			$temp['nomor_permohonan'] = $row->nomor_permohonan;
			$temp['nama'] = $row->nama;
			$temp['address'] = $row->address;
			$temp['komoditi'] = $komoditi_text;
			$temp['sertifikat'] = $sertifikat_text;
			$temp['status'] = $pembayaran->status;
			$pemeriksaan_array[] = $temp;

		}

		$data['pemeriksaan'] = $pemeriksaan_array;
		$data['user_level'] = $this->session->userdata('level');
		$data['query'] = $this->users_model->get_data(0,9999999,array("status_aproved"=>"0")); 

		$data['content'] = $this->parser->parse("pemeriksaan/dibayar",$data,true);

		$this->template->show($data,"home");
	}

	function dibayar_detail($kode_permohonan=""){
		$this->authentication->verify('pemeriksaan','show');
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['title_group']	="Pemeriksaan";
		$data['title_form']		="Detail Pembayaran Sertifikasi";

		$data['kode_permohonan'] = $kode_permohonan;
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$tgl_tmp = explode("-", $pemeriksaan->tgl_permohonan);
		$data['tgl_permohonan'] = (int)$tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];
		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		$data['pemohon_nama'] = $data['nama'];
		$data['pemohon_jabatan'] = $data['jabatan'];
		$data['pemohon_perusahaan'] = $data['perusahaan'];
		$data['nomor_surat_permohonan'] = $data['nomor_permohonan'];
		$data['tanggal_surat_permohonan'] = $data['tgl_permohonan'];
		$data['jml_diperiksa'] = 0;
		$data['jml_ok'] = 0;
		
		$komoditi = $this->permohonan_model->get_komoditi_permohonan($kode_permohonan);
		$komoditi_array = array();
		$komoditi_tr = array();
		$i=0;
		foreach ($komoditi as $key => $row) {
			$i++;
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
			$temp['jml_ok'] = $row->jml_ok;
			$temp['tarif'] = $this->permohonan_model->get_tarif($row->kode_komoditi,$row->kode_retribusi,$row->kode_spek,$row->kode_satuan);
			$komoditi_array[] = $temp;

			if($i==1){
				$ket ="</td><td rowspan='".count($komoditi)."' style='border-bottom:1px solid black'>&nbsp;";
			}else{
				$ket ="";
			}
			$komoditi_tr[] = $i.".</td><td style='border-right:1px solid black;border-bottom:1px solid black'>".$temp['varietas']."</td><td style='border-right:1px solid black;border-bottom:1px solid black;text-align:right'>".number_format($temp['jml'])."</td><td style='border-right:1px solid black;border-bottom:1px solid black;text-align:right'>".number_format($temp['jml_ok'])."</td><td style='border-right:1px solid black;border-bottom:1px solid black;text-align:right'>".number_format($temp['jml']-$temp['jml_ok']).$ket;

			$data['jml_diperiksa'] += $temp['jml'];
			$data['jml_ok'] += $temp['jml_ok'];
			$data['tarif'] = $temp['tarif'];
			$data['satuan'] = $temp['satuan'];
			$data['nama_komoditi'] = $temp['komoditi'];
			$data['bentuk_benih'] = $temp['bentuk_benih'];
		}

		$data['komoditi_tr'] = implode("</td></tr><tr><td style='border-right:1px solid black;border-bottom:1px solid black'>",$komoditi_tr);
		$data['komoditi'] = $komoditi_array;
		$data['jml_gagal'] = number_format($data['jml_diperiksa']-$data['jml_ok']);
		$data['jml_diperiksa'] = number_format($data['jml_diperiksa']);
		$data['jml_ok'] = number_format($data['jml_ok']);

		$update_pembayaran = $this->permohonan_model->get_pembayaran($kode_permohonan);
		if ($update_pembayaran!=null) {
			$data['total_bayar'] = ($update_pembayaran->total_bayar);
			$data['total_biaya'] = number_format($update_pembayaran->total_bayar);
			$data['jml_lulus'] = number_format($update_pembayaran->jml);
			$data['status_pembayaran'] = $update_pembayaran->status;

			if ($update_pembayaran->tgl_bayar != null)
				$data['tgl_pembayaran'] = "".date_format(date_create($update_pembayaran->tgl_bayar),'d/m/Y');
			if ($update_pembayaran->nomor_surat != null)
				$data['nomor_surat'] = $update_pembayaran->nomor_surat;
			if ($update_pembayaran->tgl_surat != null) {
				$data['tgl_surat'] = "".date_format(date_create($update_pembayaran->tgl_surat),'d/m/Y');

				$tgl_tmp2 = explode("-", $update_pembayaran->tgl_surat);
				$data['tanggal_surat'] = (int)$tgl_tmp2[2]." ".$BulanIndo[(int)$tgl_tmp2[1]-1]." ".$tgl_tmp2[0];

			}
			$data['surat'] = $update_pembayaran->surat;
			if ($data['surat'] == null) {
				$data['surat'] = $this->permohonan_model->get_surat_template(1)['surat'];
				$data['saved_surat'] = false;
			} else {
				$data['saved_surat'] = true;
			}
		}

		$update_pemeriksaan = $this->permohonan_model->get_pemeriksaan($kode_permohonan);
			if ($update_pemeriksaan!=null) {
				if (($update_pemeriksaan->tgl_periksa != null) && ($update_pemeriksaan->tgl_selesai != null)){
					$tgl_tmp = explode("-", $update_pemeriksaan->tgl_periksa);
					$tgl_periksa = (int)$tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];

					$tgl_tmp = explode("-", $update_pemeriksaan->tgl_selesai);
					$tgl_selesai = (int)$tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];


					if($update_pemeriksaan->tgl_periksa == $update_pemeriksaan->tgl_selesai){
						$data['tanggal_pemeriksaan'] = $tgl_periksa;
					}else{
						$data['tanggal_pemeriksaan'] = $tgl_periksa." s/d ".$tgl_selesai;
					}
				}else{
					$data['tanggal_pemeriksaan'] = "-";
				}
			}

		$data['content'] = $this->parser->parse("pemeriksaan/dibayar_detail",$data,true);

		$this->template->show($data,"home");
	}

	function dibayar_detail_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('pemeriksaan','show');

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['kode_permohonan'] = $pemeriksaan->kode_permohonan;
		$data['profile_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['profile_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['profile_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
		$data['profile_propinsi'] = $this->crud->get_propinsi_by_id($data['propinsi'])->nama_propinsi;

		$komoditi = $this->permohonan_model->get_komoditi_pemeriksaan($kode_permohonan,$kode_varietas,$kode_komoditi);
		$komoditi2 = $this->permohonan_model->get_komoditi($kode_permohonan,$kode_varietas,$kode_komoditi);

		foreach ($komoditi as $key => $row) {
			$data[$key] = $row;
		}

		$data['tarif'] = $this->permohonan_model->get_tarif($komoditi2->kode_komoditi,$komoditi2->kode_retribusi,$komoditi2->kode_spek,$komoditi2->kode_satuan);
		$data['jml_ok'] = $komoditi2->jml_ok;
		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Permohonan Sertifikasi";

		$data['content'] = $this->parser->parse("pemeriksaan/dibayar_detail_komoditi",$data,true);

		$this->template->show($data,"home");
	}

	function diperiksa(){
		$this->authentication->verify('pemeriksaan','show');
		$data['title_group']	="Dashboard";
		$data['title_form']		="Pemeriksaan Proses Pemeriksaan";

		$data['query'] = $this->users_model->get_data(0,9999999,array("status_aproved"=>"0")); 

		$pemeriksaan_array = array();
		$pemeriksaan = $this->permohonan_model->get_all_permohonan(array("periksa","bayar"));

		foreach ($pemeriksaan as $row) {
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
			$temp['tgl_pemeriksaan'] = "-";
			$temp['nama_pemeriksa'] = "-";
			$temp['status'] = 0;
			$update_pemeriksaan = $this->permohonan_model->get_pemeriksaan($row->kode_permohonan);
			if ($update_pemeriksaan!=null) {
				if (($update_pemeriksaan->tgl_periksa != null) && ($update_pemeriksaan->tgl_selesai != null))
					$temp['tgl_pemeriksaan'] = "".date_format(date_create($update_pemeriksaan->tgl_periksa),'d/m/Y')." - ".date_format(date_create($update_pemeriksaan->tgl_selesai),'d/m/Y');
				if ($update_pemeriksaan->nama != null)
					$temp['nama_pemeriksa'] = $update_pemeriksaan->nama;
				if ($update_pemeriksaan->status != null) {
					$temp['status'] = $update_pemeriksaan->status;
				} else {
					$temp['status'] = 0;
				}
			}
			$pemeriksaan_array[] = $temp;

		}

		$data['pemeriksaan'] = $pemeriksaan_array;
		$data['user_level'] = $this->session->userdata('level');
		$data['content'] = $this->parser->parse("pemeriksaan/diperiksa",$data,true);

		$this->template->show($data,"home");
	}

	function diperiksa_detail($kode_permohonan=""){
		$this->authentication->verify('pemeriksaan','show');
		$data['title_group']	="Dashboard";
		$data['title_form']		="Status Pemeriksaan Sertifikasi";

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['title_group']	="Dashboard";
		$data['title_form']		="Detail Permohonan Sertifikasi";
		$data['kode_permohonan'] = $kode_permohonan;
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$tgl_tmp = explode("-", $pemeriksaan->tgl_permohonan);
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$data['tgl_permohonan'] = $tgl_tmp[2]." ".$BulanIndo[(int)$tgl_tmp[1]-1]." ".$tgl_tmp[0];
		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

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
			$temp['jml_ok'] = $row->jml_ok;
			$temp['keterangan'] = $row->keterangan;
			$temp['asal'] = $row->asal;
			$temp['kelas'] = $row->kelas;
			$temp['umur'] = $row->umur;
			$komoditi_array[] = $temp;
		}

		$data['komoditi'] = $komoditi_array;
		$update_pemeriksaan = $this->permohonan_model->get_pemeriksaan($kode_permohonan);
		if ($update_pemeriksaan!=null) {
			if (($update_pemeriksaan->tgl_periksa != null) && ($update_pemeriksaan->tgl_selesai != null))
				$data['tgl_pemeriksaan'] = "".date_format(date_create($update_pemeriksaan->tgl_periksa),'d/m/Y')." - ".date_format(date_create($update_pemeriksaan->tgl_selesai),'d/m/Y');
			$data['nama_pemeriksa'] = $update_pemeriksaan->nama;
			$data['status_pemeriksaan'] = $update_pemeriksaan->status;
		}
		$data['content'] = $this->parser->parse("pemeriksaan/diperiksa_detail",$data,true);

		$this->template->show($data,"home");
	}

	// function diperiksa_komoditi($kode_permohonan="",$kode_varietas="",$kode_komoditi=""){
	function diperiksa_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('pemeriksaan','show');

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['kode_permohonan'] = $kode_permohonan;
		$data['kode_varietas'] = $kode_varietas;
		$data['kode_komoditi'] = $kode_komoditi;
		$data['profile_desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['profile_kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['profile_kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;
		$data['profile_propinsi'] = $this->crud->get_propinsi_by_id($data['propinsi'])->nama_propinsi;
		$komoditi = $this->permohonan_model->get_komoditi_pemeriksaan($kode_permohonan,$kode_varietas,$kode_komoditi);
		$komoditi2 = $this->permohonan_model->get_komoditi($kode_permohonan,$kode_varietas,$kode_komoditi);

		foreach ($komoditi as $key => $row) {
			$data[$key] = $row;
		}

		$data['title_group']	="Dashboard";
		$data['title_form']		="Pemeriksaan Komoditi Sertifikasi";

		if ($data['keterangan'] == null) {
			$data['keterangan'] = $this->parameter_komoditi_model->get_data_row($kode_komoditi)['persyaratan'];
		}

		$update_pemeriksaan = $this->permohonan_model->get_pemeriksaan($kode_permohonan);
		if ($update_pemeriksaan!=null) {
			$data['pemeriksa'] = $update_pemeriksaan->nama;
		}

		$data['content'] = $this->parser->parse("pemeriksaan/diperiksa_komoditi",$data,true);

		$this->template->show($data,"home");
	}

	function approve_permohonan($kode_permohonan="") {
		if($this->permohonan_model->approve_permohonan($kode_permohonan)){
			$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
			$username = $permohonan->username;
			$user		= $this->users_model->get_data_row($username);
			$message	= "Terimakasih ".$user['nama']."<br><br>";
			
			$message	.= "Permohonan sertifikasi yang anda ajukan dengan nomor permohonan ".$permohonan->nomor_permohonan." telah kami setujui untuk selanjutnya diperiksa.<br><br>";

			$sending = $this->sendmail_model->dosendmail($user['email'],"Permohonan Sertifikasi ". $permohonan->nomor_permohonan." Disetujui",$message);

			//print_r($user['email']);
			//print_r($message);

			echo "1";
		}else{
			echo "0";	
		}
	}

	function update_pemeriksaan_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0) {
		if($this->permohonan_model->update_pemeriksaan_komoditi($kode_permohonan,$kode_varietas,$kode_komoditi)){
			// echo "Data berhasil disimpan";
			$this->session->set_flashdata('alert', 'Data berhasil disimpan');
			redirect(base_url()."pemeriksaan/diperiksa_komoditi/".$kode_permohonan."/".$kode_varietas."/".$kode_komoditi);
		}else{
			// echo "Penyimpanan data gagal dilakukan";
		}
	}

	function update_pemeriksaan($kode_permohonan="") {
		$update = $this->permohonan_model->update_pemeriksaan($kode_permohonan);
		if($update ==1 || $update == 2){
			if ($update == 2) {
				$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
				$username = $permohonan->username;
				$user		= $this->users_model->get_data_row($username);
				$message	= "Terimakasih ".$user['nama']."<br><br>";
				
				$message	.= "Pemeriksaan untuk permohonan sertifikasi Anda dengan nomor permohonan ".$permohonan->nomor_permohonan." telah selesai dilakukan.<br><br> Selanjutnya silahkan melakukan pembayaran sesuai dengan biaya pemeriksaan.";

				$sending = $this->sendmail_model->dosendmail($user['email'],"Pemeriksaan Sertifikasi ". $permohonan->nomor_permohonan." Selesai Dilakukan",$message);

				//print_r($user['email']);
				//print_r($message);
			}

			echo "Data berhasil disimpan";
		}else{
			echo "Penyimpanan data gagal dilakukan";
		}
	}

	function update_pembayaran($kode_permohonan="") {
		$update = $this->permohonan_model->update_pembayaran($kode_permohonan);
		if($update ==1 || $update == 2){
			if ($update == 2) {
				$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
				$username = $permohonan->username;
				$user		= $this->users_model->get_data_row($username);
				$message	= "Terimakasih ".$user['nama']."<br><br>";
				
				$message	.= "Pembayaran untuk sertifikasi dengan nomor permohonan ".$permohonan->nomor_permohonan." sudah dibayar lunas.<br><br>";

				$sending = $this->sendmail_model->dosendmail($user['email'],"Pembayaran Sertifikasi ". $permohonan->nomor_permohonan." Diterima",$message);

				//print_r($user['email']);
				//print_r($message);
			}
			$this->session->set_flashdata('alert_form', 'Data berhasil disimpan...');
		}else{
			$this->session->set_flashdata('alert_form', 'Penyimpanan data gagal dilakukan...');
		}
	}

	function update_trup($kode_trup="") {
		$update = $this->permohonan_model->update_pembayaran($kode_permohonan);
		if($update ==1 || $update == 2){
			if ($update == 2) {
				$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
				$username = $permohonan->username;
				$user		= $this->users_model->get_data_row($username);
				$message	= "Terimakasih ".$user['nama']."<br><br>";
				
				$message	.= "Pembayaran untuk sertifikasi dengan nomor permohonan ".$permohonan->nomor_permohonan." sudah dibayar lunas.<br><br>";

				$sending = $this->sendmail_model->dosendmail($user['email'],"Pembayaran Sertifikasi ". $permohonan->nomor_permohonan." Diterima",$message);

				//print_r($user['email']);
				//print_r($message);
			}
			$this->session->set_flashdata('alert_form', 'Data berhasil disimpan...');
		}else{
			$this->session->set_flashdata('alert_form', 'Penyimpanan data gagal dilakukan...');
		}
	}

	function save_surat($kode_permohonan="") {
		if($this->permohonan_model->save_surat($kode_permohonan)){
			echo 'Surat berhasil disimpan...';
		}else{
			echo 'Penyimpanan Surat data gagal dilakukan...';
		}
	}

	function pdf_surat($kode_permohonan="") {
		$surat = $this->permohonan_model->get_pembayaran($kode_permohonan);
		$html = $surat->surat;

		$filename = $kode_permohonan.".pdf";
		$pdfFilePath = dirname(__FILE__).'/../../public/files/bayar/'.$filename;
		
		ini_set('memory_limit','32M');
		 
		$this->load->library('pdf');
		$pdf = $this->pdf->load(); 
		$pdf->WriteHTML($html); 
		$pdf->Output($pdfFilePath, 'F');
	}

	function load_pdf($kode_permohonan){
 		$this->authentication->verify('permohonan','edit');
 		$filename = $kode_permohonan.".pdf";
		$path = dirname(__FILE__).'/../../public/files/bayar/'.$filename;
		header("Content-Length: " . filesize ( $path ) ); 
        header("Content-type: application/octet-stream"); 
        header("Content-disposition: attachment; filename=".basename($filename));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        ob_clean();
        flush();
        readfile($path);
 	}

 	function save_surat_trup($kode_trup="") {
		if($this->users_model->save_surat($kode_trup)){
			echo 'Surat berhasil disimpan...';
		}else{
			echo 'Penyimpanan Surat data gagal dilakukan...';
		}
	}

	function pdf_surat_trup($kode_trup="") {
		$trup = $this->users_model->get_trup($kode_trup);
		$html = $trup['preview'];

		$filename = $kode_trup.".pdf";
		$pdfFilePath = dirname(__FILE__).'/../../public/files/trup/'.$filename;
		
		ini_set('memory_limit','32M');
		 
		$this->load->library('pdf');
		$pdf = $this->pdf->load(); 
		$pdf->WriteHTML($html); 
		$pdf->Output($pdfFilePath, 'F');
	}

	function load_pdf_trup($kode_trup){
 		$filename = $kode_trup.".pdf";
		$path = dirname(__FILE__).'/../../public/files/trup/'.$filename;
		header("Content-Length: " . filesize ( $path ) ); 
        header("Content-type: application/octet-stream"); 
        header("Content-disposition: attachment; filename=".basename($filename));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        ob_clean();
        flush();
        readfile($path);
 	}
}
