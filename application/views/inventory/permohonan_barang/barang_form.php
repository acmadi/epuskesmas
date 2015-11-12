</style>
<script type="text/javascript">
    $(function(){

      $('#btn-close').click(function(){
        close_popup();
      });

      /*$('#code_mst_inv_barang').change(function(){
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
*/
        $('#form-ss').submit(function(){
            var data = new FormData();
            $('#notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
            $('#notice').show();

            data.append('id_inv_permohonan_barang', $('input[name="id_inv_permohonan_barang"]').val());
            data.append('jumlah', $('input[name="jumlah"]').val());
            data.append('nama_barang', $('input[name="nama_barang"]').val());
            data.append('code_mst_inv_barang', $('#v_kode_barang').val());
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
        $("#jqxinput").jqxInput(
          {
          theme: 'classic',
          width: "100%",
          height: 30,
          source: function (query, response) {
            var dataAdapter = new $.jqx.dataAdapter
            (
              {
                  datatype: "json",
                    datafields: [
                  { name: 'uraian', type: 'string'},
                  { name: 'code', type: 'number'}
                ],
                url: '<?php echo base_url().'inventory/permohonanbarang/autocomplite_barang' ?>'
              },
              {
                autoBind: true,
                formatData: function (data) {
                  data.query = query;
                  return data;
                },
                loadComplete: function (data) {
                  if (data.length > 0) {
                    response($.map(data, function (item) {
                      return item.code+' | '+item.uraian;
                    }));
                  }
                }
              }
            );
          }
        });

        $("#jqxinput").change(function(){
            var codebarang = document.getElementById("jqxinput").value;
            var res = codebarang.split(" | ");
            document.getElementById("v_nama_barang").value = res[1];
            document.getElementById("v_kode_barang").value = res[0];
        });
/*        var countries = new Array(<?php 
          foreach ($kodebarang as $barang) {
          
          echo "\"".$barang->code."#".$barang->uraian."\", ";
        }?>);
        $("#code_mst_inv_barang").jqxInput({placeHolder: "Kode Nama Barang", height: 25, width: 200, minLength: 1,  source: countries });        */
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
              <input id="jqxinput" class="form-control" name="code_mst_inv" type="text" value="<?php 
                if(set_value('code_mst_inv_barang')=="" && isset($code_mst_inv_barang)){
                  echo $code_mst_inv_barang;
                }else{
                  echo  set_value('code_mst_inv_barang');
                }
                ?>" />
              <input id="v_kode_barang" class="form-control" name="code_mst_inv_barang" type="hidden" value="<?php 
                if(set_value('code_mst_inv_barang')=="" && isset($code_mst_inv_barang)){
                  echo $code_mst_inv_barang;
                }else{
                  echo  set_value('code_mst_inv_barang');
                }
                ?>" />
              <!--<input type="text" class="form-control" id="code_mst_inv_barang" name="code_mst_inv_barang"> 
                  <select  name="code_mst_inv_barang" id="code_mst_inv_barang" class="form-control">
                  <option value=""
                  </option>
                  <?php /*foreach($kodebarang as $barang) : ?>
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
                  <?php endforeach */?>
              </select>-->
            </div>
            <div class="form-group">
              <label>Nama Baranga</label>
              <input type="text" class="autocomplete form-control" id="v_nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?php
              if(set_value('nama_barang')=="" && isset($nama_barang)){
                  echo $nama_barang;
                }else{
                  echo  set_value('nama_barang');
                }
                ?>">
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
