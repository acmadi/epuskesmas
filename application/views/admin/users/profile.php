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

<script type="text/javascript">
	$(function() {
		
		new AjaxUpload($('#linkimages'), {
			action: '<?php echo base_url()?>index.php/admin_user/douploadimages/{id}',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				$('#linkimages_alert').show('fold',500);
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
					$('#linkimages_alert').html('<div align=right onClick="$(\'#linkimages_alert\').hide(\'fold\',500);" style="color:red;font-weight:bold">X</div><br>Only JPG, PNG or GIF files are allowed');
					return false;
				}
				$('#linkimages_alert').show('fold',500);
				$('#linkimages_alert').html('Uploading image...');
			},
			onComplete: function(file, response){
				result = response.split("|");
				if(result[0]=="success"){
					$('#linkimages').attr("src", "<?php echo base_url()?>media/images/users/{id}/"+result[1]);
					$('#links').val("<?php echo base_url()?>media/images/users/{id}/"+result[1]);
					$('#linkimages_alert').html('<div align=right onClick="$(\'#linkimages_alert\').hide(\'fold\',500);" style="color:red;font-weight:bold">X</div><br>Upload Image OK');
				} else{
					$('#linkimages_alert').html('<div align=right onClick="$(\'#linkimages_alert\').hide(\'fold\',500);" style="color:red;font-weight:bold">X</div><br>'+result[1]);
				}
			}
		});

		$("#birthdate").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: '1950:2000'
		});	

	});
</script>
<?php if(validation_errors()==TRUE):?>	
<div class="alert" id="alert">
<div align=right onClick="$('#alert').hide('fold',1000);" style="color:red;font-weight:bold">X</div>
<?php echo validation_errors();?>
</div>
<?php endif;?>
<form action="<?php echo base_url()?>index.php/admin_user/{action}/{id}" method="POST" name="frmUsers">
	<button type="submit" class=btn>Simpan</button>
	<button type="reset" class=btn>Ulang</button>
	<button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user/edit_account/{id}';">Ubah User Account</button>
	<?php if($this->session->userdata('level')=="administrator" || $this->session->userdata('level')=="super administrator") {?>
		<button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user';">Kembali</button>
	<?php }?>
	<br />
	<br />
	<table border="0" cellpadding="2" cellspacing="2">
		<?php if($this->session->userdata('status_active')!=""){?>
		<tr>
			<td>Status : <?php echo $this->session->userdata('status_active')?><br><br><b><?php echo anchor(base_url().'index.php/admin_user/reg_resend_email','Klik disini untuk mengirim ulang email verifikasi.')?></b><br><br></td>
		</tr>
		<?php }?>
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="2" class="panel" width=100%>
					<input type="hidden" name="id" value="{id}" />
					<input type="hidden" name="username" value="<?php echo $username;?>" />
				</table>
				<br><br>
				<table border="0" cellpadding="3" cellspacing="2" class="panel" width=100%>
					<tr>
						<td>Full Name</td>
						<td>:</td>
						<td style="background:white">
								<?php 
									if(set_value('name_first')==""){
									 	$namefirst=$name_first;
									}else{
										$namefirst=set_value('name_first');
									}
									echo form_dropdown('name_first', array("Mr"=>"Mr","Mrs"=>"Mrs","Miss"=>"Miss"), $namefirst," class=input");
									
								?>
								<input class=input type="text" size="20" name="name_middle" 
									value="<?php
										 if(set_value('name_middle')==""){
									 		echo $name_middle;
										}else{
											echo set_value('name_middle');
										}
										 
										 ?>" /> 
								
								<input class=input type="text" size="20" name="name_end" 
								value="<?php 
											if(set_value('name_end')==""){
									 			echo $name_end;
											}else{
												echo set_value('name_end');
											}
											
										?>" />
						</td>
					</tr>
					<tr>
						<td>Display Name</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="50" name="name_display" 
								value="<?php 
										if(set_value('name_display')==""){
									 			echo $name_display;
											}else{
												echo set_value('name_display');
											}
									?>" />
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td style="background:white">
						<input class=input type="text" size="30" name="email" 
							value="<?php 
								if(set_value('email')==""){
								 	echo $email;
								}else{
									echo  set_value('email');
								}
								 ?>
								 
								 " /> 
						</td>
					</tr>
					<tr>
						<td rowspan="2">Avatar</td>
						<td rowspan="2">:</td>
						<?php
