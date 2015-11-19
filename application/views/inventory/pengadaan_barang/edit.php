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
  <form action="<?php echo base_url()?>inventory/pengadaanbarang/{action}/{kode}/" method="post">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body">
        <div class="form-group">
          <label>Tanggal</label><?php if(isset($viewreadonly)){if($action='view'){ 
            echo "<br>".$tgl_pengadaan; }}else{ ?>
              <div id='tgl' name="tgl" disabled value="<?php
              echo $tgl_pengadaan;;//echo ($tgl_pengadaan!="") ? date("Y-m-d",strtotime($$tgl_pengadaan)) : "";
            ?>" ></div>
             <?php  }?>
        </div>
        <div class="form-group">
          <label>Status<h1></h1></label>
          <select  name="status" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
              <option value="">Pilih Status</option>
              </option>
              <?php foreach($kodestatus as $stat) : ?>
                <?php $select = $stat->code == $pilihan_status_pengadaan ? 'selected' : '' ?>
                <option value="<?php echo $stat->code ?>" <?php echo $select ?>><?php echo $stat->value ?></option>
              <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label>No. Kontrak</label>
          <input type="text" class="form-control" name="nomor_kontrak" placeholder="Nomor Kontrak" value="<?php 
            if(set_value('nomor_kontrak')=="" && isset($nomor_kontrak)){
              echo $nomor_kontrak;
            }else{
              echo  set_value('nomor_kontrak');
            }
            ?>" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="Keterangan" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>><?php 
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
      <div id="success"> 
          <table class="table table-condensed">
              <tr>
                <td>Jumlah Unit</td>
                <td>
                    <div id="jumlah_unit_"></div>
                </td>
              </tr>
              <tr>
                <td>Nilai Pengadaan</td>
                <td>
                  <div id="nilai_pengadaan_"></div>
                </td>
              </tr>
              <tr>
                <td>Waktu dibuat</td>
                <td>
                  <div id="waktu_dibuat_"></div>
                </td>
              </tr>
              <tr>
                <td>Terakhir di edit</td>
                <td>
                  <div id="terakhir_diubah_"></div>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="box-footer">
        <?php if(!isset($viewreadonly)){?><button type="submit" class="btn btn-primary">Simpan</button><?php } ?>
        <button type="button" id="btn-kembali" class="btn btn-warning">Kembali</button>
      </div>
      </div>
    </form>        
    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->      
<div class="box box-success">
  <div class="box-body">
    <div class="div-grid">
        <div id="jqxTabs">
          <?php echo $barang;?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function(){
    $('#btn-kembali').click(function(){
        window.location.href="<?php echo base_url()?>inventory/pengadaanbarang";
    });

    $("#menu_inventory_pengadaanbarang").addClass("active");
    $("#menu_inventory").addClass("active");

    $("#tgl").jqxDateTimeInput({ formatString: 'dd-MM-yyyy', theme: theme});


  });

</script>
