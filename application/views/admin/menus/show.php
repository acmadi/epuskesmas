<?php if($this->session->flashdata('alert_form')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert_form')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>index.php/admin_menu/doorder/id_theme/{id_theme}" method="POST" name="frmFiles">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
        </div><!-- /.box-header -->

        <div class="box-body col-md-6">
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" >Simpan Urutan</button>
			<button type="button" class="btn btn-warning" onclick="document.location.href='<?php echo base_url()?>admin_menu/add/id_theme/{id_theme}/position/{position}'">Tambah Menu Utama</button>
	   	 </div>
	    </div>
        <div class="box-body col-md-3 pull-right" style="text-align:right">
            <div class="form-group">
              <label for="exampleInputEmail1">Tentukan Posisi</label>
              <?php echo form_dropdown('position', $position_option, $position," class=form-control");?>
            </div>
	    </div>
        <div class="box-body col-md-3 pull-right" style="text-align:right">

            <div class="form-group">
              <label for="exampleInputEmail1">Themes</label>
              <?php echo form_dropdown('id_theme', $theme_option, $id_theme," class=form-control");?>
            </div>
	    </div>

      	<div class="box-body">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="tbl" id="menus_tbl">
				<thead>
					<tr class="nodrop nodrag">
						<th  width=90%  colspan="3">Menu</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{menu_tree}</td>
					</tr>
				</tbody>
			</table>
		</div><!-- /.box -->

  	</div><!-- /.box -->
  </div><!-- /.box -->
</div><!-- /.box -->
</form>
</section>

<script>
	$(function () {	
		$("#menu_admin_menu").addClass("active");
		$("#menu_admin").addClass("active");
	});
</script>

