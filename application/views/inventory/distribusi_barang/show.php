
<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>inventory/pengadaanbarang/dodel_multi" method="POST" name="">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
	    </div>

      	<div class="box-footer">
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
	      <div class="col-md-6" style="text-align:right">
		 	<button type="button" class="btn btn-success" id="btn-refresh"><i class='fa fa-refresh'></i> &nbsp; Refresh</button>
		 	<button type="button" class="btn btn-primary" id="btn-warning"><i class='fa fa-sign-in'></i> &nbsp; Alokasikan Aset	</button>
	     </div>
		</div>
        <div class="box-body">
		    <div class="div-grid">
		        <div id="jqxgrid"></div>
			</div>
	    </div>
	  </div>
	</div>
  </div>
</form>
</section>

<script type="text/javascript">
	$(function () {	
	    $("#menu_inventory").addClass("active");
	    $("#menu_inventory_distribusibarang").addClass("active");

	    $('#code_cl_phc').change(function(){
	      var code_cl_phc = $(this).val();
	      $.ajax({
	        url : '<?php echo site_url('inventory/distribusibarang/get_ruangan') ?>',
	        type : 'POST',
	        data : 'code_cl_phc=' + code_cl_phc,
	        success : function(data) {
	          $('#code_ruangan').html(data);
	        }
	      });

	      return false;
	    }).change();
	});

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'id_pengadaan', type: 'number'},
			{ name: 'tgl_pengadaan', type: 'date'},
			{ name: 'pilihan_status_pengadaan', type: 'string'},
			{ name: 'value', type: 'string'},
			{ name: 'jumlah_unit', type: 'double'},
			{ name: 'total_harga', type: 'double'},
			{ name: 'nilai_pengadaan', type: 'double'},
			{ name: 'keterangan', type: 'text'},
        ],
		url: "<?php echo site_url('inventory/pengadaanbarang/json'); ?>",
		cache: false,
			updateRow: function (rowID, rowData, commit) {
             
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
     
		$('#btn-refresh').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});

		$("#jqxgrid").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Pilih', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><input type='checkbox' name='aset' id='aset_"+dataRecord.id_pengadaan+"'></div>";
                 }
                },
				{ text: 'Kode Barang',editable:false , columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Register',editable:false , columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Nama Barang',editable:false , columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'Harga Satuan (Rp.)', editable:false ,columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Kondisi Barang', editable:false ,columntype: 'textbox', filtertype: 'textbox', width: '15%' }
            ]
		});
</script>