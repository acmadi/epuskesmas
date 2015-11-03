<link href="<?php echo base_url()?>public/themes/disbun/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>public/themes/disbun/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
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
<div id="notification">
</div>
<div class="row" style="background:#FAFAFA">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Data Sertifikat per Komoditi</a></li>
      <li><a href="#tab_2" data-toggle="tab">Cetak Sertifikat</a></li>
    </ul>
    <div class="tab-content">

      <div class="tab-pane active" id="tab_1">    
        <div class="row">
          <div class="col-md-6 ">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Pemohon Sertifikasi</h3>
              </div>
              <div class="box-body">
                <strong>Nama : <?php echo $nama; ?></strong><br>
                Jabatan : <?php echo $jabatan; ?><br>
                Telepon : <?php echo $phone_number; ?><br>
                Email : <?php echo $email; ?><br>
                Alamat : <?php echo $address; ?><br>
                Desa  : <?php echo $desa; ?><br>
                Kecamatan  : <?php echo $kecamatan; ?><br>
                Kabupaten  : <?php echo $kota; ?><br>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-warning">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-square"></i> Approval Sertifikat {kode_sertifikat}</h3>
              </div>
              <div class="box-body">
                <form name="update-sertifikat" id="update-sertifikat">
                <div class="form-group">
                <label>Nomor Sertifikat :</label>
                <input type="text" class="form-control" placeholder="525/   /BP2MB/2015" name="nomor_sertifikat" value="<?php if (isset($nomor_sertifikat)) echo $nomor_sertifikat;?>" />
                </div>
                <div class="form-group">
                <label>Tanggal Berlaku :</label>
                <input type="text" class="form-control" placeholder="Tanggal Persetujuan" name="tgl_berlaku"  id="datemask" value="<?php if (isset($tgl_berlaku)) echo $tgl_berlaku;?>" />
                </div>
                <div class="form-group">
                <label>Sampai :</label>
                <input type="text" class="form-control" placeholder="Tanggal Berakhir" name="tgl_berakhir"  id="datemask2" value="<?php if (isset($tgl_berakhir)) echo $tgl_berakhir;?>" />
                </div>
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" name="status" id="status" value="1" <?php if(isset($status_sertifikat)) {if($status_sertifikat==1) echo "checked";}?> /> &nbsp; Status Cetak
                  </label>
                </div>
                <button type="button" id="btn-send" class="btn btn-danger btn-social"><i class="fa fa-check-square-o"></i> Update Sertifikat</button>
                <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-md-6 ">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Detail Sertifikat</h3>
              </div>
              <div class="box-body">
                <strong>Jenis Sertifikat : </strong>{kode_sertifikat}<br>
                <strong>Nomor Sertifikat : </strong><?php if (isset($nomor_sertifikat)) echo $nomor_sertifikat; else echo "-";?><br>
                <strong>Tanggal Berlaku : </strong><?php if (isset($tgl_berlaku)) echo $tgl_berlaku; else echo "-";?> s/d <?php if (isset($tgl_berakhir)) echo $tgl_berakhir; else echo "-";?><br><br>

                <strong>Komoditi : </strong><?php echo $nama_komoditi; ?><br>
                <strong>Varietas : </strong><?php echo $nama_varietas; ?><br>
                <strong>Jumlah Benih Diperiksa : </strong><?php echo number_format($jml); ?><br>
                <strong>Jumlah Benih Memenuhi Syarat : </strong><?php echo number_format($jml_ok); ?><br>
                <strong>Jumlah Benih Tidak Memenuhi Syarat : </strong><?php echo number_format($jml-$jml_ok); ?><br>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Lokasi Kebun Sumber Benih</h3>
              </div>
              <div class="box-body">
                <strong>Lokasi : </strong><?php echo $lokasi; ?><br>
                <strong>Provinsi : </strong><?php echo $nama_propinsi; ?><br>
                <strong>Kota / Kab : </strong><?php echo $nama_kota; ?><br>
                <strong>Kecamatan : </strong><?php echo $nama_kecamatan; ?><br>
                <strong>Desa : </strong><?php echo $nama_desa; ?><br>
              </div>
            </div>
          </div> 
        </div>
      </div>
    <div class="tab-pane" id="tab_2"> 
      <div class="row">
        <div class="col-md-8">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-certificate"></i> Cetak Sertifikat </h3>
            </div>
            <div class="box-body">
                      <textarea id="preview" name="preview">
                      <?php 
                        if(set_value('preview')=="" && isset($preview)){
                          echo $preview;
                        }else{
                          echo  set_value('preview');
                        }
                      ?>
                      </textarea>
                    </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <button type="button" id="btn-save" class="btn btn-warning btn-social"><i class="fa fa-save"></i> Simpan Sertifikat</button><br><br>
            <button type="button" id="btn-print" class="btn btn-success btn-social" <?php if(!$saved_sertifikat) echo "style='display:none'"; ?>><i class="fa fa-print"></i> Cetak Sertifikat</button>
            </div>
        </div>
      </div>
    </div>

  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/datepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_sertifikat_cetak").addClass("active");
    $("#menu_sertifikat").addClass("active");

    $("#dataTable").dataTable();
    $("#datemask").datepicker({format: 'yyyy-mm-dd'});
    $("#datemask2").datepicker({format: 'yyyy-mm-dd'});

    CKEDITOR.config.height = '800px';
    CKEDITOR.config.extraAllowedContent = 'p(*)[*]{*};p[align];div{text-align};div{font-weight};div{font-size};strong{color};table{border};td{border};td{border-right};td{border-bottom};td{border-top}';
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.replace('preview');

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>sertifikat/cetak_detail/{kode_permohonan}";
    });

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('#btn-send').click(function(){
      if($('#status').is(':checked')) {
        if (!confirm('Anda yakin data sudah benar ?')) {
          return false;
        }else{
          $('#btn-send').hide("slow")
        }
        
      }
      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'sertifikat/update_sertifikat/{kode_permohonan}/{kode_varietas}/{kode_komoditi}';?>",
        data: $('#update-sertifikat').serialize(),
        success: function(response){
          window.location.reload();
        }
       });    
    });

    $('#btn-print').click(function(){
        $.get("<?php echo base_url()?>sertifikat/pdf_sertifikat/{kode_permohonan}/{kode_varietas}/{kode_komoditi}", function(response) {
          window.open("<?php echo base_url()?>sertifikat/load_pdf/{kode_permohonan}/{kode_varietas}/{kode_komoditi}");
        });

    });
    
    $('#btn-save').click(function(){
      for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
      }

      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'sertifikat/save_sertifikat/{kode_permohonan}/{kode_varietas}/{kode_komoditi}';?>",
        data: $("#preview").serialize(),
        success: function(response){
          $('#notification').html('<div id="information" class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4>  <i class="icon fa fa-check"></i> Information!</h4><span></span></div>');
          $('#notification span').html(response);
              $('html, body').animate({
                  scrollTop: $("#top").offset().top
              }, 300);
              $('#btn-print').show('fade');
        }
       });    
    });


  });
</script>
