<?php
class Inv_barang_model extends CI_Model {

    var $tabel    = 'inv_inventaris_barang';
	var $lang	  = '';

    function __construct() {
        parent::__construct();
		$this->lang	  = $this->config->item('language');
    }
    
    function get_data_status()
    {	
    	$this->db->where("mst_inv_pilihan.tipe",'status_pengadaan');
 		$this->db->select('mst_inv_pilihan.*');		
 		$this->db->order_by('mst_inv_pilihan.code','asc');
		$query = $this->db->get('mst_inv_pilihan');	
		return $query->result();	
    }
    function pilih_data_status($status)
    {   
        $this->db->where("mst_inv_pilihan.tipe",$status);
        $this->db->select('mst_inv_pilihan.*');     
        $this->db->order_by('mst_inv_pilihan.code','asc');
        $query = $this->db->get('mst_inv_pilihan'); 
        return $query->result();    
    }
    function get_data_pilihan($pilih)
    {   
        $this->db->where("mst_inv_pilihan.tipe",$pilih);
        $this->db->select('mst_inv_pilihan.*');     
        $this->db->order_by('mst_inv_pilihan.code','asc');
        $query = $this->db->get('mst_inv_pilihan'); 
        return $query->result();    
    }
    function get_data($start=0,$limit=999999,$options=array())
    {
        $query = $this->db->query(" (SELECT mst_inv_pilihan.value,
                                    inv_inventaris_barang.barang_kembar_proc,
                                    inv_inventaris_barang.*,
                                    Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                    Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang
                                            JOIN mst_inv_pilihan
                                              ON inv_inventaris_barang.pilihan_status_invetaris =
                                                 mst_inv_pilihan.code
                                                 AND tipe = 'status_inventaris'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_pilihan.value,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang.*,
                                            Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                            JOIN mst_inv_pilihan
                                              ON inv_inventaris_barang.pilihan_status_invetaris =
                                                 mst_inv_pilihan.code
                                                 AND tipe = 'status_inventaris'
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)  ");
        return $query->result();
    }
    function get_data_A($start=0,$limit=999999,$options=array())
    {
        $query = $this->db->query("  (
                SELECT   mst_inv_pilihan.value,
                inv_inventaris_barang.barang_kembar_proc,
                inv_inventaris_barang.*,
                Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                Sum(inv_inventaris_barang.harga)                  AS totalharga
                FROM     inv_inventaris_barang
                JOIN     mst_inv_pilihan
                ON       inv_inventaris_barang.pilihan_status_invetaris = mst_inv_pilihan.code
                AND      tipe='status_inventaris'
                WHERE    inv_inventaris_barang.id_pengadaan=0
                AND      inv_inventaris_barang.pilihan_status_invetaris=3
                GROUP BY inv_inventaris_barang.barang_kembar_proc)
                UNION
                (
                SELECT     mst_inv_pilihan.value,
                inv_inventaris_barang.barang_kembar_proc,
                inv_inventaris_barang.*,
                Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                Sum(inv_inventaris_barang.harga)                  AS totalharga
                FROM       inv_inventaris_barang
                INNER JOIN inv_pengadaan
                ON         inv_pengadaan.id_pengadaan=inv_inventaris_barang.id_pengadaan
                AND        pilihan_status_pengadaan=4
                JOIN       mst_inv_pilihan
                ON         inv_inventaris_barang.pilihan_status_invetaris = mst_inv_pilihan.code
                AND        tipe='status_inventaris'
                AND        inv_inventaris_barang.pilihan_status_invetaris=3
                GROUP BY   inv_inventaris_barang.barang_kembar_proc 
        )");
        $query = $this->db->get($this->tabel,$limit,$start);
        return $query->result();
    }
    function get_data_golongan($table,$start=0,$limit=999999,$options=array()){
        $this->db->select("$table.*");
        $query = $this->db->get($table,$limit,$start);
        return $query->result();
    }
    function get_data_golongan_A($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                    satuan.value                                      AS satuan,
                                    hak.value                                         AS hak,
                                    penggunaan.value                                  AS penggunaan,
                                    inv_inventaris_barang.barang_kembar_proc,
                                    inv_inventaris_barang_a.*,
                                    Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                    Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_a
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_a.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_a.id_mst_inv_barang
                                                    ".$where." )
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_a.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_a.pilihan_satuan_barang = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            JOIN mst_inv_pilihan AS hak
                                              ON inv_inventaris_barang_a.pilihan_status_hak = hak.code
                                                 AND hak.tipe = 'status_hak'
                                            JOIN mst_inv_pilihan AS penggunaan
                                              ON inv_inventaris_barang_a.pilihan_penggunaan = penggunaan.code
                                                 AND penggunaan.tipe = 'penggunaan'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0 
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            satuan.value                                      AS satuan,
                                            hak.value                                         AS hak,
                                            penggunaan.value                                  AS penggunaan,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_a.*,
                                            Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_a
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_a.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_a.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_a.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_a.pilihan_satuan_barang = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            JOIN mst_inv_pilihan AS hak
                                              ON inv_inventaris_barang_a.pilihan_status_hak = hak.code
                                                 AND hak.tipe = 'status_hak'
                                            JOIN mst_inv_pilihan AS penggunaan
                                              ON inv_inventaris_barang_a.pilihan_penggunaan = penggunaan.code
                                                 AND penggunaan.tipe = 'penggunaan'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)  ");
        return $query->result();
    }
    function get_filter_golongan_A($table=0,$start=0,$limit=999999,$options=array()){
        $query = $this->db->query("        (SELECT mst_inv_barang.uraian,
                                   inv_inventaris_distribusi.id_cl_phc,
                                    satuan.value                                      AS satuan,
                                    hak.value                                         AS hak,
                                    penggunaan.value                                  AS penggunaan,
                                    inv_inventaris_barang.barang_kembar_proc,
                                    inv_inventaris_barang_a.*,
                                    COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                    SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_a
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_a.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_a.id_mst_inv_barang )
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_a.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_a.pilihan_satuan_barang = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            JOIN mst_inv_pilihan AS hak
                                              ON inv_inventaris_barang_a.pilihan_status_hak = hak.code
                                                 AND hak.tipe = 'status_hak'
                                            JOIN mst_inv_pilihan AS penggunaan
                                              ON inv_inventaris_barang_a.pilihan_penggunaan = penggunaan.code
                                                 AND penggunaan.tipe = 'penggunaan'
                                            JOIN inv_inventaris_distribusi 
                                      ON (inv_inventaris_barang_a.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                     AND inv_inventaris_distribusi.id_cl_phc = 'P3172100201')
                                                 WHERE  inv_inventaris_barang.id_pengadaan = 0
                                                 GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                                UNION
                                                (SELECT mst_inv_barang.uraian,
                                                inv_inventaris_distribusi.id_cl_phc,
                                                        satuan.value                                      AS satuan,
                                                        hak.value                                         AS hak,
                                                        penggunaan.value                                  AS penggunaan,
                                                        inv_inventaris_barang.barang_kembar_proc,
                                                        inv_inventaris_barang_a.*,
                                                        COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                                        SUM(inv_inventaris_barang.harga)                  AS totalharga
                                                 FROM   inv_inventaris_barang_a
                                                        JOIN inv_inventaris_barang
                                                          ON ( inv_inventaris_barang.id_inventaris_barang =
                                                                      inv_inventaris_barang_a.id_inventaris_barang
                                                               AND inv_inventaris_barang.id_mst_inv_barang =
                                                                   inv_inventaris_barang_a.id_mst_inv_barang )
                                                        JOIN mst_inv_barang
                                                          ON ( mst_inv_barang.code = inv_inventaris_barang_a.id_mst_inv_barang )
                                                        JOIN mst_inv_pilihan AS satuan
                                                          ON inv_inventaris_barang_a.pilihan_satuan_barang = satuan.code
                                                             AND satuan.tipe = 'satuan'
                                                        JOIN mst_inv_pilihan AS hak
                                                          ON inv_inventaris_barang_a.pilihan_status_hak = hak.code
                                                             AND hak.tipe = 'status_hak'
                                                        JOIN mst_inv_pilihan AS penggunaan
                                                          ON inv_inventaris_barang_a.pilihan_penggunaan = penggunaan.code
                                                             AND penggunaan.tipe = 'penggunaan'
                                                        INNER JOIN inv_pengadaan
                                                                ON inv_pengadaan.id_pengadaan =
                                                                   inv_inventaris_barang.id_pengadaan
                                                                   AND pilihan_status_pengadaan = 4
                                                        JOIN inv_inventaris_distribusi 
                                      ON (inv_inventaris_barang_a.id_inventaris_barang = inv_inventaris_distribusi.id_inventaris_barang
                                      AND inv_inventaris_distribusi.id_cl_phc = 'P3172100201')
                                                 GROUP  BY inv_inventaris_barang.barang_kembar_proc) ");
        return $query->result();
    }
    
    function get_data_golongan_B($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                    satuan.value                                      AS satuan,
                                    bahan.value                                  AS bahan,
                                    inv_inventaris_barang.barang_kembar_proc,
                                    inv_inventaris_barang_b.*,
                                    COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                    SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_b
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_b.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_b.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_b.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_b.pilihan_satuan = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            JOIN mst_inv_pilihan AS bahan
                                              ON inv_inventaris_barang_b.pilihan_bahan = bahan.code
                                                 AND bahan.tipe = 'bahan'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            satuan.value                                      AS satuan,
                                            bahan.value                                  AS bahan,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_b.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_b
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_b.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_b.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_b.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_b.pilihan_satuan = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            JOIN mst_inv_pilihan AS bahan
                                              ON inv_inventaris_barang_b.pilihan_bahan = bahan.code
                                                 AND bahan.tipe = 'bahan'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)  ");
        return $query->result();
    }
    function get_data_golongan_C($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                            hak.value                                         AS hak,
                                            tingkat.value                                     AS tingkat,
                                            beton.value                                       AS beton,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_c.*,
                                            Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_c
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_c.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_c.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_c.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS hak
                                              ON inv_inventaris_barang_c.pillihan_status_hak = hak.code
                                                 AND hak.tipe = 'status_hak'
                                            JOIN mst_inv_pilihan AS tingkat
                                              ON inv_inventaris_barang_c.pillihan_status_hak = tingkat.code
                                                 AND tingkat.tipe = 'kons_tingkat'
                                            JOIN mst_inv_pilihan AS beton
                                              ON inv_inventaris_barang_c.pilihan_kons_beton = beton.code
                                                 AND beton.tipe = 'kons_beton'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            hak.value                                         AS hak,
                                            tingkat.value                                     AS tingkat,
                                            beton.value                                       AS beton,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_c.*,
                                            Count(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            Sum(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_c
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_c.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_c.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_c.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS hak
                                              ON inv_inventaris_barang_c.pillihan_status_hak = hak.code
                                                 AND hak.tipe = 'status_hak'
                                            JOIN mst_inv_pilihan AS tingkat
                                              ON inv_inventaris_barang_c.pilihan_kons_tingkat = tingkat.code
                                                 AND tingkat.tipe = 'kons_tingkat'
                                            JOIN mst_inv_pilihan AS beton
                                              ON inv_inventaris_barang_c.pilihan_kons_beton = beton.code
                                                 AND beton.tipe = 'kons_beton'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)  ");
        return $query->result();
    }
    function get_data_golongan_D($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                            tanah.value                                      AS tanah,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_d.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_d
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_d.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_d.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_d.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS tanah
                                              ON inv_inventaris_barang_d.pilihan_status_tanah = tanah.code
                                                 AND tanah.tipe = 'status_hak'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            tanah.value                                      AS tanah,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_d.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_d
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_d.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_d.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_d.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS tanah
                                              ON inv_inventaris_barang_d.pilihan_status_tanah = tanah.code
                                                 AND tanah.tipe = 'status_hak'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)  ");
        return $query->result();
    }
     function get_data_golongan_E($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                            bahan.value                                      AS bahan,
                                            satuan.value                                      AS satuan,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_e.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_e
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_e.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_e.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_e.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS bahan
                                              ON inv_inventaris_barang_e.pilihan_budaya_bahan = bahan.code
                                                 AND bahan.tipe = 'bahan'
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_e.pilihan_satuan = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            bahan.value                                      AS bahan,
                                            satuan.value                                      AS satuan,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_e.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_e
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_e.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_e.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_e.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS bahan
                                              ON inv_inventaris_barang_e.pilihan_budaya_bahan = bahan.code
                                                 AND bahan.tipe = 'bahan'
                                            JOIN mst_inv_pilihan AS satuan
                                              ON inv_inventaris_barang_e.pilihan_satuan = satuan.code
                                                 AND satuan.tipe = 'satuan'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc) ");
        return $query->result();
    }
     function get_data_golongan_F($where="",$start=0,$limit=999999,$options=array()){
        $query = $this->db->query(" (SELECT mst_inv_barang.uraian,
                                            tingkat.value                                      AS tingkat,
                                            beton.value                                      AS beton,
                                            tanah.value                                      AS tanah,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_f.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_f
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_f.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_f.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_f.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS tingkat
                                              ON inv_inventaris_barang_f.pilihan_konstruksi_bertingkat = tingkat.code
                                                 AND tingkat.tipe = 'kons_tingkat'
                                            JOIN mst_inv_pilihan AS beton
                                              ON inv_inventaris_barang_f.pilihan_konstruksi_beton = beton.code
                                                 AND beton.tipe = 'kons_beton'
                                            JOIN mst_inv_pilihan AS tanah
                                              ON inv_inventaris_barang_f.pilihan_status_tanah = tanah.code
                                                 AND tanah.tipe = 'status_hak'
                                     WHERE  inv_inventaris_barang.id_pengadaan = 0
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)
                                    UNION
                                    (SELECT mst_inv_barang.uraian,
                                            tingkat.value                                      AS tingkat,
                                            beton.value                                      AS beton,
                                            tanah.value                                      AS tanah,
                                            inv_inventaris_barang.barang_kembar_proc,
                                            inv_inventaris_barang_f.*,
                                            COUNT(inv_inventaris_barang.id_inventaris_barang) AS jumlah,
                                            SUM(inv_inventaris_barang.harga)                  AS totalharga
                                     FROM   inv_inventaris_barang_f
                                            JOIN inv_inventaris_barang
                                              ON ( inv_inventaris_barang.id_inventaris_barang =
                                                          inv_inventaris_barang_f.id_inventaris_barang
                                                   AND inv_inventaris_barang.id_mst_inv_barang =
                                                       inv_inventaris_barang_f.id_mst_inv_barang 
                                                    ".$where.")
                                            JOIN mst_inv_barang
                                              ON ( mst_inv_barang.code = inv_inventaris_barang_f.id_mst_inv_barang )
                                            JOIN mst_inv_pilihan AS tingkat
                                              ON inv_inventaris_barang_f.pilihan_konstruksi_bertingkat = tingkat.code
                                                 AND tingkat.tipe = 'kons_tingkat'
                                            JOIN mst_inv_pilihan AS beton
                                              ON inv_inventaris_barang_f.pilihan_konstruksi_beton = beton.code
                                                 AND beton.tipe = 'kons_beton'
                                            JOIN mst_inv_pilihan AS tanah
                                              ON inv_inventaris_barang_f.pilihan_status_tanah = tanah.code
                                                 AND tanah.tipe = 'status_hak'
                                            INNER JOIN inv_pengadaan
                                                    ON inv_pengadaan.id_pengadaan =
                                                       inv_inventaris_barang.id_pengadaan
                                                       AND pilihan_status_pengadaan = 4
                                     GROUP  BY inv_inventaris_barang.barang_kembar_proc)   ");
        return $query->result();
    }
 	function get_data_row($kode){
		$data = array();
		$this->db->where("inv_pengadaan.id_pengadaan",$kode);
		$this->db->select("$this->tabel.*,mst_inv_pilihan.value");
        $this->db->join('mst_inv_pilihan', "inv_pengadaan.pilihan_status_pengadaan = mst_inv_pilihan.code AND mst_inv_pilihan.tipe='status_pengadaan'",'left');
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}
	function get_data_barang_edit($id_barang,$kd_proc,$kd_inventaris){
		$data = array();
		
		/*$this->db->select("inv_inventaris_barang.id_inventaris_barang,inv_inventaris_barang.id_mst_inv_barang,inv_inventaris_barang.nama_barang,inv_inventaris_barang.harga,
                        COUNT(inv_inventaris_barang.id_mst_inv_barang) AS jumlah,
                        COUNT(inv_inventaris_barang.id_mst_inv_barang)*inv_inventaris_barang.harga AS totalharga,
                        inv_inventaris_barang.keterangan_pengadaan,inv_inventaris_barang.tanggal_diterima,
                        inv_inventaris_barang.waktu_dibuat,inv_inventaris_barang.terakhir_diubah,inv_inventaris_barang.pilihan_status_invetaris");
		$this->db->where("id_inventaris_barang",$kd_inventaris);
		$this->db->where("id_mst_inv_barang",$id_barang);
        $this->db->where("barang_kembar_proc",$kd_proc);*/
        $sql="SELECT inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah FROM inv_inventaris_barang WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )";
		$query = $this->db->query($sql, array($kd_inventaris));
		if ($query->num_rows() > 0){
			$data = $query->row_array();
		}

		$query->free_result();    
		return $data;
	}
    function get_data_barang_edit_table($id_barang,$kd_inventaris,$pilih_table){
        $data = array();
        if($pilih_table=='inv_inventaris_barang_a'){

            $sql= "SELECT inv_inventaris_barang_a.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_a ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_a.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_a.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));

        }else if($pilih_table=='inv_inventaris_barang_b'){

            $sql= "SELECT inv_inventaris_barang_b.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_b ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_b.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_b.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));

        }else if($pilih_table=='inv_inventaris_barang_c'){

            $sql= "SELECT inv_inventaris_barang_c.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_c ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_c.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_c.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));            

        }else if($pilih_table=='inv_inventaris_barang_d'){

            $sql= "SELECT inv_inventaris_barang_d.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_d ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_d.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_d.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));

        }else if($pilih_table=='inv_inventaris_barang_e'){

            $sql= "SELECT inv_inventaris_barang_e.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_e ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_e.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_e.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));

        }else if($pilih_table=='inv_inventaris_barang_f'){   

            $sql= "SELECT inv_inventaris_barang_f.*, inv_inventaris_barang.*,COUNT(inv_inventaris_barang.barang_kembar_proc) AS jumlah 
FROM inv_inventaris_barang 
LEFT JOIN inv_inventaris_barang_f ON (inv_inventaris_barang.id_inventaris_barang = inv_inventaris_barang_f.id_inventaris_barang 
AND inv_inventaris_barang.id_mst_inv_barang=inv_inventaris_barang_f.id_mst_inv_barang)
WHERE inv_inventaris_barang.barang_kembar_proc = (SELECT barang_kembar_proc FROM inv_inventaris_barang WHERE id_inventaris_barang= ? )
";           $query= $this->db->query($sql, array($kd_inventaris));

        }
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }

        $query->free_result();    
        return $data;
    }
	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

    function get_permohonan_id($puskesmas="")
    {
    	$this->db->select('MAX(id_inv_permohonan_barang)+1 as id');
    	$this->db->where('code_cl_phc',$puskesmas);
    	$permohonan = $this->db->get('inv_permohonan_barang')->row();
    	if (empty($permohonan->id)) {
    		return 1;
    	}else {
    		return $permohonan->id;
    	}
	}
	function get_inventarisbarang_id($id,$barang,$table)
    {
    	$query  = $this->db->query("SELECT max(id_inventaris_barang) as id from $table WHERE id_pengadaan=$id AND id_mst_inv_barang=$barang");
    	if (empty($query->result()))
    	{
    		return 1;
    	}else {
    		foreach ($query->result() as $jum ) {
    			return $jum->id+1;
    		}
    	}

	}

   function insert_entry()
    {
    	$data['tgl_pengadaan']	            = date("Y-m-d",strtotime($this->input->post('tgl')));
		$data['pilihan_status_pengadaan']	= $this->input->post('status');
		$data['keterangan']		            = $this->input->post('keterangan');
        $data['nomor_kontrak']              = $this->input->post('nomor_kontrak');
		$data['waktu_dibuat']		        = date('Y-m-d H:i:s');
        $data['terakhir_diubah']            = "0000-00-00 00:00:00";
		$data['jumlah_unit']      	        = 0;
        $data['nilai_pengadaan']            = 0;
		if($this->db->insert($this->tabel, $data)){
			return $this->db->insert_id();
		}else{
			return mysql_error();
		}
    }
    function get_data_puskesmas($start=0,$limit=999999,$options=array())
    {
        $this->db->order_by('value','asc');
        // $this->db->where(code)
        $query = $this->db->get('cl_phc',$limit,$start);
        return $query->result();
    }
    function get_data_tanah($start=0,$limit=999999,$options=array())
    {
        $this->db->order_by('code','asc');
        $this->db->where("code like '%00000000'");
        $query = $this->db->get('mst_inv_barang',$limit,$start);
        return $query->result();
    }
    function tanggal($pengadaan){
        $query = $this->db->query("select tgl_pengadaan from inv_pengadaan where id_pengadaan = $pengadaan")->result();
        foreach ($query as $key) {
            return $key->tgl_pengadaan;
        }
    }
    function insert_data_from($id_barang,$kode_proc,$tanggal_diterima,$id_pengadaan)
    {   //$tanggal = $this->tanggal($kode);
        $values = array(
            'id_mst_inv_barang'     => $id_barang,
            'id_pengadaan'          => $id_pengadaan,
            'nama_barang'           => $this->input->post('nama_barang'),
            'harga'                 => $this->input->post('harga'),
            'keterangan_pengadaan'  => $this->input->post('keterangan_pengadaan'),
            'pilihan_status_invetaris'  => $this->input->post('pilihan_status_invetaris'),
            /*'tanggal_pembelian'     => $tanggal,
            'tanggal_pengadaan'     => $tanggal,*/
            'tanggal_diterima'      => $tanggal_diterima,
            'barang_kembar_proc'    => $kode_proc,
        );
        if($this->db->insert('inv_inventaris_barang', $values)){
            return $this->db->insert_id();
        }else{
            return mysql_error();
        }
    }
    function update_entry($kode)
    {
    	$data['tgl_pengadaan']             = date("Y-m-d",strtotime($this->input->post('tgl')));
        $data['pilihan_status_pengadaan']   = $this->input->post('status');
        $data['keterangan']                 = $this->input->post('keterangan');
        $data['nomor_kontrak']              = $this->input->post('nomor_kontrak');
        $data['terakhir_diubah']            = date('Y-m-d');
		$this->db->where('id_pengadaan',$kode);

		if($this->db->update($this->tabel, $data)){
			return true;
		}else{
			return mysql_error();
		}
    }
    function tampil_id($status){
    	$this->db->select('code');
    	$this->db->where('value',$status);
		$this->db->where('tipe','status_pengadaan');
		$query=$this->db->get('mst_inv_pilihan');
		if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $id = $k->code;
            }
        }
        else
        {
            $id = 1;
        }
        	return  $id;
    }

    function tampilstatus_id($status,$tipe){
        $this->db->select('code');
        $this->db->where('value',$status);
        $this->db->where('tipe',$tipe);
        $query=$this->db->get('mst_inv_pilihan');
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $id = $k->code;
            }
        }
        else
        {
            $id = 1;
        }
            return  $id;
    }

    function update_status()
    {	
        $pilihan_inv  = $this->input->post('pilihan_inv');
    	$kode_proc= $this->input->post('kode_proc');
        $id_pengadaan= $this->input->post('id_pengadaan');

        $id = $this->db->query("SELECT id_inventaris_barang FROM inv_inventaris_barang WHERE barang_kembar_proc =$kode_proc and id_pengadaan=$id_pengadaan")->result(); 
        foreach ($id as $key) {
            $data['pilihan_status_invetaris']   = $this->tampilstatus_id($pilihan_inv,'status_inventaris');
            $this->db->update('inv_inventaris_barang', $data,array('id_inventaris_barang'=> $key->id_inventaris_barang));
        }
            

    }
    function sum_jumlah_item($kode,$tipe){
    	$this->db->select_sum($tipe);
    	$this->db->where('id_pengadaan',$kode);
		$query=$this->db->get('inv_inventaris_barang');
		if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $jumlah = $k->harga;
            }
        }
        else
        {
            $jumlah = 0;
        }
        return  $jumlah;
    }
    function barang_kembar_proc($kode){
        $q = $this->db->query("SELECT  MAX(RIGHT(barang_kembar_proc,3)) as kd_max FROM inv_inventaris_barang WHERE id_mst_inv_barang=$kode ORDER BY barang_kembar_proc DESC");
        $kd = "";
        if($q->num_rows()>0)
        {
           foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
        return $kode.$kd;
    }
    function sum_unit($kode)
    {
        $this->db->select("*");
        $this->db->where('id_pengadaan',$kode);  
        return $query = $this->db->get("inv_inventaris_barang"); 
    }
	function delete_entry($kode)
	{
		$this->db->where('id_pengadaan',$kode);

		return $this->db->delete($this->tabel);
	}
	function delete_entryitem($id_barang,$kd_proc)
	{   $id = $this->db->query("SELECT id_inventaris_barang FROM inv_inventaris_barang WHERE barang_kembar_proc =$kd_proc")->result(); 
        foreach ($id as $key) {
              $key->id_inventaris_barang;
              $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
              $this->db->delete('inv_inventaris_barang');
                $kodebarang_ = substr($id_barang, 0,2);
                if($kodebarang_=='01') {
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_a');
                }else if($kodebarang_=='02') {  
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_b');
                }else if($kodebarang_=='03') {  
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_c');
                }else if($kodebarang_=='04') {                 
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_d');
                }else if($kodebarang_=='05') {  
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_e');
                }else if($kodebarang_=='06') {  
                    $this->db->where('id_inventaris_barang',$key->id_inventaris_barang);
                    $this->db->delete('inv_inventaris_barang_f');
                }
        }
        
	}
    function delete_entryitem_table($kode,$id_barang,$table)
    {    
        $this->db->where('id_pengadaan',$kode);
        $this->db->where('id_mst_inv_barang',$id_barang);
        return $this->db->delete($table);
    }
	function get_databarang($start=0,$limit=999999)
    {
		$this->db->order_by('uraian','asc');
        $query = $this->db->get('mst_inv_barang',$limit,$start);
        return $query->result();
    }
}