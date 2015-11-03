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
      <li class="active"><a href="#tab_3" data-toggle="tab">3. Data Sertifikasi Komoditi</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_3">    
        <div class="row">

        <!-- <form action="<?php echo base_url()."permohonan/komoditi_simpan"; ?>" method="post"> -->
        <form id="komoditi-form" name="komoditi-form">
          <div class="col-md-6">
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
                Desa  : <?php echo $nama_desa; ?><br>
                Kecamatan  : <?php echo $nama_kecamatan; ?><br>
                Kabupaten  : <?php echo $nama_kota; ?><br>
              </div>
            </div>
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Lokasi Kebun Sumber Benih</h3>
              </div>
              <div class="box-body">

              <div class="form-group">
                <label>Lokasi :</label>
                <textarea class="form-control" placeholder="Alamat" name="address" rows="2" />{address}</textarea>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                  <div style="width:80px">Provinsi</div>
                </span>
                <select class="form-control" name="propinsi" />{provinsi_option}</select>
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon">
                  <div style="width:80px">Kota / Kab</div>
                </span>
                <select class="form-control" name="kota" /></select>
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon">
                  <div style="width:80px">Kecamatan</div>
                </span>
                <select class="form-control" name="kecamatan" /></select>
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon">
                  <div style="width:80px">Desa</div>
                </span>
                <select class="form-control" name="desa" /></select>
              </div>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Data Komoditi</h3>
              </div>
              <div class="box-body">
                      <button type="button" id="btn-save" class="btn btn-warning btn-social"><i class="fa fa-folder-open"></i> Simpan</button>
                      <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                      <br><br>
              <input type="hidden" name="kode_permohonan" value="{kode_permohonan}"/>
              <div class="form-group">
                <label>Komoditi :</label>
                <select class="form-control" name="komoditi" />{jenistanaman_option}</select>
              </div>
              <div class="form-group">
                <label>Retribusi :</label>
                <select class="form-control" name="retribusi"/>{retribusi_option}</select>
              </div>
              <div class="form-group">
                <label>Spesifikasi :</label>
                <select class="form-control" name="spesifikasi"/>{spesifikasi_option}</select>
              </div>
              <div class="form-group">
                <label>Satuan :</label>
                <select class="form-control" name="satuan"/>{satuan_option}</select>
              </div>
              <div class="form-group">
                <label>Bentuk Benih :</label>
                <select class="form-control" name="bentuk_benih"/>{bentukbenih_option}</select>
              </div>
              <div class="form-group">
                <label>Varietas :</label>
                <select class="form-control" name="varietas"/>{varietas_option}</select>
              </div>
              <div class="form-group">
                <label>Jenis Sertifikat :</label>
                <select class="form-control" name="sertifikat"/>{sertifikat_option}</select>
              </div>

              <div class="form-group">
                <label>Jumlah Diajukan :</label>
                <input type="text" class="form-control" placeholder="Jumlah Diajukan" name="jumlah" />
              </div>
              <div class="form-group">
                <label>Asal Benih:</label>
                <input type="text" class="form-control" placeholder="Asal Benih (daerah)" name="asal_benih" />
              </div>
              <div class="form-group">
                <label>Kelas Benih:</label>
                <input type="text" class="form-control" placeholder="Kelas Benih" name="kelas_benih" />
              </div>
              <div class="form-group">
                <label>Umur Benih:</label>
                <input type="text" class="form-control" placeholder="Umur Benih (bulan)" name="umur_benih" />
              </div>
              <br>

              </div>
            </div>
            </form>
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
    $("#menu_dashboard_permohonan").addClass("active");
    $("#menu_dashboard").addClass("active");

    $("#btn-back").click(function(){
      document.location.href="<?php echo base_url().'permohonan/detail/'.$kode_permohonan.'?tab=tab_2';?>";
    });

    $('#btn-save').click(function(){
      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'permohonan/komoditi_simpan';?>",
        data: $('#komoditi-form').serialize(),
        success: function(response){
          $('#notification').html('<div id="information" class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4>  <i class="icon fa fa-check"></i> Information!</h4><span></span></div>');
          $('#notification span').html(response);
              $('html, body').animate({
                  scrollTop: $("#top").offset().top
              }, 300);
        }
       });    
    });


    $("select[name='propinsi']").change(function() {
      $("select[name='kota']").html("<option>-</option>");
      $("select[name='kecamatan']").html("<option>-</option>");
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/kota/' + $('select[name=propinsi]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='kota']").html(data.kota);
      }, "json");
    });

    $("select[name='kota']").change(function() {
      $("select[name='kecamatan']").html("<option>-</option>");
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/kecamatan/' + $('select[name=kota]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='kecamatan']").html(data.kecamatan);
      }, "json");
    });

    $("select[name='kecamatan']").change(function() {
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/desa/' + $('select[name=kecamatan]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='desa']").html(data.desa);
      }, "json");
    });

    $.get('<?php echo base_url()?>disbun/kota/{propinsi}/{kota}', function(response) {
      var data = eval(response);
      $("select[name='kota']").html(data.kota);
    }, "json");

    $.get('<?php echo base_url()?>disbun/kecamatan/{kota}/{kecamatan}', function(response) {
      var data = eval(response);
      $("select[name='kecamatan']").html(data.kecamatan);
    }, "json");

    $.get('<?php echo base_url()?>disbun/desa/{kecamatan}/{desa}', function(response) {
      var data = eval(response);
      $("select[name='desa']").html(data.desa);
    }, "json");

    $("select[name='komoditi']").change(function() {
      $("select[name='retribusi']").html("<option>-</option>");
      $("select[name='spesifikasi']").html("<option>-</option>");
      $("select[name='satuan']").html("<option>-</option>");
      $.get('<?php echo base_url()?>permohonan/retribusi/' + $('select[name=komoditi]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='retribusi']").html(data.retribusi);
      }, "json");
    });

    $("select[name='retribusi']").change(function() {
      $("select[name='spesifikasi']").html("<option>-</option>");
      $("select[name='satuan']").html("<option>-</option>");
      $.get('<?php echo base_url()?>permohonan/spesifikasi/' + $('select[name=komoditi]').val()+ '/' + $('select[name=retribusi]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='spesifikasi']").html(data.spesifikasi);
      }, "json");
    });

    $("select[name='spesifikasi']").change(function() {
      $("select[name='satuan']").html("<option>-</option>");
      $.get('<?php echo base_url()?>permohonan/satuan/' + $('select[name=komoditi]').val()+ '/' + $('select[name=retribusi]').val()+ '/' + $('select[name=spesifikasi]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='satuan']").html(data.satuan);
      }, "json");
    });

    // $.get('<?php echo base_url()?>permohonan/retribusi/{komoditi_selected}', function(response) {
    //   var data = eval(response);
    //   $("select[name='retribusi']").html(data.retribusi);
    // }, "json");

  });
</script>
