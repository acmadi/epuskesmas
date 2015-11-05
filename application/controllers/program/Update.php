<?php
class Update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/researcher/researcher_model');
		$this->load->model('idec_model');
	}

	
	public function get_ruangan()
	{
		if($this->input->is_ajax_request()) {
			echo $idUnit = $this->input->post('unit');
			//$idLab  = $this->input->post('lab');
			$labs 	= $this->employee_model->organization(array('id_organization_item_parent' => $idUnit, 'level' => 'lab'));

			echo '<option value="">-</option>';
			foreach($labs as $lab) :
				$select = $lab->id_organization_item == $idLab ? 'selected' : '';
				echo '<option value="'.$lab->id_organization_item.'" '.$select.'>' . $lab->org_name . '</option>';
			endforeach;

			return FALSE;
		}

		show_404();
	}

	
}