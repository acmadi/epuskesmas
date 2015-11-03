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
      <li class="active"><a href="#tab_3" data-toggle="tab">3. Rencana Kegiatan Pembibitan</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_3">    
        <div class="row">
        <form id="updateKomoditi" name="updateKomoditi">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Pemohon Rekomendasi</h3>
              </div>
              <div class="box-body">
                <strong style="font-size:20px">Nomor :<br>{kode_trup}</strong><br><br>
                <strong>Nama : {nama}</strong><br>
                Penanggugjawab : {penanggungjawab}<br>
                No KTP : {ktp}<br>
                Tanggal Daftar : {tgl_daftar}<br>
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
              <input type="hidden" name="kode_trup" value="{kode_trup}"/>
              <div class="form-group">
                <label>Komoditi :</label>
                <select class="form-control" name="komoditi" disabled />{jenistanaman_option}</select>
              </div>
              <div class="form-group">
                <label>Varietas / Klon :</label>
                <select class="form-control" name="varietas" disabled />{varietas_option}</select>
              </div>
              <div class="form-group">
                <label>Satuan :</label>
                <select class="form-control" name="satuan"/>{satuan_option}</select>
              </div>
              <div class="form-group">
                <label>Jumlah / Luas :</label>
                <input type="text" class="form-control" placeholder="Jumlah Diajukan" name="jml" value="<?php 
                if(set_value('jml')=="" && isset($jml)){
                  echo $jml;
                }else{
                  echo  set_value('jml');
                }
                ?>"/> 
              </div>
              <div class="form-group">
                <label>Asal Benih:</label>
                <input type="text" class="form-control" placeholder="Asal Benih (daerah)" name="asal" value="<?php 
                if(set_value('asal')=="" && isset($asal)){
                  echo $asal;
                }else{
                  echo  set_value('asal');
                }
                ?>"/>
              </div>
              <div class="form-group">
                <label>Umur Benih:</label>
                <input type="text" class="form-control" placeholder="Umur Benih (bulan)" name="umur" value="<?php 
                if(set_value('umur')=="" && isset($umur)){
                  echo $umur;
                }else{
                  echo  set_value('umur');
                }
                ?>"/>
              </div>
              <div class="form-group">
                <label>Rencana Penyaluran:</label>
                <input type="text" class="form-control" placeholder="Rencana Penyaluran" name="penyaluran" value="<?php 
                if(set_value('penyaluran')=="" && isset($penyaluran)){
                  echo $penyaluran;
                }else{
                  echo  set_value('penyaluran');
                }
                ?>"/>
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
      document.location.href="<?php echo base_url().'users/trup_draft/'.$kode_trup.'?tab=tab_2';?>";
    });

    $('#btn-save').click(function(){
      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'users/komoditi_rencana_update/{kode_trup}/{kode_varietas}/{kode_komoditi}';?>",
        data: $('#updateKomoditi').serialize(),
        success: function(response){
          $('#notification').html('<div id="information" class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4>  <i class="icon fa fa-check"></i> Information!</h4><span></span></div>');
          $('#notification span').html(response);
              $('html, body').animate({
                  scrollTop: $("#top").offset().top
              }, 300);
        }
       });    
    });
});

</script>
