	<script type="text/javascript">
            $(document).ready(function () {

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
			        });*/      
			        $('#form-ss').submit(function(){
			            var data = new FormData();
			            $('#notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
			            $('#notice').show();

			            data.append('nip_nit', $('input[name="nip_nit"]').val());
			            data.append('urut', $('input[name="urut"]').val());
			            data.append('rt', $('input[name="rt"]').val());
			            data.append('rw', $('input[name="rw"]').val());
			            data.append('propinsi', $('input[name="propinsi"]').val());
			            data.append('kota', $('input[name="kota"]').val());
			            data.append('kecamatan', $('input[name="kecamatan"]').val());
			            data.append('kelurahan', $('input[name="kelurahan"]').val());
			            data.append('nip_nit', $('#v_kode_barang').val());
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
			          placeHolder: " Ketik Kode atau Nama Barang ",
			          theme: 'classic',
			          width: '100%',
			          height: '30px',
			          minLength: 2,
			          source: function (query, response) {
			            var dataAdapter = new $.jqx.dataAdapter
			            (
			              {
			                datatype: "json",
			                  datafields: [
			                  { name: 'uraian', type: 'string'},
			                  { name: 'code', type: 'string'},
			                  { name: 'code_tampil', type: 'string'}
			                ],
			                url: '<?php echo base_url().'inventory/permohonanbarang/autocomplite_barang'; ?>'
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
			                      return item.code_tampil +' | '+item.uraian;
			                    }));
			                  }
			                }
			              });
			          }
			        });

			        $("#jqxinput").select(function(){
			            var codebarang = $(this).val();
			            var res = codebarang.split(" | ");
			            $("#v_nama_barang").val(res[1]);
			            $("#v_kode_barang").val(res[0].replace(/\./g,""));
			        });

			    $("select[name='propinsi']").change(function() {
			      $("select[name='kota']").html("<option>-</option>");
			      $("select[name='kecamatan']").html("<option>-</option>");
			      $("select[name='desa']").html("<option>-</option>");
			      $.get('<?php echo base_url()?>kepegawaian/drh/kota/' + $('select[name=propinsi]').val()+'/0', function(response) {
			        var data = eval(response);
			        $("select[name='kota']").html(data.kota);
			      }, "json");
			    });

			    $("select[name='kota']").change(function() {
			      $("select[name='kecamatan']").html("<option>-</option>");
			      $("select[name='desa']").html("<option>-</option>");
			      $.get('<?php echo base_url()?>kepegawaian/drh/kecamatan/' + $('select[name=kota]').val()+'/0', function(response) {
			        var data = eval(response);
			        $("select[name='kecamatan']").html(data.kecamatan);
			      }, "json");
			    });

			    $("select[name='kecamatan']").change(function() {
			      $("select[name='desa']").html("<option>-</option>");
			      $.get('<?php echo base_url()?>kepegawaian/drh/desa/' + $('select[name=kecamatan]').val()+'/0', function(response) {
			        var data = eval(response);
			        $("select[name='desa']").html(data.desa);
			      }, "json");
			    });



			    $.get('<?php echo base_url()?>kepegawaian/drh/kota/{propinsi}/{kota}', function(response) {
			      var data = eval(response);
			      $("select[name='kota']").html(data.kota);
			    }, "json");

			    $.get('<?php echo base_url()?>kepegawaian/drh/kecamatan/{kota}/{kecamatan}', function(response) {
			      var data = eval(response);
			      $("select[name='kecamatan']").html(data.kecamatan);
			    }, "json");

			    $.get('<?php echo base_url()?>kepegawaian/drh/desa/{kecamatan}/{desa}', function(response) {
			      var data = eval(response);
			      $("select[name='desa']").html(data.desa);
			    }, "json");
            });
        </script>


	<form action="<?php echo base_url()?>kepegawaian/drh/{action}/{id}" method="POST" name="">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<label>No Urut</label>
							<input type="text" class="form-control" name="urut" placeholder="No Urut" value="<?php 
				              if(set_value('urut')=="" && isset($urut)){
				                echo $urut;
				              }else{
				                echo  set_value('urut');
				              }
				            ?>">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php 
				              if(set_value('alamat')=="" && isset($alamat)){
				                echo $alamat;
				              }else{
				                echo  set_value('alamat');
				              }
				            ?>">
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label>RT</label>
							<input type="text" class="form-control" name="rt" placeholder="RT" value="<?php 
				              if(set_value('rt')=="" && isset($rt)){
				                echo $rt;
				              }else{
				                echo  set_value('rt');
				              }
				            ?>">
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label>RW</label>
							<input type="text" class="form-control" name="rw" placeholder="RW" value="<?php 
				              if(set_value('rw')=="" && isset($rw)){
				                echo $rw;
				              }else{
				                echo  set_value('rw');
				              }
				            ?>">
						</div>
						</div>
						<div class="input-group">
					        <span class="input-group-addon">
					          <div style="width:80px">Provinsi</div>
					        </span>
					        <select class="form-control" name="propinsi">{provinsi_option}</select>
					    </div>
					      <br>
					    <div class="input-group">
					        <span class="input-group-addon">
					          <div style="width:80px">Kota / Kab</div>
					        </span>
					        <select class="form-control" name="kota"></select>
					    </div>
					      <br>
					    <div class="input-group">
					        <span class="input-group-addon">
					          <div style="width:80px">Kecamatan</div>
					        </span>
					        <select class="form-control" name="kecamatan"></select>
					    </div>
					      <br>
					    <div class="input-group">
					        <span class="input-group-addon">
					          <div style="width:80px">Desa</div>
					        </span>
					        <select class="form-control" name="desa"></select>
					    </div>
					      
						
					</div>
						<div class="box-footer pull-right">
				          <button type="submit" class="btn btn-primary">Simpan</button>
				          <button type="reset" class="btn btn-warning">Ulang</button>
				          <button type="button" class="btn btn-success" onClick="document.location.href='<?php echo base_url()?>kepegawaian/drh'">Kembali</button>
				        </div>
					<!-- <div id='jqxWidget'>
	        </div>
	        <div style="font-size: 13px; font-family: Verdana;" id="selectionlog">
	        </div> -->
				</div>
			</div>
		</div>
	</form>
