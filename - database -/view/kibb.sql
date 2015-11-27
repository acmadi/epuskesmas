/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `kibb` (
	`asal_usul` varchar (300),
	`keterangan_pengadaan` varchar (600),
	`keadaan_barang` varchar (300),
	`id_ruangan` double ,
	`harga` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`pilihan_status_invetaris` varchar (30),
	`uraian` varchar (600),
	`satuan` varchar (300),
	`bahan` varchar (300),
	`barang_kembar_proc` varchar (150),
	`id_pengadaan` double ,
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`merek_type` blob ,
	`identitas_barang` blob ,
	`pilihan_bahan` varchar (30),
	`ukuran_barang` varchar (300),
	`pilihan_satuan` varchar (30),
	`tanggal_bpkb` date ,
	`nomor_bpkb` varchar (300),
	`no_polisi` varchar (300),
	`tanggal_perolehan` date ,
	`jumlah` double ,
	`totalharga` double 
); 
