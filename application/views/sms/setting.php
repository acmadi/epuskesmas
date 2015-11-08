
<?php if($this->session->flashdata('alert_form')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert_form')?>
</div>
<?php } ?>

<section class="content">
<form action="<?php echo base_url()?>admin_config/doupdate" method="POST" name="frmUsers">
  <div class="row">
    <!-- left column -->
    <div class="col-md-4">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Modem {title_form}</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">COM Port</label>
              <input type="text" class="form-control" name="com" placeholder="COM" value="{com}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Card Number</label>
              <input type="text" class="form-control" name="cardnumber" placeholder="Number" value="{cardnumber}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Daemon Status</label>
              <?php echo form_dropdown('damon_status', array("Running","Stop"), "running"," class=form-control");?>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-warning">Reset</button>
          </div>
      </div><!-- /.box -->
  	</div><!-- /.box -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title">Modem Testing</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Request USSD</label>
              <input type="text" class="form-control" name="mail_server" placeholder="{mail_server}" value="{mail_server}">
            </div>
          <div class="box-footer">
            <button type="button" class="btn btn-primary">Request</button>
            <button type="button" class="btn btn-success">Identify</button>
          </div>
          <div class="box-footer">
            <button type="button" class="btn btn-warning">Clean Inbox</button>
            <button type="button" class="btn btn-warning">Clean Sent Items</button>
            <button type="button" class="btn btn-warning">Clean Outbox</button>
            <button type="button" class="btn btn-danger">Restart Service</button>
          </div>
          <div class="box-footer">
              <b>Informasi :</b>
              <ul>
                <li>Contoh request USSD adalah *123#.</li>
                <li>Jika ada pesan "Error opening device, it is already opened by other application." pada saat request USSD artinya sedang ada proses background dan silahkan tunggu beberapa saat dan coba lagi.</li>
                <li>Jika request USSD gagal, silahkan tunggu beberapa saat dan coba lagi.</li>
                <li>Clean Inbox / Sent Items / Outbox digunakan untuk membersihkan SMS di database aplikasi.</li>
                <li>Restart Service digunakan untuk mengulang service jika terjadi masalah pada service.</li>
              </ul>
          </div>
      </div><!-- /.box -->
  	</div><!-- /.box -->  
  </div><!-- /.box -->
</form>
</section>

<script>
	$(function () {	
		$("#menu_admin_panel").addClass("active");
		$("#menu_sms_setting").addClass("active");
	});
</script>