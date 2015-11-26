<?php
class Sms_model extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }

    function get_data()
    {
        $data['inbox'] 		= $this->db->get('inbox')->num_rows();
        $data['pbk'] 		= $this->db->get('sms_pbk')->num_rows();
        $data['grup'] 		= $this->db->get('sms_grup')->num_rows();

        $this->db->where('Status','SendingOK');
        $this->db->or_where('Status','SendingOKNoReport');
        $this->db->or_where('Status','DeliveryOK');
        $data['sentitems'] 	= $this->db->get('sentitems')->num_rows();

        return $data;
    }

    function get_sms_kategori()
    {
        $query = $this->db->query("SELECT sms_tipe.nama, COUNT(sms_opini.id_opini) AS jml FROM sms_opini 
        INNER JOIN sms_tipe ON sms_opini.id_sms_tipe=sms_tipe.id_tipe 
        GROUP BY sms_tipe.id_tipe ORDER BY 'nama' asc");

        return $query->result();
    }
}