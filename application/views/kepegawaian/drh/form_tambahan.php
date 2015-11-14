<script >
var nip_nit = '<?php echo $nip_nit?>';
  $(function(){	
		$("#menu_kepegawaian_drh").addClass("active");
		$("#menu_kepegawaian").addClass("active");


	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'nip_nit', type: 'number' },
			{ name: 'urut', type: 'number' },
			{ name: 'alamat', type: 'string' },
			{ name: 'rt', type: 'string' },
			{ name: 'rw', type: 'string' },
			{ name: 'code_cl_province', type: 'number' },
			{ name: 'code_cl_district', type: 'string' },
			{ name: 'code_cl_kec', type: 'string' },
			{ name: 'code_cl_village', type: 'string' },
			{ name: 'edit', type: 'number'},
			{ name: 'delete', type: 'number'}
        ],
        url: "<?php echo site_url('kepegawaian/json/json_alamat'); ?>",
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
				{ text: 'View', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_alamat").jqxGrid('getrowdata', row);
				    if(dataRecord.view==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_edit.gif' onclick='detail(\""+dataRecord.nip_nit+"\",\""+dataRecord.urut+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif'></a></div>";
					}
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_alamat").jqxGrid('getrowdata', row);
				    if(dataRecord.delete==1){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_del.gif' onclick='del(\""+dataRecord.nip_nit+"\",\""+dataRecord.urut+"\");'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></a></div>";
					}
                 }
                },
				{ text: 'NIP / NIT', datafield: 'nip_nit', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Urut', datafield: 'urut', columntype: 'textbox', filtertype: 'textbox', width: '5%' },
				{ text: 'Alamat ', datafield: 'alamat', columntype: 'textbox', filtertype: 'textbox', width: '20%'},
				{ text: 'RT',datafield: 'rt', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'RW',datafield: 'rw', columntype: 'textbox', filtertype: 'textbox', width: '5%'},
				{ text: 'Provinsi',datafield: 'code_cl_province', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Kota',datafield: 'code_cl_district', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Kecamatan',datafield: 'code_cl_kec', columntype: 'textbox', filtertype: 'textbox', width: '10%'},
				{ text: 'Kelurahan',datafield: 'code_cl_village', columntype: 'textbox', filtertype: 'textbox', width: '10%'}
            ]
		});

        $("#jqxNavigationBar").jqxNavigationBar({ width: '100%', height: '100%',expandMode: 'multiple', expandedIndexes: [2, 3]});
	});

	function edit(id){
		document.location.href="<?php echo base_url().'kepegawaian/drh/edit';?>/" + id;
	}

	function del(id){
		var confirms = confirm("Hapus Data ?");
		if(confirms == true){
			$.post("<?php echo base_url().'kepegawaian/drh/dodel' ?>/" + id,  function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_alamat").jqxGrid('updatebounddata', 'cells');
			});
		}
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
				<button class="btn btn-success pull-right" id='btn_add_barang' type='button'><i class='icon-copy'></i> Tambah Alamat</button>
		 	<button type="button" class="btn btn-success" id="btn-refresh"><i class='fa fa-refresh'></i> &nbsp; Refresh</button>
                <div id="jqxgrid_alamat"></div>
            </div>
            <div>
                <div style='margin-top: 2px;'>
                    <div style='float: left;'>
                    </div>
                    <div style='margin-left: 4px; float: left;'>
                        Mail</div>
                </div>
            </div>
            <div>
                <ul>
                    <li><a href='#'>Contacts</a></li>
                    <li><a href='#'>Mails</a></li>
                    <li><a href='#'>Notes</a></li>
                </ul>
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


