<?php if(validation_errors()!=""){ ?>
<div class="alert alert-warning alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
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

<div class="row">
	<!-- left column -->
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12" style="min-height:196px">
						<div class="form-group">
							<label>Puskesmas</label>
							<div>
							<?php foreach($kodepuskesmas as $pus) : ?>
								<?php echo $pus->code == $code_cl_phc ? $pus->value : '' ?>
							<?php endforeach ?>
							</div>
						</div>
						<div class="form-group">
							<label>Nama Ruangan</label>
							<div >{nama_ruangan}</div>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<div>{keterangan}</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.box -->
	</div><!-- /.box -->
	<div class="col-md-6">
		<div class="box box-warning">
			<div class="box-body">
				<div class="row">
				  	<div class="col-md-12">
						<div class="form-group">
							<label>Tanggal</label>
							<div id="tgl"></div>
						</div>
				  	</div>
				  	<div class="col-md-6">
						<div class="form-group">
							<label>Pilih Ruangan</label>
				     		<select name="code_cl_phc" class="form-control" id="code_cl_phc">
				     			<option value="">Pilih Puskesmas</option>
								<?php foreach ($kodepuskesmas as $row ) { ;?>
								<option value="<?php echo $row->code; ?>" onchange="" ><?php echo $row->value; ?></option>
							<?php	} ;?>
				     		</select>
				  		</div>
				  	</div>
				  	<div class="col-md-6">
						<div class="form-group">
							<label>&nbsp;</label>
				     		<select name="code_ruangan" class="form-control" id="code_ruangan">
				     			<option value="">Pilih Ruangan</option>
				     		</select>
				  		</div>
				  	</div>
				  	<div class="col-md-12">
						<div class="form-group pull-right">
            				<button type="button" class="btn btn-warning">Ekspor</button>
            				<button type="button" class="btn btn-success" onClick="document.location.href='<?php echo base_url()?>inventory/inv_ruangan'">Kembali</button>
						</div>
				  	</div>
				</div>
			</div>
		</div><!-- /.box -->
	</div><!-- /.box -->
</div><!-- /.box -->
<div class="row">

</div><!-- /.box -->
<script>
	$(function () {	
		$("#menu_inventory").addClass("active");
		$("#menu_inventory_inv_ruangan").addClass("active");

	    $('#code_cl_phc').change(function(){
	      	var code_cl_phc = $(this).val();
	      	var id_mst_inv_ruangan = '<?php echo set_value('code_ruangan')?>';
	      	$.ajax({
		        url : '<?php echo site_url('inventory/inv_barang/get_ruangan') ?>',
		        type : 'POST',
		        data : 'code_cl_phc=' + code_cl_phc+'&id_mst_inv_ruangan=' + id_mst_inv_ruangan,
		        success : function(data) {
		          	$('#code_ruangan').html(data);
					filter_ruangan();
        		}
	    	});
	      	return false;
	    }).change();

	    $('#code_ruangan').change(function(){
	      	var id_mst_inv_ruangan = $(this).val();
			filter_ruangan(id_mst_inv_ruangan);
	      	return false;
	    }).change();
    	$("#tgl").jqxDateTimeInput({ formatString: 'dd-MM-yyyy', theme: theme, height: '31px'});

	});

	function filter_ruangan(id_mst_inv_ruangan){
	}
</script>
