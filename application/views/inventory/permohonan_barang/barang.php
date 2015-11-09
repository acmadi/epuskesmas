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
		url: "<?php echo site_url('inventory/permohonanbarang/barang/'.$kode); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
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
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
		   	
				{ text: 'No', datafield: 'no', columntype: 'textbox', filtertype: 'none', width: '5%' },
				{ text: 'Nama Barang', datafield: 'nama_barang', columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'Jumlah ', datafield: 'jumlah', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Keterangan',datafield: 'keterangan', columntype: 'textbox', filtertype: 'textbox', width: '40%'}
           ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_barang").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_barang').click(function () {
			edit_barang(0,<?php echo $kode ?>);
		});

	});

	function close_document(){
		$("#popup_barang").jqxWindow('close');
	}

	function edit_barang(id, id_dokumen){
		var offset = $("#jqxgrid_barang").offset();
		$("#popup_barang #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		/*$.get("<?php echo site_url('inventory/permohonanbarang/tambahbarang');?>",{id : id , id_dokumen:id_dokumen}, function(data) {
				$("#popup_barang #popup_content").html(data);
			});*/
		$("#popup_barang").jqxWindow({
			theme: theme, resizable: false,
			width: 400,
			height: 500,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_barang").jqxWindow('open');
	}

	function del_document(id){
		/*var confirms = confirm("Delete File?");
		if(confirms == true){
			$.post('<?php echo site_url('smt_rekam_kegiatan/document/delete') ?>', 'id=' + id, function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
			});
		}*/
	}

</script>

<div id="popup_barang" style="display:none">
	<div id="popup_title">Dara Barang</div>
	<div id="popup_content">&nbsp;</div>
</div>

<div>
	<div style="width:100%;">
	   <?php //if($is_admin == "1" ){ ?>
		<div style="float:right;padding:2px">
			<button class="btn btn-success" id='btn_add_barang' type='button'><i class='icon-copy'></i> Tambah Barang</button>
		</div>
	   <?php // } ?>
        <div id="jqxgrid_barang"></div>
	</div>
</div>