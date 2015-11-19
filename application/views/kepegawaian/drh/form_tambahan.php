<script >
  $(function(){	
		$("#menu_kepegawaian_drh").addClass("active");
		$("#menu_kepegawaian").addClass("active");


	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'nip_nit', type: 'string' },
			{ name: 'urut', type: 'number' },
			{ name: 'alamat', type: 'string' },
			{ name: 'rt', type: 'string' },
			{ name: 'rw', type: 'string' },
			{ name: 'code_cl_province', type: 'string' },
			{ name: 'propinsi', type: 'string' },
			{ name: 'kota', type: 'string' },
			{ name: 'kecamatan', type: 'string' },
			{ name: 'kelurahan', type: 'string' },
			{ name: 'code_cl_district', type: 'string' },
			{ name: 'code_cl_kec', type: 'string' },
			{ name: 'code_cl_village', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
        url: "<?php echo site_url('kepegawaian/json/json_alamat/'.$id); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_alamat").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_alamat").jqxGrid('updatebounddata', 'sort');
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
			$("#jqxgrid_alamat").jqxGrid('clearfilters');
		});

		$("#jqxgrid_alamat").jqxGrid(
		{		
			width: '99%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_alamat").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_alamat(\""+dataRecord.urut+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_alamat").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='delete_alamat(\""+dataRecord.nip_nit+"\",\""+dataRecord.urut+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Alamat ', datafield: 'alamat', columntype: 'textbox', filtertype: 'textbox', width: '30%'},
				{ text: 'RT',datafield: 'rt', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'RW',datafield: 'rw', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Provinsi',datafield: 'propinsi', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Kota',datafield: 'kota', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Kecamatan',datafield: 'kecamatan', columntype: 'textbox', filtertype: 'textbox', width: '15%'},
				{ text: 'Kelurahan',datafield: 'kelurahan', columntype: 'textbox', filtertype: 'textbox', width: '15%'}
            ]
		});

		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_kursus', type: 'string' },
			{ name: 'nama_kursus', type: 'number' },
			{ name: 'id_mst_peg_kursus', type: 'string' },
			{ name: 'nip_nit_diklat', type: 'string' },
			{ name: 'nama_diklat', type: 'string' },
			{ name: 'code_cl_province', type: 'string' },
			{ name: 'lama_diklat', type: 'string' },
			{ name: 'tgl_diklat', type: 'string' },
			{ name: 'tar_penyelengara', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
        url: "<?php echo site_url('kepegawaian/json/json_diklat/'.$id); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_diklat").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_diklat").jqxGrid('updatebounddata', 'sort');
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
     
		$('#btn-refresh-diklat').click(function () {
			$("#jqxgrid_diklat").jqxGrid('clearfilters');
		});

		$("#jqxgrid_diklat").jqxGrid(
		{		
			width: '99%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_diklat").jqxGrid('getrowdata', row);
				    if(dataRecord.edit==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='edit_diklat(\""+dataRecord.nip_nit_diklat+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_diklat").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='delete_diklat(\""+dataRecord.nip_nit+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'Nama Kursus ', datafield: 'nama_kursus', columntype: 'textbox', filtertype: 'textbox', width: '30%'},
				{ text: 'Nama Diklat',datafield: 'nama_diklat', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Lama Diklat',datafield: 'lama_diklat', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Tanggal Diklat',datafield: 'tgl_diklat', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Penyelenggara',datafield: 'tar_penyelengara', columntype: 'textbox', filtertype: 'textbox', width: '15%'}
            ]
		});

        $("#jqxNavigationBar").jqxNavigationBar({ width: '100%', height: '100%',expandMode: 'multiple', expandedIndexes: [1]});

        $('#clearfilteringbutton').click(function () {
			$("#jqxgrid_alamat").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_alamat").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_alamat').click(function () {
			add_alamat();
		});

		$('#btn_add_diklat').click(function () {
			add_diklat();
		});

        $("select[name='code_cl_province']").change(function(){
			$.post("<?php echo base_url().'kepegawaian/drh/filter_district' ?>", 'code_cl_province='+$(this).val(),  function(){
				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			});
	    });
	});

	function close_popup(){
		$("#popup_alamat").jqxWindow('close');
	}

	function add_alamat(){
		$("#popup_alamat #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo site_url().'kepegawaian/drh/add_alamat/'.$id; ?>" , function(data) {
			$("#popup_content").html(data);
		});
		$("#popup_alamat").jqxWindow({
			theme: theme, resizable: true,
			width: '40%',
			height: '75%',
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_alamat").jqxWindow('open');
	}

	function edit_alamat(urut){
		$("#popup_alamat #popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo site_url().'kepegawaian/drh/edit_alamat/'.$id; ?>/" +urut, function(data) {
			$("#popup_content").html(data);
		});
		$("#popup_alamat").jqxWindow({
			theme: theme, resizable: true,
			width: '40%',
			height: '75%',
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_alamat").jqxWindow('open');
	}

	function delete_alamat(id,urut){
		var confirms = confirm("Hapus Data ?");
		if(confirms == true){
			$.post("<?php echo base_url().'kepegawaian/drh/dodel_alamat/'.$id; ?>/" +urut ,  function(){
				alert('Data berhasil dihapus');

				$("#jqxgrid_alamat").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

// DIKLAT
	
	function close_popup_diklat(){
		$("#popup_diklat").jqxWindow('close');
	}

	function add_diklat(){
		$("#popup_diklat #popup_content_diklat").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo site_url().'kepegawaian/drh/add_diklat/'.$id; ?>" , function(data) {
			$("#popup_content_diklat").html(data);
		});
		$("#popup_diklat").jqxWindow({
			theme: theme, resizable: false,
			width: '40%',
			height: '75%',
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});

		$("#popup_diklat").jqxWindow('open');
	}
			
 </script>
<div id='jqxWidget' style="float: left;width:100%">
        <div id='jqxNavigationBar'>
        	<div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                     </div>
                    <div style='margin-left: 4px; float: left;'>
                        Alamat</div>
                </div>
            </div>
            <div>
				<button class="btn btn-primary" id='btn_add_alamat' type='button' ><i class='icon-copy'></i> Tambah Alamat</button>
		 		<button type="button" class="btn btn-success" id="btn-refresh"><i class='fa fa-refresh'></i> &nbsp; Refresh</button>
                <div id="jqxgrid_alamat"></div>
            </div>
            <div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                    </div>
                    <div style='margin-left: 4px; float: left;'>
                        Diklat</div>
                </div>
            </div>
            <div>
				<button class="btn btn-primary" id='btn_add_diklat' type='button' ><i class='icon-copy'></i> Tambah Diklat</button>
		 		<button type="button" class="btn btn-success" id="btn-refresh-diklat"><i class='fa fa-refresh'></i> &nbsp; Refresh</button>
                <div id="jqxgrid_diklat"></div>
            </div>
            <div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                    </div>
                    <div style='margin-left: 4px; float: left;'>
                        Contacts</div>
                </div>
            </div>
            <div>
                <ul>
                    <li><a href='#'>Business Cards</a></li>
                    <li><a href='#'>Address Cards</a></li>
                    <li><a href='#'>Detailed Address Cards</a></li>
                    <li><a href='#'>Phone List</a></li>
                </ul>
            </div>
            <div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                    </div>
                    <div style='margin-left: 4px; float: left;'>
                        Tasks</div>
                </div>
            </div>
            <div>
                <ul>
                    <li><a href='#'>Simple List</a></li>
                    <li><a href='#'>Detailed List</a></li>
                    <li><a href='#'>Active Tasks</a></li>
                    <li><a href='#'>Phone List</a></li>
                </ul>
            </div>
            <div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                    </div>
                    <div style='margin-left: 4px; float: left;'>
                        Notes</div>
                </div>
            </div>
            <div>
                <ul>
                    <li><a href='#'>Icons</a></li>
                    <li><a href='#'>Notes List</a></li>
                    <li><a href='#'>Last Seven Days</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="popup_alamat" style="display:none">
		<div id="popup_title">Data Alamat Pegawai</div>
		<div id="popup_content">&nbsp;</div>
	</div>
	<div id="popup_diklat" style="display:none">
		<div id="popup_title">Data Diklat Pegawai</div>
		<div id="popup_content_diklat">&nbsp;</div>
	</div>



