<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inv_permohonan_barang_item', type: 'number' },
			{ name: 'nama_barang', type: 'string' },
			{ name: 'jumlah', type: 'number' },
			{ name: 'keterangan', type: 'string' },
			{ name: 'id_inv_permohonan_barang', type: 'number' },
			{ name: 'code_mst_inv_barang', type: 'string' }
        ],
		url: "<?php echo site_url('inventory/permohonanbarang/document/'.$kode); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_document").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_document").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_document").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
		   	
				{ text: 'No', datafield: 'no', columntype: 'textbox', filtertype: 'none', width: '5%' },
				{ text: 'Nama barang', datafield: 'nama_barang', columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'Jumlah ', datafield: 'jumlah', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Keterangan',datafield: 'keterangan', columntype: 'textbox', filtertype: 'textbox', width: '40%'}
           ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_document").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_document").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_document').click(function () {
			edit_document(0,<?php echo $kode ?>);
		});

	});

	function close_document(){
		$("#popup_document").jqxWindow('close');
	}

	function edit_document(id, id_dokumen){
		var offset = $("#jqxgrid_document").offset();
		$("#popup_document #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo site_url('smt_rekam_kegiatan/document/uploads');?>","id=" + id + '&id_dokumen='+id_dokumen, function(response) {
				$("#popup_document #popup_content").html(response);
			});
		$("#popup_document").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 220,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_document").jqxWindow('open');
	}

	function del_document(id){
		/*var confirms = confirm("Delete File?");
		if(confirms == true){
			$.post('<?php echo site_url('smt_rekam_kegiatan/document/delete') ?>', 'id=' + id, function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_document").jqxGrid('updatebounddata', 'cells');
			});
		}*/
	}

</script>
<div id="popup_document" style="display:none">
	<div id="popup_title">Document</div>
	<div id="popup_content">
			
	</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	   <?php //if($is_admin == "1" ){ ?>
		<div style="float:right;padding:2px">
			<button style='width:150px' id='btn_add_document' type='button'><i class='icon-copy'></i> ADD Document</button>
		</div>
	   <?php// } ?>
        <div id="jqxgrid_document"></div>
	</div>
</div>