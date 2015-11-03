<div class="row">
   <div class="col-md-12">
     <div class="register-logo">
        Informasi <b>Komoditi </b>
      </div>
    </div>
</div><!-- Info boxes -->
        <div class="box box-danger">
          <div class="box-body">
          <div class="col-md-10 ">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi Komoditi <b><?php echo $komoditi['nama']?></b></h3>
              </div>
              <div class="box-body">
              <?php 
              $persyaratan = str_replace('<td style="border-bottom:1px solid black">&nbsp;</td>', "", $komoditi['persyaratan']);
              $persyaratan = str_replace('<td style="border-bottom:1px solid black; text-align:center"><strong>Hasil Pemeriksaan</strong></td>', "", $persyaratan);
              $persyaratan = str_replace('PBT: {pemeriksa}', "&nbsp;", $persyaratan);

              echo $persyaratan;?>
              <br>
              <?php echo $komoditi['sop']?>
              </div>
            </div>
          <div class="col-md-2">
                <button type="button" id="btn-back" class="btn btn-primary btn-social pull-right"><i class="fa fa-reply"></i> Kembali</button>
          </div><!-- /.box-body -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="<?php echo base_url()?>public/themes/disbun/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<script>
  $(function () { 
    $("#btn-back").click(function(){
      document.location.href="<?php echo base_url()?>komoditi";
    });
  });
</script>
