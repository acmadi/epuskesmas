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
<div class="row" style="background:#FAFAFA">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Data Permohonan Sertifikasi</a></li>
      <li><a href="#tab_2" data-toggle="tab">Cetak Biaya Pemeriksaan</a></li>
    </ul>
    <div class="tab-content">


      <div class="tab-pane active" id="tab_1">    
        <div class="row">
          <div class="col-md-6 ">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Sertifikasi</h3>
              </div>
              <div class="box-body">
                <strong>Nomor Permohonan : </strong><?php echo $nomor_permohonan; ?> <br>
                <strong>Tanggal Permohonan : </strong><?php echo $tgl_permohonan; ?><br><br>
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
                <h3 class="box-title"><i class="fa fa-money"></i> Data Pembayaran Diterima</h3>
              </div>
              <div class="box-body">
                  <p>Silahkan input data hasil pembayaran :</p>
                  <form name="update-pembayaran" id="update-pembayaran">
                  <div class="form-group">
                    <label>Nomor Surat Tagihan :</label>
                    <input type="text" class="form-control" placeholder="525/###/BP2MB/2015" name="nomor_surat" value="<?php if (isset($nomor_surat)) echo $nomor_surat;?>" />
                  </div>
                  <div class="form-group">
                    <label>Tanggal Surat :</label>
                    <input type="text" class="form-control" placeholder="Tanggal Surat" name="tgl_surat"  id="datemask" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if (isset($tgl_surat)) echo $tgl_surat;?>" />
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pembayaran :</label>
                    <input type="text" class="form-control" placeholder="Tanggal Pembayaran" name="tgl_pembayaran"  id="datemask2" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php if (isset($tgl_pembayaran)) echo $tgl_pembayaran;?>" />
                  </div>
                  <div class="form-group">
                    <label>Total Pembayaran (Rp) :</label>
                    <input type="text" class="form-control" placeholder="000.000.000" name="total_bayar" value="<?php if (isset($total_bayar)) echo number_format($total_bayar);?>"/>
                  </div>
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="status" id="status" value="1" <?php if(isset($status_pembayaran)) {if($status_pembayaran==1) echo "checked";}?> /> &nbsp; Status Lunas
                    </label>
                  </div>           
                    <?php if((isset($status_pembayaran) && $status_pembayaran!=1) || (!isset($status_pembayaran))) { ?>                     
                    <button type="button" id="btn-send" class="btn btn-warning btn-social"><i class="fa fa-check-square-o"></i> Update Pembayaran</button>
                    <?php  }?> 
                    <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
        	<div class="col-md-12">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Daftar Komoditi</h3>
              </div>
              <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Sertifikat</th>
                        <th>Komoditi</th>
                        <th>Varietas</th>
                        <th>Bentuk Benih</th>
                        <th>Jumlah<br>Diajukan</th>
                        <th>Jumlah<br>Memenuhi Syarat</th>
                        <th>Tarif</th>
                        <th>Total</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $start=1;
                      $jml = 0; $jml_ok = 0; $total = 0;
                      foreach($komoditi as $row):?>
                        <tr>
                          <td><?php  echo $start++; ?>&nbsp;</td>
                          <td><?php  echo $row['sertifikat']; ?>&nbsp;</td>
                          <td><?php  echo $row['komoditi']; ?>&nbsp;</td>
                          <td><?php  echo $row['varietas']; ?>&nbsp;</td>
                          <td><?php  echo $row['bentuk_benih']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml']); $jml += $row['jml']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml_ok']); $jml_ok += $row['jml_ok']; ?>&nbsp;</td>
                          <td><?php  echo $row['tarif']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml_ok']*$row['tarif']); $total += $row['jml_ok']*$row['tarif'];?>&nbsp;</td>
                          <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()."pemeriksaan/dibayar_detail_komoditi/".$row['kode_permohonan']."/".$row['kode_varietas']."/".$row['kode_komoditi'];?>" title="Detail Account">Detail</a></td>
                        </tr>
                      <?php endforeach;?>    
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>&nbsp</th>
                        <th colspan="4">Jumlah</th>
                        <th><?php echo number_format($jml)?></th>
                        <th><?php echo number_format($jml_ok)?></th>
                        <th>&nbsp;</th>
                        <th><?php echo number_format($total)?></th>
                        <th>&nbsp;</th>
                      </tr>
                    </tfoot>
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
                        if(set_value('surat')=="" && isset($surat)){
                          echo $surat;
                        }else{
                          echo  set_value('surat');
                        }
                      ?>
                      </textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                      <button type="button" id="btn-save" class="btn btn-warning btn-social"><i class="fa fa-save"></i> Simpan Surat</button><br><br>
                      <button type="button" id="btn-print" class="btn btn-success btn-social" <?php if(!$saved_surat) echo "style='display:none'"; ?>><i class="fa fa-print"></i> Cetak Biaya Pemeriksaan</button>
                    </div>
                </div>
              </form>
            </div>
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
    $("#menu_pemeriksaan_dibayar").addClass("active");
    $("#menu_pemeriksaan").addClass("active");
    
    CKEDITOR.config.height = '920px';
    CKEDITOR.config.extraAllowedContent = 'p(*)[*]{*};p[align];div{text-align};div{font-weight};div{font-size};strong{color};table{border};td{border};td{border-right};td{border-bottom};td{border-top}';
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.replace('surat');

    $("#dataTable").dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
    $("#datemask").datepicker({format: 'dd/mm/yyyy'});
    $("#datemask2").datepicker({format: 'dd/mm/yyyy'});

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/dibayar";
    });

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('#btn-print').click(function(){
        $.get("<?php echo base_url()?>pemeriksaan/pdf_surat/{kode_permohonan}", function(response) {
          window.open("<?php echo base_url()?>pemeriksaan/load_pdf/{kode_permohonan}");
        });

    });
    
    $('#btn-save').click(function(){
      for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
      }
      $.ajax({ 
        type: "POST",
        url: "<?php echo base_url().'pemeriksaan/save_surat/{kode_permohonan}';?>",
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
        url: "<?php echo base_url().'pemeriksaan/update_pembayaran/{kode_permohonan}';?>",
        data: $('#update-pembayaran').serialize(),
        success: function(response){
          window.location.reload();
        }
       });    
    });

  });
</script>
