
<script>

	$(function(){
		
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'id_pengadaan', type: 'number' },
			{ name: 'pilihan_keadaan_barang', type: 'string' },
			{ name: 'nama_barang', type: 'string' },
			{ name: 'pilihan_komponen', type: 'string' },
			{ name: 'harga', type: 'double' },
			{ name: 'keterangan_pengadaan', type: 'string' },
			{ name: 'pilihan_status_invetaris', type: 'string' },
			{ name: 'tanggal_pembelian', type: 'date' },
			{ name: 'foto_barang', type: 'string' },
			{ name: 'barang_kembar_proc', type: 'string' },
			{ name: 'keterangan_inventory', type: 'string' },
			{ name: 'tanggal_pengadaan', type: 'date' },
			{ name: 'tanggal_diterima', type: 'date' },
			{ name: 'tanggal_dihapus', type: 'date' },
			{ name: 'alasan_penghapusan', type: 'string' },
			{ name: 'pilihan_asal', type: 'string' },
			{ name: 'value', type: 'string' },
			{ name: 'waktu_dibuat', type: 'date' },
			{ name: 'terakhir_diubah', type: 'date' },
			{ name: 'jumlah', type: 'number' },
			{ name: 'totalharga', type: 'double' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/inv_barang/json/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
            commit(true);
			var arr = $.map(rowData, function(el) { return el });
			//alert(arr[6]); alert(arr[8]);		//6 status
			alert(arr);

				$.post( '<?php echo base_url()?>inventory/inv_barang/updatestatus_barang', {kode_proc:arr[6],pilihan_inv:arr[8]},function( data ) {
						$("#jqxgrid_barang").jqxGrid('updateBoundData');
						
				 });
         },
		filter: function(){
			$("#jqxgrid_barang").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_barang").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				source.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	$('#btn-refresh').click(function () {
			$("#jqxgrid_barang").jqxGrid('clearfilters');
		});
		$("#jqxgrid_barang").jqxGrid(
		{	
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_barang").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_barang").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'nama_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'jumlah ', editable: false,datafield: 'jumlah', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Harga Satuan (Rp.)',editable: false, datafield: 'harga', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Total Harga (Rp.)', editable: false,datafield: 'totalharga', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Keterangan ', editable: false,datafield: 'keterangan_pengadaan', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{
                        text: 'Status', datafield: 'value', width: '7%', columntype: 'dropdownlist',
                        createeditor: function (row, column, editor) {
                            // assign a new data source to the dropdownlist.
                            var list = [<?php foreach ($kodestatus_inv as $key) {?>
							"<?=$key->value?>",
							<?php } ?>];
                            editor.jqxDropDownList({ autoDropDownHeight: true, source: list });
                        },
                        // update the editor's value before saving it.
                        cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
                            // return the old value, if the new value is empty.
                            if (newvalue == "") return oldvalue;
                        }
                 },
				{ text: 'Tanggal di terima',editable: false,datafield: 'tanggal_diterima', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'}
           ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_barang").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_barang').click(function () {
			add_barang();
		});

	});
	function close_popup(){
		$("#popup_barang").jqxWindow('close');
	}

	function add_barang(){
		$("#popup_barang #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo base_url().'inventory/inv_barang/add/'; ?>" , function(data) {
			$("#popup_content").html(data);
		});
		$("#popup_barang").jqxWindow({
			theme: theme, resizable: false,
			width: 500,
			height: 600,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_barang").jqxWindow('open');
	}

	function edit_barang(id_barang,barang_kembar_proc,id_inventaris_barang,id_pengadaan){
		$("#popup_barang #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo base_url().'inventory/inv_barang/edit_barang/';?>" + id_barang+'/'+barang_kembar_proc+'/'+id_inventaris_barang+'/'+id_pengadaan, function(data) {
			$("#popup_content").html(data);
		});
		$("#popup_barang").jqxWindow({
			theme: theme, resizable: false,
			width: 1000,
			height: 600,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_barang").jqxWindow('open');
	}
	function del_barang(id_barang,barang_kembar_proc){
		var confirms = confirm("Hapus Data ?");
		if(confirms == true){
			$.post("<?php echo base_url().'inventory/inv_barang/dodelpermohonan/'; ?>" + id_barang+'/'+barang_kembar_proc,  function(){
				alert('Data berhasil dihapus');

				$("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
			});
		
		}
	}

</script>

<div id="popup_barang" style="display:none">
	<div id="popup_title">Data Barang</div>
	<div id="popup_content">&nbsp;</div>
</div>

<div class="box box-success">
	<div class="box-header">
      <h3 class="box-title">{title_form}</h3>
    </div>
		<div class="box-footer">
	      <div class="col-md-9">
			<button class="btn btn-success" id='btn_add_barang' type='button'><i class='icon-copy'></i> Tambah Barang</button>
			<button type="button" class="btn btn-success" id="btn-refresh"><i class='fa fa-refresh'></i> &nbsp; Refresh</button>
		  </div>
		</div>
		<div class="box-header">
		<div class="col-md-3">
	     		<select name="code_cl_phc" class="form-control" style="width:90">
	     			<option value="">Pilih Puskesmas</option>
					<?php foreach ($get_data_tanah as $row ) { ;?>
					<option value="<?php echo $row->code; ?>" onchange="" ><?php echo $row->uraian; ?></option>
				<?php	} ;?>
	     	</select>
		  </div>
		  <div class="col-md-3">
	     		<select name="code_cl_phc" class="form-control" id="code_cl_phc">
	     			<option value="">Pilih Puskesmas</option>
					<?php foreach ($datapuskesmas as $row ) { ;?>
					<option value="<?php echo $row->code; ?>" onchange="" ><?php echo $row->value; ?></option>
				<?php	} ;?>
	     	</select>
		  </div>
		  <div class="col-md-3">
	     		<select name="code_ruangan" class="form-control" id="code_ruangan">
	     			<option value="">Pilih Ruangan</option>
	     	</select>
		  </div>
		 </div> 
 <div class="box-body">
	<div style="width:100%;">
	    <div class="div-grid">
	      <div id="jqxTabs">
	        <div id="jqxgrid_barang"></div>
	      </div>
	    </div>
	</div>
 </div>
</div>
<script type="text/javascript">
$(function(){
    $("#menu_inventory_inv_barang").addClass("active");
    $("#menu_inventory").addClass("active");
    $('#code_cl_phc').change(function(){
      var code_cl_phc = $(this).val();
      var id_mst_inv_ruangan = '<?php echo set_value('code_ruangan')?>';
      $.ajax({
        url : '<?php echo site_url('inventory/inv_barang/get_ruangan') ?>',
        type : 'POST',
        data : 'code_cl_phc=' + code_cl_phc+'&id_mst_inv_ruangan=' + id_mst_inv_ruangan,
        success : function(data) {
          $('#code_ruangan').html(data);
        }
      });

      return false;
    }).change();

  });

</script>