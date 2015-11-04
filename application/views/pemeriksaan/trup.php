<?php if($this->session->flashdata('alert')!=""){ ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<h4>	<i class="icon fa fa-check"></i> Information!</h4>
	<?php echo $this->session->flashdata('alert')?>
</div>
<?php } ?>

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">{title_form}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
                  <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
						<th>No</th>
						<th>Tanggal<br>Jenis</th>
						<th>Nomor<br>Rekomendasi<br>/ TRUP</th>
						<th>Username<br>Nama</th>
						<th>Tanggal<br>Pemeriksaan</th>
						<th>Masa<br>Berlaku</th>
						<th>Status</th>
						<th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$start=1;
					$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
					foreach($query as $row):
						$tgl_daftar = explode("-", $row->tgl_daftar);
						$tgl_daftar = $tgl_daftar[2]." ".$BulanIndo[(int)$tgl_daftar[1]-1]." ".$tgl_daftar[0];
						
						$tgl_pemeriksaan = explode("-", $row->tgl_pemeriksaan);
						$tgl_pemeriksaan = isset($tgl_pemeriksaan[2]) ? $tgl_pemeriksaan[2]." ".$BulanIndo[(int)$tgl_pemeriksaan[1]-1]." ".$tgl_pemeriksaan[0] : "-";
						
						$tgl_aktif = explode("-", $row->tgl_aktif);
						$tgl_aktif = isset($tgl_aktif[2]) ? $tgl_aktif[2]." ".$BulanIndo[(int)$tgl_aktif[1]-1]." ".$tgl_aktif[0] : "-";

						$tgl_akhir = explode("-", $row->tgl_akhir);
						$tgl_akhir = isset($tgl_akhir[2]) ? $tgl_akhir[2]." ".$BulanIndo[(int)$tgl_akhir[1]-1]." ".$tgl_akhir[0] : "-";

						if($row->statustrup=="aktif"){
							if($row->tgl_akhir>date("Y-m-d")){
								$stat = "<a class='btn btn-success btn-xs' title='Berlaku'>Berlaku</a>";							
							}else{
								$stat = "<a class='btn btn-danger btn-xs' title='Tidak Aktif'>Tidak Aktif</a>";							
							}
						}else{
							$stat = "<a class='btn btn-warning btn-xs' title='Tidak Aktif'>Menunggu</a>";							
						}

					?>
						<tr>
							<td><?php  echo $start++?>&nbsp;</td>
							<td><?php  echo $tgl_daftar."<br>".ucfirst($row->jenistrup);?> Benih</td>
							<td>Rek. <?php  echo $row->kode_trup?><br>TRUP:<?php  echo $row->nomor_trup?></td>
							<td><?php  echo $row->username."<br>".$row->nama?>&nbsp;</td>
							<td><?php  echo $tgl_pemeriksaan?></td>
							<td><?php  echo $tgl_aktif ." s/d<br>".$tgl_akhir ?></td>
							<td align="center"><?php  echo $stat?></td>
							<td align="center"><a class="btn btn-primary btn-xs" href="<?php  echo base_url()?>pemeriksaan/trup_detail/<?php  echo $row->kode_trup?>" title="Detail Account">Detail</a></td>
						</tr>
					<?php endforeach;?>                   
				</tbody>
              </table>
	    </div>

	  </div>
	</div>
  </div>
</section>

<script>
	$(function () {	
        $("#dataTable").dataTable();
		$("#menu_pemeriksaan_trup").addClass("active");
		$("#menu_pemeriksaan").addClass("active");
	});
</script>
