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

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$rows_all = $this->permohonanbarang_model->get_data();


		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field,$value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$rows = $this->permohonanbarang_model->get_data($this->input->post('recordstartindex'), $this->input->post('pagesize'));
		$data = array();
		$no=1;
		foreach($rows as $act) {
			$data[] = array(
				'no'		=> $no++,
				'id_inv_permohonan_barang' => $act->id_inv_permohonan_barang,
				'tanggal_permohonan'	=> $act->tanggal_permohonan,
				'jumlah_unit'	=> $act->jumlah_unit,
				'nama_ruangan'	=> $act->nama_ruangan,
				'keterangan'=> $act->keterangan,
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

	function index(){
		$this->authentication->verify('inventory','edit');
		$data['title_group'] = "Parameter";
		$data['title_form'] = "Master Data - Daftar Permohonan Barang";
		$data['content'] = $this->parser->parse("inventory/permohonan_barang/show",$data,true);

		$this->template->show($data,"home");
	}

	public function get_ruangan()
	{
		if($this->input->is_ajax_request()) {
			$code = $this->input->post('code');
			$id_ruang = $this->input->post('id_ruang');

			$kode 	= $this->inv_ruangan_model->getSelectedData('mst_inv_ruangan',$code)->result();

			'<option value="">Pilih Ruangan</option>';
			foreach($kode as $kode) :
				echo $select = $kode->id_mst_inv_ruangan == $id_ruang ? 'selected' : '';
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

			$kode 	= $this->invbarang_model->getSelectedData('mst_inv_barang',$code)->result();

			'<option value="">Pilih Ruangan</option>';
			foreach($kode as $kode) :
				echo $select = $kode->code == $code ? 'selected' : '';
				echo '<option value="'.$kode->uraian.'" '.$select.'>' . $kode->uraian . '</option>';
			endforeach;

			return FALSE;
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
			redirect(base_url().'inventory/permohonanbarang/edit/'.$this->input->post('codepus').'/'. $id);
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/permohonanbarang/add");
		}

		$this->template->show($data,"home");
	}

	function edit($code_cl_phc="",$kode=0)
	{
		$this->authentication->verify('inventory','edit');

        $this->form_validation->set_rules('tgl', 'Tanggal Permohonan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('codepus', 'Puskesmas', 'trim|required');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->permohonanbarang_model->get_data_row($code_cl_phc,$kode); 
			
			$cekpus = $this->puskesmas_model->get_data_row($kode);

			$data['title_group'] = "Inventory";
			$data['title_form']="Ubah Permohonan Barang";
			$data['action']="edit";
			$data['kode']=$kode;

			$kodepuskesmas = $this->session->userdata('puskesmas');
			if(substr($kodepuskesmas, -2)=="01"){
				$this->db->like('code','P'.substr($kodepuskesmas,0,7));
			}else{
				$this->db->like('code','P'.$kodepuskesmas);
			}
			$data['kodepuskesmas'] = $this->puskesmas_model->get_data();
			
			$data['codepuskes']	= !empty($cekpus) ? $cekpus->code : $data['code_cl_phc'];
			$data['coderuangan']	= !empty($cekruang) ? $cekruang->id_mst_inv_ruangan : $data['code_cl_phc'];
			$data['document']	  = $this->load->view('inventory/permohonan_barang/document', $data, TRUE);
			$data['content'] = $this->parser->parse("inventory/permohonan_barang/edit",$data,true);
		}elseif($this->permohonanbarang_model->update_entry($kode)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$this->input->post('kode'));
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode);
		}

		$this->template->show($data,"home");
	}

	function dodel($kode=0){
		$this->authentication->verify('inventory','del');

		if($this->permohonanbarang_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/permohonanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/permohonanbarang");
		}
	}
	public function document($id = 0)
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
		$activity = $this->permohonanbarang_model->getItem('inv_permohonan_barang_item', array('id_inv_permohonan_barang'=>16))->result();

		foreach($activity as $act) {
			$data[] = array(
				'id_inv_permohonan_barang_item'   				=> $act->id_inv_permohonan_barang_item,
				'nama_barang'   		=> $act->nama_barang,
				'jumlah'		=> $act->jumlah,
				'keterangan'		=> $act->keterangan,
				'id_inv_permohonan_barang'		=> $act->id_inv_permohonan_barang,
				'code_mst_inv_barang'	=> $act->code_mst_inv_barang
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
	public function tambahbarang()
	{
		if($_POST) {

			$values = array(
				'keterangan' => $this->input->post('keterangan'),
				'jumlah' => $this->input->post('jumlah'),
				'nama_barang' => $this->input->post('nama_barang'),
				'id_inv_permohonan_barang' => $this->input->post('id_inv_permohonan_barang'),
				'code_mst_inv_barang' => $this->input->post('code_mst_inv_barang'),
				'id_inv_permohonan_barang_item'=>$this->permohonanbarang_model->get_permohonanbarangitem_id(),
			);


			if($this->input->post('id_dokumen_file') == 0) {
				$this->db->insert('inv_permohonan_barang_item', $values);
			} else {
				$this->db->where('id_dokumen_file', $this->input->post('id_dokumen_file'));
				$this->db->update('smt_rekam_file', $values);
			}

			$datas['notice'] = 'Data berhasil disimpan';
			$datas['error']	 = 0;

			echo json_encode($datas);

			return FALSE;
		}

		if($this->input->is_ajax_request()) {
			$data['title']		 	 = $this->input->get('id') == 0 ? 'Add' : 'Edit';
			$data['id_dokumen']  	 = $this->input->get('id_dokumen') == 0 ? 0 : $this->input->get('id_dokumen');
			$data['id_dokumen_file'] = $this->input->get('id') == 0 ? 0 : $this->input->get('id');
			$data['kodebarang']		 = $this->permohonanbarang_model->get_databarang();
			$this->load->view('inventory/permohonan_barang/document_form', $data);
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
}
