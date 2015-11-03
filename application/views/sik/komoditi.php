<div class="row">
   <div class="col-md-12">
     <div class="register-logo">
        Informasi <b>Komoditi </b>
      </div>
    </div>
</div><!-- Info boxes -->

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php $active = true;
                    foreach ($tab as $row) { ?>
                    <li  <?php if ($active) {echo 'class="active"'; $active = false;} ?>><a href="<?php echo $row['label_id']; ?>" data-toggle="tab">Komoditas <?php echo $row['label']; ?></a></li>
                  <?php } ?>
                </ul>
                <div class="tab-content no-padding">

                  <?php $active = true;
                    foreach ($tab_content as $contentrow) { ?>
                    <div class="tab-pane <?php if ($active) {echo "active"; $active = false;} ?>" id="<?php echo $contentrow['tab_id']; ?>" style="position: relative;">
                      <div class="box box-danger">
                      <div class="box-body">
                        <table id="dataTable_<?php echo $contentrow['tab_id']; ?>" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Komoditi</th>
                              <th>SMB</th>
                              <th>SKMB</th>
                              <th>SKHPP</th>
                              <th>SMKP</th>
                              <th>SMSB</th>
                              <th>SMKE</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $start=0;
                          foreach($contentrow['tab_content'] as $row):?>
                            <tr>
                              <td><?php $start++; echo ($start<10 ? "0":"").$start; ?>&nbsp;</td>
                              <td><a href="<?php echo base_url()?>komoditi/detail/<?php echo $row->kode_komoditi?>"><?php echo $row->nama?></a>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SMB']) ? $sert[$row->kode_komoditi]['SMB'] : 0)?>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SKMB']) ? $sert[$row->kode_komoditi]['SKMB'] : 0)?>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SKHPP']) ? $sert[$row->kode_komoditi]['SKHPP'] : 0)?>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SMKP']) ? $sert[$row->kode_komoditi]['SMKP'] : 0)?>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SMSB']) ? $sert[$row->kode_komoditi]['SMSB'] : 0)?>&nbsp;</td>
                              <td><?php echo (isset($sert[$row->kode_komoditi]['SMKE']) ? $sert[$row->kode_komoditi]['SMKE'] : 0)?>&nbsp;</td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>Komoditi</th>
                              <th>SMB</th>
                              <th>SKMB</th>
                              <th>SKHPP</th>
                              <th>SMKP</th>
                              <th>SMSB</th>
                              <th>SMKE</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div>
                  <?php } ?>
                </div>
              </div>
       

<script src="<?php echo base_url()?>public/themes/disbun/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="<?php echo base_url()?>public/themes/disbun/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<script src="<?php echo base_url()?>public/themes/disbun/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/themes/disbun/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
  $(function () { 
      <?php foreach ($tab_content as $row) { ?>
        $("#dataTable_<?php echo $row['tab_id']; ?>").dataTable();
      <?php } ?>
      $("#dataTable").dataTable();
  });
</script>
