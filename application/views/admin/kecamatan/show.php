<script>
	$(function(){
	   var theme = "base";
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_kecamatan', type: 'number' },
			{ name: 'nama_kecamatan',  type: 'string' }
		],
		url: "<?php echo base_url(); ?>index.php/admin_master_kecamatan/json_kecamatan",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
				var data = rowdata;
				$.ajax({
					dataType: 'json',
					type: "POST",
					url: 'data.php',
					data: data,
					success: function (data, status, xhr) {
						commit(true);
					}
				});		
			},
		filter: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
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
     
        $("#jqxgrid").jqxGrid({		
			width: '48%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Proses', align: 'center', columntype: 'none', filtertype: 'none', sortable: false, width: 47, cellsrenderer: function (row) {
				     var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                     return "<div style='text-align: center;padding:3px'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='dodel("+dataRecord.id_kecamatan+")'></a>  <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id_kecamatan+");'></a></div>";
                 }
                },
				{ text: 'ID Kecamatan', datafield: 'id_kecamatan', filtertype: 'textbox',  width: 100},
				{ text: 'Nama Kecamatan', datafield: 'nama_kecamatan', filtertype: 'textbox', width: 320 }
			]
		});
        
		$('#clearfilteringbutton').jqxButton({ height: 25, theme: theme });
        $('#btn_tambah').jqxButton({height: 25, theme: theme});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
        $('#btn_tambah').click(function(){
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			$("#popup").jqxWindow({
				theme: theme, resizable: true,
                width: 500,
                height: 215,
    			isModal: true, autoOpen: false, modalOpacity: 0.2
			});
            $("#popup_title").html("Kecamatan &raquo; Tambah");
            $("#popup").jqxWindow('open');
			$.get("<?php echo base_url();?>index.php/admin_master_kecamatan/add" , function(response) {
				$("#popup_content").html("<div>"+response+"</div>");
			});
		});
	});

	function save_add_dialog(content){
		$.ajax({ 
			type: "POST",
			url: "<?php echo base_url()?>index.php/admin_master_kecamatan/doadd",
			data: content,
			success: function(response){
				 if(response=="1"){
					 close_dialog();
					 $('#clearfilteringbutton').click();
					 $.notific8('Notification', {
					  life: 5000,
					  message: 'Save data succesfully.',
					  heading: 'Saving data',
					  theme: 'lime'
					});
				 }else{
					 $.notific8('Notification', {
					  life: 5000,
					  message: response,
					  heading: 'Saving data FAIL',
					  theme: 'red'
					});
				 }
			}
		 }); 		
	}

	function edit(id){
		$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$("#popup").jqxWindow({
			theme: theme, resizable: true,
            width: 500,
            height: 220,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
        $("#popup_title").html("Kecamatan &raquo; Edit");
        $("#popup").jqxWindow('open');
		$.get("<?php echo base_url();?>index.php/admin_master_kecamatan/edit/"+id , function(response) {
			$("#popup_content").html("<div>"+response+"</div>");
		});
	}

	function save_edit_dialog(content){
		$.ajax({ 
			type: "POST",
			url: "<?php echo base_url()?>index.php/admin_master_kecamatan/doedit",
			data: content,
			success: function(response){
				 if(response=="1"){
					 close_dialog();
					 $('#clearfilteringbutton').click();
					 $.notific8('Notification', {
					  life: 5000,
					  message: 'Save data succesfully.',
					  heading: 'Saving data',
					  theme: 'lime'
					});
				 }else{
					 $.notific8('Notification', {
					  life: 5000,
					  message: response,
					  heading: 'Saving data FAIL',
					  theme: 'red'
					});
				 }
			}
		 }); 		
	}

	function dodel(id){
		if(confirm("Anda yakin akan menghapus data ("+id+") ini?")){
			$.ajax({ 
				type: "POST",
				url: "<?php echo base_url()?>index.php/admin_master_kecamatan/dodel/"+id,
				success: function(response){
					 if(response=="1"){
						 $('#clearfilteringbutton').click();
						 $.notific8('Notification', {
						  life: 5000,
						  message: 'Delete data succesfully.',
						  heading: 'Delete data',
						  theme: 'lime'
						});
					 }else{
						 $.notific8('Notification', {
						  life: 5000,
						  message: response,
						  heading: 'Delete data FAIL',
						  theme: 'red'
						});
					 }
				}
			 }); 		
		}
	}

	function close_dialog(){
		$("#popup").jqxWindow("close");
	}
</script>
<div style="display:none" id="popup"><div id="popup_title"></div><div id="popup_content">{popup}</div></div>
<div style="padding:8px">
	<div style="width:98%;height:30px;font-size:20px;">
		. {title}
	</div>
	<br>
	<div style="width:98%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<input style="margin: 2px;" value="Refresh Data" id="clearfilteringbutton" type="button" />
        <input style="margin: 2px;" value="+ Tambah Data" id="btn_tambah" type="button"/>
        <div style="margin: 2px;" id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>