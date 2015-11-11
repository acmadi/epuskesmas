CREATE TABLE `inv_permohonan_barang_item` (
  `id_inv_permohonan_barang_item` int(11) NOT NULL,
  `code_mst_inv_barang` varchar(12) DEFAULT NULL,
  `nama_barang` varchar(200) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text,
  `id_inv_permohonan_barang` int(11) NOT NULL,
  `code_cl_phc` char(12) NOT NULL,
  PRIMARY KEY (`id_inv_permohonan_barang_item`,`id_inv_permohonan_barang`,`code_cl_phc`),
  KEY `fk_inv_permohonan_barang_item_inv_permohonan_barang1_idx` (`id_inv_permohonan_barang`),
  KEY `fk_inv_permohonan_barang_item_mst_barang1_idx` (`code_mst_inv_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1