<?php if(validation_errors()!=""){ ?>
<div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo validation_errors()?>
</div>
<?php } ?>

<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>
<div id="notification">
</div>
<div class="row" style="background:#FAFAFA">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_3" data-toggle="tab">Sertifikasi Komoditi</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_3">    
        <div class="row">
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Permohonan Sertifikasi</h3>
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
          </div>
          <div class="col-md-8">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Data Komoditi</h3>
              </div>
              <form name="diperiksa-komoditi" id="diperiksa-komoditi" action="<?php echo base_url().'pemeriksaan/update_pemeriksaan_komoditi/{kode_permohonan}/{kode_varietas}/{kode_komoditi}';?>" method="post">
              <div class="box-body">
                      <button type="submit" id="btn-save" class="btn btn-warning btn-social"><i class="fa fa-folder-open"></i> Simpan</button>
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
                <label>Jumlah Diajukan :</label> <?php echo $jml; ?>
              </div>
              <div class="form-group">
                <label>Jumlah Memenuhi Syarat :</label> 
                <input type="text" class="form-control" placeholder="Jumlah memenuhi syarat" name="jml_ok" value="<?php echo $jml_ok; ?>" />
                <label>Keterangan :</label> 
                <textarea id="keterangan" name="keterangan" rows="10" cols="10"><?php 
                if(set_value('keterangan')=="" && isset($keterangan)){
                  echo $keterangan;
                }else{
                  echo  set_value('keterangan');
                }
              ?></textarea>
              </div>
              </form>
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
<script src="<?php echo base_url()?>public/themes/disbun/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_pemeriksaan_diperiksa").addClass("active");
    $("#menu_pemeriksaan").addClass("active");

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/diperiksa_detail/{kode_permohonan}";
    });

    // $('#btn-save').click(function(){
    //   $.ajax({ 
    //     type: "POST",
    //     url: "<?php echo base_url().'pemeriksaan/update_pemeriksaan_komoditi/{kode_permohonan}/{kode_varietas}/{kode_komoditi}';?>",
    //     data: $('#diperiksa-komoditi').serialize(),
    //     success: function(response){
    //       $('#notification').html('<div id="information" class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4>  <i class="icon fa fa-check"></i> Information!</h4><span></span></div>');
    //       $('#notification span').html(response);
    //           $('html, body').animate({
    //               scrollTop: $("#top").offset().top
    //           }, 300);
    //     }
    //    });    
    // });

    CKEDITOR.config.height = '300px';
    CKEDITOR.config.extraAllowedContent = 'p(*)[*]{*};p[align];div{text-align};div{font-weight};strong{color};table{border};td{border};td{border-right};td{border-bottom};td{border-top}';
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.replace('keterangan');

  });
</script>
