<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>users/baru" method="POST" name="frmUsers">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-hover">
            <thead>
              <tr>
    						<th>No</th>
    						<th>Jenis </th>
    						<th>Nomor Sertifikat</th>
    						<th>Nama / Perusahaan</th>
    						<th>Tanggal Berakhir</th>
    						<th>Komoditi</th>
    						<th>Varietas</th>
    						<?php if($user_level == "super administrator") { ?>
                  <th>Detail</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
    					<?php 
              $start=1;
              $jml = 0; $jml_ok = 0; $total = 0;
              foreach($sertifikat as $row):?>
                <tr>
                  <td><?php  echo $start++; ?>&nbsp;</td>
                  <td><?php  echo $row['jenis_sertifikat']; ?>&nbsp;</td>
                  <td><?php  echo $row['nomor_sertifikat']; ?>&nbsp;</td>
                  <td><?php  echo $row['nama_pemohon']; ?>&nbsp;</td>
                  <td><?php  echo $row['tgl_berlaku']; ?>&nbsp;</td>
                  <td><?php  echo $row['nama_komoditi']; ?>&nbsp;</td>
                  <td><?php  echo $row['nama_varietas']; ?>&nbsp;</td>
              <?php if($user_level == "super administrator") { ?>
                  <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()."sertifikat/nonaktif_detail/".$row['kode_permohonan']."/".$row['kode_varietas']."/".$row['kode_komoditi'];?>" title="Detail">Detail</a></td>
                <?php } ?>
            </tr>
              <?php endforeach;?>                  
            </tbody>
        </table>
	    </div>

	  </div>
	</div>
  </div>
</form>
</section>

<script>
	$(function () {	
        $("#dataTable").dataTable();
		$("#menu_sertifikat_nonaktif").addClass("active");
		$("#menu_sertifikat").addClass("active");
	});
</script>
