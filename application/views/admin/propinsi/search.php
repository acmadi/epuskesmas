<script type="text/javascript">
	$(function() {
		$("#frm").submit(function() {
			var act = '<?php echo base_url(); ?>index.php/admin_master_propinsi/index';
			if(jQuery.trim($("input[name='id_propinsi']").val()) !="") act += '/id_propinsi/' + jQuery.trim($("input[name='id_propinsi']").val());
			if(jQuery.trim($("input[name='nama_propinsi']").val()) !="") act += '/nama_propinsi/' + $("input[name='nama_propinsi']").val();
			window.location= act;
			return false;
		});
	});
</script>
<div class="clear">&nbsp;</div>
<form action="" method="post" name="frm" id="frm">
	<br />
	<table border="0" cellpadding="0" cellspacing="8" class="panel" width=80%>
		<tr>
			<td>
				<table width=100% border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Id Propinsi</td>
						<td>:</td>
						<td><input class=input type="text" size="10" name="id_propinsi" value="<?php echo $id_propinsi?>" /></td>
						<td><button type="submit" class="btn"> Cari </button></td>
					</tr>
					<tr>
						<td>Nama Propinsi</td>
						<td>:</td>
						<td><input class=input type="text" size="50" name="nama_propinsi" value="<?php echo $nama_propinsi?>" /></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
</form>
<div class="clear">&nbsp;</div>
