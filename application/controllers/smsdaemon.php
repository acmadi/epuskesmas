<?php
class Smsdaemon extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('sms/inbox_model');
		$this->load->model('sms/opini_model');
		$this->load->model('sms/autoreply_model');
		$this->load->model('sms/bc_model');
		$this->load->model('sms/pbk_model');
		$this->load->model('sms/setting_model');
	}
	
	function index($args = ""){
		if($this->input->is_cli_request()) {
			ini_set('max_execution_time', 0);
			ini_set('max_input_time', -1);
			ini_set('html_errors', 'Off');
			ini_set('register_argc_argv', 'On');
			ini_set('output_buffering', 'Off');
			ini_set('implicit_flush', 'On');
			
			$loop=true;
			$x=1;
			while($loop){
				echo("\n".date("d-m-Y h:i:s") ." ".$x." ".$args." versi 1.0");
				$this->sms_autoteply($args);

				$this->sms_broadcast($args);

				$this->sms_opini($args);
				$x++;
				sleep(5);
			}	
		}else{
			die("access via cli");
		}

	}
	
	function sms_autoteply($args = ""){
		echo "\nsms.autoteply ...\n";

	}
	
	function sms_broadcast($args = ""){
		echo "sms.broadcast ...\n";

	}
	
	function sms_opini($args = ""){
		echo "sms.opini ...\n";
		
	}
}
