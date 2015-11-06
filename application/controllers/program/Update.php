<?php
class Update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		

		$this->load->model('mst/inv_ruangan_model');
	}

	
	public function get_ruangan()
	{
		if($this->input->is_ajax_request()) {
			$idUnit = $this->input->post('unit');
			//$idLab  = $this->input->post('lab');
			$kode 	= $this->inv_ruangan_model->getSelectedData('mst_inv_ruangan',$idUnit)->result();

			echo '<option value="">Pilih Ruangan</option>';
			foreach($kode as $kode) :
				$select = $kode->id_mst_inv_ruangan == $coderuangan ? 'selected' : '';
				echo '<option value="'.$kode->id_mst_inv_ruangan.'" '.$select.'>' . $kode->nama_ruangan . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}

	
}