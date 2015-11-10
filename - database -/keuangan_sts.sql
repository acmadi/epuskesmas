CREATE TABLE `keu_sts` (
  `tgl` date NOT NULL,
  `nomor` varchar(30) DEFAULT NULL,
  `total` double(20,2) DEFAULT NULL,
  `status` enum('','tutup') DEFAULT NULL,
  `ttd_pimpinan_nip` varchar(50) DEFAULT NULL,
  `ttd_pimpinan_nama` varchar(200) DEFAULT NULL,
  `ttd_penerima_nip` varchar(50) DEFAULT NULL,
  `ttd_penerima_nama` varchar(200) DEFAULT NULL,
  `ttd_penyetor_nip` varchar(50) DEFAULT NULL,
  `ttd_penyetor_nama` varchar(200) DEFAULT NULL,
  `code_cl_phc` varchar(12) NOT NULL,
  PRIMARY KEY (`tgl`,`code_cl_phc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `keu_sts_hasil` (
  `tgl` date NOT NULL,
  `id_keu_anggaran` int(11) NOT NULL DEFAULT '0',
  `tarif` double(10,2) DEFAULT NULL,
  `vol` int(11) DEFAULT NULL,
  `jml` double(20,2) DEFAULT NULL,
  `code_cl_phc` char(11) NOT NULL,
  PRIMARY KEY (`tgl`,`id_keu_anggaran`,`code_cl_phc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;