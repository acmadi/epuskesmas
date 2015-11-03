<script type="text/javascript">
	$(function() {
		$("#frmUsers").submit(function() {
			var act = '<?php echo base_url(); ?>index.php/admin_user/index';
			if(jQuery.trim($("input[name='username']").val()) !="") act += '/username/' + jQuery.trim($("input[name='username']").val());
			if(jQuery.trim($("select[name='level']").val()) !="") act += '/level/' + $("select[name='level']").val();
			if(jQuery.trim($("select[name='status_active']").val()) !="") act += '/status_active/' + $("select[name='status_active']").val();
			if($("input:checked[name='online']").val()) act += '/online/' + $("input[name='online']").val();
			window.location= act;
			return false;
		});
	});
</script>
<div class="clear">&nbsp;</div>
<form action="" method="post" name="frmUsers" id="frmUsers">
	<br />
	<table border="0" cellpadding="0" cellspacing="8" class="panel" width=80%>
		<tr>
			<td>
				<table width=100% border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Email / Username</td>
						<td>:</td>
						<td><input class=input type="text" size="50" name="username" value="<?php echo $username?>" /></td>
						<td><button type="submit" class="btn"> Cari </button></td>
					</tr>
					<tr>
						<td>Level</td>
						<td>:</td>
						<td><?php echo form_dropdown('level', $level_option, $level," class=input");?></td>
					</tr>
					<tr>
						<td>Active</td>
						<td>:</td>
						<td><?php echo form_dropdown('status_active', $status_active_option, $status_active," class=input");?></td>
					</tr>
					<tr>
						<td>Online</td>
						<td>:</td>
						<td><input class=input type="checkbox" name="online" value="1" <?php if($online) echo "checked"; ?>></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
</form>
<div class="clear">&nbsp;</div>
