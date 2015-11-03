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
      <li class="active"><a href="#tab_1" data-toggle="tab">Form Permohonan Rekomendasi TRUP</a></li>
    </ul>
    <div class="tab-content">


      <div class="tab-pane active" id="tab_1">    
        <div class="row">
          <div class="col-md-6 ">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Pemohon Rekomendasi</h3>
              </div>
              <div class="box-body">
                <strong>1.  Nama Pemohon : {namapemohon}</strong><br>
                2.  Nama Ketua/Penanggung jawab : {penanggungjawab}<br>
                3.  Alamat : {nama_kota}  {nama_kecamatan} {nama_desa}<br>
                4.  No. KTP : {ktp}<br>
                5.  Pengalaman jadi penangkar  : {pengalaman}<br>
                6.  Asal Modal Usaha  : {modal_asal}<br>
                7.  Jumlah modal usaha : Rp. {modal_nilai} ,-<br>
                8.  Kerjasama Kelompok : {kerjasama}<br>
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <div class="row">
              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-check-circle-o"></i> Detail Pengajuan Rekomendasi TRUP</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nomor :</label>
                      {kode_trup}
                      <br>
                      <label>Tanggal Pendaftaran :</label>
                      {tgl_daftar}
                      <br>
                      <label>Jenis Rekomendasi :</label>
                      {jenistrup}
                      <br>
                      <label>Lokasi Pembibitan :
                      Kota {kota}, Kecamatan {kecamatan}, Desa {desa}</label>
                    </div>
                    <?php if($statustrup!="aktif"){ ?>
                      <div class="form-group">
                        Anda akan kami hubungi untuk melakukan pemeriksaan.
                      </div>
                    <?php }else{?>
                      <div class="form-group">
                        <label>Tanggal Pemeriksaan :</label>
                        {tgl_pemeriksaan}
                      <br>
                        <label>Petugas Pemeriksa :</label>
                        {pemeriksa}
                      <br>
                        <label>Nomor Rekomendasi TRUP :</label>
                        {nomor_trup}
                      <br>
                        <label>Status :</label>
                        {statusTRUP}
                      <br>
                        <label>Tanggal Aktif :</label>
                        {tgl_aktif}
                      <br>
                        <label>Tanggal Berakhir :</label>
                        {tgl_akhir}
                      </div>                    
                    <?php }?>
                    <div class="form-group">
                      <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
                    </div>
                  </div>
                </div>

                </div>
              </div>
          </div>
        </div>


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

    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_dashboard_trup").addClass("active");
    $("#menu_dashboard").addClass("active");

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>users/trup";
    });

  });
</script>
