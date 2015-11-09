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


<section class="content">
<form action="<?php echo base_url()?>mst/invpilihan/{action}/{kode}" method="POST" name="">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
        </div><!-- /.box-header -->

          <div class="box-footer pull-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-warning">Ulang</button>
            <button type="button" class="btn btn-success" onClick="document.location.href='<?php echo base_url()?>mst/invpilihan'">Kembali</button>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label>Pilihan Tipe</label>
              <select name="tipe" class="form-control">
                <?php for($i=0;$i<count($tipe) ;$i++)  { ?>
                  <?php $select =$tipe[$i] == $tipe ? 'selected' : '' ?>
                  <option value="<?php echo $tipe[$i]; ?>" <?php echo $select ?>><?php echo $tipe[$i]; ?></option> 
                <?php
                }
                ?>
              </select>
                
            </div>
            <div class="form-group">
              <label>Kode</label>
              <input type="text" class="form-control" name="kode" placeholder="Nama" value="<?php 
                if(set_value('code')=="" && isset($code)){
                  echo $code;
                }else{
                  echo  set_value('code');
                }
                ?>">
                
            </div>
            <div class="form-group">
              <label>Value</label>
              <input type="text" class="form-control" name="value" placeholder="Deskripsi" value="<?php 
                if(set_value('value')=="" && isset($value)){
                  echo $value;
                }else{
                  echo  set_value('value');
                }
                ?>">
            </div>
          </div>
          </div><!-- /.box-body -->
      </div><!-- /.box -->
  	</div><!-- /.box -->
  </div><!-- /.box -->
</form>
</section>

<script>
	$(function () {	
    $("#menu_mst_invpilihan").addClass("active");
    $("#menu_master_data").addClass("active");
	});
</script>
