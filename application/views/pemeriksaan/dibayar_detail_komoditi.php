<?php if(validation_errors()!=""){ ?>
<div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo validation_errors()?>
</div>
<?php } ?>

<?php if($this->session->flashdata('alert_form')!=""){ ?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo $this->session->flashdata('alert_form')?>
</div>
<?php } ?>
<div class="row" style="background:#FAFAFA">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_3" data-toggle="tab">Data Sertifikasi Komoditi</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_3">    
        <div class="row">
          <div class="col-md-5">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Pemohon Sertifikasi</h3>
              </div>
              <div class="box-body">
                <strong style="font-size:20px">Nomor Permohonan :<br><?php echo $nomor_permohonan; ?></strong><br><br>
                <strong>Nama : <?php echo $nama; ?></strong><br>
                Jabatan : <?php echo $jabatan; ?><br>
                Telepon : <?php echo $phone_number; ?><br>
                Email : <?php echo $email; ?><br>
                Alamat : <?php echo $address; ?><br>
                Propinsi  : <?php echo $profile_propinsi; ?><br>
                Kabupaten  : <?php echo $profile_kota; ?><br>
                Kecamatan  : <?php echo $profile_kecamatan; ?><br>
                Desa  : <?php echo $profile_desa; ?><br>
              </div>
            </div>
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Lokasi Kebun Sumber Benih</h3>
              </div>
              <div class="box-body">
                <strong>Lokasi : <?php echo $lokasi; ?></strong><br>
                Provinsi : <?php echo $nama_propinsi; ?><br>
                Kabupaten / Kota  : <?php echo $nama_kota; ?><br>
                Kecamatan  : <?php echo $nama_kecamatan; ?><br>
                Desa : <?php echo $nama_desa; ?><br></strong>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Data Komoditi</h3>
              </div>
              <div class="box-body">
                  <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                  <br><br>
              <div class="form-group">
                <label>Komoditi :</label> <?php echo $nama_komoditi; ?>
              </div>
              <div class="form-group">
                <label>Varietas :</label> <?php echo $nama_varietas; ?>
              </div>
              <div class="form-group">
                <label>Bentuk Benih :</label> <?php echo $nama_bentuk_benih; ?>
              </div>
              <div class="form-group">
                <label>Jenis Sertifikat :</label> <?php echo $nama_sertifikat; ?>
              </div>
              <div class="form-group">
                <label>Retribusi :</label> <?php echo $nama_retribusi; ?>
              </div>
              <div class="form-group">
                <label>Spesifikasi :</label> <?php echo $nama_spesifikasi; ?>
              </div>
              <div class="form-group">
                <label>Satuan :</label> <?php echo $nama_satuan; ?>
              </div>
              <div class="form-group">
                <label>Jumlah Diajukan :</label> <b><?php echo number_format($jml); ?></b>
              </div>
              <div class="form-group">
                <label>Jumlah Lulus Uji :</label> <b><?php echo number_format($jml_ok); ?></b>
              </div>
              <div class="form-group">
                <label>Tarif :</label> <span class="text-red"><b>Rp. <?php echo number_format($tarif); ?></b></span>
              </div>
              <div class="form-group">
                <label>Total :</label> <span class="text-red"><b>Rp. <?php echo number_format($tarif*$jml_ok)?></b></span>
              </div>
              <div class="form-group">
                <label>Asal Benih:</label> <?php echo $asal; ?>
              </div>
              <div class="form-group">
                <label>Kelas Benih:</label> <?php echo $kelas; ?>
              </div>
              <div class="form-group">
                <label>Umur Benih:</label> <?php echo $umur; ?> bulan
              </div>
              <br>

              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_pemeriksaan_dibayar").addClass("active");
    $("#menu_pemeriksaan").addClass("active");

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/dibayar_detail/{kode_permohonan}";
    });

  });
</script>
