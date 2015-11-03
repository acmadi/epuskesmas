<div class="row">
   <div class="col-md-12">
     <div class="register-logo">
        <b>Form </b>Pendaftaran
      </div>
    </div>
</div>
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
<div class="row">
  <form action="<?php echo base_url()?>disbun/pendaftaran" method="post">
  <div class="col-md-6">
    <p class="login-box-msg">Silahkan tentukan data login anda:</p>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php 
                if(set_value('email')=="" && isset($email)){
                  echo $email;
                }else{
                  echo  set_value('email');
                }
                ?>"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php 
                if(set_value('username')=="" && isset($username)){
                  echo $username;
                }else{
                  echo  set_value('username');
                }
                ?>"/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php 
                if(set_value('password')=="" && isset($usepasswordrname)){
                  echo $password;
                }else{
                  echo  set_value('password');
                }
                ?>"/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="cpassword" value="<?php 
                if(set_value('cpassword')=="" && isset($cpassword)){
                  echo $cpassword;
                }else{
                  echo  set_value('cpassword');
                }
                ?>"/>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="input-group">
        <span class="input-group-addon">
          <div style="width:80px">Jenis User</div>
        </span>
        <select class="form-control" name="jenis"/>
          <option value="perorangan" <?php 
                if(isset($jenis) && $jenis=="perorangan")  echo "selected";
                ?>>Perorangan</option>
          <option value="kelompok" <?php 
                if(isset($jenis) && $jenis=="kelompok")  echo "selected";
                ?>>Kelompok</option>
          <option value="pemerintah"<?php 
                if(isset($jenis) && $jenis=="pemerintah")  echo "selected";
                ?>>Pemerintah</option>
          <option value="badan"<?php 
                if(isset($jenis) && $jenis=="badan")  echo "selected";
                ?>>Badan / Lembaga</option>
        </select>
      </div>
      <br>
  </div><!-- /.form-box -->

  <div class="col-md-6">
    <p class="login-box-msg">Silahkan lengkapi data profil anda :</p>
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-user" style="width:20px"></i>
        </span>
        <input type="text" class="form-control" placeholder="** Nama Lengkap" name="nama" value="<?php 
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
        <input type="text" class="form-control" placeholder="Tempat Lahir" name="birthplace" value="<?php 
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
        <input type="text" class="form-control" placeholder="Tanggal Lahir" id="datemask" name="birthdate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php 
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
        <input type="text" class="form-control" placeholder="Nama Jenis Usaha / Perusahaan" name="perusahaan" value="<?php 
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
        <input type="text" class="form-control" placeholder="Posisi / Jabatan" name="jabatan" value="<?php 
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
        <input type="text" class="form-control" placeholder="** No. Tlp" name="phone_number" value="<?php 
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
        <textarea class="form-control" placeholder="Alamat" name="address" rows="2"/><?php 
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
        <select class="form-control" name="propinsi"/>{provinsi_option}</select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon">
          <div style="width:80px">Kota / Kab</div>
        </span>
        <select class="form-control" name="kota"/></select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon">
          <div style="width:80px">Kecamatan</div>
        </span>
        <select class="form-control" name="kecamatan"/></select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon">
          <div style="width:80px">Desa</div>
        </span>
        <select class="form-control" name="desa"/></select>
      </div>
      <br>
      <div class="row">
        <!--<div class="col-xs-8">    
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>                        
        </div>-->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div><!-- /.col -->
      </div>
    </form>        

  </div><!-- /.form-box -->
</div><!-- /.register-box -->
<script type="text/javascript">
$(function(){
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    $("select[name='propinsi']").change(function() {
      $("select[name='kota']").html("<option>-</option>");
      $("select[name='kecamatan']").html("<option>-</option>");
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/kota/' + $('select[name=propinsi]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='kota']").html(data.kota);
      }, "json");
    });

    $("select[name='kota']").change(function() {
      $("select[name='kecamatan']").html("<option>-</option>");
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/kecamatan/' + $('select[name=kota]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='kecamatan']").html(data.kecamatan);
      }, "json");
    });

    $("select[name='kecamatan']").change(function() {
      $("select[name='desa']").html("<option>-</option>");
      $.get('<?php echo base_url()?>disbun/desa/' + $('select[name=kecamatan]').val()+'/0', function(response) {
        var data = eval(response);
        $("select[name='desa']").html(data.desa);
      }, "json");
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
