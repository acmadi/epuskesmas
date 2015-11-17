</style>
<?php
if(isset($disable)){if($disable='disable'){?>

<script type="text/javascript">
  $("#dateInput").jqxDateTimeInput({ width: '300px', height: '25px' });
</script>
<?php }} ?>
<script type="text/javascript">
function toRp(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.\t'+e(d)+',00'}
    $(function(){
      $('#btn-close').click(function(){
        close_popup();
      }); 
        $('#form-ss').submit(function(){
            var data = new FormData();
            $('#notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
            $('#notice').show();
            data.append('id_mst_inv_barang', $('#v_kode_barang').val());
            data.append('tanggal_diterima', $('#dateInput').val());
            data.append('nama_barang', $('#v_nama_barang').val());
            data.append('jumlah', $('#jumlah').val());
            data.append('harga', $('#harga').val());
            data.append('keterangan_pengadaan', $('#keterangan').val());
            $.ajax({
                cache : false,
                contentType : false,
                processData : false,
                type : 'POST',
                url : '<?php echo base_url()."inventory/pengadaanbarang/".$action."_barang/".$kode."/".$id_barang."/".$kd_proc."/" ?>',
                data : data,
                success : function(response){
                  var res  = response.split("|");
                  if(res[0]=="OK"){
                      $('#notice').hide();
                      $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                      $('#notice').show();

                      $("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
                      close_popup();
                  }
                  else if(res[0]=="Error"){
                      $('#notice').hide();
                      $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                      $('#notice').show();
                  }
                  else{
                      $('#popup_content').html(response);
                  }
              }
            });

            return false;
        });

        $("#jqxinput").jqxInput(
          {
          placeHolder: " Ketik Kode atau Nama Barang ",
          theme: 'classic',
          width: '100%',
          height: '30px',
          minLength: 2,
          source: function (query, response) {
            var dataAdapter = new $.jqx.dataAdapter
            (
              {
                datatype: "json",
                  datafields: [
                  { name: 'uraian', type: 'string'},
                  { name: 'code', type: 'string'},
                  { name: 'code_tampil', type: 'string'}
                ],
                url: '<?php echo base_url().'inventory/permohonanbarang/autocomplite_barang'; ?>'
              },
              {
                autoBind: true,
                formatData: function (data) {
                  data.query = query;
                  return data;
                },
                loadComplete: function (data) {
                  if (data.length > 0) {
                    response($.map(data, function (item) {
                      return item.code_tampil +' | '+item.uraian;
                    }));
                  }
                }
              });
          }
        });
      
        $("#jqxinput").select(function(){
            var codebarang = $(this).val();
            var res = codebarang.split(" | ");
            $("#v_nama_barang").val(res[1]);
            $("#v_kode_barang").val(res[0].replace(/\./g,""));
        });
        $("#harga").change(function(){
            var jumlah = document.getElementById("jumlah").value;
            var harga = document.getElementById("harga").value;
            var subtotal =jumlah*harga;
            document.getElementById("subtotal").value = toRp(subtotal);
        });
        
    });
</script>

<div style="padding:15px">
  <div id="notice" class="alert alert-success alert-dismissable" <?php if ($notice==""){ echo 'style="display:none"';} ?> >
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
    <i class="icon fa fa-check"></i>
    Information!
    </h4>
    <div id="notice-content">{notice}</div>
  </div>
	<div class="row">
    <?php echo form_open(current_url(), 'id="form-ss"') ?>
    <div class="col-md-6">
    <div class="box box-primary">
          <div class="box-body">
            <div class="form-group">
              <label>Kode Barang</label>
              <input id="jqxinput" class="form-control" autocomplete="off" name="code_mst_inv" type="text" value="<?php 
                if(set_value('code_mst_inv')=="" && isset($id_mst_inv_barang)){
                  $s = array();
                  $s[0] = substr($id_mst_inv_barang, 0,2);
                  $s[1] = substr($id_mst_inv_barang, 2,2);
                  $s[2] = substr($id_mst_inv_barang, 4,2);
                  $s[3] = substr($id_mst_inv_barang, 6,2);
                  $s[4] = substr($id_mst_inv_barang, 8,2);
                  echo implode(".", $s).' | '.$nama_barang;
                }else{
                  echo  set_value('code_mst_inv');
                }
                ?>" <?php if(isset($disable)){if($disable='disable'){echo "readonly";}} ?>/>
              <input id="v_kode_barang" class="form-control" name="code_mst_inv_barang" type="hidden" value="<?php 
                if(set_value('code_mst_inv_barang')=="" && isset($id_mst_inv_barang)){
                  echo $id_mst_inv_barang;
                }else{
                  echo  set_value('code_mst_inv_barang');
                }
                ?>" />
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" class="autocomplete form-control" id="v_nama_barang" name="nama_barang"  placeholder="Nama Barang" value="<?php
              if(set_value('nama_barang')=="" && isset($nama_barang)){
                  echo $nama_barang;
                }else{
                  echo  set_value('nama_barang');
                }
                ?>">
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php 
                if(set_value('jumlah')=="" && isset($jumlah)){
                  echo $jumlah;
                }else{
                  echo  set_value('jumlah');
                }
                ?>">
            </div>
            <div class="form-group">
              <label>Harga Satuan</label>
              <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga Satuan" value="<?php 
                if(set_value('harga')=="" && isset($harga)){
                  echo $harga;
                }else{
                  echo  set_value('harga');
                }
                ?>">
            </div>
            <div class="form-group">
              <label>Sub Total</label>
              <input type="text" class="form-control" name="subtotal"  id="subtotal" placeholder="Sub Total" readonly="" value="<?php
              if(set_value('subtotal')=="" && isset($harga)){
                  echo $jumlah*$harga;
                }else{
                  echo  set_value('subtotal');
                }
                ?>">
            </div>
            <?php if(isset($disable)){if($disable='disable'){?>
            <div class="form-group">
              <label>Tanggal</label>
              <div id='dateInput' name="tanggal_diterima" value="<?php
              echo (!empty($tanggal_diterima)) ? date("Y-m-d",strtotime($tanggal_diterima)) :  date("d-m-Y");
            ?>"></div>
            </div>
            <?php }} ?>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"><?php 
                  if(set_value('keterangan')=="" && isset($keterangan_pengadaan)){
                    echo $keterangan_pengadaan;
                  }else{
                    echo  set_value('keterangan');
                  }
                  ?></textarea>
            </div>
        </div>
        </div>
        </div>
    <div class="col-md-6">
    <div class="box box-warning">
    <div class="box-body">

    <!--body from edit-->
    <?php 
    $kodebarang_ = substr($id_mst_inv_barang, 0,2);
    if($kodebarang_=='01') {?>
      <div class="form-group">
        <label>Luas</label>
        <input type="text" class="form-control" name="luas"  placeholder="Luas"  value="<?php
        if(set_value('luas')=="" && isset($luas)){
            echo $luas;
          }else{
            echo  set_value('luas');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control"  name="alamat" placeholder="alamat"><?php 
        if(set_value('alamat')=="" && isset($alamat)){
          echo $alamat;
        }else{
          echo  set_value('alamat');
        }
        ?></textarea>
      </div>
      <div class="form-group">
        <label>Pilihan Status Barang</label>
        <select  name="pilihan_satuan_barang" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Barang</option>
            </option>
            <?php foreach($pilihan_satuan_barang as $barang) : ?>
              <?php $select = $barang->code == $pilihan_satuan_barang ? 'selected' : '' ?>
              <option value="<?php echo $barang->code ?>" <?php echo $select ?>><?php echo $barang->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Pilihan Status Hak</label>
        <select  name="pilihan_status_hak" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Hak</option>
            </option>
            <?php foreach($pilihan_status_hak as $hak) : ?>
              <?php $select = $hak->code == $pilihan_status_hak ? 'selected' : '' ?>
              <option value="<?php echo $hak->code ?>" <?php echo $select ?>><?php echo $hak->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Tanggal Sertifikat</label>
        <div id='status_sertifikat_tanggal' name="status_sertifikat_tanggal" value="<?php
        echo (!empty($status_sertifikat_tanggal)) ? date("Y-m-d",strtotime($status_sertifikat_tanggal)) :  date("d-m-Y");
      ?>"></div>
      </div>
      <div class="form-group">
        <label>Nomor Sertifikat</label>
        <input type="text" class="form-control" name="status_sertifikat_nomor"  placeholder="Nomor Sertifikat"  value="<?php
        if(set_value('status_sertifikat_nomor')=="" && isset($status_sertifikat_nomor)){
            echo $status_sertifikat_nomor;
          }else{
            echo  set_value('status_sertifikat_nomor');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Penggunaan</label>
        <select  name="pilihan_penggunaan" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Penggunaan</option>
            </option>
            <?php foreach($pilihan_penggunaan as $pengguna) : ?>
              <?php $select = $pengguna->code == $pilihan_penggunaan ? 'selected' : '' ?>
              <option value="<?php echo $pengguna->code ?>" <?php echo $select ?>><?php echo $pengguna->value ?></option>
            <?php endforeach ?>
        </select>
      </div>

      <?php  }else if($kodebarang_=='02') {?>

      <div class="form-group">
        <label>Merek Tipe</label>
        <textarea class="form-control"  name="merek_type" placeholder="Keterangan"><?php 
        if(set_value('merek_type')=="" && isset($merek_type)){
          echo $merek_type;
        }else{
          echo  set_value('merek_type');
        }
        ?></textarea>
      </div>
      <div class="form-group">
        <label>Identitas Barang</label>
        <textarea class="form-control"  name="identitas_barang" placeholder="Keterangan"><?php 
        if(set_value('identitas_barang')=="" && isset($identitas_barang)){
          echo $identitas_barang;
        }else{
          echo  set_value('identitas_barang');
        }
        ?></textarea>
      </div>
      <div class="form-group">
        <label>Pilihan Barang</label>
        <select  name="pilihan_bahan" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Barang</option>
            </option>
            <?php foreach($pilihan_bahan as $bahan) : ?>
              <?php $select = $bahan->code == $pilihan_bahan ? 'selected' : '' ?>
              <option value="<?php echo $bahan->code ?>" <?php echo $select ?>><?php echo $bahan->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Ukuran Barang</label>
        <input type="text" class="form-control" name="ukuran_barang"  placeholder="Ukuran Barang"  value="<?php
        if(set_value('ukuran_barang')=="" && isset($ukuran_barang)){
            echo $ukuran_barang;
          }else{
            echo  set_value('ukuran_barang');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Satuan</label>
        <select  name="pilihan_satuan" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Satuan</option>
            </option>
            <?php foreach($pilihan_satuan as $satuan) : ?>
              <?php $select = $satuan->code == $pilihan_satuan ? 'selected' : '' ?>
              <option value="<?php echo $satuan->code ?>" <?php echo $select ?>><?php echo $satuan->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Tanggal BPKB</label>
        <div id='tanggal_bpkb' name="tanggal_bpkb" value="<?php
        echo (!empty($tanggal_bpkb)) ? date("Y-m-d",strtotime($tanggal_bpkb)) :  date("d-m-Y");
      ?>"></div>
      </div>
      <div class="form-group">
        <label>Nomor BPKB</label>
        <input type="text" class="form-control" name="nomor_bpkb"  placeholder="Nomor BPKB"  value="<?php
        if(set_value('nomor_bpkb')=="" && isset($nomor_bpkb)){
            echo $nomor_bpkb;
          }else{
            echo  set_value('nomor_bpkb');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Nomor Polisi</label>
        <input type="text" class="form-control" name="no_polisi"  placeholder="Nomor Polisi"  value="<?php
        if(set_value('no_polisi')=="" && isset($no_polisi)){
            echo $no_polisi;
          }else{
            echo  set_value('no_polisi');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Tanggal Perolehan</label>
        <div id='tanggal_perolehan' name="tanggal_perolehan" value="<?php
        echo (!empty($tanggal_perolehan)) ? date("Y-m-d",strtotime($tanggal_perolehan)) :  date("d-m-Y");
      ?>"></div>
      </div>


      <?php  }else if($kodebarang_=='03') {?>
        
      <div class="form-group">
        <label>Luas Lantai</label>
        <input type="text" class="form-control" name="luas_lantai"  placeholder="Luas Lantai"  value="<?php
        if(set_value('luas_lantai')=="" && isset($luas_lantai)){
            echo $luas_lantai;
          }else{
            echo  set_value('luas_lantai');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Alamat Lokasi</label>
        <textarea class="form-control" id="letak_lokasi_alamat" name="letak_lokasi_alamat" placeholder="Lokasi Alamat"><?php 
            if(set_value('letak_lokasi_alamat')=="" && isset($letak_lokasi_alamat)){
              echo $letak_lokasi_alamat;
            }else{
              echo  set_value('letak_lokasi_alamat');
            }
            ?></textarea>
      </div>
      <div class="form-group">
        <label>Pilihan Status Hak</label>
        <select  name="pillihan_status_hak" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Status Hak</option>
            </option>
            <?php foreach($pillihan_status_hak as $hak) : ?>
              <?php $select = $hak->code == $pillihan_status_hak ? 'selected' : '' ?>
              <option value="<?php echo $hak->code ?>" <?php echo $select ?>><?php echo $hak->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Nomor Kode Tanah</label>
        <input type="text" class="form-control" name="nomor_kode_tanah"  placeholder="Nomor Kode Tanah"  value="<?php
        if(set_value('nomor_kode_tanah')=="" && isset($nomor_kode_tanah)){
            echo $nomor_kode_tanah;
          }else{
            echo  set_value('nomor_kode_tanah');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Kontruksi Tingkat</label>
        <select  name="pilihan_kons_tingkat" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilih Kontruksi Tingkat</option>
            </option>
            <?php foreach($pilihan_kons_tingkat as $tingkat) : ?>
              <?php $select = $tingkat->code == $pilihan_kons_tingkat ? 'selected' : '' ?>
              <option value="<?php echo $tingkat->code ?>" <?php echo $select ?>><?php echo $tingkat->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Pilihan Kontruksi Beton</label>
        <select  name="pilihan_kons_beton" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Kontruksi Beton</option>
            </option>
            <?php foreach($pilihan_kons_beton as $beton) : ?>
              <?php $select = $beton->code == $pilihan_kons_beton ? 'selected' : '' ?>
              <option value="<?php echo $beton->code ?>" <?php echo $select ?>><?php echo $beton->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Tanggal Dokumen</label>
        <div id='dokumen_tanggal' name="dokumen_tanggal" value="<?php
        echo (!empty($dokumen_tanggal)) ? date("Y-m-d",strtotime($dokumen_tanggal)) :  date("d-m-Y");
      ?>"></div>
      </div>
      <div class="form-group">
        <label>Nomor Dokumen</label>
        <input type="text" class="form-control" name="dokumen_nomor"  placeholder="Nomor Dokumen"  value="<?php
        if(set_value('dokumen_nomor')=="" && isset($dokumen_nomor)){
            echo $dokumen_nomor;
          }else{
            echo  set_value('dokumen_nomor');
          }
          ?>">
      </div>


      <?php  }else if($kodebarang_=='04') {?>
      
      <div class="form-group">
        <label>Kontruksi</label>
        <textarea class="form-control" id="konstruksi" name="konstruksi" placeholder="Kontruksi"><?php 
            if(set_value('konstruksi')=="" && isset($konstruksi)){
              echo $konstruksi;
            }else{
              echo  set_value('konstruksi');
            }
            ?></textarea>
      </div>
      <div class="form-group">
        <label>Panjang</label>
        <input type="text" class="form-control" name="panjang"  placeholder="Panjang"  value="<?php
        if(set_value('panjang')=="" && isset($panjang)){
            echo $panjang;
          }else{
            echo  set_value('panjang');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Lebar</label>
        <input type="text" class="form-control" name="lebar"  placeholder="Lebar"  value="<?php
        if(set_value('lebar')=="" && isset($lebar)){
            echo $lebar;
          }else{
            echo  set_value('lebar');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Luas</label>
        <input type="text" class="form-control" name="luas"  placeholder="Luas"  value="<?php
        if(set_value('luas')=="" && isset($luas)){
            echo $luas;
          }else{
            echo  set_value('luas');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Alamat Lokasi</label>
        <textarea class="form-control" id="letak_lokasi_alamat" name="letak_lokasi_alamat" placeholder="Alamat Lokasi"><?php 
            if(set_value('letak_lokasi_alamat')=="" && isset($letak_lokasi_alamat)){
              echo $letak_lokasi_alamat;
            }else{
              echo  set_value('letak_lokasi_alamat');
            }
            ?></textarea>
      </div>
      <div class="form-group">
              <label>Tanggal Dokumen</label>
              <div id='dokumen_tanggal' name="dokumen_tanggal" value="<?php
              echo (!empty($dokumen_tanggal)) ? date("Y-m-d",strtotime($dokumen_tanggal)) :  date("d-m-Y");
            ?>"></div>
            </div>
      <div class="form-group">
        <label>Nomor Dokumen</label>
        <input type="text" class="form-control" name="dokumen_nomor"  placeholder="dokumen_nomor"  value="<?php
        if(set_value('dokumen_nomor')=="" && isset($dokumen_nomor)){
            echo $dokumen_nomor;
          }else{
            echo  set_value('dokumen_nomor');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Status Tanah</label>
        <select  name="pilihan_status_tanah" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Status Tanah</option>
            </option>
            <?php foreach($pilihan_status_tanah as $tanah) : ?>
              <?php $select = $tanah->code == $pilihan_status_tanah ? 'selected' : '' ?>
              <option value="<?php echo $tanah->code ?>" <?php echo $select ?>><?php echo $tanah->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Nomor Kode Tanah</label>
        <input type="text" class="form-control" name="nomor_kode_tanah"  placeholder="Nomor Kode Tanah"  value="<?php
        if(set_value('nomor_kode_tanah')=="" && isset($nomor_kode_tanah)){
            echo $nomor_kode_tanah;
          }else{
            echo  set_value('nomor_kode_tanah');
          }
          ?>">
      </div>


      <?php  }else if($kodebarang_=='05') {?>
      
      <div class="form-group">
        <label>Judul Buku Pencipta</label>
        <input type="text" class="form-control" name="buku_judul_pencipta"  placeholder="Judul Buku Pencipta"  value="<?php
        if(set_value('buku_judul_pencipta')=="" && isset($buku_judul_pencipta)){
            echo $buku_judul_pencipta;
          }else{
            echo  set_value('buku_judul_pencipta');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Spesifikasi Buku</label>
        <textarea class="form-control" id="buku_spesifikasi" name="buku_spesifikasi" placeholder="Spesifikasi Buku"><?php 
            if(set_value('buku_spesifikasi')=="" && isset($buku_spesifikasi)){
              echo $buku_spesifikasi;
            }else{
              echo  set_value('buku_spesifikasi');
            }
            ?></textarea>
      </div>
      <div class="form-group">
        <label>Budaya Asal Daerah</label>
        <input type="text" class="form-control" name="budaya_asal_daerah"  placeholder="Budaya Asal Daerah"  value="<?php
        if(set_value('budaya_asal_daerah')=="" && isset($budaya_asal_daerah)){
            echo $budaya_asal_daerah;
          }else{
            echo  set_value('budaya_asal_daerah');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pencipta Budaya</label>
        <input type="text" class="form-control" name="budaya_pencipta"  placeholder="Pencipta Budaya"  value="<?php
        if(set_value('budaya_pencipta')=="" && isset($budaya_pencipta)){
            echo $budaya_pencipta;
          }else{
            echo  set_value('budaya_pencipta');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Budaya Bahan</label>
        <select  name="pilihan_budaya_bahan" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Budaya Bahan</option>
            </option>
            <?php foreach($pilihan_budaya_bahan as $bahan) : ?>
              <?php $select = $bahan->code == $pilihan_budaya_bahan ? 'selected' : '' ?>
              <option value="<?php echo $bahan->code ?>" <?php echo $select ?>><?php echo $bahan->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Jenis Flora dan Fauna</label>
        <input type="text" class="form-control" name="flora_fauna_jenis"  placeholder="Jenis Flora dan Fauna<"  value="<?php
        if(set_value('flora_fauna_jenis')=="" && isset($flora_fauna_jenis)){
            echo $flora_fauna_jenis;
          }else{
            echo  set_value('flora_fauna_jenis');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Ukuran Flora dan Fauna</label>
        <input type="text" class="form-control" name="flora_fauna_ukuran"  placeholder="Ukuran Flora dan Fauna"  value="<?php
        if(set_value('buku_judul_pencipta')=="" && isset($flora_fauna_ukuran)){
            echo $flora_fauna_ukuran;
          }else{
            echo  set_value('flora_fauna_ukuran');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Satuan</label>
        <select  name="pilihan_satuan" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Status Tanah</option>
            </option>
            <?php foreach($pilihan_satuan as $satuan) : ?>
              <?php $select = $satuan->code == $pilihan_satuan ? 'selected' : '' ?>
              <option value="<?php echo $satuan->code ?>" <?php echo $select ?>><?php echo $satuan->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Tahun Cetak Beli</label>
        <div id='tahun_cetak_beli' name="tahun_cetak_beli" value="<?php
        echo (!empty($tahun_cetak_beli)) ? date("Y-m-d",strtotime($tahun_cetak_beli)) :  date("d-m-Y");
      ?>"></div>
      </div>


      <?php  }else if($kodebarang_=='06') {?>
      
      <div class="form-group">
        <label>Bangunan</label>
        <input type="text" class="form-control" name="bangunan"  placeholder="Bangunan"  value="<?php
        if(set_value('bangunan')=="" && isset($bangunan)){
            echo $bangunan;
          }else{
            echo  set_value('bangunan');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Pilihan Kontruksi Bertingkat</label>
        <select  name="pilihan_konstruksi_bertingkat" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Kontruksi Bertingkat</option>
            </option>
            <?php foreach($pilihan_konstruksi_bertingkat as $tingkat) : ?>
              <?php $select = $tingkat->code == $pilihan_konstruksi_bertingkat ? 'selected' : '' ?>
              <option value="<?php echo $tingkat->code ?>" <?php echo $select ?>><?php echo $tingkat->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Pilihan Kontruksi Beton</label>
        <select  name="pilihan_konstruksi_beton" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Kontruksi Beton</option>
            </option>
            <?php foreach($pilihan_konstruksi_beton as $beton) : ?>
              <?php $select = $beton->code == $pilihan_konstruksi_beton ? 'selected' : '' ?>
              <option value="<?php echo $beton->code ?>" <?php echo $select ?>><?php echo $beton->value ?></option>
            <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Luas</label>
        <input type="text" class="form-control" name="luas"  placeholder="Luas"  value="<?php
        if(set_value('luas')=="" && isset($luas)){
            echo $luas;
          }else{
            echo  set_value('luas');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Lokasi</label>
        <textarea class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi"><?php 
            if(set_value('lokasi')=="" && isset($lokasi)){
              echo $lokasi;
            }else{
              echo  set_value('lokasi');
            }
            ?></textarea>
      </div>
      <div class="form-group">
        <label>Tanggal Dokumen</label>
        <div id='dateInput' name="dokumen_tanggal" value="<?php
        echo (!empty($dokumen_tanggal)) ? date("Y-m-d",strtotime($dokumen_tanggal)) :  date("d-m-Y");
      ?>"></div>
      <div class="form-group">
        <label>Nomor Dokumen</label>
        <input type="text" class="form-control" name="dokumen_nomor"  placeholder="Nomor Dokumen"  value="<?php
        if(set_value('dokumen_nomor')=="" && isset($dokumen_nomor)){
            echo $dokumen_nomor;
          }else{
            echo  set_value('dokumen_nomor');
          }
          ?>">
      </div>
      <div class="form-group">
        <label>Tanggal Mulai</label>
        <div id='tanggal_mulai' name="tanggal_mulai" value="<?php
        echo (!empty($tanggal_mulai)) ? date("Y-m-d",strtotime($tanggal_mulai)) :  date("d-m-Y");
      ?>"></div>
      <div class="form-group">
        <label>Pilihan Status Tanah</label>
        <select  name="pilihan_konstruksi_beton" type="text" class="form-control" <?php if(isset($viewreadonly)){if($action='view'){echo "disabled"; }}?>>
            <option value="">Pilihan Status Tanah</option>
            </option>
            <?php foreach($pilihan_konstruksi_beton as $beton) : ?>
              <?php $select = $beton->code == $pilihan_konstruksi_beton ? 'selected' : '' ?>
              <option value="<?php echo $beton->code ?>" <?php echo $select ?>><?php echo $beton->value ?></option>
            <?php endforeach ?>
        </select>
      </div>

      <?php } ?>
<!--end from edit-->
    </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" id="btn-close" class="btn btn-warning">Batal</button>
        </div>
    </div>
    </div>
    </div>
</form>
</div>