//						if(!empty($avatar)){
//							$avatar=$avatar;
//							
//						
//						
//						}else{
//							$avatar=base_url().'media/images/smily-user-icon.jpg';
//						}
						if(!empty($avatar)){
								$pisah=explode(base_url(),$avatar);
							 	if(count($pisah)>1){
									$pisahLagi=explode("/",$pisah[1]); 
									$prop=APPPATH."../".$pisah[1];
									if (file_exists($prop)) {
											$av_prop=array(
												'src'		=>  $avatar,
												'width'		=> '40',
												'hieght'	=> 	'30'
											);
											$av1=$avatar;
									}else{
//										$av_prop=array(
//											'src'		=>  base_url().'media/images/smily-user-icon.jpg',
//											'width'		=> '40',
//											'hieght'	=> 	'30'
//										);
										$av1=base_url().'media/images/smily-user-icon.jpg';
									}	
									
									$av=$av1;
									
								 }else{
//								 	$av_prop=array(
//											'src'		=>  base_url().'media/images/smily-user-icon.jpg',
//											'width'		=> '40',
//											'hieght'	=> 	'30'
//										);
									$av=base_url().'media/images/smily-user-icon.jpg';	
								 }
								
							}else{
//								$av_prop=array(
//										'src'		=>  base_url().'media/images/smily-user-icon.jpg',
//										'width'		=> '40',
//										'hieght'	=> 	'30'
//									);
								$av= base_url().'media/images/smily-user-icon.jpg';
							}
							$avatar=$av;
						?>
						<td style="background:white">
							<img src="<?php 
										if(set_value('avatar')==""){
									 			echo $avatar;
											}else{
												echo set_value('avatar');
											}
								
										?>" width="50" id='linkimages' style='border:1px solid #999999'>
						
						</td>
					</tr>
					<input class=input type="hidden" size="80" value="<?php 
										if(set_value('avatar')==""){
									 			echo $avatar;
											}else{
												echo set_value('avatar');
											}
								
										?>" name="avatar" id="links" readonly/></td>
					<tr>
						<td style="background:white"><div class="alert" id="linkimages_alert" style='display:none;'></div></td>
					</tr>
					
					<tr>
						<td>Gender</td>
						<td>:</td>
						<td style="background:white">
							<?php 
								if(set_value('gendre')==""){
									$gende= $gendre;
								}else{
									$gende= set_value('gendre');
								}
								echo form_dropdown('gendre', array("L"=>"Male","P"=>"Female"), $gende," class=input");?>
						</td>
					</tr>
					
					<tr>
						<?php
