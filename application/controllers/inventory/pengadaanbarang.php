<?php
class Pengadaanbarang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('inventory/pengadaanbarang_model');
		$this->load->model('mst/puskesmas_model');
		$this->load->model('inventory/inv_ruangan_model');
		$this->load->model('mst/invbarang_model');
	}

	function autocomplite_barang(){
		$search = explode("&",$this->input->server('QUERY_STRING'));
		$search = str_replace("query=","",$search[0]);
		$search = str_replace("+"," ",$search);

		$this->db->like("code",$search);
		$this->db->or_like("uraian",$search);
		$this->db->order_by('code','asc');
		$this->db->limit(10,0);
		$query= $this->db->get("mst_inv_barang")->result();
		foreach ($query as $q) {
			$s = array();
			$s[0] = substr($q->code, 0,2);
			$s[1] = substr($q->code, 2,2);
			$s[2] = substr($q->code, 4,2);
			$s[3] = substr($q->code, 6,2);
			$s[4] = substr($q->code, 8,2);
			$barang[] = array(
				'code_tampil' 	=> implode(".", $s), 
				'code' 			=> $q->code , 
				'uraian' 		=> $q->uraian, 
			);
		}
		echo json_encode($barang);
	}

	function json(){
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
		
		$rows_all = $this->pengadaanbarang_model->get_data();


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
		
		$rows = $this->pengadaanbarang_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		foreach($rows as $act) {
			$data[] = array(
				'id_pengadaan' 				=> $act->id_pengadaan,
				'tgl_pengadaan' 			=> $act->tgl_pengadaan,
				'pilihan_status_pengadaan' 	=> $act->pilihan_status_pengadaan,
				'value' 					=> $act->value,
				'jumlah_unit'				=> $act->jumlah_unit,
				'nilai_pengadaan'			=> $act->nilai_pengadaan,
				'keterangan'				=> $act->keterangan,
				'detail'					=> 1,
				'edit'						=> 1,
				'delete'					=> 1
			);
		}


		
		$size = sizeof($rows_all);
		$json = array(
			'TotalRows' => (int) $size,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	
	function index(){
		$this->authentication->verify('inventory','edit');
		$data['title_group'] = "Parameter";
		$data['title_form'] = "Master Data - Daftar Pengadaan Barang";

		$data['content'] = $this->parser->parse("inventory/pengadaan_barang/show",$data,true);
		$this->template->show($data,"home");
	}

	public function get_ruangan()
	{
		if($this->input->is_ajax_request()) {
			$code_cl_phc = $this->input->post('code_cl_phc');
			$id_mst_inv_ruangan = $this->input->post('id_mst_inv_ruangan');

			$kode 	= $this->inv_ruangan_model->getSelectedData('mst_inv_ruangan',$code_cl_phc)->result();

			'<option value="">Pilih Ruangan</option>';
			foreach($kode as $kode) :
				echo $select = $kode->id_mst_inv_ruangan == $id_mst_inv_ruangan ? 'selected' : '';
				echo '<option value="'.$kode->id_mst_inv_ruangan.'" '.$select.'>' . $kode->nama_ruangan . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}
	public function get_nama()
	{
		if($this->input->is_ajax_request()) {
			$code = $this->input->post('code');

			$this->db->where("code",$code);
			$kode 	= $this->invbarang_model->getSelectedData('mst_inv_barang',$code)->row();

			if(!empty($kode)) echo $kode->uraian;

			return TRUE;
		}

		show_404();
	}

	function add(){
		$this->authentication->verify('inventory','add');

        $this->form_validation->set_rules('tgl', 'Tanggal Perngadaan', 'trim|required');
        $this->form_validation->set_rules('status', 'Status Pengadaan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('nomor_kontrak', 'Nomor Kontrak', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['title_group'] = "Inventory";
			$data['title_form']="Tambah Pengadaan Barang";
			$data['action']="add";
			$data['kode']="";

			$data['kodestatus'] = $this->pengadaanbarang_model->get_data_status();
		
			$data['content'] = $this->parser->parse("inventory/pengadaan_barang/form",$data,true);
		}elseif($id = $this->pengadaanbarang_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url().'inventory/pengadaanbarang/edit/'.$id);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/pengadaanbarang/add");
		}

		$this->template->show($data,"home");
	}

	function edit($id_pengadaan=0){
		$this->authentication->verify('inventory','edit');

        $this->form_validation->set_rules('tgl', 'Tanggal Perngadaan', 'trim|required');
        $this->form_validation->set_rules('status', 'Status Pengadaan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('nomor_kontrak', 'Nomor Kontrak', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data 	= $this->pengadaanbarang_model->get_data_row($id_pengadaan);
			$data['title_group'] 	= "Inventory";
			$data['title_form']		= "Ubah Pengadaan Barang";
			$data['action']			= "edit";
			$data['kode']			= $id_pengadaan;

			$data['kodestatus'] = $this->pengadaanbarang_model->get_data_status();
			$data['barang']	  	= $this->parser->parse('inventory/pengadaan_barang/barang', $data, TRUE);
			$data['content'] 	= $this->parser->parse("inventory/pengadaan_barang/edit",$data,true);
		}elseif($this->pengadaanbarang_model->update_entry($id_pengadaan)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."inventory/pengadaanbarang/edit/".$id_pengadaan);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/pengadaanbarang/edit/".$id_pengadaan);
		}

		$this->template->show($data,"home");
	}
	function detail($id_pengadaan=0){
		$this->authentication->verify('inventory','edit');
		if($this->form_validation->run()== FALSE){
			$data 	= $this->pengadaanbarang_model->get_data_row($id_pengadaan);
			$data['title_group'] 	= "Inventory";
			$data['title_form']		= "Detail Pengadaan Barang";
			$data['action']			= "view";
			$data['kode']			= $id_pengadaan;
			$data['viewreadonly']	= "readonly=''";

			$data['kodestatus'] = $this->pengadaanbarang_model->get_data_status();
			$data['barang']	  	= $this->parser->parse('inventory/pengadaan_barang/barang', $data, TRUE);
			$data['content'] 	= $this->parser->parse("inventory/pengadaan_barang/edit",$data,true);
			$this->template->show($data,"home");
		}
	}
	function dodel($kode=0){
		$this->authentication->verify('inventory','del');

		if($this->pengadaanbarang_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/pengadaanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/pengadaanbarang");
		}
	}
	function updatestatus(){
		//$this->authentication->verify('inventory','edit');
		$this->pengadaanbarang_model->update_status();				
	}
	function dodelpermohonan($kode=0,$id_barang="",$kd_proc=0){
		$this->authentication->verify('inventory','del');

		if($this->pengadaanbarang_model->delete_entryitem($kode,$id_barang,$kd_proc)){
			$dataupdate['nilai_pengadaan']= $this->pengadaanbarang_model->sum_jumlah_item( $kode,'harga');
			$dataupdate['jumlah_unit']= $this->pengadaanbarang_model->sum_unit($kode)->num_rows();
			$key['id_pengadaan'] = $kode;
    		$this->db->update("inv_pengadaan",$dataupdate,$key);
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
		}
	}

	public function barang($id = 0)
	{
		$data	  	= array();
		$filter 	= array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tanggal_diterima' ) {
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
		$activity = $this->pengadaanbarang_model->getItem('inv_inventaris_barang', array('id_pengadaan'=>$id))->result();
		foreach($activity as $act) {
			$data[] = array(
				'id_mst_inv_barang'   			=> $act->id_mst_inv_barang,
				'nama_barang'					=> $act->nama_barang,
				'jumlah'						=> $act->jumlah,
				'harga'							=> $act->harga,
				'totalharga'					=> $act->totalharga,
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

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function add_barang($kode=0)
	{	
		$data['action']			= "add";
		$data['kode']			= $kode;
        $this->form_validation->set_rules('id_mst_inv_barang', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga Satuan', 'trim|required');
        $this->form_validation->set_rules('keterangan_pengadaan', 'Keterangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['kodebarang']		= $this->pengadaanbarang_model->get_databarang();
			$data['notice']			= validation_errors();

			die($this->parser->parse('inventory/pengadaan_barang/barang_form', $data));
		}else{
			$jumlah =$this->input->post('jumlah');
			$id_barang = $this->input->post('id_mst_inv_barang');
			$kode_proc = $this->pengadaanbarang_model->barang_kembar_proc($id_barang);
			for($i=1;$i<=$jumlah;$i++){
				$values = array(
					'id_inventaris_barang' => $this->pengadaanbarang_model->get_inventarisbarang_id($kode,$id_barang),
					'id_mst_inv_barang'=> $id_barang,
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'keterangan_pengadaan' => $this->input->post('keterangan_pengadaan'),
					'barang_kembar_proc' => $kode_proc,
					'id_pengadaan' => $kode,
				);
				$simpan=$this->db->insert('inv_inventaris_barang', $values);
			}
			if($simpan==true){
				$dataupdate['jumlah_unit']= $this->pengadaanbarang_model->sum_unit($kode)->num_rows();
				$dataupdate['nilai_pengadaan']= $this->pengadaanbarang_model->sum_jumlah_item( $kode,'harga');
				$key['id_pengadaan'] = $kode;
        		$this->db->update("inv_pengadaan",$dataupdate,$key);
				die("OK|");
			}else{
				 die("Error|Proses data gagal");
			}
			
		}
	}
	public function edit_barang($kode=0,$id_barang=0,$kd_proc=0)
	{
		$data['action']			= "edit";
		$data['kode']			= $kode;
		$this->form_validation->set_rules('id_mst_inv_barang', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga Satuan', 'trim|required');
        $this->form_validation->set_rules('keterangan_pengadaan', 'Keterangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->pengadaanbarang_model->get_data_barang_edit($kode,$kd_proc,$id_barang); 
			$data['kodebarang']		= $this->pengadaanbarang_model->get_databarang();
			$data['notice']			= validation_errors();
			$data['action']			= "edit";
			$data['kode']			= $kode;
			$data['id_barang']		= $id_barang;
			$data['kd_proc']		= $kd_proc;
			$data['disable']		= "disable";
			die($this->parser->parse('inventory/pengadaan_barang/barang_form_edit', $data));
		}else{
			$jumlah =$this->input->post('jumlah');
			$id_barang = $this->input->post('id_mst_inv_barang');
			$this->dodelpermohonan($kode,$id_barang,$kd_proc);
			$tanggalterima = explode("/",$this->input->post('tanggal_diterima'));
			$this->input->post('tanggal_diterima');
			$tanggal_diterima = $tanggalterima[2].'-'.$tanggalterima[1].'-'.$tanggalterima[0];
			$kode_proc = $this->pengadaanbarang_model->barang_kembar_proc($id_barang);
			for($i=1;$i<=$jumlah;$i++){
				$values = array(
					'id_inventaris_barang' => $this->pengadaanbarang_model->get_inventarisbarang_id($kode,$id_barang),
					'id_mst_inv_barang'=> $id_barang,
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'keterangan_pengadaan' => $this->input->post('keterangan_pengadaan'),
					'id_pengadaan' => $kode,
					'tanggal_diterima' => $tanggal_diterima,
					'barang_kembar_proc' => $kode_proc,
				);
				$simpan=$this->db->insert('inv_inventaris_barang', $values);
			}
			if($simpan==true){
				$dataupdate['terakhir_diubah']= date("Y-m-d");
				$dataupdate['nilai_pengadaan']= $this->pengadaanbarang_model->sum_jumlah_item( $kode,'harga');
				$dataupdate['jumlah_unit']= $this->pengadaanbarang_model->sum_unit($kode)->num_rows();
				$key['id_pengadaan'] = $kode;
        		$this->db->update("inv_pengadaan",$dataupdate,$key);
				die("OK|");
			}else{
				 die("Error|Proses data gagal");
			}
		}
		
	}
	
	function dodel_barang($kode=0,$code_cl_phc="",$id_inv_permohonan_barang_item=0){
		$this->authentication->verify('inventory','del');

		if($this->pengadaanbarang_model->delete_entry($kode,$code_cl_phc)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/pengadaanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/pengadaanbarang");
		}
	}

	
	public function get_autonama() {
        $kode = $this->input->post('code_mst_inv_barang',TRUE); //variabel kunci yang di bawa dari input text id kode
        $query = $this->mkota->get_allkota(); //query model
 
        $kota       =  array();
        foreach ($query as $d) {
            $kota[]     = array(
                'label' => $d->nama_kota, //variabel array yg dibawa ke label ketikan kunci
                'nama' => $d->nama_kota , //variabel yg dibawa ke id nama
                'ibukota' => $d->ibu_kota, //variabel yang dibawa ke id ibukota
                'keterangan' => $d->keterangan //variabel yang dibawa ke id keterangan
            );
        }
        echo json_encode($kota);      //data array yang telah kota deklarasikan dibawa menggunakan json
    }
}
