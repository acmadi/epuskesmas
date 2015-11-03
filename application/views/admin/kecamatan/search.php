<script type="text/javascript">
	$(function() {
		$("#frm").submit(function() {
			var act = '<?php echo base_url(); ?>index.php/admin_master_kecamatan/index';
			if(jQuery.trim($("input[name='id_kecamatan']").val()) !="") act += '/id_kecamatan/' + jQuery.trim($("input[name='id_kecamatan']").val());
			if(jQuery.trim($("input[name='nama_kecamatan']").val()) !="") act += '/nama_kecamatan/' + $("input[name='nama_kecamatan']").val();
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
						<td>Id Kecamatan</td>
						<td>:</td>
						<td><input class=input type="text" size="10" name="id_kecamatan" value="<?php echo $id_kecamatan?>" /></td>
						<td><button type="submit" class="btn"> Cari </button></td>
					</tr>
					<tr>
						<td>Nama Kecamatan</td>
						<td>:</td>
						<td><input class=input type="text" size="50" name="nama_kecamatan" value="<?php echo $nama_kecamatan?>" /></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
</form>
<div class="clear">&nbsp;</div>
