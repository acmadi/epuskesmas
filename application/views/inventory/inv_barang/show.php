
<script>

	$(function(){
		
	<?php 	if(!isset($filter_golongan_invetaris) || $filter_golongan_invetaris ==''){ ?>		
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
     	
		$("#jqxgrid_barang").jqxGrid(
		{	
			width: '99%',
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

		var sourceHapus = { 
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
		url: "<?php echo site_url('inventory/json/Atanah/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
            commit(true);
			var arr = $.map(rowData, function(el) { return el });
			//alert(arr[6]); alert(arr[8]);		//6 status
			alert(arr);

				$.post( '<?php echo base_url()?>inventory/inv_barang/updatestatus_barang', {kode_proc:arr[6],pilihan_inv:arr[8]},function( data ) {
						$("#jqxgrid_DataHapus").jqxGrid('updateBoundData');
						
				 });
         },
		filter: function(){
			$("#jqxgrid_DataHapus").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_DataHapus").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceHapus.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(sourceHapus, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_DataHapus").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: sourceHapus, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_DataHapus").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_DataHapus").jqxGrid('getrowdata', row);
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
		
		<?php	}else  if(isset($filter_golongan_invetaris)){
	    		if($filter_golongan_invetaris=='0100000000'){ ?>
		var sourceGolonganA = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'satuan', type: 'string' },
			{ name: 'hak', type: 'string' },
			{ name: 'penggunaan', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'luas', type: 'double' },
			{ name: 'jumlah', type: 'double' },
			{ name: 'jumlah_satuan', type: 'string' },
			{ name: 'alamat', type: 'text' },
			{ name: 'pilihan_satuan_barang', type: 'string' },
			{ name: 'pilihan_status_hak', type: 'number' },
			{ name: 'status_sertifikat_tanggal', type: 'double' },
			{ name: 'status_sertifikat_nomor', type: 'string' },
			{ name: 'pilihan_penggunaan', type: 'number' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_A/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$(".jqxgrid_Golongan_A").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$(".jqxgrid_Golongan_A").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganA.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_A = new $.jqx.dataAdapter(sourceGolonganA, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_A").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_A, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_A").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_A").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Luas ', editable: false,datafield: 'luas', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Alamat',editable: false, datafield: 'alamat', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Jumlah Barang',editable: false, datafield: 'jumlah_satuan', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Hak', editable: false,datafield: 'hak', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Tanggal Sertifikat',editable: false,datafield: 'status_sertifikat_tanggal', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'},
				{ text: 'Nomor Sertifikat', editable: false,datafield: 'status_sertifikat_nomor', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Pilihan Penggunaan', editable: false,datafield: 'penggunaan', columntype: 'textbox', filtertype: 'textbox', width: '15%'}

				
           ]
		});
		$("#jqxgrid_Golongan_A_hapus").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_A, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_A_hapus").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_A_hapus").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Luas ', editable: false,datafield: 'luas', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Alamat',editable: false, datafield: 'alamat', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Jumlah Barang',editable: false, datafield: 'jumlah_satuan', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Hak', editable: false,datafield: 'hak', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Tanggal Sertifikat',editable: false,datafield: 'status_sertifikat_tanggal', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'},
				{ text: 'Nomor Sertifikat', editable: false,datafield: 'status_sertifikat_nomor', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Pilihan Penggunaan', editable: false,datafield: 'penggunaan', columntype: 'textbox', filtertype: 'textbox', width: '15%'}

				
           ]
		});

		<?php	}else if($filter_golongan_invetaris=='0200000000'){ ?>

		var sourceGolonganB = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'merek_type', type: 'text' },
			{ name: 'identitas_barang', type: 'text' },
			{ name: 'bahan', type: 'string' },
			{ name: 'satuan', type: 'string' },
			{ name: 'pilihan_bahan', type: 'string' },
			{ name: 'ukuran_barang', type: 'string' },
			{ name: 'ukuran_satuan', type: 'string' },
			{ name: 'pilihan_satuan', type: 'string' },
			{ name: 'tanggal_bpkb', type: 'date' },
			{ name: 'nomor_bpkb', type: 'string' },
			{ name: 'no_polisi', type: 'string' },
			{ name: 'tanggal_perolehan', type: 'date' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_B/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$("#jqxgrid_Golongan_B").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_Golongan_B").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganB.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_B = new $.jqx.dataAdapter(sourceGolonganB, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_B").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_B, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_B").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_B").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Merek Tipe ', editable: false,datafield: 'merek_type', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Identitas Barang',editable: false, datafield: 'identitas_barang', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Pilihan Bahan', editable: false,datafield: 'bahan', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Ukuran Barang ', editable: false,datafield: 'ukuran_satuan', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal BPKB',editable: false,datafield: 'tanggal_bpkb', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'},
				{ text: 'Nomor BPKB ', editable: false,datafield: 'nomor_bpkb', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'No Polisi ', editable: false,datafield: 'no_polisi', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal Perolehan',editable: false,datafield: 'tanggal_perolehan', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'}
           ]
		});
		
		<?php	}else if($filter_golongan_invetaris=='0300000000'){ ?>

		var sourceGolonganC = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'luas_lantai', type: 'string' },
			{ name: 'hak', type: 'string' },
			{ name: 'tingkat', type: 'string' },
			{ name: 'beton', type: 'string' },
			{ name: 'letak_lokasi_alamat', type: 'text' },
			{ name: 'pillihan_status_hak', type: 'string' },
			{ name: 'nomor_kode_tanah', type: 'string' },
			{ name: 'pilihan_kons_tingkat', type: 'string' },
			{ name: 'pilihan_kons_beton', type: 'string' },
			{ name: 'dokumen_tanggal', type: 'date' },
			{ name: 'dokumen_nomor', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_C/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$("#jqxgrid_Golongan_C").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_Golongan_C").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganC.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_C = new $.jqx.dataAdapter(sourceGolonganC, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_C").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_C, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_C").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_C").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Luas Lantai ', editable: false,datafield: 'luas_lantai', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Lokasi Alamat',editable: false, datafield: 'letak_lokasi_alamat', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Status Hak', editable: false,datafield: 'hak', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Kode Tanah ', editable: false,datafield: 'nomor_kode_tanah', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Kontruksi Tingkat ', editable: false,datafield: 'tingkat', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Kontruksi Beton ', editable: false,datafield: 'beton', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Nomor Dokumen', editable: false,datafield: 'dokumen_nomor', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal Dokumen',editable: false,datafield: 'dokumen_tanggal', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'}
           ]
		});
		
		<?php	}else if($filter_golongan_invetaris=='0400000000'){ ?>

		var sourceGolonganD = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'konstruksi', type: 'string' },
			{ name: 'panjang', type: 'double' },
			{ name: 'lebar', type: 'string' },
			{ name: 'luas', type: 'string' },
			{ name: 'tanah', type: 'tanah' },
			{ name: 'dokumen_tanggal', type: 'date' },
			{ name: 'dokumen_nomor', type: 'string' },
			{ name: 'pilihan_status_tanah', type: 'string' },
			{ name: 'nomor_kode_tanah', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_D/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$("#jqxgrid_Golongan_D").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_Golongan_D").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganD.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_D = new $.jqx.dataAdapter(sourceGolonganD, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_D").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_D, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_D").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_D").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang',editable: false, datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Kontruksi ', editable: false,datafield: 'konstruksi', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Panjang ', editable: false,datafield: 'panjang', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Lebar',editable: false, datafield: 'lebar', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Luas', editable: false,datafield: 'luas', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Nomor Dokumen ', editable: false,datafield: 'dokumen_nomor', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal Dokumen',editable: false,datafield: 'dokumen_tanggal', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'},
				{ text: 'Status Tanah ', editable: false,datafield: 'tanah', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Nomor Kode Tanah ', editable: false,datafield: 'nomor_kode_tanah', columntype: 'textbox', filtertype: 'textbox', width: '13%'}
           ]
		});
		
		<?php	}else if($filter_golongan_invetaris=='0500000000'){ ?>
	

		var sourceGolonganE = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'satuan', type: 'string' },
			{ name: 'bahan', type: 'string' },
			{ name: 'flora_ukuran_satuan', type: 'string' },
			{ name: 'buku_judul_pencipta', type: 'string' },
			{ name: 'buku_spesifikasi', type: 'double' },
			{ name: 'budaya_asal_daerah', type: 'string' },
			{ name: 'budaya_pencipta', type: 'string' },
			{ name: 'pilihan_budaya_bahan', type: 'string' },
			{ name: 'flora_fauna_jenis', type: 'string' },
			{ name: 'flora_fauna_ukuran', type: 'string' },
			{ name: 'pilihan_satuan', type: 'string' },
			{ name: 'tahun_cetak_beli', type: 'date' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_E/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$("#jqxgrid_Golongan_E").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_Golongan_E").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganE.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_E = new $.jqx.dataAdapter(sourceGolonganE, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_E").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_E, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_E").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_E").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Judul Pencipta Buku ', editable: false,datafield: 'buku_judul_pencipta', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Spesifikasi Buku',editable: false, datafield: 'buku_spesifikasi', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Asal Budaya Daerah', editable: false,datafield: 'budaya_asal_daerah', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Budaya Pencipta ', editable: false,datafield: 'budaya_pencipta', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Bahan Budaya ', editable: false,datafield: 'pilihan_budaya_bahan', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Jenis Flora Fauna ', editable: false,datafield: 'flora_fauna_jenis', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Ukuran Flora Fauna ', editable: false,datafield: 'flora_ukuran_satuan', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal Cetak Beli',editable: false,datafield: 'tahun_cetak_beli', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'}
           ]
		});


		<?php	}else if($filter_golongan_invetaris=='0600000000'){ ?>
		
		var sourceGolonganF = { 
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_inventaris_barang', type: 'number' },
			{ name: 'id_mst_inv_barang', type: 'string' },
			{ name: 'uraian', type: 'string' },
			{ name: 'bangunan', type: 'string' },
			{ name: 'pilihan_konstruksi_beton', type: 'double' },
			{ name: 'luas', type: 'string' },
			{ name: 'tanah', type: 'string' },
			{ name: 'beton', type: 'string' },
			{ name: 'tingkat', type: 'string' },
			{ name: 'lokasi', type: 'string' },
			{ name: 'dokumen_tanggal', type: 'date' },
			{ name: 'dokumen_nomor', type: 'string' },
			{ name: 'tanggal_mulai', type: 'string' },
			{ name: 'pilihan_status_tanah', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
		url: "<?php echo site_url('inventory/json/Golongan_F/'); ?>",
		cache: false,
		updateRow: function (rowID, rowData, commit) {
         },
		filter: function(){
			$("#jqxgrid_Golongan_F").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_Golongan_F").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				sourceGolonganF.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var data_golongan_F = new $.jqx.dataAdapter(sourceGolonganF, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     	
		$("#jqxgrid_Golongan_F").jqxGrid(
		{	
			width: '99%',
			selectionmode: 'singlerow',
			source: data_golongan_F, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},

			columns: [
			<?php if(!isset($viewreadonly)){?>	{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false,editable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_F").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\",\""+dataRecord.id_inventaris_barang+"\",\""+dataRecord.id_pengadaan+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', editable: false,filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_Golongan_F").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del_barang(\""+dataRecord.id_mst_inv_barang+"\",\""+dataRecord.barang_kembar_proc+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },<?php } ?>
				{ text: 'Kode Barang',editable: false, datafield: 'id_mst_inv_barang', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Nama Barang ', editable: false,datafield: 'uraian', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Bangunan', editable: false,datafield: 'bangunan', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Kontruksi Tingkat', editable: false,datafield: 'tingkat', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Kontruksi Beton', editable: false,datafield: 'beton', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Luas',editable: false, datafield: 'luas', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Lokasi', editable: false,datafield: 'lokasi', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Tanggal Dokumen', editable: false,datafield: 'dokumen_tanggal', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Nomor Dokumen', editable: false,datafield: 'dokumen_nomor', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Status Tanah ', editable: false,datafield: 'tanah', columntype: 'textbox', filtertype: 'textbox', width: '13%'},
				{ text: 'Tanggal Mulai',editable: false,datafield: 'tanggal_mulai', columntype: 'date', filtertype: 'date', cellsformat: 'dd-MM-yyyy', width: '10%'}
           ]
		});
		<?php }} ?>
        $('#btn-refresh').click(function () {
			$("#jqxgrid_barang").jqxGrid('clearfilters');
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
			width: 1000,
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
	     		<select name="golongan_invetaris" id="golongan_invetaris" class="form-control" style="width:90">
	     			 <option value="">Pilih KIB Inventaris </option>
	     			 <?php 
	     			 	for($baris=0;$baris<count($get_data_tanah);$baris++) {
	     			 		echo "<option value=\"".$get_data_tanah[$baris][0]."\">";
	     			 			echo $get_data_tanah[$baris][1];
	     			 		echo "</option>";
	     			 	}

	     			 ?>
					<!--<?php /*foreach ($get_data_tanah as $row ) { ;?>
					<?php $select = $row->code == $filter_golongan_invetaris ? 'selected' : '' ?>
					<option value="<?php echo $row->code; ?>" onchange="" <?php echo $select ?>><?php echo $row->uraian; ?></option>
				<?php	} ;*/?>-->
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
		  <div class="col-md-3"><?php echo $this->session->userdata('filterGIB').'asdfsadfasdfasdf'.$this->session->userdata('filterHAPUS'); ?>
	     		<select name="code_ruangan" class="form-control" id="code_ruangan">
	     			<option value="">Pilih Ruangan</option>
	     	</select>
		  </div>
		 </div> 
 <div class="box-body">
	<div style="width:100%;">
	    <div class="div-grid">
	      <div id='jqxtabs'>
	      	<ul style='margin-left: 20px;'>
	    <?php 	if(!isset($filter_golongan_invetaris) || $filter_golongan_invetaris ==''){ ?>	
	     	
	            <li id="inventaris_">Inventaris</li>
	            <li id="barang_hapus">Barang Dihapus</li>

	    <?php	}else  if(isset($filter_golongan_invetaris)){
	    		if($filter_golongan_invetaris=='0100000000'){ ?>

	            <li id="kibA">KIB A</li>
	            <li id="hapusA">Barang Dihapus</li>

	    <?php	}else if($filter_golongan_invetaris=='0200000000'){ ?>

	            <li id="kibB">KIB B</li>
	            <li id="hapusB">Barang Dihapus</li>

	    <?php	}else if($filter_golongan_invetaris=='0300000000'){ ?>

	            <li id="kibC">KIB C</li>
	            <li id="hapusC">Barang Dihapus</li>

	    <?php	}else if($filter_golongan_invetaris=='0400000000'){ ?>

	            <li id="kibD">KIB D</li>
	            <li id="hapusD">Barang Dihapus</li>

	    <?php	}else if($filter_golongan_invetaris=='0500000000'){ ?>

	            <li id="kibE">KIB E</li>
	            <li id="hapusE">Barang Dihapus</li>

	    <?php	}else if($filter_golongan_invetaris=='0600000000'){ ?>

	            <li id="kibF">KIB F</li>
	            <li id="hapusF">Barang Dihapus</li>
	    <?php		}	 
				} 
		?> 


	        </ul>
	     <?php 		if(!isset($filter_golongan_invetaris) || $filter_golongan_invetaris ==''){ ?>	
	        		<div><div id="jqxgrid_barang"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>

	    <?php		}else  if(isset($filter_golongan_invetaris)){
     				if($filter_golongan_invetaris=='0100000000'){ ?>

			        		<div><div id="jqxgrid_Golongan_A"></div></div>
			        		<div><div id="jqxgrid_Golongan_A_hapus"></div></div>


	    <?php		}else if($filter_golongan_invetaris=='0200000000'){ ?>
		        	
	        		<div><div id="jqxgrid_Golongan_B"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>

	    <?php		}else if($filter_golongan_invetaris=='0300000000'){ ?>

	        		<div><div id="jqxgrid_Golongan_C"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>

	    <?php		}else if($filter_golongan_invetaris=='0400000000'){ ?>

	        		<div><div id="jqxgrid_Golongan_D"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>

	    <?php		}else if($filter_golongan_invetaris=='0500000000'){ ?>

	        		<div><div id="jqxgrid_Golongan_E"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>

	    <?php		}else if($filter_golongan_invetaris=='0600000000'){ ?>

	        		<div><div id="jqxgrid_Golongan_F"></div></div>
	        		<div><div id="jqxgrid_DataHapus"></div></div>
		<?php		}	 
				} 
		?>        		
	      </div>
	    </div>
	</div>
 </div>
</div>
	
        
<script type="text/javascript">
$(function(){
	$('#jqxtabs').jqxTabs({ width: "100%", });
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
    $("#golongan_invetaris").change(function(){
		$.post("<?php echo base_url().'inventory/inv_barang/filter_golongan_invetaris' ?>", 'golongan_invetaris='+$(this).val(),  function(){
			location.reload(); 
		});
	});


    <?php 	if(!isset($filter_golongan_invetaris) || $filter_golongan_invetaris ==''){ ?>	
	     	$("#inventaris_").click(function(){
	     		alert('Inventaris_');
	     	});
	     	$("#barang_hapus").click(function(){
	     		alert ('barang_hapus');
	     	});

    <?php	}else  if(isset($filter_golongan_invetaris)){
    		if($filter_golongan_invetaris=='0100000000'){ ?>

            $("#kibA").click(function(){
	     		$.post("<?php echo base_url().'inventory/inv_barang/filterGIB' ?>", 'filterGIB_='+ '0100000000',  function(){
					$("#jqxgrid_Golongan_A").jqxGrid('updatebounddata', 'cells');
				});
	     	});
	     	$("#hapusA").click(function(){
	     		$.post("<?php echo base_url().'inventory/inv_barang/filterHAPUS' ?>", 'filterHAPUS_='+'0100000000',  function(){
					$("#jqxgrid_Golongan_A").jqxGrid('updatebounddata', 'cells');
				});
	     	});

    <?php	}else if($filter_golongan_invetaris=='0200000000'){ ?>

            $("#kibB").click(function(){
	     		alert('kibB');
	     	});
	     	$("#hapusB").click(function(){
	     		alert ('hapusB');
	     	});

    <?php	}else if($filter_golongan_invetaris=='0300000000'){ ?>

            $("#kibC").click(function(){
	     		alert('kibC');
	     	});
	     	$("#hapusC").click(function(){
	     		alert ('hapusC');
	     	});

    <?php	}else if($filter_golongan_invetaris=='0400000000'){ ?>

            $("#kibD").click(function(){
	     		alert('kibD');
	     	});
	     	$("#hapusD").click(function(){
	     		alert ('hapusD');
	     	});

    <?php	}else if($filter_golongan_invetaris=='0500000000'){ ?>

            $("#kibE").click(function(){
	     		alert('kibE');
	     	});
	     	$("#hapusE").click(function(){
	     		alert ('hapusE');
	     	});

    <?php	}else if($filter_golongan_invetaris=='0600000000'){ ?>

            $("#kibF").click(function(){
	     		alert('kibF');
	     	});
	     	$("#hapusF").click(function(){
	     		alert ('hapusF');
	     	});
    <?php		}	 
			} 
		?> 


  });


</script>
    
	
	