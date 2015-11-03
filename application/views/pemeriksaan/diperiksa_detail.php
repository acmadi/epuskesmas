<link href="<?php echo base_url()?>public/themes/disbun/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
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
      <li class="active"><a href="#tab_1" data-toggle="tab">Data Permohonan Sertifikasi</a></li>
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
                <h3 class="box-title"><i class="fa fa-edit"></i> Data Pemeriksaan</h3>
              </div>
              <div class="box-body">
                    <p>Silahkan input data hasil pemeriksaan :</p>
                    <form name="update-pemeriksaan" id="update-pemeriksaan">
                    <div class="form-group">
                      <label>Tanggal Pemeriksaan :</label>
                      <input type="text" class="form-control" placeholder="Tanggal Pemeriksaan" name="tgl_pemeriksaan"  id="datemask" value="<?php if (isset($tgl_pemeriksaan)) echo $tgl_pemeriksaan;?>"/>
                    </div>
                    <div class="form-group">
                      <label>Pengawas Benih Tanaman :</label>
                      <input type="text" class="form-control" placeholder="Nama Pemeriksa" name="nama" value="<?php if (isset($nama_pemeriksa)) echo $nama_pemeriksa;?>"/>
                    </div>
                    <div class="checkbox icheck">
                      <label>
                        <input type="checkbox" id="status" name="status" value="1" <?php if(isset($status_pemeriksaan)) {if($status_pemeriksaan==1) echo "checked";}?> /> &nbsp; Status Selesai
                      </label>
                    </div>     
                      <?php if((isset($status_pemeriksaan) && $status_pemeriksaan!=1) || (!isset($status_pemeriksaan))) { ?>        
                      <button type="button" id="btn-send" class="btn btn-warning btn-social"><i class="fa fa-check-square-o"></i> Update Pemeriksaan</button>
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
                        <th>Jumlah<br>Memenuhi<br>Syarat</th>
                        <th>Jumlah<br>Tidak Memenuhi<br>Syarat</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $start=1;
                      $jml = 0; $jml_ok = 0;
                      foreach($komoditi as $row):?>
                        <tr>
                          <td><?php  echo $start++; ?>&nbsp;</td>
                          <td><?php  echo $row['sertifikat']; ?>&nbsp;</td>
                          <td><?php  echo $row['komoditi']; ?>&nbsp;</td>
                          <td><?php  echo $row['varietas']; ?>&nbsp;</td>
                          <td><?php  echo $row['bentuk_benih']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml']); $jml += $row['jml']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml_ok']); $jml_ok += $row['jml_ok']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml']-$row['jml_ok']); ?>&nbsp;</td>
                          <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()."pemeriksaan/diperiksa_komoditi/".$row['kode_permohonan']."/".$row['kode_varietas']."/".$row['kode_komoditi'];?>" title="Detail">Detail</a></td>
                        </tr>
                      <?php endforeach;?>   
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>&nbsp</th>
                        <th colspan="4">Jumlah</th>
                        <th><?php echo number_format($jml)?></th>
                        <th><?php echo number_format($jml_ok)?></th>
                        <th><?php echo number_format($jml-$jml_ok)?></th>
                        <th>&nbsp;</th>
                      </tr>
                    </tfoot>
                  </table>
            </div>
          	</div>
        </div>
      </div>
    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_pemeriksaan_diperiksa").addClass("active");
    $("#menu_pemeriksaan").addClass("active");

    $("#dataTable").dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
    $("#datemask").daterangepicker({format: 'DD/MM/YYYY'});
    $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()

                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/diperiksa";
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
          url: "<?php echo base_url().'pemeriksaan/update_pemeriksaan/{kode_permohonan}';?>",
          data: $('#update-pemeriksaan').serialize(),
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
