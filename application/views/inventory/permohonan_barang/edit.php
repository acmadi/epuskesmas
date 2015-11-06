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
  <form action="<?php echo base_url()?>inventory/permohonanbarang/add" method="post">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body">
        <div class="form-group">
          <label>Tanggal</label>
          <div id='tgl' name="tgl" value="<?php
              echo (set_value('tgl')!="") ? date("Y-m-d",strtotime(set_value('tgl'))) : "";
            ?>"></div>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="Keterangan"><?php 
              if(set_value('keterangan')=="" && isset($keterangan)){
                echo $keterangan;
              }else{
                echo  set_value('keterangan');
              }
              ?></textarea>
        </div>
      </div>
    </div>
  </div><!-- /.form-box -->

  <div class="col-md-6">
    <div class="box box-warning">
      <div class="box-body">
        <div class="form-group">
          <label>Puskesmas<h1></h1></label>
          <select  name="codepus" id="puskesmas" class="form-control">
              <option value="">
              </option>
              <?php foreach($kodepuskesmas as $pus) : ?>
                <?php $select = $pus->code == set_value('codepus') ? 'selected' : '' ?>
                <option value="<?php echo $pus->code ?>" <?php echo $select ?>><?php echo $pus->value ?></option>
              <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>Ruangan</label>
          <select name="ruangan" id="ruangan"  class="form-control">
              <option value="">Pilih Ruangan</option>
          </select>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" class="btn btn-warning">Kembali</button>
      </div>
      </div>
    </form>        

  </div><!-- /.form-box -->
</div><!-- /.register-box -->      
  <div class="box-body">
    <div class="div-grid">
        <div id="jqxTabs">
          <?php echo $document;?>
        </div>
    </div>
  </div>
<script type="text/javascript">
$(function(){
    $('#btn_back').click(function(){
        window.location.href="<?php echo base_url()?>admin_user";
    });

    $("#menu_permohonan_barang").addClass("active");
    $("#menu_inventory").addClass("active");
    $("#tgl").jqxDateTimeInput({ formatString: 'dd-MM-yyyy', theme: theme});
    $('#puskesmas').change(function(){
      var code = $(this).val();
      var id_ruang = '<?php echo set_value('ruangan')?>';
      $.ajax({
        url : '<?php echo site_url('inventory/permohonanbarang/get_ruangan') ?>',
        type : 'POST',
        data : 'code=' + code+'&id_ruang=' + id_ruang,
        success : function(data) {
          $('#ruangan').html(data);
        }
      });

      return false;
    });

    <?php if(isset($coderuangan)){ ?>
      data = $( "#puskesmas" ).val();
      $.ajax({
        url : '<?php echo site_url('inventory/permohonanbarang/get_ruangan') ?>',
        type : 'POST',
        data : 'unit=' + data,
        success : function(data) {
          $('#ruangan').html(data);
        }
      });

      return false;
    <?php } ?>
     $('#jqxTabs').jqxTabs({ width: '100%', height: '250', position: 'top', theme: theme });
  });

</script>
