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
      <li class="active"><a href="#tab_1" data-toggle="tab">Detail Sertifikat</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tab_1"> 
      <div class="row">
        <div class="col-md-8">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-certificate"></i> Cetak Sertifikat </h3>
            </div>
            <div class="box-body">
            <?php 
                if(set_value('preview')=="" && isset($preview)){
                  echo $preview;
                }else{
                  echo  set_value('preview');
                }
              ?>
                <!-- <div class="form-group">
                  <div class="text-center" style="text-decoration:underline;font-size:18px"><b>SURAT KETERANGAN MUTU BENIH</b></div>
                  <div class="text-center"><b>Nomor : 525/110/SKMB/BP2MP/2015</b></div>
                  <div style="padding-top:20px">
                    <p style="text-align:justify">
                      Berdasarkan ketentuan yang berlaku tentang Pengawasan dan Pengujian Mutu Benih Tanaman Perkebunan di wilayah Negara Kesatuan Republik Indonesia
                      (UU. No. 12 / 1992, PP. No. 44 / 1995, Peraturan Menteri Pertanian No. 02 / 2014) dan dari hasil pemeriksaan lapangan (Teknis dan Administrasi) 
                      yang dilaksanakan pada tanggal 23 Maret 2015 oleh Petugas Pengawas Benih Tanam (PBT) pada Balai Pengawasan dan Pengujian Mutu Benih (BP2MB)
                      Tanaman Perkebunan Provinsi Jawa Barat terhadap:
                    </p>
                    <p>
                    <ol>
                      <li style="font-weight:bold;padding:4px">Pemohon Sertifikasi
                        <table width="100%" cellpadding="4" style="font-weight:normal">
                          <tr valign="top">
                            <td width="25%">a. Nama</td>
                            <td>:</td>
                            <td>Siti Aisyah Riyanti, S.Si<br>(Direktur Umum / Keuangan PT. Darma Prema Bioenergy)</td>
                          </tr>
                          <tr valign="top">
                            <td>b. Alamat</td>
                            <td>:</td>
                            <td>Komplek Puri Cipageran Indah 2 Blok B.12 No.6 Desa Tanimulya<br>
                              Kec. Ngamprah Kab. Bandung Barat</td>
                          </tr>
                          <tr valign="top">
                            <td>c. No. / Tgl. Permohonan</td>
                            <td>:</td>
                            <td>12/DPB/03/2015, tanggal 04 Maret 2015</td>
                          </tr>
                        </table>
                      </li>
                      <li style="font-weight:bold;padding:4px">Benih yang disertifikasi
                        <table width="100%" cellpadding="4" style="font-weight:normal">
                          <tr valign="top">
                            <td width="25%">a. Jenis Tanaman</td>
                            <td>:</td>
                            <td>Kemiri Sunan</td>
                          </tr>
                          <tr valign="top">
                            <td>b. Bentuk Benih</td>
                            <td>:</td>
                            <td>Benih Polibag</td>
                          </tr>
                          <tr valign="top">
                            <td>c. Asal Benih</td>
                            <td>:</td>
                            <td>Kabupaten Garut</td>
                          </tr>
                          <tr valign="top">
                            <td>d. Varietas</td>
                            <td>:</td>
                            <td>Kemindo 1</td>
                          </tr>
                          <tr valign="top">
                            <td>e. Kelas Benih</td>
                            <td>:</td>
                            <td>Benih Sebar</td>
                          </tr>
                          <tr valign="top">
                            <td>f. Umur Benih</td>
                            <td>:</td>
                            <td>3 bulan</td>
                          </tr>
                          <tr valign="top">
                            <td>g. Lokasi Pembibitan</td>
                            <td>:</td>
                            <td>Komplek Puri Cipageran Indah 2 Blok B.12 No.6, Desa Tanimulya<br>
                              Kec. Ngamprah Kab.Bandung Barat</td>
                          </tr>
                        </table>
                      </li>
                      <li style="font-weight:bold;padding:4px">Hasil Pemeriksaan
                        <table width="100%" cellpadding="4" style="border:1px solid black">
                          <tr valign="top">
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid">Diajukan/<br>Diperiksa<br>(Phn)</td>
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid">Memenuhi<br>Syarat<br>(Phn)</td>
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid">Tidak Memenuhi<br>Syarat<br>(Phn)</td>
                            <td style="text-align:center;border-bottom:1px black solid">Standar Mutu Bibit<br>Memenuhi Syarat:</td>
                          </tr>
                          <tr valign="top">
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid"><br>1.585</td>
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid"><br>1.455</td>
                            <td style="text-align:center;border-right:1px black solid;border-bottom:1px black solid"><br>130</td>
                            <td style="font-weight:normal;border-bottom:1px black solid">
                              - Umur benih minimal 3 bulan<br>
                              - Tinggi benih minimal 40 cm<br>
                              - Jumlah daun minimal 8 lembar<br>
                              - Warna daun hijau s.d hijau tua<br>
                              - Diameter batang minimal 6 mm<br>
                              - Batang sudah berkayu hijau kecoklatan<br>
                              - Kondisi benih sehat dan bebas hama penyakit
                            </td>
                          </tr>
                          <tr valign="top">
                            <td style="border-right:1px black solid" colspan="3">Pengawas Benih Tanaman</td>
                            <td style="font-weight:normal">Beny Badruzzaman, SP.</td>
                          </tr>
                        </table>
                      </li>
                      <li style="font-weight:bold;padding:4px">Kesimpulan
                        <table width="100%" cellpadding="4" style="font-weight:normal">
                          <tr valign="top">
                            <td width="4%">a.</td>
                            <td>Benih tersebut <span style="font-weight:bold;">Memenuhi Syarat sebagai Benih Sebar</span> sejumlah 1.445 pohon dan harus diberi
                            label  <span style="font-weight:bold;color:pink">Warna Merah Jambu</span> dengan waktu penyaluran minimal pada bulan Mei 2015.</td>
                          </tr>
                          <tr valign="top">
                            <td>b.</td>
                            <td>Benih yang tidak memenuhi syarat standar mutu benih sejumlah 130 pohon tidak boleh disalurkan,<br>
                            dan benih yang disalurkan/diedarkan agar dilaporkan ke BP2MB Tanaman Perkebunan Provinsi Jawa Barat.</td>
                          </tr>
                          <tr valign="top">
                            <td>c.</td>
                            <td>Bila dalam penyaluran / peredarannya terhadap benih yang tidak memenuhi syarat standar mutu
                              benih, maka hal tersebut diluar tanggung jawab pihak BP2MB Tanaman Perkebunan Provinsi Jawa Barat.</td>
                          </tr>
                          <tr valign="top">
                            <td>d.</td>
                            <td>Surat Keterangan Mutu Benih ini dibuat dalam rangkap 2 (dua), 1 (satu) untuk arsip BP2MB Tanaman 
                              Perkebunan Provinsi Jawa Barat, sedangkan untuk kepentingan penyaluran/peredarannya harus 
                              menggunakan fotocopy SKMB yang dilegalisir oleh BP2MB Tanaman Perkebunan Provinsi Jawa Barat</td>
                          </tr>
                          <tr valign="top">
                            <td>e.</td>
                            <td>Surat Keterangan Mutu Benih ini berlaku sampai dengan tanggal 23 Juli 2015</td>
                          </tr>
                        </table>
                      </li>
                    </ol>
                    </p>
                  </div>    
                  <p style="text-align:justify">
                      Dengan <b>Surat Keterangan Mutu Benih</b> ini dibuat danhanya berlaku untuk benih yang
                      tercantum identitas dan jumlahnya seperti pada lembar surat keterangan ini.
                    </p>

                </div> -->
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <button type="button" id="btn-print" class="btn btn-warning btn-social"><i class="fa fa-print"></i> Cetak Sertifikat</button>
            <br><br>
            <button type="button" id="btn-back" class="btn btn-primary btn-social"><i class="fa fa-reply"></i> Kembali</button>
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
    $("#menu_sertifikat_nonaktif").addClass("active");
    $("#menu_sertifikat").addClass("active");

    $("#dataTable").dataTable();
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("#datemask2").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    $("#btn-back").click(function(){
    	document.location.href="<?php echo base_url()?>sertifikat/nonaktif";
    });

     $('#btn-print').click(function(){
        $.get("<?php echo base_url()?>sertifikat/pdf_sertifikat/{kode_permohonan}/{kode_varietas}/{kode_komoditi}", function(response) {
          window.open("<?php echo base_url()?>sertifikat/load_pdf/{kode_permohonan}/{kode_varietas}/{kode_komoditi}");
        });

    });

  });
</script>
