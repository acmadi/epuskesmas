/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `kibf` (
	`id_ruangan` double ,
	`harga` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`pilihan_status_invetaris` varchar (30),
	`uraian` varchar (600),
	`tingkat` varchar (300),
	`beton` varchar (300),
	`tanah` varchar (300),
	`barang_kembar_proc` varchar (150),
	`id_pengadaan` double ,
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`bangunan` varchar (600),
	`pilihan_konstruksi_bertingkat` varchar (30),
	`pilihan_konstruksi_beton` varchar (30),
	`luas` varchar (600),
	`lokasi` blob ,
	`dokumen_tanggal` date ,
	`dokumen_nomor` varchar (600),
	`tanggal_mulai` date ,
	`pilihan_status_tanah` varchar (30),
	`jumlah` double ,
	`totalharga` double 
); 
