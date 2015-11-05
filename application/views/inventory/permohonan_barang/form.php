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
<div class="row">
  <form action="<?php echo base_url()?>admin_user/add" method="post">
  <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal</label>
              <div id='tgl' class="form-control" name="tgl" value="<?php
                  echo (set_value('tgl')!="") ? date("m-d-Y",strtotime(set_value('tgl'))) : date("m-d-Y");
                ?>"></div>

            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" placeholder="Keterangan">
                  <?php 
                  if(set_value('kode')=="" && isset($kode)){
                    echo $kode;
                  }else{
                    echo  set_value('kode');
                  }
                  ?>
              </textarea>
            </div>
  </div><!-- /.form-box -->

  <div class="col-md-6">
    <div class="form-group">
        <label>Puskesmas</label>
            <select  name="codepus" id="puskesmas" class="form-control">
                <option value="">Pilih Puskesmas</option>
                <?php foreach($puskesmas as $pus) : ?>
                  <?php $select = $pus->code == set_value('codepus') ? 'selected' : '' ?>
                  <option value="<?php echo $pus->code ?>" <?php echo $select ?>><?php echo $pus->value ?></option>
                <?php endforeach ?>
            </select>
      </div>
      <div class="form-group">
        <label>Ruangan</label>
            <select  name="unit" id="unit" class="form-control">
                <option value="">Pilih Ruangan</option>
                <?php foreach($organization as $org) : ?>
                  <?php $select = $org->code == set_value('code') ? 'selected' : '' ?>
                  <option value="<?php echo $org->code ?>" <?php echo $select ?>><?php echo $org->org_name ?></option>
                <?php endforeach ?>
            </select>
      </div>
          <div class="box-footer pull-right">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" class="btn btn-warning">Ulang</button>
            <button type="button" class="btn btn-success" onClick="document.location.href='<?php echo base_url()?>inventory/permohonanbarang'">Kembali</button>
          </div>
    </form>        

  </div><!-- /.form-box -->
</div><!-- /.register-box -->
<script type="text/javascript">
$(function(){
    $('#btn_back').click(function(){
        window.location.href="<?php echo base_url()?>admin_user";
    });

    $("#menu_permohonan_barang").addClass("active");
    $("#menu_inventory").addClass("active");
    $("#tgl").jqxDateTimeInput({ formatString: 'dd-MM-yyyy', theme: theme});
    $('#puskesmas').change(function(){
      var data = $(this).val();
      alert(data);
      $.ajax({
        url : '<?php echo site_url('program/update/get_ruangan') ?>',
        type : 'POST',
        data : 'unit=' + data,
        success : function(data) {
          $('#lab').html(data);
        }
      });

      return false;
    });

    <?php if(set_value('unit') != '') : ?>
    var data = '<?php echo set_value('unit') ?>';
    var lab = '<?php echo set_value('lab') ?>';
      $.ajax({
        url : '<?php echo site_url('program/update/get_lab') ?>',
        type : 'POST',
        data : 'unit=' + data + '&lab='+lab,
        success : function(data) {
          $('#lab').html(data);
        }
      });

      return false;
    <?php endif; ?>

  });
</script>
