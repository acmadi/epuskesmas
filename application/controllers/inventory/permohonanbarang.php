<?php
class Permohonanbarang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('inventory/permohonanbarang_model');
		$this->load->model('mst/puskesmas_model');
		$this->load->model('inventory/inv_ruangan_model');
		$this->load->model('mst/invbarang_model');
	}
	function json(){
		$this->authentication->verify('inventory','show');


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tanggal_permohonan') {
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
		if($this->session->userdata('filter_code_cl_phc') != '') {
			$this->db->where('inv_permohonan_barang.code_cl_phc',$this->session->userdata('filter_code_cl_phc'));
		}
		$rows_all = $this->permohonanbarang_model->get_data();


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				if($field == 'tanggal_permohonan') {
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
		if($this->session->userdata('filter_code_cl_phc') != '') {
			$this->db->where('inv_permohonan_barang.code_cl_phc',$this->session->userdata('filter_code_cl_phc'));
		}
		$rows = $this->permohonanbarang_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		$no=1;
		foreach($rows as $act) {
			$data[] = array(
				'no'					=> $no++,
				'code_cl_phc' 			=> $act->code_cl_phc,
				'id_inv_permohonan_barang' => $act->id_inv_permohonan_barang,
				'tanggal_permohonan'	=> $act->tanggal_permohonan,
				'jumlah_unit'			=> $act->jumlah_unit,
				'nama_ruangan'			=> $act->nama_ruangan,
				'keterangan'			=> $act->keterangan,
				'status'	=> 1,
				'detail'	=> 1,
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
	function filter(){
		if($_POST) {
			if($this->input->post('code_cl_phc') != '') {
				$this->session->set_userdata('filter_code_cl_phc',$this->input->post('code_cl_phc'));
			}
		}
	}
	function index(){
		$this->authentication->verify('inventory','edit');
		$data['title_group'] = "Parameter";
		$data['title_form'] = "Master Data - Daftar Permohonan Barang";
		$this->db->like('code','p'.substr($this->session->userdata('puskesmas'),0,7));

		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas, 0,7));
		}else {
			$this->db->like('code','P'.$kodepuskesmas);
		}
		$data['datapuskesmas'] 	= $this->inv_ruangan_model->get_data_puskesmas();
		$data['content'] = $this->parser->parse("inventory/permohonan_barang/show",$data,true);


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

        $this->form_validation->set_rules('tgl', 'Tanggal Permohonan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('codepus', 'Puskesmas', 'trim|required');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['title_group'] = "Inventory";
			$data['title_form']="Tambah Permohonan Barang";
			$data['action']="add";
			$data['kode']="";

			$kodepuskesmas = $this->session->userdata('puskesmas');
			if(substr($kodepuskesmas, -2)=="01"){
				$this->db->like('code','P'.substr($kodepuskesmas,0,7));
			}else{
				$this->db->like('code','P'.$kodepuskesmas);
			}
			$data['kodepuskesmas'] = $this->puskesmas_model->get_data();
		
			$data['content'] = $this->parser->parse("inventory/permohonan_barang/form",$data,true);
		}elseif($id = $this->permohonanbarang_model->insert_entry()){
			$this->session->set_flashdata('alert', 'Save data successful...');
			redirect(base_url().'inventory/permohonanbarang/edit/'. $id.'/'.$this->input->post('codepus'));
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/permohonanbarang/add");
		}

		$this->template->show($data,"home");
	}

	function edit($kode=0,$code_cl_phc=""){
		$this->authentication->verify('inventory','edit');

        $this->form_validation->set_rules('tgl', 'Tanggal Permohonan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('codepus', 'Puskesmas', 'trim|required');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data 	= $this->permohonanbarang_model->get_data_row($code_cl_phc,$kode); 

			$data['title_group'] 	= "Inventory";
			$data['title_form']		= "Ubah Permohonan Barang";
			$data['action']			= "edit";
			$data['kode']			= $kode;
			$data['code_cl_phc']	= $code_cl_phc;

			$this->db->where('code',$code_cl_phc);
			$data['kodepuskesmas'] 	= $this->puskesmas_model->get_data();

			$data['barang']	  	= $this->parser->parse('inventory/permohonan_barang/barang', $data, TRUE);
			$data['content'] 	= $this->parser->parse("inventory/permohonan_barang/edit",$data,true);
		}elseif($this->permohonanbarang_model->update_entry($kode,$code_cl_phc)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode."/".$code_cl_phc);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode."/".$code_cl_phc);
		}

		$this->template->show($data,"home");
	}

	function dodel($kode=0,$code_cl_phc=""){
		$this->authentication->verify('inventory','del');

		if($this->permohonanbarang_model->delete_entry($kode,$code_cl_phc)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/permohonanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/permohonanbarang");
		}
	}
	function dodelpermohonan($kode=0,$kode_item=""){
		$this->authentication->verify('inventory','del');

		if($this->permohonanbarang_model->delete_entryitem($kode,$kode_item)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode_item.')');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode."/".$code_cl_phc);
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode."/".$code_cl_phc);
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

				if($field == 'date_received' || $field == 'date_accepted') {
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
		$activity = $this->permohonanbarang_model->getItem('inv_permohonan_barang_item', array('id_inv_permohonan_barang'=>$id))->result();
		$no=1;
		foreach($activity as $act) {
			$data[] = array(
				'no'							=> $no++,
				'id_inv_permohonan_barang_item' => $act->id_inv_permohonan_barang_item,
				'nama_barang'   				=> $act->nama_barang,
				'jumlah'						=> $act->jumlah,
				'keterangan'					=> $act->keterangan,
				'id_inv_permohonan_barang'		=> $act->id_inv_permohonan_barang,
				'code_mst_inv_barang'			=> $act->code_mst_inv_barang,
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

	public function add_barang($kode=0,$code_cl_phc="")
	{	
		$data['action']			= "add";
		$data['kode']			= $kode;
		$data['code_cl_phc']	= $code_cl_phc;
		$data['id_inv_permohonan_barang_item']=0;
        $this->form_validation->set_rules('code_mst_inv_barang', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data['kodebarang']		= $this->permohonanbarang_model->get_databarang();
			$data['notice']			= validation_errors();

			die($this->parser->parse('inventory/permohonan_barang/barang_form', $data));
		}else{
			$values = array(
				'id_inv_permohonan_barang_item'=>$this->permohonanbarang_model->get_permohonanbarangitem_id(),
				'code_mst_inv_barang' => $this->input->post('code_mst_inv_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
				'code_cl_phc' => $code_cl_phc,
				'id_inv_permohonan_barang' => $kode
			);
			if($this->db->insert('inv_permohonan_barang_item', $values)){
				die("OK|");
			}else{
				die("Error|Proses data gagal");
			}
		}
	}
	public function edit_barang($kode=0,$code_cl_phc="",$id_inv_permohonan_barang_item=0)
	{
		$data['action']			= "edit";
		$data['kode']			= $kode;
		$data['code_cl_phc']	= $code_cl_phc;
		$data['id_inv_permohonan_barang_item']	= $id_inv_permohonan_barang_item;
		$this->form_validation->set_rules('code_mst_inv_barang', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->permohonanbarang_model->get_data_barang_edit($code_cl_phc, $kode, $id_inv_permohonan_barang_item); 
			$data['kodebarang']		= $this->permohonanbarang_model->get_databarang();
			$data['notice']			= validation_errors();

			die($this->parser->parse('inventory/permohonan_barang/barang_form', $data));
		}else{
			$values = array(
				'code_mst_inv_barang' => $this->input->post('code_mst_inv_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
			);

			if($this->db->update('inv_permohonan_barang_item', $values,array('id_inv_permohonan_barang_item' => $id_inv_permohonan_barang_item,'code_cl_phc'=>$code_cl_phc,'id_inv_permohonan_barang'=>$kode))){
				die("OK|");
			}else{
				die("Error|Proses data gagal");
			}
		}
		
	}
	
	function dodel_barang($kode=0,$code_cl_phc="",$id_inv_permohonan_barang_item=0){
		$this->authentication->verify('inventory','del');

		if($this->permohonanbarang_model->delete_entry($kode,$code_cl_phc)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/permohonanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/permohonanbarang");
		}
	}

	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		// cari di database
		$data = $this->db->from('mts_inv_barang')->like('uraian',$keyword)->get();	

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'code'	=>$row->code,
				'uraian'	=>$row->uraian,

			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
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
