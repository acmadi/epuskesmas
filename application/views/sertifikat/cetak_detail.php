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
      <li class="active"><a href="#tab_1" data-toggle="tab">Data Permohonan Sertifikasi</a></li>
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
                <strong>Nomor Permohonan : </strong><?php echo $nomor_permohonan; ?> <br>
                <strong>Tanggal Permohonan : </strong><?php echo $tgl_permohonan; ?><br><br>
                <strong>Tanggal Pembayaran : </strong><?php echo $tgl_pembayaran; ?><br>
                <strong>Total Pembayaran : </strong>Rp. <?php echo number_format($total_bayar); ?>,-<br><br>
                <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
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
                        <th>Nomor Sertifikat</th>
                        <th>Jenis</th>
                        <th>Komoditi</th>
                        <th>Varietas</th>
                        <th>Bentuk Benih</th>
                        <th>Jumlah<br>Diajukan</th>
                        <th>Jumlah<br>Memenuhi<br>Syarat</th>
                        <th>Masa<br>Berlaku</th>
                        <th>Status</th>
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
                          <td><?php  echo $row['sertifikat']['nomor_sertifikat']; ?>&nbsp;</td>
                          <td><?php  echo $row['jenis']; ?>&nbsp;</td>
                          <td><?php  echo $row['komoditi']; ?>&nbsp;</td>
                          <td><?php  echo $row['varietas']; ?>&nbsp;</td>
                          <td><?php  echo $row['bentuk_benih']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml']); $jml += $row['jml']; ?>&nbsp;</td>
                          <td><?php  echo number_format($row['jml_ok']); $jml_ok += $row['jml_ok']; ?>&nbsp;</td>
                          <td><?php  echo $row['sertifikat']['tgl_berlaku']; ?> s/d <?php  echo $row['sertifikat']['tgl_berakhir']; ?></td>
                          <td align="center">
                          <?php if($row['sertifikat']['status'] == 0) { ?>
                          <a class="btn btn-warning btn-xs" title="Status">Pending</a> 
                          <?php } else { ?>
                          <a class="btn btn-success btn-xs" title="Status">Done</a>
                          <?php } ?>
                          </td>
                          <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()."sertifikat/cetak_detail_komoditi/".$row['kode_permohonan']."/".$row['kode_varietas']."/".$row['kode_komoditi'];?>" title="Detail ">Detail</a></td>
                        </tr>
                      <?php endforeach;?>    
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>&nbsp</th>
                        <th colspan="5">Jumlah</th>
                        <th><?php echo number_format($jml)?></th>
                        <th><?php echo number_format($jml_ok)?></th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                    </tfoot>
                  </table>
            </div>
            </div>
        </div>
      </div>
      </div>
    
    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script type="text/javascript">
$(function(){
    $("#menu_sertifikat_cetak").addClass("active");
    $("#menu_sertifikat").addClass("active");
    
    $("#dataTable").dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });

    $("#btn-back").click(function(){
      document.location.href="<?php echo base_url()?>sertifikat/cetak";
    });

  });
</script>
