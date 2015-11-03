<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>mst/agama/dodel_multi" method="POST" name="">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="box-footer">
		 	<button type="button" class="btn btn-primary" onclick="document.location.href='<?php echo base_url()?>mst/agama/add'">Tambah</button>
            <button type="submit" class="btn btn-danger" onClick="if(!confirm('Hapus semua data yang dipilih?'))return false;">Hapus</button>
         </div>
	    </div>

        <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
						<th>&nbsp;</th>
						<th>NO</font></th>
						<th>Kode</font></th>
						<th>Value</th>
						<th>Ubah</th>
						<th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$start=0;
					foreach($query as $row):?>
						<tr>
							<td><input type="checkbox" name="id[]" value="<?php echo $row->kode?>" /></td>
							<td><?php $start++; echo ($start<10 ? "0":"").$start; ?>&nbsp;</td>
							<td><?php echo $row->kode?>&nbsp;</td>
							<td><?php echo $row->value?>&nbsp;</td>
							<td align="center"><a href="<?php echo base_url()?>mst/agama/edit/<?php echo $row->kode?>" title="Ubah"><img src="<?php echo base_url()?>media/images/16_edit.gif" /></a></td>
							<td align="center">
							<?php 
								$linkData="mst/agama/dodel/".$row->kode;
								$testLink=$this->verifikasi_icon->del_icon('mst',$linkData);
								echo $testLink;
								?>
							</td>
						</tr>
					<?php endforeach;?>                   
				</tbody>
                    <tfoot>
                      <tr>
						<th>&nbsp;</th>
						<th>NO</font></th>
						<th>Kode</font></th>
						<th>Nama</th>
						<th>Ubah</th>
						<th>Hapus</th>
                      </tr>
                    </tfoot>
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
		$("#menu_mst_agama").addClass("active");
		$("#menu_parameter").addClass("active");
	});
</script>
