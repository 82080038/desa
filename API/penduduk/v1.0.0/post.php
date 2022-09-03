<?php
$perintah=$_POST['perintah'];
$hasilKerja=array();

switch ($perintah) {
  case 'simpanDatapendudukDPS':
  include "excel_reader2.php";
  $idAlamat=$_POST['idAlamat'];
  $alamatKeDatabase=json_encode(getAlamat($idAlamat));
  $target = basename($_FILES['filePenduduk']['name']) ;
  move_uploaded_file($_FILES['filePenduduk']['tmp_name'], $target);
// beri permisi agar file xls dapat di baca
  chmod($_FILES['filePenduduk']['name'],0777);
// mengambil isi file xls
  $data = new Spreadsheet_Excel_Reader($_FILES['filePenduduk']['name'],false);
// menghitung jumlah baris data yang ada
  $jumlah_baris = $data->rowcount($sheet_index=0);
// jumlah default data yang berhasil di import
  $berhasil = 0;
  $namaBerhasil=array();
  for ($i=1; $i<=$jumlah_baris; $i++){
  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $KK1     = $data->val($i, 2);
    $KK = preg_replace("/[^0-9]/", "", $KK1);
    $NIK1   = $data->val($i, 3);
    $NIK = preg_replace("/[^0-9]/", "", $NIK1);
    $nama  =addslashes($data->val($i, 4));
    $tptLahir  = addslashes($data->val($i, 5));
    $tgl_lahir  =preg_replace("/[^0-9]/", "", $data->val($i, 6));
    $tgl_lahir1=substr($tgl_lahir,0,2);
    $tgl_lahir2=substr($tgl_lahir,2,2);
    $tgl_lahir3=substr($tgl_lahir,4,4);
    $tgl_lahirExcel=date("$tgl_lahir3-$tgl_lahir2-$tgl_lahir1");
    $umur  = $data->val($i, 7);
    $BelumKawin  = $data->val($i, 8);
    $SudahKawin  = $data->val($i, 9);
    $PernahKawin  = $data->val($i, 10);
    $jkL  = $data->val($i, 11);
    $jkP  = $data->val($i, 12);
    $dusun  = $data->val($i, 13);
    $pecahkannik=substr($NIK,6,6);
    $hari_lahir=substr($pecahkannik,0,2);
    $bulan=substr($pecahkannik,2,2);
    $tahun=substr($pecahkannik,4,2);
    $tahunAwal="$tahun";
    $tahunPecah="19$tahunAwal";
    if($hari_lahir>40){
      $jk='P';
      $Hasil_hitung=$hari_lahir-40;
      if($Hasil_hitung==0){
        $hari_lahir='01';
      }else{
        $hari_lahir=$Hasil_hitung;
      }
    }else{
      $jk='L';
      $hari_lahir=$hari_lahir;
    }
    $hari_lahir=sprintf("%02d", "$hari_lahir");
    $tahun_sekarang=date("Y");
    $hitungUmur=date('Y')-($tahunPecah);
    $tahunawaltambahduaribu=intval($tahunAwal+2000);
    if($tahunawaltambahduaribu>$tahun_sekarang){
      $tambahanTahun="19$tahunAwal";
    }
    else
    {
      $tambahanTahun="20$tahunAwal";
    }
    $tanggal_lahir=$tambahanTahun."-".$bulan."-".sprintf("%02d", "$hari_lahir");
    $unixTimeSaatIni = time();
    $unixTimeTahunLahir= strtotime($tanggal_lahir);
    $unixTimeDalamSetahun = 31536000;
    $hitungUsia = ($unixTimeSaatIni - $unixTimeTahunLahir) / $unixTimeDalamSetahun;
    $usia=floor($hitungUsia);
    $kawin=trim($BelumKawin.$SudahKawin.$PernahKawin);
    if($nama != ""){
      $querySimpan="INSERT INTO `tbl_dps`
      (`no_kk`, `nik`, `nama_lengkap`, `jk`, `tpt_lahir`, `tgl_lahir`,`tgl_lahir_excel`, `umur`, `kawin`, `id_alamat`,`tulisan_alamat`)
      VALUES 
      ('$KK','$NIK','$nama','$jk','$tptLahir','$tanggal_lahir','$tgl_lahirExcel','$usia','$kawin','$idAlamat','$alamatKeDatabase')";
      $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
      if($kerjakanSimpan){
        $hasilKerja['simpan']=true;
        $hasilKerja['jumlahBerhasil']=$berhasil++;
        $namaBerhasil['data'][$i]="$i. $nama, JK: $jk, NIK: $NIK, Tanggal lahir : $tanggal_lahir, usia: $usia thn.";
      }else{
        $hasilKerja['simpan']=false;
        $hasilKerja['jumlahBerhasil']=$berhasil++;
      }
    }
  } 
  $hasilKerja['dataOrang']=$namaBerhasil;
  echo json_encode($hasilKerja);
// hapus kembali file .xls yang di upload tadi
  unlink($_FILES['filePenduduk']['name']);
// alihkan halaman ke index.php
// header("location:index.php?berhasil=$berhasil");
  break;
  case 'importDataWarga':
  include "excel_reader2.php";
  $target = basename($_FILES['fileImport']['name']) ;
  move_uploaded_file($_FILES['fileImport']['tmp_name'], $target);
// beri permisi agar file xls dapat di baca
  chmod($_FILES['fileImport']['name'],0777);
// mengambil isi file xls
  $data = new Spreadsheet_Excel_Reader($_FILES['fileImport']['name'],false);
// menghitung jumlah baris data yang ada
  $jumlah_baris = $data->rowcount($sheet_index=0);
// jumlah default data yang berhasil di import
  $berhasil = 0;
  $namaBerhasil=array();
  for ($i=1; $i<=$jumlah_baris; $i++){
  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $nomor=$data->val($i, 1);
    $NIK1   = $data->val($i, 2);
    $NIK = preg_replace("/[^0-9]/", "", $NIK1);
    $nama  =addslashes($data->val($i, 3));
    $kecamatan  = $data->val($i, 4);
    $desa  = $data->val($i, 4);
    $alamat  = $data->val($i, 4);
    $pecahkannik=substr($nik,6,6);
    $hari_lahir=substr($pecahkannik,0,2);
    if($hari_lahir>=40){
      $jk='P';
      $Hasil_hitung=$hari_lahir-40;
      if($Hasil_hitung==0){
        $hari_lahir='01';
      }else{
        $hari_lahir=$Hasil_hitung;
      }
    }else{
      $jk='L';
      $hari_lahir=$hari_lahir;
    }
    $bulan=substr($pecahkannik,2,2);
    $tahun=substr($pecahkannik,4,2);
    $tahunAwal="$tahun";
    $tahunPecah="19$tahunAwal";
    if($hari_lahir>40){
      $jk='P';
      $Hasil_hitung=$hari_lahir-40;
      if($Hasil_hitung==0){
        $hari_lahir='01';
      }else{
        $hari_lahir=$Hasil_hitung;
      }
    }else{
      $jk='L';
      $hari_lahir=$hari_lahir;
    }
    $hari_lahir=sprintf("%02d", "$hari_lahir");
    $tahun_sekarang=date("Y");
    $hitungUmur=date('Y')-($tahunPecah);
    $tahunawaltambahduaribu=intval($tahunAwal+2000);
  //LINE 74 Warning: A non-numeric value encountered in C:\xampp\htdocs\API2\vaksin\v1.0.0\post.php on line 74
    if($tahunawaltambahduaribu>$tahun_sekarang){
      $tambahanTahun="19$tahunAwal";
    }
    else
    {
      $tambahanTahun="20$tahunAwal";
    }
    $tanggal_lahir=$tambahanTahun."-".$bulan."-".sprintf("%02d", "$hari_lahir");
    $unixTimeSaatIni = time();
    $unixTimeTahunLahir= strtotime($tanggal_lahir);
    $unixTimeDalamSetahun = 31536000;
    $hitungUsia = ($unixTimeSaatIni - $unixTimeTahunLahir) / $unixTimeDalamSetahun;
    $usia=floor($hitungUsia);
    if($nama != ""){
      $querySimpan="INSERT INTO `tbl_dps`
      (`no_kk`, `nik`, `nama_lengkap`, `jk`, `tpt_lahir`, `tgl_lahir`,`tgl_lahir_excel`, `umur`, `kawin`, `id_alamat`,`tulisan_alamat`)
      VALUES 
      ('$KK','$NIK','$nama','$jk','$tptLahir','$tanggal_lahir','$tgl_lahirExcel','$usia','$kawin','$idAlamat','$alamatKeDatabase')";
      $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
      if($kerjakanSimpan){
        $hasilKerja['simpan']=true;
        $hasilKerja['jumlahBerhasil']=$berhasil++;
        $namaBerhasil['data'][$i]="$i. $nama, JK: $jk, NIK: $NIK, Tanggal lahir : $tanggal_lahir, usia: $usia thn.";
      }else{
        $hasilKerja['simpan']=false;
        $hasilKerja['jumlahBerhasil']=$berhasil++;
      }
    }
  } 
  $hasilKerja['dataOrang']=$namaBerhasil;
  echo json_encode($hasilKerja);
// hapus kembali file .xls yang di upload tadi
  unlink($_FILES['fileImport']['name']);
// alihkan halaman ke index.php
// header("location:index.php?berhasil=$berhasil");
  break;
  case 'updateDataWarga':
  $ambilNIK="SELECT
  tbl_warga.id_warga,
  tbl_warga.Kode_Keluarga,
  tbl_warga.NIK
  From
  tbl_warga";
  $kerjakanNIK=mysqli_query($koneksi,$ambilNIK)or die(mysqli_error($koneksi));
  $datahasil=array();
  while ($dataAwal=mysqli_fetch_array($kerjakanNIK)) {
    // $datahasil['id_warga']=$dataAwal['id_warga'];
    // $datahasil['Kode_Keluarga']=filter_var($dataAwal['Kode_Keluarga'], FILTER_SANITIZE_NUMBER_INT);
    // $datahasil['NIK']=filter_var($dataAwal['NIK'], FILTER_SANITIZE_NUMBER_INT);
    $id_warga=$dataAwal['id_warga'];
    $Kode_Keluarga=filter_var($dataAwal['Kode_Keluarga'], FILTER_SANITIZE_NUMBER_INT);
    $NIK=filter_var($dataAwal['NIK'], FILTER_SANITIZE_NUMBER_INT);
    $update="UPDATE
    tbl_warga
    SET
    Kode_Keluarga = '$Kode_Keluarga',
    NIK = '$NIK'
    WHERE
    id_warga = '$id_warga'
    ";
    $KerjakanUpdate=mysqli_query($koneksi,$update)or die(mysqli_error($koneksi));
  }
  break;
  case 'simpanKKBaru':
  // $hasil=array();
  // $hasil_kerja='';
   $id_warga=$_POST['id_warga'];
   $nikKKbaru=$_POST['nikKKbaru'];
  $namaKKbaru=$_POST['namaKKbaru'];
  $nomorKKbaru=$_POST['nomorKKbaru'];
  $query="UPDATE
  tbl_warga
SET
  Kode_Keluarga = '$nomorKKbaru',
  Nama_Kepala_Keluarga = '$namaKKbaru',
  Hubungan = '01',
  No = '1'
WHERE
  id_warga = '$id_warga'
";
$kerjakanSimpan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
   if($kerjakanSimpan){
      $hasil_kerja='berhasil';
    }else{
      $hasilKerja='gagal';
    }
  
  // $hasil[]=$hasilKerja;
  // echo $hasilKerja;
  echo json_encode($hasil_kerja);

  // $ambilDataNIK="SELECT
  // *
  // FROM
  // tbl_warga
  // WHERE
  // NIK = $nikKepalaKeluarga
  // ";
  // $kerjakan=mysqli_query($koneksi,$ambilDataNIK)or die(mysqli_error($koneksi));
  // while ($dataAwal=mysqli_fetch_assoc($kerjakan)) {
  //   $id_warga=$dataAwal['id_warga'];
  //   $id_desa=$dataAwal['id_desa'];
  //   $Dusun=$dataAwal['Dusun'];
  //   $Alamat=$dataAwal['Alamat'];
  //   $Nomor_Bangunan=$dataAwal['Nomor Bangunan'];
  //   // $Kode_Keluarga=$dataAwal['Kode_Keluarga'];
  //   $Nama_Kepala_Keluarga=$dataAwal['Nama_Kepala_Keluarga'];
  //   $No=$dataAwal['No'];
  //   $NIK=$dataAwal['NIK'];
  //   $Nama_Anggota_Keluarga=$dataAwal['Nama_Anggota_Keluarga'];
  //   $Jenis_Kelamin=$dataAwal['Jenis_Kelamin'];
  //   $Hubungan=$dataAwal['Hubungan'];
  //   $Tempat_Lahir=$dataAwal['Tempat_Lahir'];
  //   $Tanggal_Lahir=$dataAwal['Tanggal_Lahir'];
  //   $Usia=$dataAwal['Usia'];
  //   $Status=$dataAwal['Status'];
  //   $Agama=$dataAwal['Agama'];
  //   $GDarah=$dataAwal['GDarah'];
  //   $Kewarganegaraan=$dataAwal['Kewarganegaraan'];
  //   $Etnis_Suku=$dataAwal['Etnis_Suku'];
  //   $Pendidikan=$dataAwal['Pendidikan'];
  //   $Pekerjaan=$dataAwal['Pekerjaan'];
  //   $no_HP=$dataAwal['no_HP'];
  //   // $aktif_warga=$dataAwal['aktif_warga'];
  //   $querySimpan="INSERT INTO tbl_kk_baru_temp
  //   (id_warga, id_desa, Dusun, Alamat, `Nomor Bangunan`, Kode_Keluarga, Nama_Kepala_Keluarga, No, NIK, Nama_Anggota_Keluarga, Jenis_Kelamin, Hubungan, Tempat_Lahir, Tanggal_Lahir, Usia, Status, Agama, GDarah, Kewarganegaraan, Etnis_Suku, Pendidikan, Pekerjaan, no_HP, aktif_warga)
  //   VALUES
  //   ('$id_warga', '$id_desa', '$Dusun', '$Alamat', '$Nomor_Bangunan', '$nomorKKBaru', '$Nama_Anggota_Keluarga', 1, '$NIK', '$Nama_Anggota_Keluarga', '$Jenis_Kelamin', '$Hubungan', '$Tempat_Lahir', '$Tanggal_Lahir', '$Usia', '$Status', '$Agama', '$GDarah', '$Kewarganegaraan', '$Etnis_Suku', '$Pendidikan', '$Pekerjaan', '$no_HP', 'Y')
  //   ";
  //   $kerjakanSimpanTemp=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
  //   // $hasil=mysqli_affected_rows($koneksi);
  //   if($kerjakanSimpanTemp){
  //     $hasil_kerja='berhasil';
  //   }else{
  //     $hasilKerja='gagal';
  //   }
  // }
  // $hasil[]=$hasilKerja;
  // echo $hasilKerja;
  // echo json_encode($hasil_kerja);
  break;
  case 'simpanWargaBaru':
  $Kode_Keluarga=$_POST['nikKepalaKeluarga'];
  $namaKepalaKeluarga=$_POST['namaKepalaKeluarga'];
  $nikWarga=$_POST['nikWarga'];
  $namaWarga=$_POST['namaWarga'];
  $jkWarga=$_POST['jkWarga'];
  $jenisHubunganKeluargaWarga=$_POST['jenisHubunganKeluargaWarga'];
  $Tempat_Lahir=$_POST['Tempat_Lahir'];
  $tanggalLahir=$_POST['tanggalLahir'];
  $umur=$_POST['umur'];
  $statusKawin=$_POST['statusKawin'];
  $agama=$_POST['agama'];
  $golDarah=$_POST['golDarah'];
  $suku=$_POST['suku'];
  $pendidikan=$_POST['pendidikan'];
  $pekerjaan=$_POST['pekerjaan'];
  $Kewarganegaraan=$_POST['Kewarganegaraan'];
  $propinsi=$_POST['propinsi'];
  $kabupaten=$_POST['kabupaten'];
  $kecamatan=$_POST['kecamatan'];
  $desa=$_POST['desa'];
  $dusun=$_POST['dusun'];
  $alamat=$_POST['alamat'];
  $HP=$_POST['HP'];
  $pecahkan = explode('/', $tanggalLahir);
  $tanggal_lahir_db="$pecahkan[2]-$pecahkan[1]-$pecahkan[0]";
  $nomorBaru=ambilJumlahKeluarga($Kode_Keluarga)+1;
  $query="INSERT INTO tbl_warga
  (id_desa, Dusun, Alamat, Kode_Keluarga, Nama_Kepala_Keluarga, No, NIK, Nama_Anggota_Keluarga, Jenis_Kelamin, Hubungan, Tempat_Lahir, Tanggal_Lahir, Usia, Status, Agama, GDarah, Kewarganegaraan, Etnis_Suku, Pendidikan, Pekerjaan,no_HP,aktif_warga)
  VALUES
  ('$desa', '$dusun', '$alamat', '$Kode_Keluarga', '$namaKepalaKeluarga', '$nomorBaru', '$nikWarga', '$namaWarga', '$jkWarga', '$jenisHubunganKeluargaWarga', '$Tempat_Lahir', '$tanggal_lahir_db', '$umur', '$statusKawin', '$agama', '$golDarah', '$Kewarganegaraan', '$suku', '$pendidikan', '$pekerjaan','$HP', 'Y')";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  if ($kerjakan) {
    $berhasil='berhasil';
  }else{
    $berhasil='gagal';
  }
  echo json_encode($berhasil);
  break;
  default:
  echo 'Tidak ditemukan perintah yang tepat !';
  break;
}
?>