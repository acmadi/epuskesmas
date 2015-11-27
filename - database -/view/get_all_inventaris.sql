/*
SQLyog Enterprise - MySQL GUI
MySQL - 5.6.26 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `get_all_inventaris` (
	`id_ruangan` double ,
	`id_cl_phc` varchar (36),
	`register` double ,
	`value` varchar (300),
	`id_inventaris_barang` double ,
	`id_mst_inv_barang` varchar (90),
	`id_pengadaan` double ,
	`pilihan_keadaan_barang` varchar (30),
	`nama_barang` varchar (600),
	`pilihan_komponen` varchar (30),
	`harga` double ,
	`keterangan_pengadaan` varchar (600),
	`pilihan_status_invetaris` varchar (30),
	`tanggal_pembelian` date ,
	`foto_barang` varchar (600),
	`barang_kembar_proc` varchar (150),
	`keterangan_inventory` varchar (600),
	`tanggal_pengadaan` date ,
	`tanggal_diterima` date ,
	`tanggal_dihapus` date ,
	`alasan_penghapusan` varchar (600),
	`pilihan_asal` varchar (30),
	`waktu_dibuat` date ,
	`terakhir_diubah` date ,
	`jumlah` double ,
	`totalharga` double 
); 
