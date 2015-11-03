<script type="text/javascript">
	$(function() {
		$("#frm").submit(function() {
			var act = '<?php echo base_url(); ?>index.php/admin_master_desa/index';
			if(jQuery.trim($("input[name='id_desa']").val()) !="") act += '/id_desa/' + jQuery.trim($("input[name='id_desa']").val());
			if(jQuery.trim($("input[name='nama_desa']").val()) !="") act += '/nama_desa/' + $("input[name='nama_desa']").val();
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
						<td>Id Desa</td>
						<td>:</td>
						<td><input class=input type="text" size="10" name="id_desa" value="<?php echo $id_desa?>" /></td>
						<td><button type="submit" class="btn"> Cari </button></td>
					</tr>
					<tr>
						<td>Nama Desa</td>
						<td>:</td>
						<td><input class=input type="text" size="50" name="nama_desa" value="<?php echo $nama_desa?>" /></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
</form>
<div class="clear">&nbsp;</div>
