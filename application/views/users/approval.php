<script type="text/javascript">
    $(document).ready(function(){
        $('#btn-approve').click(function(){
            $('#btn-approve').text('Loading...');
            $('#btn-approve').addClass('disabled');
            $('#btn-deny').addClass('disabled');
            $('#btn-back').addClass('disabled');
            $.ajax({ 
              type: "GET",
              url: "<?php echo base_url()?>users/doapprove/<?php echo $username; ?>/1",
              success: function(response){
                if(response=="1"){
                  $('#status-label').html('Status calon anggota : <i class="icon fa fa-check"></i> <strong>Approved</strong>');
                  $('#btn-approve').remove();
                  $('#btn-deny').remove();
                  $('#btn-back').removeClass('disabled');
                 }else{
                   $('#status-label').text('Proses approval gagal, silahkan tentukan status calon anggota :');
                   $('#btn-approve').text('Approve');
                   $('#btn-approve').removeClass('disabled');
                   $('#btn-deny').removeClass('disabled');
                   $('#btn-back').removeClass('disabled');
                 }
              }
             });    
        });
    });
</script>

<?php if(validation_errors()!=""){ ?>
<div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo validation_errors()?>
</div>
<?php } ?>

<?php if($this->session->flashdata('alert_form')!=""){ ?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4>  <i class="icon fa fa-check"></i> Information!</h4>
  <?php echo $this->session->flashdata('alert_form')?>
</div>
<?php } ?>
<div class="row" style="background:#FAFAFA">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">Profil Pengguna</a></li>
    </ul>
    <div class="tab-content">


      <div class="tab-pane active" id="tab_1">    
        <form action="#" method="post">
        <div class="row">
        <div class="col-md-6 col-md-offset-1">
          <p class="login-box-msg">Silahkan periksa kembali kelengkapan data profil calon anggota :</p>
             <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="username" readonly value="<?php 
                      if(set_value('username')=="" && isset($username)){
                        echo $username;
                      }else{
                        echo  set_value('username');
                      }
                      ?>"/>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <div style="width:80px">Jenis User</div>
              </span>
              <input type="text" class="form-control" placeholder="jenis" name="jenis" readonly value="<?php 
                      if(isset($jenis) && $jenis=="pemerintah"){
                        echo "Dinas Pemerintahan";
                      }else{
                        echo  "Swasta";
                      }
                      ?>"/>
           </div>
           <br>
           <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="Email" name="email" readonly value="<?php 
                      if(set_value('email')=="" && isset($email)){
                        echo $email;
                      }else{
                        echo  set_value('email');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="** Nama Lengkap" name="nama" readonly value="<?php 
                      if(set_value('nama')=="" && isset($nama)){
                        echo $nama;
                      }else{
                        echo  set_value('nama');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="Tempat Lahir" name="birthplace" readonly value="<?php 
                      if(set_value('birthplace')=="" && isset($birthplace)){
                        echo $birthplace;
                      }else{
                        echo  set_value('birthplace');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="Tanggal Lahir" id="datemask" name="birthdate" readonly data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php 
                      if(set_value('birthdate')=="" && isset($birthdate)){
                        echo $birthdate;
                      }else{
                        echo  set_value('birthdate');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-sun-o" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="Nama Perusahaan" name="perusahaan" readonly value="<?php 
                      if(set_value('perusahaan')=="" && isset($perusahaan)){
                        echo $perusahaan;
                      }else{
                        echo  set_value('perusahaan');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-puzzle-piece" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="Posisi / Jabatan" name="jabatan" readonly value="<?php 
                      if(set_value('jabatan')=="" && isset($jabatan)){
                        echo $jabatan;
                      }else{
                        echo  set_value('jabatan');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone" style="width:20px"></i>
              </span>
              <input type="text" class="form-control" placeholder="** No. Tlp" name="phone_number" readonly value="<?php 
                      if(set_value('phone_number')=="" && isset($phone_number)){
                        echo $phone_number;
                      }else{
                        echo  set_value('phone_number');
                      }
                      ?>"/>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope" style="width:20px"></i>
              </span>
              <textarea class="form-control" placeholder="Alamat" name="address" rows="2" readonly/><?php 
                      if(set_value('address')=="" && isset($address)){
                        echo $address;
                      }else{
                        echo  set_value('address');
                      }
                      ?></textarea>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <div style="width:80px">Provinsi</div>
              </span>
              <select class="form-control" name="propinsi" disabled/>{provinsi_option}</select>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <div style="width:80px">Kota / Kab</div>
              </span>
              <select class="form-control" name="kota" disabled/></select>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <div style="width:80px">Kecamatan</div>
              </span>
              <select class="form-control" name="kecamatan" disabled/></select>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">
                <div style="width:80px">Desa</div>
              </span>
              <select class="form-control" name="desa" disabled/></select>
            </div>
            <br>
        </div>
        </form>        

        <div class="col-md-4 ">
            <div class="row">
        	  	<p id="status-label" class="login-box-msg">Silahkan tentukan status calon anggota :</p>
	    	    <div class="col-md-5 col-md-offset-3">
		            <div class="row">
		                <button type="button" id="btn-approve" class="btn btn-success btn-block btn-social "><i class="fa fa-thumbs-o-up"></i> Approve</button>
		                <button type="button" id="btn-deny" class="btn btn-danger btn-block btn-social"><i class="fa fa-thumbs-o-down"></i> Deny</button>
		                <br><br>
		                <button type="button" id="btn-back" class="btn btn-primary btn-block btn-social"><i class="fa fa-reply"></i> Kembali</button>
	           		</div>
	            </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#menu_dashboard").addClass("active");
    $("#menu_dashboard_profile").addClass("active");

    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>users/baru";
    });



    $.get('<?php echo base_url()?>disbun/kota/{propinsi}/{kota}', function(response) {
      var data = eval(response);
      $("select[name='kota']").html(data.kota);
    }, "json");

    $.get('<?php echo base_url()?>disbun/kecamatan/{kota}/{kecamatan}', function(response) {
      var data = eval(response);
      $("select[name='kecamatan']").html(data.kecamatan);
    }, "json");

    $.get('<?php echo base_url()?>disbun/desa/{kecamatan}/{desa}', function(response) {
      var data = eval(response);
      $("select[name='desa']").html(data.desa);
    }, "json");

  });
</script>
