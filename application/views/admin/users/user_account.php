<div class="title">{title_form}</div>
<div class="clear">&nbsp;</div>
<?php if(validation_errors()==TRUE):?>	
<div class="alert" id="alert">
<div align=right onClick="$('#alert').hide('fold',1000);" style="color:red;font-weight:bold">X</div>
<?php echo validation_errors();?>
</div>
<?php endif;?>
<style type="text/css">
.white {
    background: white;
}
</style>
<?php
	$row_user=$this->admin_users_model->get_user_list($id);
?>
<div>
    <form action="<?php echo base_url();?>index.php/admin_user/update_set_account/<?php echo $row_user->id; ?>" method="post" name="frmUsers">
         <table width='80%' border='0' cellpadding='6' cellspacing='2' style="border: 1px solid rgb(204,209,205); background: rgb(244,244,244);">
            <tr>
            	<td width='18%'>Username</td>
            	<td width='1%'>:</td>
            	<td class="white">
                    <input type="text" size="50" class="input" name="username" value="<?php echo $row_user->username; ?>" readonly/>
                    <span style="color: red;">*)</span>
                </td>
            </tr>
            <tr>
            	<td>Level</td>
            	<td>:</td>
            	<td class="white">
                    <select size="1" class="input" name="level">
                        <?php
    	                   $data = $this->admin_users_model->get_user_level();
                           foreach($data as $row_level){
                        ?>
                        <option value="<?php echo $row_level->level; ?>" <?php if($row_level->level==$row_user->level) echo "selected"; ?>><?php echo $row_level->level; ?></option>
                        <?php
    	                }
                        ?>
                    </select>
                    <span style="color: red;">*)</span>
                </td>
            </tr>
            <tr>
            	<td>Password</td>
            	<td>:</td>
            	<td class="white">
                    <input type="password" size="30" class="input" name="password" value="<?php echo $password; ?>"/>
                    <span style="color: red;">*)</span>
                </td>
            </tr>
            <tr>
            	<td>Confirm Password</td>
            	<td>:</td>
            	<td class="white">
                    <input type="password" size="30" class="input" name="password2" value="<?php echo $password2; ?>"/>
                    <span style="color: red;">*)</span>
                </td>
            </tr>
            <tr>
            	<td>Active</td>
            	<td>:</td>
            	<td class="white">
                    <input type="checkbox" class="input" name="status_active" value="1" <?php if($row_user->status_active == '1') echo "checked"; ?>/>
                </td>
            </tr>
            <tr>
                <td><?php echo $cap['image']; ?></td>
                <td>:</td>
                <td class="white"><input type="text" size="10" class="input" name="captcha"></td>
            </tr>
        </table>
        <table width='80%' border='0' cellpadding='5' cellspacing='2'>
            <tr>
                <td width='20%'>
                    <button type="submit" class=btn>Simpan</button>
                    <button type="reset" class=btn>Ulang</button>
                    <button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user/';">Kembali</button>
                </td>
            </tr>
        </table>
    </form>
</div>