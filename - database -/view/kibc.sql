/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `kibc` (
	`asal_usul` varchar (300),
	`keterangan_pengadaan` varchar (600),
	`keadaan_barang` varchar (300),
	`id_ruangan` double ,
	`harga` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`pilihan_status_invetaris` varchar (30),
	`uraian` varchar (600),
	`hak` varchar (300),
	`tingkat` varchar (300),
	`beton` varchar (300),
	`barang_kembar_proc` varchar (150),
	`id_pengadaan` double ,
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`luas_lantai` double ,
	`letak_lokasi_alamat` blob ,
	`pillihan_status_hak` varchar (30),
	`nomor_kode_tanah` varchar (300),
	`pilihan_kons_tingkat` varchar (30),
	`pilihan_kons_beton` varchar (30),
	`dokumen_tanggal` date ,
	`dokumen_nomor` varchar (300),
	`jumlah` double ,
	`totalharga` double 
); 
