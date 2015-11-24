<?php
class Distribusibarang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('mst/puskesmas_model');
		$this->load->model('inventory/pengadaanbarang_model');
		$this->load->model('inventory/inv_barang_model');
		$this->load->model('inventory/inv_ruangan_model');
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
				'nilai_pengadaan'			=> number_format($act->nilai_pengadaan,2),
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
		$data['title_group'] = "Inventory";
		$data['title_form'] = "Distribusi Barang";

		$kodepuskesmas = $this->session->userdata('puskesmas');
		if(substr($kodepuskesmas, -2)=="01"){
			$this->db->like('code','P'.substr($kodepuskesmas, 0,7));
		}else {
			$this->db->like('code','P'.$kodepuskesmas);
		}
		$data['datapuskesmas'] 	= $this->inv_barang_model->get_data_puskesmas();

		$data['content'] = $this->parser->parse("inventory/distribusi_barang/show",$data,true);
		$this->template->show($data,"home");
	}

	public function get_ruangan()
	{
		if($this->input->is_ajax_request()) {
			$code_cl_phc = $this->input->post('code_cl_phc');
			$id_mst_inv_ruangan = $this->input->post('id_mst_inv_ruangan');

			$kode 	= $this->inv_ruangan_model->getSelectedData('mst_inv_ruangan',$code_cl_phc)->result();

			if(substr($code_cl_phc, -2)=="01"){
				echo '<option value="none">-- Belum Distribusi --</option>';
			}
			echo '<option value="all">-- Seluruh Ruangan --</option>';
			foreach($kode as $kode) :
				echo $select = $kode->id_mst_inv_ruangan == $id_mst_inv_ruangan ? 'selected' : '';
				echo '<option value="'.$kode->id_mst_inv_ruangan.'" '.$select.'>' . $kode->nama_ruangan . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}

}
