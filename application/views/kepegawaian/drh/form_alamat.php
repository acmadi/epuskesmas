	<form action="<?php echo base_url()?>kepegawaian/drh/{action}/{id}" method="POST" name="">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="form-group">
						<label>No Urut</label>
						<input type="text" class="form-control" name="urut" placeholder="No Urut" value="<?php 
			              if(set_value('urut')=="" && isset($urut)){
			                echo $urut;
			              }else{
			                echo  set_value('urut');
			              }
			            ?>">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" placeholder="No Urut" value="<?php 
			              if(set_value('alamat')=="" && isset($alamat)){
			                echo $alamat;
			              }else{
			                echo  set_value('alamat');
			              }
			            ?>">
					</div>
					<div class="form-group">
						<label>RT</label>
						<input type="text" class="form-control" name="rt" placeholder="No Urut" value="<?php 
			              if(set_value('rt')=="" && isset($rt)){
			                echo $rt;
			              }else{
			                echo  set_value('rt');
			              }
			            ?>">
					</div>
					<div class="form-group">
						<label>RW</label>
						<input type="text" class="form-control" name="rw" placeholder="No Urut" value="<?php 
			              if(set_value('rw')=="" && isset($rw)){
			                echo $rw;
			              }else{
			                echo  set_value('rw');
			              }
			            ?>">
					</div>
					<div class="form-group">
						<label>Provinsi</label>
						<select type="text" class="form-control" name="code_cl_province"  >
							<option value="">--pilih Provinsi--</option>
			                  <?php foreach ($province as $row ) { ?>
			                  <option value="<?php echo $row->code; ?>" onChange="" ><?php echo $row->nama; ?></option>
			                  <?php } ?> 
						</select>
					</div>
					<div class="form-group">
						<label>Kota/Kabupaten</label>
						<select type="text" class="form-control" name="code_cl_province"  >
							<option value="">--pilih Kota / Kabupten--</option>
			                  <?php foreach ($district as $row ) { ?>
			                  <option value="<?php echo $row->code; ?>"><?php echo $row->value; ?></option>
			                  <?php } ?> 
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select type="text" class="form-control" name="code_cl_province"  >
							<option value="">--pilih Kecamatan--</option>
			                  <?php foreach ($kecamatan as $row ) { ?>
			                  <option value="<?php echo $row->code; ?>"><?php echo $row->value; ?></option>
			                  <?php } ?> 
						</select>
					</div>
					<div class="form-group">
						<label>Kelurahan</label>
						<select type="text" class="form-control" name="code_cl_province"  >
							<option value="">--pilih Kelurahan--</option>
			                  <?php foreach ($kelurahan as $row ) { ?>
			                  <option value="<?php echo $row->code; ?>"><?php echo $row->value; ?></option>
			                  <?php } ?> 
						</select>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	</form>
