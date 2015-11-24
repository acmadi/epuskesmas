
<script>

	$(function(){
		ambil_total();
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
		url: "<?php echo site_url('inventory/pengadaanbarang/barang/'.$kode); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
            commit(true);
			var arr = $.map(rowData, function(el) { return el });
			//alert(arr[6]); alert(arr[8]);		//6 status
			var pengadaan= '<?php echo $kode; ?>';
			//alert(pengadaan);

				$.post( '<?php echo base_url()?>inventory/pengadaanbarang/updatestatus_barang', {kode_proc:arr[6],pilihan_inv:arr[8],id_pengadaan:pengadaan},function( data ) {
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
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\");'></a></div>";
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
                },
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'nama_barang', columntype: 'textbox', filtertype: 'textbox', width: '22%'},
				{ text: 'Jumlah ', editable: false,datafield: 'jumlah', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Harga Satuan (Rp.)',editable: false, datafield: 'harga', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Total Harga (Rp.)', editable: false,datafield: 'totalharga', columntype: 'textbox', filtertype: 'textbox', width: '12%'},
            <?php }else{ ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'nama_barang', columntype: 'textbox', filtertype: 'textbox', width: '27%'},
				{ text: 'Jumlah ', editable: false,datafield: 'jumlah', columntype: 'textbox', filtertype: 'textbox', width: '8%'},
				{ text: 'Harga Satuan (Rp.)',editable: false, datafield: 'harga', columntype: 'textbox', filtertype: 'textbox', width: '12%'},
				{ text: 'Total Harga (Rp.)', editable: false,datafield: 'totalharga', columntype: 'textbox', filtertype: 'textbox', width: '12%'},
            <?php } ?>
				{ text: 'Keterangan ', editable: false,datafield: 'keterangan_pengadaan', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{
                        text: 'Status', datafield: 'value', width: '8%', columntype: 'dropdownlist',
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
	/*8function ambil_total(){
	$("#success").load("<?php echo base_url().'inventory/pengadaanbarang/total_pengadaan/'.$kode ?>", function(response, status, xhr) {
	  if (status == "error") {
	    var msg = "Sorry but there was an error: ";
	    $("#error").html(msg + xhr.status + " " + xhr.statusText);
	  }else{
	    //alert(response);
	  }
	});
	  
	}*/
	function ambil_total()
	{
		$.ajax({
		url: "<?php echo base_url().'inventory/pengadaanbarang/total_pengadaan/'.$kode ?>",
		dataType: "json",
		success:function(data)
		{ 
			$.each(data,function(index,elemet){
				document.getElementById("jumlah_unit_").innerHTML = elemet.jumlah_unit;
				document.getElementById("nilai_pengadaan_").innerHTML = elemet.nilai_pengadaan;
				document.getElementById("waktu_dibuat_").innerHTML = elemet.waktu_dibuat;
				document.getElementById("terakhir_diubah_").innerHTML = elemet.terakhir_diubah;
			});
		}
		});
		/*$.ajax({
        url: "<?php echo base_url().'inventory/pengadaanbarang/total_pengadaan/'.$kode ?>",
        dataType: "json"
		}).success(function(data){
		    $('#jumlah_unit_').append(JSON.stringify(data));
		});*/


		return false;
	}
	function close_popup(){
		$("#popup_barang").jqxWindow('close');
		ambil_total();
	}

	function add_barang(){
		$("#popup_barang #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo base_url().'inventory/pengadaanbarang/add_barang/'.$kode.'/'; ?>" , function(data) {
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

	function edit_barang(id_barang,barang_kembar_proc,id_inventaris_barang){
		$("#popup_barang #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo base_url().'inventory/pengadaanbarang/edit_barang/'.$kode.'/';?>" + id_barang+'/'+barang_kembar_proc+'/'+id_inventaris_barang, function(data) {
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
			$.post("<?php echo base_url().'inventory/pengadaanbarang/dodelpermohonan/'.$kode.'/'; ?>" + id_barang+'/'+barang_kembar_proc,  function(){
				alert('Data berhasil dihapus');

				$("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
			});
			ambil_total();
		}
	}

</script>

<div id="popup_barang" style="display:none">
	<div id="popup_title">Data Barang</div>
	<div id="popup_content">&nbsp;</div>
</div>

<div>
	<div style="width:100%;">
		<div style="padding:5px" class="pull-right">
			<?php if(!isset($viewreadonly)){?><button class="btn btn-success" id='btn_add_barang' type='button'><i class='fa fa-plus-square'></i> Tambah Barang</button><?php } ?>
		</div>
        <div id="jqxgrid_barang"></div>
	</div>
</div>