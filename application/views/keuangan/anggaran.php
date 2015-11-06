
	<script type="text/javascript">
		function getDemoTheme() {
			var theme = document.body ? $.data(document.body, 'theme') : null
			if (theme == null) {
				theme = '';
			}
			else {
				return theme;
			}
			var themestart = window.location.toString().indexOf('?');
			if (themestart == -1) {
				return '';
			}

			var theme = window.location.toString().substring(1 + themestart);
			if (theme.indexOf('(') >= 0)
			{
				theme = theme.substring(1);
			}
			if (theme.indexOf(')') >= 0) {
				theme = theme.substring(0, theme.indexOf(')'));
			}

			var url = "<?=base_url()?>jqwidgets/styles/jqx." + theme + '.css';

			if (document.createStyleSheet != undefined) {
				var hasStyle = false;
				$.each(document.styleSheets, function (index, value) {
					if (value.href != undefined && value.href.indexOf(theme) != -1) {
						hasStyle = true;
						return false;
					}
				});
				if (!hasStyle) {
					document.createStyleSheet(url);
				}
			}
			else {
				var hasStyle = false;
				if (document.styleSheets) {
					$.each(document.styleSheets, function (index, value) {
						if (value.href != undefined && value.href.indexOf(theme) != -1) {
							hasStyle = true;
							return false;
						}
					});
				}
				if (!hasStyle) {
					var link = $('<link rel="stylesheet" href="' + url + '" media="screen" />');
					link[0].onload = function () {
						if ($.jqx && $.jqx.ready) {
							$.jqx.ready();
						};
					}
					$(document).find('head').append(link);
				}
			}
			$.jqx = $.jqx || {};
			$.jqx.theme = theme;
			return theme;
		};
		var theme = '';
		try
		{
			if (jQuery) {
				theme = getDemoTheme();
				if (window.location.toString().indexOf('file://') >= 0) {
					var loc = window.location.toString();
					var addMessage = false;
					if (loc.indexOf('grid') >= 0 || loc.indexOf('chart') >= 0 || loc.indexOf('scheduler') >= 0 || loc.indexOf('tree') >= 0 || loc.indexOf('list') >= 0 || loc.indexOf('combobox') >= 0 || loc.indexOf('php') >= 0 || loc.indexOf('adapter') >= 0 || loc.indexOf('datatable') >= 0 || loc.indexOf('ajax') >= 0) {
						addMessage = true;
					}

					if (addMessage) {
						$(document).ready(function () {
							setTimeout(function () {
								$(document.body).prepend($('<div style="font-size: 12px; font-family: Verdana;">Note: To run a sample that includes data binding, you must open it via "http://..." protocol since Ajax makes http requests.</div><br/>'));
							}
							, 50);
						});
					}
				}
			}
			else {
				$(document).ready(function () {
					theme = getDemoTheme();
				});
			}
		}
		catch (error) {
			var er = error;
		}
	</script>
	<script type="text/javascript">
        $(document).ready(function () {           
            var newRowID = null;

            // prepare the data
            var source =
            {
                dataType: "tab",
                dataFields: [
                    { name: "Id", type: "number" },
                    { name: "ParentID", type: "number" },
                    { name: "KodeRekening", type: "string" },
                    { name: "KodeAnggaran", type: "string" },
                    { name: "Uraian", type: "string" },
                    { name: "Type", type: "string" }
                ],
                hierarchy:
                {
                    keyDataField: { name: 'Id' },
                    parentDataField: { name: 'ParentID' }
                },
                id: 'Id',
                url: '<?php echo base_url()?>keuangan/master_sts/api_data',
                 addRow: function (rowID, rowData, position, parentID, commit) {				
					// POST to server using $.post or $.ajax					
                     // synchronize with the server - send insert command
                     // call commit with parameter true if the synchronization with the server is successful 
                     // and with parameter false if the synchronization failed.
                     // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                     commit(true);
                     newRowID = rowID;
                 },
                 updateRow: function (rowID, rowData, commit) {
                     // synchronize with the server - send update command
                     // call commit with parameter true if the synchronization with the server is successful 
                     // and with parameter false if the synchronization failed.					
					
					
					
                    commit(true);
					var arr = $.map(rowData, function(el) { return el });															
																				
					alert(arr);
					
					
					if(arr.length == 9){
						var arr2 = $.map(arr[2], function(el) { return el });
						alert(arr2);
						if(arr[3]>0){
							alert('child '+arr);
							$.post( '<?php echo base_url()?>keuangan/master_sts/anggaran_add', {id_anggaran:arr[0],sub_id:arr2[0], kode_rekening:arr[5], kode_anggaran:arr[6], uraian : arr[7], type : arr[8]},function( data ) {
								alert( "input" );
							});
							if(arr2[0] == null){
								alert("parent");
							}
						}else{
							alert('parent '+arr);
						}
					}else{
						$.post( '<?php echo base_url()?>keuangan/master_sts/anggaran_update', {id_anggaran_awal:rowID, id_anggaran:arr[0],sub_id:arr[1], kode_rekening:arr[2], kode_anggaran:arr[3], uraian : arr[4], type : arr[5]},function( data ) {
							alert( "update" );
						});
					}
                 },
                 deleteRow: function (rowID, commit) {
                     // synchronize with the server - send delete command
                     // call commit with parameter true if the synchronization with the server is successful 
                     // and with parameter false if the synchronization failed.
					if( Object.prototype.toString.call( rowID ) === '[object Array]' ) {
						for(var i=0; i< rowID.length; i++){
							$.post( '<?php echo base_url()?>keuangan/master_sts/anggaran_delete', {id_anggaran:rowID[i]},function( data ) {
								alert( "delete" );
							});
						}
						
					}else{
						$.post( '<?php echo base_url()?>keuangan/master_sts/anggaran_delete', {id_anggaran:rowID},function( data ) {
							alert( "delete" );
						});
					}
					 
                     commit(true);
                 }
             };

            var dataAdapter = new $.jqx.dataAdapter(source, {
                loadComplete: function () {
                    // data is loaded.
                }
            });

            $("#treeGrid").jqxTreeGrid(
            {
                width: 850,
                source: dataAdapter, 
                pageable: true,
                editable: true,
                showToolbar: true,
                altRows: true,
                ready: function()
                {
                    // called when the DatatreeGrid is loaded.         
                },
                pagerButtonsCount: 8,
                toolbarHeight: 35,
                renderToolbar: function(toolBar)
                {
                    var toTheme = function (className) {
                        if (theme == "") return className;
                        return className + " " + className + "-" + theme;
                    }

                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; height: 100%; width: 100%;'></div>");
                    var buttonTemplate = "<div style='float: left; padding: 3px; margin: 2px;'><div style='margin: 4px; width: 16px; height: 16px;'></div></div>";
                    var addButton = $(buttonTemplate);
                    var editButton = $(buttonTemplate);
                    var deleteButton = $(buttonTemplate);
                    var cancelButton = $(buttonTemplate);
                    var updateButton = $(buttonTemplate);
                    var addParentButton = $(buttonTemplate);
                    container.append(addParentButton);
                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(cancelButton);
                    container.append(updateButton);

                    toolBar.append(container);
					addParentButton.jqxButton({cursor: "pointer", enableDefault: false, disabled: false, height: 25, width: 25 });
                    addParentButton.find('div:first').addClass(toTheme('jqx-icon-plus'));
                    addParentButton.jqxTooltip({ position: 'bottom', content: "Add Parent"});
					
                    addButton.jqxButton({cursor: "pointer", enableDefault: false, disabled: true, height: 25, width: 25 });
                    addButton.find('div:first').addClass(toTheme('jqx-icon-plus'));
                    addButton.jqxTooltip({ position: 'bottom', content: "Add Child"});

                    editButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    editButton.find('div:first').addClass(toTheme('jqx-icon-edit'));
                    editButton.jqxTooltip({ position: 'bottom', content: "Edit"});

                    deleteButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    deleteButton.find('div:first').addClass(toTheme('jqx-icon-delete'));
                    deleteButton.jqxTooltip({ position: 'bottom', content: "Delete"});

                    updateButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    updateButton.find('div:first').addClass(toTheme('jqx-icon-save'));
                    updateButton.jqxTooltip({ position: 'bottom', content: "Save Changes"});

                    cancelButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    cancelButton.find('div:first').addClass(toTheme('jqx-icon-cancel'));
                    cancelButton.jqxTooltip({ position: 'bottom', content: "Cancel"});

                    var updateButtons = function (action) {
                        switch (action) {
                            case "Select":
                                addButton.jqxButton({ disabled: false });
                                deleteButton.jqxButton({ disabled: false });
                                editButton.jqxButton({ disabled: false });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;
                            case "Unselect":
                                addButton.jqxButton({ disabled: true });
                                deleteButton.jqxButton({ disabled: true });
                                editButton.jqxButton({ disabled: true });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;
                            case "Edit":
                                addButton.jqxButton({ disabled: true });
                                deleteButton.jqxButton({ disabled: true });
                                editButton.jqxButton({ disabled: true });
                                cancelButton.jqxButton({ disabled: false });
                                updateButton.jqxButton({ disabled: false });
                                break;
                            case "End Edit":
                                addButton.jqxButton({ disabled: false });
                                deleteButton.jqxButton({ disabled: false });
                                editButton.jqxButton({ disabled: false });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;

                        }
                    }

                    var rowKey = null;
                    $("#treeGrid").on('rowSelect', function (event) {
                        var args = event.args;
                        rowKey = args.key;
                        updateButtons('Select');
                    });
                    $("#treeGrid").on('rowUnselect', function (event) {
                        updateButtons('Unselect');
                    });
                    $("#treeGrid").on('rowEndEdit', function (event) {
                        updateButtons('End Edit');
                    });
                    $("#treeGrid").on('rowBeginEdit', function (event) {
                        updateButtons('Edit');
                    });
					
					addParentButton.click(function (event) {
                        if (!addButton.jqxButton('disabled')) {
							//$("#treeGrid").jqxTreeGrid('clearSelection');
                            $("#treeGrid").jqxTreeGrid('expandRow', rowKey);
                            // add new empty row.
                            $("#treeGrid").jqxTreeGrid('addRow', null, {}, 'first', rowKey);
                            // select the first row and clear the selection.
                            $("#treeGrid").jqxTreeGrid('clearSelection');
                            $("#treeGrid").jqxTreeGrid('selectRow', newRowID);
                            // edit the new row.
                            $("#treeGrid").jqxTreeGrid('beginRowEdit', newRowID);
                            updateButtons('add');
                        }
                    });
					
                    addButton.click(function (event) {
                        if (!addButton.jqxButton('disabled')) {
							
                            $("#treeGrid").jqxTreeGrid('expandRow', rowKey);
                            // add new empty row.
                            $("#treeGrid").jqxTreeGrid('addRow', null, {}, 'first', rowKey);
                            // select the first row and clear the selection.
                            $("#treeGrid").jqxTreeGrid('clearSelection');
                            $("#treeGrid").jqxTreeGrid('selectRow', newRowID);
                            // edit the new row.
                            $("#treeGrid").jqxTreeGrid('beginRowEdit', newRowID);
                            updateButtons('add');
                        }
                    });

                    cancelButton.click(function (event) {
                        if (!cancelButton.jqxButton('disabled')) {
                            // cancel changes.
                            $("#treeGrid").jqxTreeGrid('endRowEdit', rowKey, true);
                        }
                    });

                    updateButton.click(function (event) {
                        if (!updateButton.jqxButton('disabled')) {
                            // save changes.
                            $("#treeGrid").jqxTreeGrid('endRowEdit', rowKey, false);
                        }
                    });

                    editButton.click(function () {
                        if (!editButton.jqxButton('disabled')) {
                            $("#treeGrid").jqxTreeGrid('beginRowEdit', rowKey);
                            updateButtons('edit');

                        }
                    });
                    deleteButton.click(function () {
                        if (!deleteButton.jqxButton('disabled')) {
                            var selection = $("#treeGrid").jqxTreeGrid('getSelection');
                            if (selection.length > 1) {
                                var keys = new Array();
                                for (var i = 0; i < selection.length; i++) {
                                    keys.push($("#treeGrid").jqxTreeGrid('getKey', selection[i]));
                                }
                                $("#treeGrid").jqxTreeGrid('deleteRow', keys);
                            }
                            else {
                                $("#treeGrid").jqxTreeGrid('deleteRow', rowKey);
                            }
                            updateButtons('delete');

                        }
                    });
                },
                columns: [
				/*
				{ name: "Id", type: "number" },
                    { name: "ParentID", type: "number" },
                    { name: "KodeRekening", type: "string" },
                    { name: "KodeAnggaran", type: "string" },
                    { name: "Uraian", type: "string" },
                    { name: "Type", type: "string" }
				*/
                  { text: 'ID Anggaran', dataField: "Id", align: 'center', width: '20%' },				
                  { text: 'Kode Rekening', dataField: "KodeRekening", align: 'center', width: '20%' },
                  { text: 'Kode Anggaran', dataField: "KodeAnggaran", align: 'center', width: '20%' },
                  { text: 'Uraian', dataField: "Uraian", align: 'center', width: '20%' },
                  { text: 'Type', dataField: "Type", align: 'center', width: '20%' },
                  
                ]
            });
        });
    </script>

<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>" method="POST" name="">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
	    </div>

	      
        <div class="box-body">
			<div class="default">
				<div  id="treeGrid"></div>
			</div>
	    </div>
	  </div>
	</div>
  </div>
</form>
</section>