//						if(!empty($birthdate))
//						{
//						$birthdate=trim($birthdate);
//						$tgl=explode("-",$birthdate);
//						}
//						else
//						{
//							$tgl[0]=0;
//							$tgl[1]=0;
//							$tgl[2]=0;
//						}
						//echo 'hallo '.$tgl['0'];
						
						?>
						<td>Birthday</td>
						<td>:</td>
						<td style="background:white">
							<input type="text" name="birthdate" id="birthdate" class="input" 
								value="<?php
								 			if(set_value('birthdate')==""){
									 			echo $birthdate;
											}else{
												echo set_value('birthdate');
											}
								
									?>">
						</td>
					</tr>
					<tr>
						<td>Place Of Birth </td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="50" name="birthplace" 
								value="<?php 
										if(set_value('birthplace')==""){
									 			echo $birthplace;
											}else{
												echo set_value('birthplace');
											}
								
										?>" />
						</td>
					</tr>
					<tr>
						<td>ID/KTP/SIM</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="id_number" 
								value="<?php 
										if(set_value('id_number')==""){
									 			echo $id_number;
											}else{
												echo set_value('id_number');
											}
										?>" />
						</td>
					</tr>
					
					<tr>
						<td>Occupation</td>
						<td>:</td>
						<td style="background:white">
							<?php 
								$options=array(
									'Student'	=>'Student',
									'Freelance'	=> 'Freelance',
									'Part Time'	=> 'Part Time',
									'Fulltime'	=> 'Fulltime',
									'Internship'=> 'Internship'
								);
								if(set_value('occupation')==""){
									 $occ= $occupation;
								}else{
									$occ= set_value('occupation');
								}
								$style="class='input'";
								echo form_dropdown('occupation',$options,$occ,$style);
							?>
						</td>
					</tr>
					
					<tr>
						<td>Address</td>
						<td>:</td>
						<td style="background:white">
							<textarea name="address" rows="3" cols="40" class=input>
								<?php if(set_value('address')==""){
										echo $address;
									}else{
										echo set_value('address');
									}?>
							</textarea>
						 </td>
					</tr>
					<tr>
						<td>Grade</td>
						<td>:</td>
						<td style="background:white">
							<?php
								if(set_value('grade')==""){
									 $gr= $grade;
								}else{
									$gr= set_value('grade');
								}
								 echo form_dropdown('grade', array("S2"=>"S2","S1"=>"S1","D3"=>"D3","D1"=>"D1"), $gr," class=input");
							?> 
						</td>
					</tr>
					
					<tr>
						<td>Job Title</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="job_title" 
								value="<?php
									 if(set_value('job_title')==""){
										echo $job_title;
									}else{
										echo set_value('job_title');
									}
									 ?>" />
						</td>
					</tr>
					<tr>
						<td>Company</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="company" 
								value="<?php
									 if(set_value('company')==""){
										echo $company;
									}else{
										echo set_value('company');
									}
								?>" />
						</td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="phone_number"
								 value="<?php
								 	 if(set_value('phone_number')==""){
										echo $company;
									}else{
										echo set_value('phone_number');
									}
									?>" 
							/>
						</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="mobile" 
								value="<?php
									 if(set_value('mobile')==""){
										echo $mobile;
									}else{
										echo set_value('mobile');
									}
									?>" 
							/>
						</td>
					</tr>
					<tr>
						<td>Personal Achievement</td>
						<td>:</td>
						<td style="background:white">
							<textarea name="achievement" rows="3" cols="40" class=input>
							<?php if(set_value('achievement')==""){
										echo $achievement;
									}else{
										echo set_value('achievement');
									}?>
							</textarea> 
						</td>
					</tr>
					<tr>
						<td>About Yourself</td>
						<td>:</td>
						<td style="background:white">
							<textarea name="about" rows="3" cols="40" class=input>
								<?php if(set_value('about')==""){
										echo $about;
									}else{
										echo set_value('about');
									}?>
							</textarea> 
						</td>
					</tr>
					<tr>
						<td>Hobbies</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="hobbies" 
								value="<?php if(set_value('hobbies')==""){
												echo $hobbies;
											}else{
												echo set_value('hobbies');
											}?>" 
							/>
						</td>
					</tr>
					<tr>
						<td>Affiliates</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="affiliates" 
								value="<?php 
											if(set_value('affiliates')==""){
												echo $affiliates;
											}else{
												echo set_value('affiliates');
											}
									?>" 
							/>
						</td>
					</tr>
					<tr>
						<td>Facebook</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="facebook" 
								value="<?php 
											if(set_value('facebook')==""){
												echo $facebook;
											}else{
												echo set_value('facebook');
											}
									?>" 
							/>
						</td>
					</tr>
					<tr>
						<td>Twitter</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="twitter" 
								value="<?php 
										if(set_value('twitter')==""){
												echo $twitter;
											}else{
												echo set_value('twitter');
											}
									?>" />
						</td>
					</tr>
					<tr>
						<td>Wordpress</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="wordpress" 
								value="<?php 
											if(set_value('wordpress')==""){
												echo $wordpress;
											}else{
												echo set_value('wordpress');
											}
									?>" 
							/>
						</td>
					</tr>
					
					<tr>
						<td>Blogspot</td>
						<td>:</td>
						<td style="background:white">
							<input class=input type="text" size="40" name="blogspot" 
								value="<?php 
											if(set_value('blogspot')==""){
												echo $blogspot;
											}else{
												echo set_value('blogspot');
											}
									?>" 
							/>
						</td>
					</tr>
					
					
					<tr>
					<td><?php echo $cap['image'];?></td>
					<td>:</td>
					<?php
					$data = array(
								  'name'        => 'captcha',
								  'id'          => 'captcha',
								  'class'       => 'input',
								);
					?>
					<td style="background:white"><?php echo form_input($data);?></td>
					
					</tr>
					
				</table>

			</td>
		</tr>
	</table>
	<br />
	<button type="submit" class=btn>Simpan</button>
	<button type="reset" class=btn>Ulang</button>
	<button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user/edit_account/{id}';">Ubah User Account</button>
	<?php if($this->session->userdata('level')=="administrator" || $this->session->userdata('level')=="super administrator") {?>
		<button type="button" class=btn onclick="document.location.href='<?php echo base_url()?>index.php/admin_user';">Kembali</button>
	<?php }?>
</form>
