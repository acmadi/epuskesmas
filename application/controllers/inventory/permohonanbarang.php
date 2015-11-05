<?php
class Permohonanbarang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('inventory/permohonanbarang_model');
		$this->load->model('mst/puskesmas_model');
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
				'tanggal'	=> $act->tanggal,
				'jumlah'	=> $act->jumlah,
				'ruangan'	=> $act->ruangan,
				'keterangan'	=> $act->keterangan,
				'status'	=> $act->status,
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


	function add(){
		$this->authentication->verify('inventory','add');

        $this->form_validation->set_rules('kode', 'Kode Barang', 'trim|required');
        $this->form_validation->set_rules('uraian', 'Nama Barang', 'trim|required');
        
			if($this->form_validation->run()== FALSE){
				$data['title_group'] = "Parameter";
				$data['title_form']="Tambah Inventory Barang";
				$data['action']="add";
				$data['kode']="";
				$data['puskesmas'] = $this->puskesmas_model->get_data(0, 10);
			
				$data['content'] = $this->parser->parse("inventory/permohonan_barang/form",$data,true);
				$this->template->show($data,"home");
			}elseif($this->invbarang_model->insert_entry() == 1){
				$this->session->set_flashdata('alert', 'Save data successful...');
				redirect(base_url()."inventory/permohonanbarang/");
			}else{
				$this->session->set_flashdata('alert_form', 'Save data failed...');
				redirect(base_url()."inventory/permohonanbarang/add");
			}

	}

	function edit($kode=0)
	{
		$this->authentication->verify('inventory','add');

        $this->form_validation->set_rules('uraian', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('kode', 'Kode Barang', 'trim|required');

		if($this->form_validation->run()== FALSE){
			$data = $this->invbarang_model->get_data_row($kode); 

			$data['title_group'] = "Parameter";
			$data['title_form']="Ubah inventory Barang";
			$data['action']="edit";
			$data['kode']=$kode;

		
			$data['content'] = $this->parser->parse("inventory/permohonanbarang/form",$data,true);
			$this->template->show($data,"home");
		}elseif($this->invbarang_model->update_entry($kode)){
			$this->session->set_flashdata('alert_form', 'Save data successful...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$this->input->post('kode'));
		}else{
			$this->session->set_flashdata('alert_form', 'Save data failed...');
			redirect(base_url()."inventory/permohonanbarang/edit/".$kode);
		}
	}

	function dodel($kode=0){
		$this->authentication->verify('inventory','del');

		if($this->invbarang_model->delete_entry($kode)){
			$this->session->set_flashdata('alert', 'Delete data ('.$kode.')');
			redirect(base_url()."inventory/permohonanbarang");
		}else{
			$this->session->set_flashdata('alert', 'Delete data error');
			redirect(base_url()."inventory/permohonanbarang");
		}
	}
}
