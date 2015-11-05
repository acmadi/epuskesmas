CREATE TABLE IF NOT EXISTS `mst_inv_ruangan` (
  `id_mst_inv_ruangan` INT NOT NULL,
  `nama_ruangan` VARCHAR(100) NOT NULL,
  `keterangan` TEXT NULL,
  `code_cl_phc` CHAR(11) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`id_mst_inv_ruangan`, `code_cl_phc`),
  INDEX `fk_mst_inv_ruangan_cl_phc_idx` (`code_cl_phc` ASC),
  CONSTRAINT `fk_mst_inv_ruangan_cl_phc`
    FOREIGN KEY (`code_cl_phc`)
    REFERENCES `cl_phc` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = myisam;


CREATE TABLE IF NOT EXISTS `inv_permohonan_barang` (
  `id_inv_permohonan_barang` INT NOT NULL,
  `jumlah_unit` INT NULL,
  `keterangan` TEXT NULL,
  `tanggal_permohonan` DATE NULL,
  `waktu_dibuat` TIMESTAMP NULL,
  `terakhir_diubah` TIMESTAMP NULL,
  `id_mst_inv_ruangan` INT NULL,
  `code_cl_phc` CHAR(11) CHARACTER SET 'utf8' NULL,
  `app_users_list_username` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_inv_permohonan_barang`),
  INDEX `fk_inv_permohonan_barang_mst_inv_ruangan1_idx` (`id_mst_inv_ruangan` ASC),
  INDEX `fk_inv_permohonan_barang_cl_phc1_idx` (`code_cl_phc` ASC),
  INDEX `fk_inv_permohonan_barang_app_users_list1_idx` (`app_users_list_username` ASC),
  CONSTRAINT `fk_inv_permohonan_barang_mst_inv_ruangan1`
    FOREIGN KEY (`id_mst_inv_ruangan`)
    REFERENCES `mst_inv_ruangan` (`id_mst_inv_ruangan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inv_permohonan_barang_cl_phc1`
    FOREIGN KEY (`code_cl_phc`)
    REFERENCES `cl_phc` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inv_permohonan_barang_app_users_list1`
    FOREIGN KEY (`app_users_list_username`)
    REFERENCES `app_users_list` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = myisam;


CREATE TABLE IF NOT EXISTS `inv_permohonan_barang_item` (
  `id_inv_permohonan_barang_item` INT NOT NULL,
  `nama_barang` VARCHAR(200) NULL,
  `jumlah` INT NULL,
  `keterangan` TEXT NULL,
  `id_inv_permohonan_barang` INT NOT NULL,
  `code_mst_inv_barang` VARCHAR(12) NULL,
  PRIMARY KEY (`id_inv_permohonan_barang_item`, `id_inv_permohonan_barang`),
  INDEX `fk_inv_permohonan_barang_item_inv_permohonan_barang1_idx` (`id_inv_permohonan_barang` ASC),
  INDEX `fk_inv_permohonan_barang_item_mst_barang1_idx` (`code_mst_inv_barang` ASC),
  CONSTRAINT `fk_inv_permohonan_barang_item_inv_permohonan_barang1`
    FOREIGN KEY (`id_inv_permohonan_barang`)
    REFERENCES `inv_permohonan_barang` (`id_inv_permohonan_barang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inv_permohonan_barang_item_mst_barang1`
    FOREIGN KEY (`code_mst_inv_barang`)
    REFERENCES `mst_inv_barang` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = myisam;

