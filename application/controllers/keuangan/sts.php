<?php
class Sts extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('keuangan/sts_model');
	}

	function index(){
		header("location:master_sts/anggaran");
	}

	function api_data_sts_general(){
		$this->authentication->verify('keuangan','add');		
		
		if(!empty($this->session->userdata('puskes')) and  $this->session->userdata('puskes') != '0'){
			$data['ambildata'] = $this->sts_model->get_data_keu_sts_general($this->session->userdata('puskes'));
			foreach($data['ambildata'] as $d){
				$txt = $d["tgl"]." \t ".$d["nomor"]." \t ".$d["total"]." \t ".$d["status"]." \t <a href=\"".base_url()."keuangan/sts/detail/".$d['tgl']."\">detail</a> \n ";				
				echo $txt;
			}
		}		
	}
	
	function api_data_sts_detail($tgl){
		$this->authentication->verify('keuangan','add');		
		
		
		if(!empty($this->session->userdata('puskes')) and  $this->session->userdata('puskes') != '0'){
			$data['ambildata'] = $this->sts_model->get_data_puskesmas_isi_sts($this->session->userdata('puskes'), $tgl);
			
			foreach($data['ambildata'] as $d){
				$txt = $d["id_anggaran"]." \t ".$d["sub_id"]." \t ".$d["kode_rekening"]." \t ".$d["kode_anggaran"]." \t ".$d["uraian"]." \t ".$d["tarif"]." \t ".$d["vol"]." \t ".$d["jml"]."\n";				
				echo $txt;
			}
			
		}		
	}
	
	function generate_nomor($date){
		//120/1/IX/15
		//nomorpertahun/tgldesimal/bulanromawi/2digittahun
		$tahun = substr(date("Y",strtotime($date)),2,2);
		$dataBulan = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XII','XIII'];
		$bulan = $dataBulan[date("n", strtotime($date))-1];
		$tanggal = date("j", strtotime($date));
		
		$this->db->select('nomor');
		$this->db->where("year(tgl) = ('".date("Y",strtotime($date))."')");
		$this->db->where('code_cl_phc',$this->session->userdata('puskes'));
		$this->db->order_by('tgl','desc');
		$this->db->limit('1');
		$query=$this->db->get('keu_sts');
		$no = 1;
		if(!empty($query->result())){
			foreach($query->result() as $q ){
				$no = explode('/',$q->nomor)[0]+1;				
			}
		}
		$ready = $no."/".$tanggal."/".$bulan."/".$tahun;
		return $ready;
		
	}
	function set_puskes(){
		$this->authentication->verify('keuangan','add');
		$this->session->set_userdata('puskes',$this->input->post('puskes'));
	}
	function general(){
		$this->authentication->verify('keuangan','add');
		$data['data_puskesmas']	= $this->sts_model->get_data_puskesmas();
		$data['title_group'] = "Surat Tanda Setoran";
		$data['title_form'] = "Surat Tanda Setoran";
		$data['ambildata'] = $this->sts_model->get_data();
		$data['kode_rekening'] = $this->sts_model->get_data_kode_rekening();
		$data['nomor'] = $this->generate_nomor(date("Y-m-d H:i:s"));		
		$data['nama_puskes'] = "";
		if(!empty($this->session->userdata('puskes')) and $this->session->userdata('puskes')!= '0'){
			$data['nama_puskes'] = $this->sts_model->get_puskesmas_name($this->session->userdata('puskes'));
		}
			
		$data['content'] = $this->parser->parse("keuangan/main_sts",$data,true);						
		
		$this->template->show($data,"home");
	}

	function detail($tgl){
		$this->authentication->verify('keuangan','add');
		$data['data_puskesmas']	= $this->sts_model->get_data_puskesmas();
		$data['title_group'] = "Detail Surat Tanda Setoran";
		$data['title_form'] = "Detail Surat Tanda Setoran";
		$data['ambildata'] = $this->sts_model->get_data();
		$data['kode_rekening'] = $this->sts_model->get_data_kode_rekening();
		$data['nomor'] = $this->generate_nomor(date("Y-m-d H:i:s"));		
		$data['tgl'] = $tgl;
		$data['content'] = $this->parser->parse("keuangan/detail_sts",$data,true);		
				
		$this->template->show($data,"home");
	}		
	function cek_tgl_sts($tgl_input){
		$this->db->select('tgl');
		$this->db->order_by('tgl','desc');
		$this->db->limit('1');
		$this->db->where('code_cl_phc',$this->session->userdata('puskes'));
		$query = $this->db->get('keu_sts');
		
		$datetime = new DateTime('tomorrow');
		$besok = strtotime($datetime->format('Y-m-d'));
		$sekarang = strtotime(date('Y-m-d'));
		$tgl_input = strtotime($tgl_input);

		if(!empty($query->result())){
			foreach($query->result() as $q){				
				$sekarang = strtotime($q->tgl);
				echo "sekarang".$sekarang." <br>";
				echo "besok".$besok." <br>";
				echo "inpput".$tgl_input." <br>";
				if($tgl_input < $sekarang and $tgl_input < $besok){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return true;
		}
		
		
	}
	function add_sts(){		
		$this->authentication->verify('keuangan','add');
		if($this->cek_tgl_sts($this->input->post('tgl'))){	
			$this->sts_model->add_sts();
			echo 'sip';
		}else{
			echo 'gagal';
		}
		
	}
}
