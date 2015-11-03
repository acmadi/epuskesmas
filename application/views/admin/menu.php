<script>
$(function() {
	$("#accordion").jqxNavigationBar({ width: 302, height: 410, theme: theme});
});
</script>
<div id="accordion">
	<div style="padding:4px 2px 1px 12px">Main Panel</div>
	<div style="padding:10px 2px 1px 15px">
		<table>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/user.gif" alt="User List"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_user" class="link2">User List</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/file.gif" alt="File List"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_file" class="link2">Files Management</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/menu.gif" alt="Menu Management"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_menu" class="link2">Menu Management</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/group.gif" alt="Group List Management"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_group" class="link2">Group List Management</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/role.gif" alt="Group Role"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_role" class="link2">Group Role</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/config.gif" alt="Setting Configuration"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_config" class="link2">Setting Configuration</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/contact.gif" alt="Contact Information"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_contact" class="link2">Contact Information</a></td>
			</tr>
		</table>
	</div>
	<div style="padding:4px 2px 1px 12px">Master Data</div>
	<div style="padding:10px 2px 1px 15px">
		<table>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_jenis_permohonan" class="link2">Jenis Permohonan</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_jenis_komoditi" class="link2">Jenis Komoditi</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_persyaratan" class="link2">Persyaratan</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_formulir" class="link2">Template Formulir</a></td>
			</tr>
		</table>
	</div>
	<div style="padding:4px 2px 1px 12px">#</div>
	<div style="padding:10px 2px 1px 15px">
		<table>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_resume" class="link2">Resume Pemeriksaan</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_proses" class="link2">Proses Monitoring</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_uraian" class="link2">Uraian Evaluasi</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_jabatan" class="link2">Jabatan</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_penanggungjawab" class="link2">Penanggung Jawab Data</a></td>
			</tr>
            <tr>
                <td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"/></td>
                <td><a href="<?php echo base_url(); ?>index.php/admin_master_golongan" class="link2">Golongan</a></td>
            </tr>
		</table>
	</div>
	<div style="padding:4px 2px 1px 12px">Master Data Lokasi</div>
	<div style="padding:10px 2px 1px 15px">
		<table>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_negara" class="link2">Negara</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_propinsi" class="link2">Propinsi</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_kota" class="link2">Kota</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_kecamatan" class="link2">Kecamatan</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/content.gif" alt="Menu"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_master_desa" class="link2">Desa</a></td>
			</tr>
		</table>
	</div>
	<div style="padding:4px 2px 1px 12px">Account</div>
	<div style="padding:10px 2px 1px 15px">
		<table>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/password.gif" alt="Change Password"></td>
				<td><a href="<?php echo base_url()?>index.php/admin_user/edit_account/<?php echo $this->session->userdata('id');?>" class="link2">Change Password</a></td>
			</tr>
			<tr>
				<td><img width=24 height=24 src="<?php echo base_url()?>public/themes/admin/images/logout.gif" alt="Logout"></td>
				<td><a href="<?php echo base_url()?>index.php/admin/logout" class="link2">Logout</a></td>
			</tr>
		</table>
	</div>
</div>

	<div style="background:#444444;color:#DDDDDD;font-size:11px;padding:5px;">
	Web address: <br><div style="padding-left:20px;padding-bottom:5px"><?php echo base_url();?></div>
	Server : <br><div style="padding-left:20px;padding-bottom:5px"><?php echo $_SERVER['SERVER_ADDR'];?><br><?php echo $_SERVER['SERVER_SIGNATURE'];?></div>
	Remote IP: <br><div style="padding-left:20px;padding-bottom:5px"><?php echo $_SERVER['REMOTE_ADDR'];?></div>
	User agent : <br><div style="padding-left:20px;padding-bottom:5px"><?php echo $_SERVER['HTTP_USER_AGENT'];?></div>
	</div>
