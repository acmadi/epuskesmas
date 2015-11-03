<div class="title">{title_form}</div>
<div class="clear">&nbsp;</div>
<?php if($this->session->flashdata('alert')!="")
{ ?>
<div class="alert" id="alert">
<div align=right onClick="$('#alert').hide('fold',1000);" style="color:red;font-weight:bold">X</div>
<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>
<div class="clear">&nbsp;</div>
<form action="<?php echo base_url()?>index.php/admin_user/edit_account/{id}" method="POST" name="frmUsers">
<input type="hidden" size="30" name="username" value="<?php echo $username?>">
	<br />
	<table border="0" cellpadding="2" cellspacing="2">
		<tr>
			<td class="panel">
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Email / Username</td>
						<td>:</td>
						<td><?php echo $username?></td>
					</tr>
					<?php if($this->session->userdata('level')=="administrator" || $this->session->userdata('level')=="super administrator") {?>
					<tr>
						<td>Level</td>
						<td>:</td>
						<td><?php echo form_dropdown('level', $level_option, $level," class=input");?>
						</td>
					</tr>
					<?php } else{ ?>
					<input type="hidden" size="30" name="level" value="<?php echo $level?>">
					<?php } ?>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input class=input type="password" size="30" name="password" value="<?php echo $password?>" /></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>:</td>
						<td><input class=input type="password" size="30" name="password2" value="<?php echo $password2?>" /></td>
					</tr>
					<?php if($this->session->userdata('level')=="administrator" || $this->session->userdata('level')=="super administrator") {?>
					<tr>
						<td>Active</td>
						<td>:</td>
						<td><input class=input type="checkbox" name="status_active" value="1" <?php if($status_active) echo "checked"; ?>></td>
					</tr>
					<?php } ?>
					<tr>
					<td><?php echo $cap['image'];?></td>
					<td>:</td>
					<td><?php echo form_input('captcha');?></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<br />
	<button type="submit" class=btn>Simpan</button>
	<button type="reset" class=btn>Ulang</button>
	<button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user/';">Kembali</button>
</form>
