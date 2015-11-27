/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `kibe` (
	`id_ruangan` double ,
	`harga` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`pilihan_status_invetaris` varchar (30),
	`uraian` varchar (600),
	`bahan` varchar (300),
	`satuan` varchar (300),
	`barang_kembar_proc` varchar (150),
	`id_pengadaan` double ,
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`buku_judul_pencipta` varchar (600),
	`buku_spesifikasi` blob ,
	`budaya_asal_daerah` varchar (600),
	`budaya_pencipta` varchar (600),
	`pilihan_budaya_bahan` varchar (30),
	`flora_fauna_jenis` varchar (600),
	`flora_fauna_ukuran` varchar (600),
	`pilihan_satuan` varchar (30),
	`tahun_cetak_beli` date ,
	`jumlah` double ,
	`totalharga` double 
); 
