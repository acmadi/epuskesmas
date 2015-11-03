<script type="text/javascript">
	$(function() {
		$("#frm").submit(function() {
			var act = '<?php echo base_url(); ?>index.php/admin_master_kota/index';
			if(jQuery.trim($("input[name='id_kota']").val()) !="") act += '/id_kota/' + jQuery.trim($("input[name='id_kota']").val());
			if(jQuery.trim($("input[name='nama_kota']").val()) !="") act += '/nama_kota/' + $("input[name='nama_kota']").val();
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
						<td>Id Kota</td>
						<td>:</td>
						<td><input class=input type="text" size="10" name="id_kota" value="<?php echo $id_kota?>" /></td>
						<td><button type="submit" class="btn"> Cari </button></td>
					</tr>
					<tr>
						<td>Nama Kota</td>
						<td>:</td>
						<td><input class=input type="text" size="50" name="nama_kota" value="<?php echo $nama_kota?>" /></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
</form>
<div class="clear">&nbsp;</div>
