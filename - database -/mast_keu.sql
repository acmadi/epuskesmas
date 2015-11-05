DROP TABLE IF EXISTS `mst_keu_rekening`;

CREATE TABLE `mst_keu_rekening` (
  `code` varchar(20) NOT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


insert  into `mst_keu_rekening`(code,uraian) values ('4.1.412.01','-'),('4.1.412.01.001','Rawat jalan kesehatan dasar'),('4.1.412.01.002','Rawat jalan semi spesialis'),('4.1.412.01.003','Perawatan tindakan khusus'),('4.1.412.01.004','Rawat jalan penunjang kesehatan sederhana'),('4.1.412.01.005','Rawat inap rumah bersalin'),('4.1.412.01.006','Lain-lain pelayanan kesehatan');

