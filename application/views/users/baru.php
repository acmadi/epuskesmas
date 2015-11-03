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
          <div class="box-footer">
            <button type="submit" class="btn btn-danger" onClick="if(!confirm('Hapus semua data yang dipilih?'))return false;">Hapus</button>
          </div>
	    </div>

        <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
						<th>&nbsp;</th>
						<th>No</th>
						<th>Username</th>
						<th>Tipe</th>
						<th>Nama / Perusahaan</th>
						<th>Email</th>
						<th>Terdaftar</th>
						<th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$start=1;
					foreach($query as $row):?>
						<tr>
							<td><input type="checkbox" name="username[]" value="<?php  echo $row->username?>" /></td>
							<td><?php  echo $start++?>&nbsp;</td>
							<td><?php  echo $row->username?>&nbsp;</td>
							<td><?php  echo ucfirst($row->jenis) ?>&nbsp;</td>
							<td><?php  echo $row->nama?>&nbsp;</td>
							<td><?php  echo $row->email?>&nbsp;</td>
							<td><?php  echo date("d-m-Y h:i:s",$row->datereg)?></td>
							<td align="center"><a class="btn btn-primary btn-xs" href="<?php  echo base_url()?>users/approval/<?php  echo $row->username?>" title="Detail Account">Detail</a></td>
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
		$("#menu_dashboard_pendaftaran").addClass("active");
		$("#menu_dashboard").addClass("active");
	});
</script>
