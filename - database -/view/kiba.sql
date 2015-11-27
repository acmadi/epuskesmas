/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `kiba` (
	`asal_usul` varchar (300),
	`keterangan_pengadaan` varchar (600),
	`id_ruangan` double ,
	`harga` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`pilihan_status_invetaris` varchar (30),
	`uraian` varchar (600),
	`satuan` varchar (300),
	`hak` varchar (300),
	`penggunaan` varchar (300),
	`barang_kembar_proc` varchar (150),
	`id_pengadaan` double ,
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`luas` double ,
	`alamat` blob ,
	`pilihan_satuan_barang` varchar (30),
	`pilihan_status_hak` varchar (30),
	`status_sertifikat_tanggal` date ,
	`status_sertifikat_nomor` varchar (150),
	`pilihan_penggunaan` varchar (30),
	`jumlah` double ,
	`totalharga` double 
); 
