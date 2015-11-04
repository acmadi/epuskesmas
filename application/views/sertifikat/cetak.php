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
						<th>Nomor Permohonan</th>
						<th>Nama</th>
						<th>Perusahaan</th>
						<th>Jenis Sertifikat</th>
						<th>Komoditi</th>
						<th>Status</th>
						<?php if($user_level == "super administrator" || $user_level == "administrator") { ?>
							<th>Detail</th>
						<?php } ?>
                      </tr>
                    </thead>
                    <tbody>
  					<?php 
	                $start=1;
	                foreach($data_array as $row):
	                ?>
						<tr>
	                    	<td><?php  echo $start++; ?>&nbsp;</td>
		                    <td><?php  echo $row['nomor_permohonan']; ?>&nbsp;</td>
	                   		<td><?php  echo $row['nama']; ?>&nbsp;</td>
	                   		<td><?php  echo $row['perusahaan']; ?></td>
	                    	<td><?php  echo $row['sertifikat']; ?>&nbsp;</td>
	                    	<td><?php  echo $row['komoditi']; ?>&nbsp;</td>
							<td align="center">
	                          <?php if(!$row['status']) { ?>
	                          <a class="btn btn-warning btn-xs" title="Status">Pending</a> 
	                          <?php } else { ?>
	                          <a class="btn btn-success btn-xs" title="Status">Done</a>
	                          <?php } ?>
	                         </td>
	                    <?php if($user_level == "super administrator" || $user_level == "administrator") { ?>
                          <td align="center"><a class="btn btn-primary btn-xs" href="<?php echo base_url()?>sertifikat/cetak_detail/<?php  echo $row['kode_permohonan']; ?>" title="Detail">Detail</a></td>
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
		$("#menu_sertifikat_cetak").addClass("active");
		$("#menu_sertifikat").addClass("active");
	});
</script>
