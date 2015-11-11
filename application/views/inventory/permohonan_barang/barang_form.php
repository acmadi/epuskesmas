<script type="text/javascript">
    $(function(){

      $('#btn-close').click(function(){
        close_popup();
      });

      $('#code_mst_inv_barang').change(function(){
          var code = $(this).val();
          $.ajax({
            url : '<?php echo base_url().'inventory/permohonanbarang/get_nama' ?>',
            type : 'POST',
            data : 'code=' + code,
            success : function(data) {
              $('input[name="nama_barang"]').val(data);
            }
          });

          return false;
        });

        $('#form-ss').submit(function(){
            var data = new FormData();
            $('#notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
            $('#notice').show();

            data.append('id_inv_permohonan_barang', $('input[name="id_inv_permohonan_barang"]').val());
            data.append('jumlah', $('input[name="jumlah"]').val());
            data.append('nama_barang', $('input[name="nama_barang"]').val());
            data.append('code_mst_inv_barang', $('select[name="code_mst_inv_barang"]').val());
            data.append('keterangan', $('#keterangan').val());
            $.ajax({
                cache : false,
                contentType : false,
                processData : false,
                type : 'POST',
                url : '<?php echo base_url()."inventory/permohonanbarang/".$action."_barang/".$kode."/".$code_cl_phc."/".$id_inv_permohonan_barang_item ?>',
                data : data,
                success : function(response){
                  var res  = response.split("|");
                  if(res[0]=="OK"){
                      $('#notice').hide();
                      $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                      $('#notice').show();

                      $("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
                      close_popup();
                  }
                  else if(res[0]=="Error"){
                      $('#notice').hide();
                      $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                      $('#notice').show();
                  }
                  else{
                      $('#popup_content').html(response);
                  }
              }
            });

            return false;
        });
    });
</script>
<div style="padding:15px">
  <div id="notice" class="alert alert-success alert-dismissable" <?php if ($notice==""){ echo 'style="display:none"';} ?> >
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
    <i class="icon fa fa-check"></i>
    Information!
    </h4>
    <div id="notice-content">{notice}</div>
  </div>
	<div class="row">
    <?php echo form_open(current_url(), 'id="form-ss"') ?>
          <div class="box-body">
            <div class="form-group">
              <label>Kode Barang</label>
               <select  name="code_mst_inv_barang" id="code_mst_inv_barang" class="form-control">
                  <option value=""
                  </option>
                  <?php foreach($kodebarang as $barang) : ?>
                    <?php 
                    if(isset($code_mst_inv_barang) && $code_mst_inv_barang==$barang->code){
                      $select = $barang->code == $code_mst_inv_barang ? 'selected' : '';
                    }elseif(set_value('code_mst_inv_barang')!=""){
                      $select = $barang->code == set_value('code_mst_inv_barang') ? 'selected' : '';
                    }else{
                      $select ='';
                    } 
                    ?>
                    <option value="<?php echo $barang->code ?>" <?php echo $select ?>><?php echo $barang->code.' - '.$barang->uraian ?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Baranga</label>
              <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="<?php
              if(set_value('nama_barang')=="" && isset($nama_barang)){
                  echo $nama_barang;
                }else{
                  echo  set_value('nama_barang');
                }
                ?>">
              <!--<select name="nama_barang" id="nama_barang"  class="form-control">
                  <option value="">Pilih Nama Barang</option>
              </select>-->
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="<?php 
                if(set_value('jumlah')=="" && isset($jumlah)){
                  echo $jumlah;
                }else{
                  echo  set_value('jumlah');
                }
                ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"><?php 
                  if(set_value('keterangan')=="" && isset($keterangan)){
                    echo $keterangan;
                  }else{
                    echo  set_value('keterangan');
                  }
                  ?></textarea>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" id="btn-close" class="btn btn-warning">Batal</button>
        </div>
    </div>
</form>
</div>