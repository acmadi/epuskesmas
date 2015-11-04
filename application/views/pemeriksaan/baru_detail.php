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
                <h3 class="box-title"><i class="fa fa-check-square"></i> Approval Permohonan Sertifikasi</h3>
              </div>
              <div class="box-body">
                <strong>Nomor Permohonan : </strong><?php echo $nomor_permohonan; ?><br>
                <strong>Tanggal Permohonan : </strong><?php echo $tgl_permohonan; ?><br>
                <strong>Jenis Sertifikat : </strong><?php echo $sertifikat; ?><br><br>

                <!-- <strong>Total Biaya Sertifikasi: <span class="text-red">Rp. 0.000.000,-</span></strong><br> -->
              </div>              
              <div class="box-body">
                    <p id="status-label">Tentukan status permohonan sertifikasi :</p>
                      <button type="button" id="btn-approve" class="btn btn-danger btn-social"><i class="fa fa-check-square-o"></i> Approve Permohonan</button>
                      <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                </div>
              </div>
          </div>
        </div>
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
                        <th>Jumlah Diajukan</th>
                        <th>Satuan</th>
                        <th>Asal</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $start=1;
                      foreach($komoditi as $row):?>
                        <tr>
                          <td><?php  echo $start++; ?>&nbsp;</td>
                          <td><?php  echo $row['sertifikat']; ?>&nbsp;</td>
                          <td><?php  echo $row['komoditi']; ?>&nbsp;</td>
                          <td><?php  echo $row['varietas']; ?>&nbsp;</td>
                          <td><?php  echo $row['bentuk_benih']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml']); ?>&nbsp;</td>
                          <td><?php  echo $row['satuan']; ?>&nbsp;</td>
                          <td><?php  echo $row['asal']; ?>&nbsp;</td>
                          <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()."pemeriksaan/baru_detail_komoditi/".$row['kode_permohonan']."/".$row['kode_varietas']."/".$row['kode_komoditi'];?>" title="Detail">Detail</a></td>
                        </tr>
                      <?php endforeach;?>    
                    </tbody>
                  </table>
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
    $("#menu_pemeriksaan_baru").addClass("active");
    $("#menu_pemeriksaan").addClass("active");

    $("#dataTable").dataTable();

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>pemeriksaan/baru";
    });

    $('#btn-approve').click(function(){
      if (confirm('Anda yakin data sudah benar ?')) {
        $('#btn-approve').text('Loading...');
        $('#btn-approve').addClass('disabled');
        $('#btn-back').addClass('disabled');
        $.ajax({ 
          type: "GET",
          url: "<?php echo base_url();?>pemeriksaan/approve_permohonan/<?php echo $kode_permohonan; ?>",
          success: function(response){
            if(response=="1"){
              $('#status-label').html('Status permohonan sertifikasi : <i class="icon fa fa-check"></i> <strong>Approved</strong>');
              $('#btn-approve').remove();
              $('#btn-back').removeClass('disabled');
             }else{
               $('#status-label').text('Proses approval gagal, silahkan tentukan status permohonan sertifikasi :');
               $('#btn-approve').text('Approve Permohonan');
               $('#btn-approve').removeClass('disabled');
               $('#btn-back').removeClass('disabled');
             }
          }
         });    
      };    
    });

  });
</script>
