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
      <li class="active"><a href="#tab_1" data-toggle="tab">Pemeriksaan Rekomendasi TRUP</a></li>
      <li><a href="#tab_2" data-toggle="tab">Cetak Rekomendasi TRUP</a></li>
    </ul>
    <div class="tab-content">


      <div class="tab-pane active" id="tab_1">    
        <div class="row">
          <form action="<?php echo base_url()."pemeriksaan/trup_detail/{kode_trup}/update"; ?>" method="post" name="forn-periksatrup">

          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Pemeriksaan Rekomendasi TRUP</h3>
              </div>
              <div class="box-body">
                <strong>1.  Nama Pemohon : {namapemohon}</strong><br>
                2.  Nama Ketua/Penanggung jawab : {penanggungjawab}<br>
                3.  Alamat : {nama_kota}  {nama_kecamatan} {nama_desa}<br>
                4.  No. KTP : {ktp}<br>
                5.  Pengalaman jadi penangkar  : {pengalaman} tahun<br>
                6.  Asal Modal Usaha  : {modal_asal}<br>
                7.  Jumlah modal usaha : Rp. {modal_nilai}<br>
                8.  Kerjasama Kelompok : {kerjasama}<br>
              </div>
            </div>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group">
                  <label>Jumlah tenaga kerja :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="tenagakerja" placeholder="Jumlah tenaga kerja" value='<?php if(set_value('tenagakerja')=="" && isset($tenagakerja)){
                    echo $tenagakerja;
                  }else{
                    echo  set_value('tenagakerja');
                  }?>' />
                </div>
                <div class="form-group">
                  <label>Perlakuan Pemeliharaan Benih :</label>
                  <br>
                  <label>Jenis Pupuk :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="benih_pupuk" placeholder="Jenis Pupuk" value='<?php if(set_value('benih_pupuk')=="" && isset($benih_pupuk)){
                    echo $benih_pupuk;
                  }else{
                    echo  set_value('benih_pupuk');
                  }?>' />
                  <label>Dosis :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="benih_dosis" placeholder="Dosis" value='<?php if(set_value('benih_dosis')=="" && isset($benih_dosis)){
                    echo $benih_dosis;
                  }else{
                    echo  set_value('benih_dosis');
                  }?>' />
                  <label>Pengendalian OPT :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="benih_pengendalian" placeholder="Pengendalian OPT" value='<?php if(set_value('benih_pengendalian')=="" && isset($benih_pengendalian)){
                    echo $benih_pengendalian;
                  }else{
                    echo  set_value('benih_pengendalian');
                  }?>' />
                  <label>Penyiangan gulma :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="benih_penyiangan" placeholder="Penyiangan gulma" value='<?php if(set_value('benih_penyiangan')=="" && isset($benih_penyiangan)){
                    echo $benih_penyiangan;
                  }else{
                    echo  set_value('benih_penyiangan');
                  }?>' />
                </div>
                <br>
                <div class="form-group">
                  <label>Pembinaan dilakukan oleh  :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="pembinaan" placeholder="Pembinaan" value='<?php if(set_value('pembinaan')=="" && isset($pembinaan)){
                    echo $pembinaan;
                  }else{
                    echo  set_value('pembinaan');
                  }?>' />
                  <label>Pelatihan / study banding  :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="pelatihan" placeholder="Pelatihan" value='<?php if(set_value('pelatihan')=="" && isset($pelatihan)){
                    echo $pelatihan;
                  }else{
                    echo  set_value('pelatihan');
                  }?>' />
                  <label>Bidang Usaha  :</label>
                  <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="bidangusaha" placeholder="Bidang Usaha" value='<?php if(set_value('bidangusaha')=="" && isset($bidangusaha)){
                    echo $bidangusaha;
                  }else{
                    echo  set_value('bidangusaha');
                  }?>' />
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-6">
              <div class="row">
              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Detail Pemeriksaan</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nomor  :
                      {kode_trup}</label>
                      <br>
                      <label>Tanggal Pendaftaran :
                      {tgl_daftar}</label>
                      <br>
                      <label>Jenis Rekomendasi :
                      {jenistrup}</label>
                      <br>
                      <label>Lokasi Pembibitan :
                      {kota}, {kecamatan}, {desa}</label>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Pemeriksaan :</label>
                      <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="tgl_pemeriksaan" placeholder="Tanggal Pemeriksaan"  id="datemask" value='<?php if(set_value('tgl_pemeriksaan')=="" && isset($tgl_pemeriksaan)){
                        echo $tgl_pemeriksaan;
                      }else{
                        echo  set_value('tgl_pemeriksaan');
                      }?>' />
                    </div>
                    <div class="form-group">
                      <label>Petugas Pemeriksa :</label>
                      <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="pemeriksa" placeholder="Petugas Pemeriksa" value='<?php if(set_value('pemeriksa')=="" && isset($pemeriksa)){
                        echo $pemeriksa;
                      }else{
                        echo  set_value('pemeriksa');
                      }?>' />
                    </div>
                    <div class="form-group">
                      <label>Kesimpulan/Rekomendasi :</label>
                      <textarea class="form-control" name="kesimpulan" <?php if($statustrup=="aktif") echo " readonly" ?>><?php if(set_value('kesimpulan')=="" && isset($kesimpulan)){
                        echo $kesimpulan;
                      }else{
                        echo  set_value('kesimpulan');
                      }?></textarea>
                    </div>

                    <div class="checkbox icheck">
                      <label>
                        <input type="checkbox" name="status" id="status" value="aktif" <?php if(isset($statustrup) && $statustrup=="aktif"){
                        echo "checked";
                      }?> /> &nbsp; Status Rekomendasi Berlaku
                      </label>
                    </div>           
                    <div class="form-group">
                      <label>Tanggal Aktif :</label>
                      <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="tgl_aktif" placeholder="Tanggal Aktif"  id="datemask2"  value='<?php if(set_value('form_tgl_aktif')=="" && isset($form_tgl_aktif)){
                        echo $form_tgl_aktif;
                      }else{
                        echo  set_value('form_tgl_aktif');
                      }?>' />
                    </div>
                    <div class="form-group">
                      <label>Tanggal Berakhir :</label>
                      <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="tgl_akhir" placeholder="Tanggal Berakhir"  id="datemask3"  value='<?php if(set_value('tgl_akhir')=="" && isset($tgl_akhir)){
                        echo $tgl_akhir;
                      }else{
                        echo  set_value('tgl_akhir');
                      }?>' />
                    </div>
                    <div class="form-group">
                      <label>Nomor Rekomendasi TRUP :</label>
                      <input<?php if($statustrup=="aktif") echo " readonly" ?> type="text" class="form-control" name="nomor_trup" placeholder="Nomor TRUP" value='<?php if(set_value('nomor_trup')=="" && isset($nomor_trup) && $nomor_trup!=""){
                        echo $nomor_trup;
                      }else{
                        echo $nomor_trup;
                      }?>' />
                    </div>
                    <div class="form-group">
                      <?php if ($statustrup!="aktif") { ?>
                        <button type="submit" id="btn-send" class="btn btn-warning btn-social"><i class="fa fa-send"></i> Simpan Data</button>
                      <?php } ?>
                      <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                    </div>
                  </div>
                </div>

                </div>
              </div>
            
          </div>
          </form>

          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> a. Keadaan  Kegiatan Pembibitan ( Eksisting )</h3>
              </div>
              <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Komoditi</th>
                        <th>Varietas / Klon</th>
                        <th>Jumlah / Luas</th>
                        <th>Umur</th>
                        <th>Asal Benih</th>
                        <th>Rencana Penyaluran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $start=1;
                      foreach($trup_eksisting as $row):?>
                        <tr>
                          <td><?php  echo $start++; ?>&nbsp;</td>
                          <td><?php echo $row->komoditi;?>&nbsp;</td>
                          <td><?php echo $row->varietas;?>&nbsp;</td>
                          <td><?php echo $row->jml." ".$row->kode_satuan;?>&nbsp;</td>
                          <td><?php echo $row->umur;?>&nbsp;</td>
                          <td><?php echo $row->asal;?>&nbsp;</td>
                          <td><?php echo $row->penyaluran;?>&nbsp;</td>
                      <?php endforeach;?> 
                    </tbody>
                  </table>
            </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> b. Rencana Kegiatan Pembibitan</h3>
              </div>
              <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Komoditi</th>
                        <th>Varietas / Klon</th>
                        <th>Jumlah / Luas</th>
                        <th>Umur</th>
                        <th>Asal Benih</th>
                        <th>Rencana Penyaluran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $start=1;
                      foreach($trup_rencana as $row):?>
                        <tr>
                          <td><?php  echo $start++; ?>&nbsp;</td>
                          <td><?php echo $row->komoditi;?>&nbsp;</td>
                          <td><?php echo $row->varietas;?>&nbsp;</td>
                          <td><?php echo $row->jml." ".$row->kode_satuan;?>&nbsp;</td>
                          <td><?php echo $row->umur;?>&nbsp;</td>
                          <td><?php echo $row->asal;?>&nbsp;</td>
                          <td><?php echo $row->penyaluran;?>&nbsp;</td>
                      <?php endforeach;?> 
                    </tbody>
                  </table>
            </div>
            </div>
          </div>
        </div>
      </div>

          <div class="tab-pane" id="tab_2"> 
            <div id="notification">
            </div>
            <div class="row">
              <form>
                <div class="col-md-9">
                  <div class="box box-warning">
                    <div class="box-body">
                      <textarea id="surat" name="surat">
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

                <div class="col-md-3">
                    <div class="form-group">
                      <button type="button" id="btn-save" class="btn btn-warning btn-social"><i class="fa fa-save"></i> Simpan Surat</button><br><br>
                      <button type="button" id="btn-print" class="btn btn-success btn-social" <?php if(!$saved_surat) echo "style='display:none'"; ?>><i class="fa fa-print"></i> Cetak Rekomendasi TRUP</button>
                    </div>
                </div>
              </form>
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
    $("#menu_pemeriksaan_trup").addClass("active");
    $("#menu_pemeriksaan").addClass("active");

    CKEDITOR.config.height = '920px';
    CKEDITOR.config.extraAllowedContent = 'p(*)[*]{*};p[align];div{text-align};div{font-weight};div{font-size};strong{color};table{border};td{border};td{border-right};td{border-bottom};td{border-top}';
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.replace('surat');

    $("#datemask").datepicker({format: 'dd/mm/yyyy'});
    $("#datemask2").datepicker({format: 'dd/mm/yyyy'});
    $("#datemask3").datepicker({format: 'dd/mm/yyyy'});

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/trup";
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
        }
      }
    });

    $('#btn-print').click(function(){
        $.get("<?php echo base_url()?>pemeriksaan/pdf_surat_trup/{kode_trup}", function(response) {
          window.open("<?php echo base_url()?>pemeriksaan/load_pdf_trup/{kode_trup}");
        });

    });
    
    $('#btn-save').click(function(){
      for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
      }
      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'pemeriksaan/save_surat_trup/{kode_trup}';?>",
        data: $('#surat').serialize(),
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
