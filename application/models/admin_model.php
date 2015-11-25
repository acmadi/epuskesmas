<?php
class Admin_model extends CI_Model {

    var $tabel     = 'app_theme';

    function __construct() {
        parent::__construct();
    }
    
 	function get_theme($id){
		$data = array();
		$options = array('id_theme' => $id);
		$query = $this->db->get_where($this->tabel,$options,1);
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}


	function get_inv_barang(){
		$query = $this->db->query("SELECT SUM(jml) AS jml, SUM(nilai) AS nilai FROM ((SELECT COUNT(id_inventaris_barang) AS jml,SUM(harga) AS nilai FROM inv_inventaris_barang WHERE id_pengadaan=0)UNION(SELECT COUNT(id_inventaris_barang) AS jml,SUM(harga) AS nilai FROM inv_inventaris_barang INNER JOIN inv_pengadaan ON inv_pengadaan.id_pengadaan=inv_inventaris_barang.id_pengadaan)) AS aset");

		return $query->result();
	}

	function get_inv_barang1(){
		$query = $this->db->query("SELECT COUNT(id_mst_inv_ruangan) as jml from mst_inv_ruangan ");

		return $query->result();
	}

	function get_jum_aset(){
		$q1 = '';

		if ($this->session->userdata('bar_tipe') == 'jml'  ){
			$q1 = "SELECT id_cl_phc, COUNT(inv_inventaris_barang.id_inventaris_barang) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'B' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		} else {
			$q1 = "SELECT id_cl_phc, SUM(harga) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'B' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		}
 
		$query =  $this->db->query($q1);

		return $query->result();
	}

	function get_jum_aset1(){
		$q1 = '';

		if ($this->session->userdata('bar_tipe') == 'jml'   ){
			$q1 = "SELECT id_cl_phc, COUNT(inv_inventaris_barang.id_inventaris_barang) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'RR' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		} else {
			$q1 = "SELECT id_cl_phc, SUM(harga) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'RR' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		}
 
		$query =  $this->db->query($q1);

		return $query->result();
	}

	function get_jum_aset2(){
		$q1 = '';

		if ($this->session->userdata('bar_tipe') == 'jml'   ){
			$q1 = "SELECT id_cl_phc, COUNT(inv_inventaris_barang.id_inventaris_barang) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'RB' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		} else {
			$q1 = "SELECT id_cl_phc, SUM(harga) AS jml FROM inv_inventaris_barang 
		INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
		LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
		WHERE pilihan_keadaan_barang = 'RB' GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc";
		}
 
		$query =  $this->db->query($q1);

		return $query->result();
	}

	function get_nilai_aset()
	{
		$query = $this->db->query("SELECT id_cl_phc, COUNT(inv_inventaris_barang.id_inventaris_barang) AS jml,SUM(harga) AS nilai FROM inv_inventaris_barang 
			INNER JOIN inv_inventaris_distribusi ON inv_inventaris_barang.id_inventaris_barang=inv_inventaris_distribusi.id_inventaris_barang 
			LEFT JOIN cl_phc ON inv_inventaris_distribusi.id_cl_phc=cl_phc.code
			GROUP BY inv_inventaris_distribusi.id_cl_phc ORDER BY 'value' asc");

		return $query->result();
	}

}