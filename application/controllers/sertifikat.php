<?php

class Sertifikat extends CI_Controller {

	var $limit=10;
	var $page=1;

    public function __construct(){
		parent::__construct();
		$this->load->model('sertifikat_model');
		$this->load->model('permohonan_model');
		$this->load->model('users_model');
		$this->load->model('sendmail_model');
		$this->load->model('disbun_model');
		$this->load->model('parameter_sertifikat_model');
        $this->load->library('email');
		$this->load->add_package_path(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/demo/tbs_class.php');
		require_once(APPPATH.'third_party/tbs_plugin_opentbs_1.8.0/tbs_plugin_opentbs.php');
	}
	
	
	
	function cetak(){
		$this->authentication->verify('user','show');
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Penomoran & Cetak Sertifikat";

		$data_array = array();
		$sertifikat = $this->sertifikat_model->get_all_permohonan(); 
		foreach ($sertifikat as $row) {
			$komoditi = $this->permohonan_model->get_komoditi_permohonan($row->kode_permohonan);
			$komoditi_array = array();
			$sertifikat_array = array();
			$komoditi_array = array();
			$status = true;
			foreach ($komoditi as $key => $row2) {
				$sertifikat = $row2->kode_sertifikat;
				$komoditi = $this->permohonan_model->get_komoditi_by_id($row2->kode_komoditi)->nama;
				if (!in_array($sertifikat,$sertifikat_array)) {
					$sertifikat_array[] = $sertifikat;
				}
				if (!in_array($komoditi,$komoditi_array)) {
					$komoditi_array[] = $komoditi;
				}
				$sertifikat_detail = $this->sertifikat_model->get_sertifikat_detail($row2->kode_permohonan,$row2->kode_varietas,$row2->kode_komoditi);
				if ($sertifikat_detail != null) {
					if ($sertifikat_detail->status == 0) {
						$status = false;
					}
				} else {
					$status = false;
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

			$temp = array();
			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['tgl_permohonan'] = $row->tgl_permohonan;
			$temp['nomor_permohonan'] = $row->nomor_permohonan;
			$temp['nama'] = $row->nama;
			$temp['perusahaan'] = $row->perusahaan;
			$temp['komoditi'] = $komoditi_text;
			$temp['sertifikat'] = $sertifikat_text;
			$temp['status'] = $status;
			$data_array[] = $temp;
		}

		$data['data_array'] = $data_array;
		$data['user_level'] = $this->session->userdata('level');
		$data['content'] = $this->parser->parse("sertifikat/cetak",$data,true);

		$this->template->show($data,"home");
	}

	function cetak_detail($kode_permohonan=""){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$this->authentication->verify('pemeriksaan','show');

		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Cetak Sertifikat";

		$data['kode_permohonan'] = $kode_permohonan;
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['tgl_permohonan'] = "".date_format(date_create($pemeriksaan->tgl_permohonan),'Y-m-d');
		$tglpermohonan_tmp = explode("-", $data['tgl_permohonan']);
		$data['tgl_permohonan'] = (int)$tglpermohonan_tmp[2]." ".$BulanIndo[(int)$tglpermohonan_tmp[1]-1]." ".$tglpermohonan_tmp[0];

		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		$komoditi = $this->permohonan_model->get_komoditi_permohonan($kode_permohonan);
		$komoditi_array = array();
		foreach ($komoditi as $key => $row) {
			$temp['kode_permohonan'] = $row->kode_permohonan;
			$temp['kode_varietas'] = $row->kode_varietas;
			$temp['kode_komoditi'] = $row->kode_komoditi;

			$temp['sertifikat'] = $this->sertifikat_model->get_sertifikat($row->kode_permohonan,$row->kode_komoditi,$row->kode_varietas);
			$temp['jenis'] = $row->kode_sertifikat;
			$temp['komoditi'] = $this->permohonan_model->get_komoditi_by_id($row->kode_komoditi)->nama;
			$temp['varietas'] = $this->permohonan_model->get_varietas_by_id($row->kode_varietas)->nama;
			$temp['bentuk_benih'] =  $this->permohonan_model->get_bentukbenih_by_id($row->kode_bentuk)->nama;
			$temp['satuan'] =  $this->permohonan_model->get_satuan_by_id($row->kode_satuan)->nama;
			$temp['jml'] = $row->jml;
			$temp['jml_ok'] = $row->jml_ok;
			$komoditi_array[] = $temp;

			$data['nama_komoditi'] = $temp['komoditi'];
		}

		$data['komoditi'] = $komoditi_array;

		$update_pembayaran = $this->permohonan_model->get_pembayaran($kode_permohonan);
		$data['tgl_pembayaran'] = "".date_format(date_create($update_pembayaran->tgl_bayar),'Y-m-d');
		$tglpembayaran_tmp = explode("-", $data['tgl_pembayaran']);
		$data['tgl_pembayaran'] = (int)$tglpembayaran_tmp[2]." ".$BulanIndo[(int)$tglpembayaran_tmp[1]-1]." ".$tglpembayaran_tmp[0];

		$data['total_bayar'] = $update_pembayaran->total_bayar;

		$data['content'] = $this->parser->parse("sertifikat/cetak_detail",$data,true);

		$this->template->show($data,"home");
	}

	function cetak_detail_komoditi($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$this->authentication->verify('pemeriksaan','show');
		$pemeriksaan = $this->permohonan_model->get_permohonan($kode_permohonan);
		$data = $this->disbun_model->get_profile($pemeriksaan->username); 

		$data['title_group']	="Sertifikat";
		$data['title_form']		="Cetak Sertifikat per Komoditi";

		$data['kode_permohonan'] = $kode_permohonan;
		$data['kode_varietas'] = $kode_varietas;
		$data['kode_komoditi'] = $kode_komoditi;
		$data['nomor_permohonan'] = $pemeriksaan->nomor_permohonan;
		$data['tgl_permohonan'] = "".date_format(date_create($pemeriksaan->tgl_permohonan),'Y-m-d');
		$tglpermohonan_tmp = explode("-", $data['tgl_permohonan']);
		$data['tgl_permohonan'] = (int)$tglpermohonan_tmp[2]." ".$BulanIndo[(int)$tglpermohonan_tmp[1]-1]." ".$tglpermohonan_tmp[0];

		$data['desa'] = $this->crud->get_desa_by_id($data['desa'])->nama_desa;
		$data['kecamatan'] = $this->crud->get_kecamatan_by_id($data['kecamatan'])->nama_kecamatan;
		$data['kota'] = $this->crud->get_kota_by_id($data['kota'])->nama_kota;

		//informasi komoditi
		$komoditi = $this->permohonan_model->get_komoditi_pemeriksaan($kode_permohonan,$kode_varietas,$kode_komoditi);
		foreach ($komoditi as $key => $row) {
			$data[$key] = $row;
		}

		//informasi sertifikat
		// $data['nomor_sertifikat'] = $this->sertifikat_model->get_nomor_sertifikat();
		$data['preview'] = $this->parameter_sertifikat_model->get_data_row($data['kode_sertifikat'])['preview']; 
		$update_sertifikat = $this->sertifikat_model->get_sertifikat_detail($kode_permohonan,$kode_varietas,$kode_komoditi);
		if ($update_sertifikat!=null) {
			$data['nomor_sertifikat'] = $update_sertifikat->nomor_sertifikat;
			$data['status_sertifikat'] = $update_sertifikat->status;

			if ($update_sertifikat->tgl_berlaku != null) {
				$data['tgl_berlaku'] = "".date_format(date_create($update_sertifikat->tgl_berlaku),'Y-m-d');
				// $data['tgl_sertifikat'] = $data['tgl_berlaku'];
				$tglberlaku_tmp = explode("-", $data['tgl_berlaku']);
				$data['tgl_sertifikat'] = (int)$tglberlaku_tmp[2]." ".$BulanIndo[(int)$tglberlaku_tmp[1]-1]." ".$tglberlaku_tmp[0];
			}
			if ($update_sertifikat->tgl_berakhir != null) {
				$data['tgl_berakhir'] = "".date_format(date_create($update_sertifikat->tgl_berakhir),'Y-m-d');

				$tmp = explode("-", $update_sertifikat->tgl_berakhir);
				$data['tgl_sertifikat_berakhir'] = (int)$tmp[2]." ".$BulanIndo[(int)$tmp[1]-1]." ".$tmp[0];

				// $tglberakhir_tmp = explode("-", $data['tgl_berakhir']);
				// $data['tgl_sertifikat_berakhir'] = (int)$tglberakhir_tmp[2]." ".$BulanIndo[(int)$tglberakhir_tmp[1]-1]." ".$tglberakhir_tmp[0];

			}
			$data['preview'] = $update_sertifikat->preview;
			if ($data['preview'] == null) {
				$data['preview'] = $this->parameter_sertifikat_model->get_data_row($data['kode_sertifikat'])['preview']; 
				$data['saved_sertifikat'] = false;
			} else {
				$data['saved_sertifikat'] = true;
			}
		} else {
			$data['preview'] = $this->parameter_sertifikat_model->get_data_row($data['kode_sertifikat'])['preview']; 
		}

		//cetak surat
		$updatepemeriksaan = $this->permohonan_model->get_pemeriksaan($kode_permohonan);
			if ($updatepemeriksaan!=null) {
				$tmp = explode("-", $updatepemeriksaan->tgl_periksa);
				$data['tgl_periksa'] = (int)$tmp[2]." ".$BulanIndo[(int)$tmp[1]-1]." ".$tmp[0];
				$tmp = explode("-", $updatepemeriksaan->tgl_selesai);
				$data['tgl_selesai'] = (int)$tmp[2]." ".$BulanIndo[(int)$tmp[1]-1]." ".$tmp[0];

				if (($updatepemeriksaan->tgl_periksa != null) && ($updatepemeriksaan->tgl_selesai != null))
					$data['tgl_pemeriksaan'] = $data['tgl_periksa']." - ".$data['tgl_selesai'];
			}

		$data['nama_pemohon'] = $data['nama'];
		$data['alamat'] = $data['address'];
		$data['benih'] = $data['nama_komoditi'];
		$data['bentuk'] = $data['nama_bentuk_benih'];
		$data['varietas'] = $data['nama_varietas'];
		$data['satuan'] = $data['nama_satuan'];
		$data['tidak_memenuhi_syarat'] = $data['jml']-$data['jml_ok'];
		$data['bulan_penyaluran'] = $BulanIndo[(int) date('m')];
		$data['hasil_pemeriksaan'] = $data['keterangan'];
		$data['nomor_surat_permohonan'] = $data['nomor_permohonan'];
		$data['tanggal_surat_permohonan'] = $data['tgl_permohonan'];

		$data['content'] = $this->parser->parse("sertifikat/cetak_detail_komoditi",$data,true);

		$this->template->show($data,"home");
	}


	function aktif(){
		$this->authentication->verify('user','show');
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Sertifikat Aktif";

		$sertifikat_array = array();
		$permohonan_sertifikat = $this->permohonan_model->get_all_permohonan(array("sertifikat"));
		foreach ($permohonan_sertifikat as $permohonan) {
			$profile = $this->disbun_model->get_profile($permohonan->username); 
			$temp['nama_pemohon'] = $profile['nama'] . " / " . $profile['perusahaan'];
			$komoditi = $this->permohonan_model->get_komoditi_sertifikat($permohonan->kode_permohonan);
			foreach ($komoditi as $row) {
				$temp['jenis_sertifikat'] = $row->kode_sertifikat;
				$temp['nama_komoditi'] = $row->nama_komoditi;
				$temp['nama_varietas'] = $row->nama_varietas;
				$temp['kode_permohonan'] = $row->kode_permohonan;
				$temp['kode_varietas'] = $row->kode_varietas;
				$temp['kode_komoditi'] = $row->kode_komoditi;

				$sertifikat_detail = $this->sertifikat_model->get_sertifikat_detail($row->kode_permohonan,$row->kode_varietas,$row->kode_komoditi);
				if ($sertifikat_detail != null) {
					$temp['nomor_sertifikat'] = $sertifikat_detail->nomor_sertifikat;
					$temp['tgl_berlaku'] = $sertifikat_detail->tgl_berlaku . " sd " . $sertifikat_detail->tgl_berakhir;

					if (($sertifikat_detail->status == "1") && ($sertifikat_detail->tgl_berakhir >= date('Y-m-d'))) {
						$sertifikat_array[] = $temp;
					}
				}
			}
		}

		$data['sertifikat'] = $sertifikat_array;
		$data['user_level'] = $this->session->userdata('level');
		$data['content'] = $this->parser->parse("sertifikat/aktif",$data,true);

		$this->template->show($data,"home");
	}

	function aktif_detail($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('user','show');
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Sertifikat Aktif";
		$data['kode_permohonan'] = $kode_permohonan;
		$data['kode_varietas'] = $kode_varietas;
		$data['kode_komoditi'] = $kode_komoditi;
		$sertifikat = $this->sertifikat_model->get_sertifikat_detail($kode_permohonan,$kode_varietas,$kode_komoditi);
		$data['preview'] = $sertifikat->preview;
		$data['content'] = $this->parser->parse("sertifikat/cetak_sertifikat",$data,true);

		$this->template->show($data,"home");
	}

	function nonaktif(){
		$this->authentication->verify('user','show');
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Sertifikat Tidak Aktif";

		$sertifikat_array = array();
		$permohonan_sertifikat = $this->permohonan_model->get_all_permohonan(array("sertifikat"));
		foreach ($permohonan_sertifikat as $permohonan) {
			$profile = $this->disbun_model->get_profile($permohonan->username); 
			$temp['nama_pemohon'] = $profile['nama'] . " / " . $profile['perusahaan'];
			$komoditi = $this->permohonan_model->get_komoditi_sertifikat($permohonan->kode_permohonan);
			foreach ($komoditi as $row) {
				$temp['jenis_sertifikat'] = $row->kode_sertifikat;
				$temp['nama_komoditi'] = $row->nama_komoditi;
				$temp['nama_varietas'] = $row->nama_varietas;
				$temp['kode_permohonan'] = $row->kode_permohonan;
				$temp['kode_varietas'] = $row->kode_varietas;
				$temp['kode_komoditi'] = $row->kode_komoditi;

				$sertifikat_detail = $this->sertifikat_model->get_sertifikat_detail($row->kode_permohonan,$row->kode_varietas,$row->kode_komoditi);
				if ($sertifikat_detail != null) {
					$temp['nomor_sertifikat'] = $sertifikat_detail->nomor_sertifikat;
					if($sertifikat_detail->tgl_berlaku!=""){
						$temp['tgl_berlaku'] = $sertifikat_detail->tgl_berlaku . " s/d " . $sertifikat_detail->tgl_berakhir;
					}else{
						$temp['tgl_berlaku'] = " - tidak tercantum - ";
					}

					if (($sertifikat_detail->status == "1") && ($sertifikat_detail->tgl_berakhir < date('Y-m-d'))) {
						$sertifikat_array[] = $temp;
					}
				}
			}
		}

		$data['sertifikat'] = $sertifikat_array;
		$data['user_level'] = $this->session->userdata('level');
		$data['content'] = $this->parser->parse("sertifikat/nonaktif",$data,true);

		$this->template->show($data,"home");
	}

	function nonaktif_detail($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
		$this->authentication->verify('user','show');
		$data['title_group']	="Sertifikat";
		$data['title_form']		="Sertifikat Tidak Aktif";
		$data['kode_permohonan'] = $kode_permohonan;
		$data['kode_varietas'] = $kode_varietas;
		$data['kode_komoditi'] = $kode_komoditi;
		$sertifikat = $this->sertifikat_model->get_sertifikat_detail($kode_permohonan,$kode_varietas,$kode_komoditi);
		$data['preview'] = $sertifikat->preview;
		$data['content'] = $this->parser->parse("sertifikat/cetak_sertifikat_nonaktif",$data,true);

		$this->template->show($data,"home");
	}

	function update_sertifikat($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0) {
		if($this->sertifikat_model->update_sertifikat($kode_permohonan,$kode_varietas,$kode_komoditi)){
			$this->session->set_flashdata('alert_form', 'Data berhasil disimpan...');
		}else{
			$this->session->set_flashdata('alert_form', 'Penyimpanan data gagal dilakukan...');
		}
	}

	function save_sertifikat($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0) {
		
		$update = $this->sertifikat_model->save_sertifikat($kode_permohonan,$kode_varietas,$kode_komoditi);
		if($update ==1 || $update == 2){
			if ($update == 2) {
				$permohonan = $this->permohonan_model->get_permohonan($kode_permohonan);
				$username = $permohonan->username;
				$sertifikat = $this->sertifikat_model->get_sertifikat_detail($kode_permohonan,$kode_varietas,$kode_komoditi);
				$user		= $this->users_model->get_data_row($username);
				$message	= "Terimakasih ".$user['nama']."<br><br>";
				
				$message	.= "Sertifikat Anda dengan nomor ".$permohonan->nomor_permohonan." sudah dicetak.<br><br>";

				$sending = $this->sendmail_model->dosendmail($user['email'],"Sertifikat dengan No ". $sertifikat->nomor_sertifikat." telah Dicetak",$message);

				//print_r($user['email']);
				//print_r($message);
			}
			echo 'Sertifikat berhasil disimpan...';
		}else{
			echo 'Penyimpanan Sertifikat data gagal dilakukan...';
		}
	}

	function pdf_sertifikat($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0) {
		$html = $this->sertifikat_model->get_sertifikat_detail($kode_permohonan,$kode_varietas,$kode_komoditi)->preview;

		$filename = $kode_permohonan."__".$kode_varietas."__".$kode_komoditi.".pdf";
		$pdfFilePath = dirname(__FILE__).'/../../public/files/sertifikat/'.$filename;
		
		ini_set('memory_limit','32M');
		 
		$this->load->library('pdf');
		$pdf = $this->pdf->load(); 
		$pdf->WriteHTML($html); 
		$pdf->Output($pdfFilePath, 'F');
	}

	function load_pdf($kode_permohonan="",$kode_varietas=0,$kode_komoditi=0){
 		$this->authentication->verify('permohonan','edit');
 		$filename = $kode_permohonan."__".$kode_varietas."__".$kode_komoditi.".pdf";
		$path = dirname(__FILE__).'/../../public/files/sertifikat/'.$filename;
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
