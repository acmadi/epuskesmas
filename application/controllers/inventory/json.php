<?php
class Json extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('inventory/inv_barang_model');
		$this->load->model('mst/puskesmas_model');
		$this->load->model('inventory/inv_ruangan_model');
		$this->load->model('mst/invbarang_model');
	}

	

	function Atanah(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		$rows_all = $this->inv_barang_model->get_data_A($filter_clphc);


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		
		$rows = $this->inv_barang_model->get_data_A($filter_clphc,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang'   		=> $act->id_inventaris_barang,
				'id_mst_inv_barang'   			=> $act->id_mst_inv_barang,
				'id_pengadaan'		   			=> $act->id_pengadaan,
				'nama_barang'					=> $act->nama_barang,
				'jumlah'						=> $act->jumlah,
				'harga'							=> number_format($act->harga,2),
				'totalharga'					=> number_format($act->totalharga,2),
				'keterangan_pengadaan'			=> $act->keterangan_pengadaan,
				'pilihan_status_invetaris'		=> $act->pilihan_status_invetaris,
				'barang_kembar_proc'			=> $act->barang_kembar_proc,
				'tanggal_diterima'				=> $act->tanggal_diterima,
				'waktu_dibuat'					=> $act->waktu_dibuat,
				'terakhir_diubah'				=> $act->terakhir_diubah,
				'value'				=> $act->value,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}


		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}


	function Golongan_A(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'status_sertifikat_tanggal') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		/*if($this->session->userdata('filter_golongan_invetaris') != '') {
			$table = 'inv_inventaris_barang_a';
			$this->db->select("mst_inv_barang.uraian,satuan.value AS satuan,hak.value AS hak,pengguna.value as pengguna");
			$this->db->join('mst_inv_barang',"mst_inv_barang.code=inv_inventaris_barang_a.id_mst_inv_barang");
			$this->db->join('mst_inv_pilihan AS satuan', "inv_inventaris_barang_a.pilihan_satuan_barang=satuan.code AND satuan.tipe='satuan'"); 
			$this->db->join('mst_inv_pilihan as hak',  "inv_inventaris_barang_a.pilihan_status_hak=hak.code AND hak.tipe='status_hak'"); 
			$this->db->join('mst_inv_pilihan AS pengguna', "inv_inventaris_barang_a.pilihan_penggunaan=pengguna.code AND pengguna.tipe='penggunaan'" );
		}*/
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_a.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if(($this->session->userdata('filterGIB') != '')) {
			$rows_all = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where='');
		}

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'status_sertifikat_tanggal') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		/*if($this->session->userdata('filter_golongan_invetaris') != '') {
			$table = 'inv_inventaris_barang_a';
			$this->db->select("mst_inv_barang.uraian,satuan.value AS satuan,hak.value AS hak,pengguna.value as pengguna");
			$this->db->join('mst_inv_barang',"mst_inv_barang.code=inv_inventaris_barang_a.id_mst_inv_barang");
			$this->db->join('mst_inv_pilihan AS satuan', "inv_inventaris_barang_a.pilihan_satuan_barang=satuan.code AND satuan.tipe='satuan'"); 
			$this->db->join('mst_inv_pilihan as hak',  "inv_inventaris_barang_a.pilihan_status_hak=hak.code AND hak.tipe='status_hak'"); 
			$this->db->join('mst_inv_pilihan AS pengguna', "inv_inventaris_barang_a.pilihan_penggunaan=pengguna.code AND pengguna.tipe='penggunaan'" );
		}*/
		if($this->session->userdata(('filterGIB') != '')) {
			$rows = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_A($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang'   	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'			=> $act->id_mst_inv_barang,
				'uraian'					=> $act->uraian,
				'satuan'					=> $act->satuan,
				'hak'						=> $act->hak,
				'jumlah'					=> $act->jumlah,
				'jumlah_satuan'				=> $act->jumlah.' '.$act->satuan,
				'penggunaan'				=> $act->penggunaan,
				'luas' 						=> $act->luas,
				'alamat' 					=> $act->alamat,
				'pilihan_satuan_barang' 	=> $act->pilihan_satuan_barang,
				'pilihan_status_hak' 		=> $act->pilihan_status_hak,
				'status_sertifikat_tanggal' => $act->status_sertifikat_tanggal,
				'status_sertifikat_nomor'	=> $act->status_sertifikat_nomor,
				'pilihan_penggunaan' 		=> $act->pilihan_penggunaan,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}


		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	function Golongan_B(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_b.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows_all = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where='');
		}
		


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_B($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang' 	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'		=> $act->id_mst_inv_barang,
				'uraian' 				=> $act->uraian,
				'merek_type' 			=> $act->merek_type,
				'bahan'		 			=> $act->bahan,
				'satuan'	 			=> $act->satuan,
				'ukuran_satuan' 		=> $act->ukuran_barang.'  '.$act->satuan,
				'identitas_barang' 		=> $act->identitas_barang,
				'pilihan_bahan' 		=> $act->pilihan_bahan,
				'ukuran_barang' 		=> $act->ukuran_barang,
				'pilihan_satuan' 		=> $act->pilihan_satuan,
				'tanggal_bpkb'			=> $act->tanggal_bpkb,
				'nomor_bpkb'		 	=> $act->nomor_bpkb,
				'no_polisi'		 		=> $act->no_polisi,
				'tanggal_perolehan'	 	=> $act->tanggal_perolehan,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}



		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	function Golongan_C(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_c.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows_all = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where='');
		}
		


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		
		if($this->session->userdata('filterGIB') != '') {
			$rows = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_C($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang' 	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'		=> $act->id_mst_inv_barang,
				'uraian' 				=> $act->uraian,
				'hak' 					=> $act->hak,
				'tingkat' 				=> $act->tingkat,
				'beton' 				=> $act->beton,
				'luas_lantai' 			=> $act->luas_lantai,
				'letak_lokasi_alamat' 	=> $act->letak_lokasi_alamat,
				'pillihan_status_hak' 	=> $act->pillihan_status_hak,
				'nomor_kode_tanah' 		=> $act->nomor_kode_tanah,
				'pilihan_kons_tingkat' 	=> $act->pilihan_kons_tingkat,
				'pilihan_kons_beton'	=> $act->pilihan_kons_beton,
				'dokumen_tanggal'		=> $act->dokumen_tanggal,
				'dokumen_nomor'		 	=> $act->dokumen_nomor,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}



		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	function Golongan_D(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_d.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows_all = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where='');
		}
		


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_D($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang' 	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'		=> $act->id_mst_inv_barang,
				'uraian' 				=> $act->uraian,
				'konstruksi' 			=> $act->konstruksi,
				'tanah' 				=> $act->tanah,
				'panjang' 				=> $act->panjang,
				'lebar' 				=> $act->lebar,
				'luas' 					=> $act->luas,
				'dokumen_tanggal'		=> $act->dokumen_tanggal,
				'dokumen_nomor'			=> $act->dokumen_nomor,
				'pilihan_status_tanah'	=> $act->pilihan_status_tanah,
				'nomor_kode_tanah'		=> $act->nomor_kode_tanah,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}



		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	function Golongan_E(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_e.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows_all = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where='');
		}
		


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_E($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang' 	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'		=> $act->id_mst_inv_barang,
				'uraian' 				=> $act->uraian,
				'bahan' 				=> $act->bahan,
				'satuan' 				=> $act->satuan,
				'buku_judul_pencipta' 	=> $act->buku_judul_pencipta,
				'buku_spesifikasi' 		=> $act->buku_spesifikasi,
				'budaya_asal_daerah' 	=> $act->budaya_asal_daerah,
				'budaya_pencipta' 		=> $act->budaya_pencipta,
				'pilihan_budaya_bahan' 	=> $act->pilihan_budaya_bahan,
				'flora_fauna_jenis'		=> $act->flora_fauna_jenis,
				'flora_fauna_ukuran'	=> $act->flora_fauna_ukuran,
				'flora_ukuran_satuan'	=> $act->flora_fauna_ukuran.'  '.$act->satuan,
				'pilihan_satuan'		=> $act->pilihan_satuan,
				'tahun_cetak_beli'		=> $act->tahun_cetak_beli,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}



		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	function Golongan_F(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filter_cl_phc') != ''){
			$kodeplch = $this->session->userdata('filter_cl_phc');
			$filter_clphc="JOIN inv_inventaris_distribusi 
                                              ON (inv_inventaris_barang_f.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                                 AND inv_inventaris_distribusi.id_cl_phc = \"".$kodeplch."\")";
		}else{
			$filter_clphc='';
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows_all = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where='');
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows_all = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where);
		}else{
			$rows_all = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where='');
		}
		


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tgl_pengadaan') {
					$value = date("Y-m-d",strtotime($value));
					$this->db->where($field,$value);
				}elseif($field != 'year') {
					$this->db->like($field,$value);
				}
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}
		if($this->session->userdata('filterGIB') != '') {
			$rows = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else if($this->session->userdata('filterHAPUS') != ''){
			$where="AND inv_inventaris_barang.pilihan_status_invetaris=3";
			$rows = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where,$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}else{
			$rows = $this->inv_barang_model->get_data_golongan_F($filter_clphc,$where='',$this->input->post('recordstartindex'), $this->input->post('pagesize'));
		}
		
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_inventaris_barang' 	=> $act->id_inventaris_barang,
				'id_mst_inv_barang'		=> $act->id_mst_inv_barang,
				'uraian' 				=> $act->uraian,
				'tanah' 				=> $act->tanah,
				'beton' 				=> $act->beton,
				'tingkat' 				=> $act->tingkat,
				'bangunan' 				=> $act->bangunan,
				'pilihan_konstruksi_bertingkat' 	=> $act->pilihan_konstruksi_bertingkat,
				'pilihan_konstruksi_beton' 			=> $act->pilihan_konstruksi_beton,
				'luas' 					=> $act->luas,
				'lokasi' 				=> $act->lokasi,
				'dokumen_tanggal'		=> $act->dokumen_tanggal,
				'dokumen_nomor'			=> $act->dokumen_nomor,
				'tanggal_mulai'		 	=> $act->tanggal_mulai,
				'pilihan_status_tanah'	=> $act->pilihan_status_tanah,
				'edit'		=> 1,
				'delete'	=> 1
			);
		}



		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	
	

}
