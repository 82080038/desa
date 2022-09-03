<?php
$perintah=$_POST['perintah'];
include "excel-reader/excel_reader2.php";
$dataKerja=array();
switch ($perintah) {
  case 'simpanVaksinBaru':
  $tanggal_jam_sekarang=(date('Y-m-d H:i:s'));
  $typeFile=$_POST['typeFile'];
  $nama_file=$_FILES['fileImport']['name'];
  $tmp_name=$_FILES['fileImport']['tmp_name'];
  $ukuran_file=$_FILES["fileImport"]["size"];
  $error_file=$_FILES["fileImport"]["error"];
  $tgl_vaksin=date($_POST['tgl_vaksin']);
  $lokasi_vaksin=$_POST['lokasi_vaksin'];
  $vaksinator=$_POST['vaksinator'];
  $admin='MEILA';
  $pengamanan='POLSEK PANCUR BATU';
  $tgl_masuk_data=$tanggal_jam_sekarang;
  // $target = "excel_rusak/".basename($nama_file);
  $target = basename($nama_file);
  // $target = "excel_rusak/".$nama_file;
  move_uploaded_file($tmp_name, $target);
//beri permision agar file xls dapat dibaca
  // chmod($target, 0777);
  chmod($nama_file, 0777);
//mengambil isi file xls
  // $data = new Spreadsheet_Excel_Reader($target, false);
  $data = new Spreadsheet_Excel_Reader($nama_file, false);
//menghitung jumlah baris data yang ada
  $jumlah_baris = $data->rowcount($sheet_index = 0);
//Jumlah default data yang berhasil di import
  $berhasil = 0;
  $dataBerhasilKerja=array();
  for($i = 1; $i <= $jumlah_baris; $i++)
  {
  // $nomor_urut = $data->val($i, 1);
    $NIK = $data->val($i, 3);
    $nik = preg_replace("/[^0-9]/", "", $NIK);
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
    $no_tiket = $data->val($i, 2);
    $tgl_registrasi = addslashes($data->val($i, 4));
    $nama_lengkap = addslashes($data->val($i, 5));
    $jam_vaksin= addslashes($data->val($i, 6));
    $kode_jenis_vaksin= addslashes($data->val($i, 7));
    $no_batch= addslashes($data->val($i, 8));
    $hasil_observasi= addslashes($data->val($i, 9));
    $keterangan_keluhan= addslashes($data->val($i, 10));
    $keterangan_vaksin= addslashes($data->val($i, 11));
    $alamat= addslashes($data->val($i, 13));
    $HP= addslashes($data->val($i, 12));
    $hp = preg_replace("/[^0-9]/", "", $HP);
    // echo $nama_lengkap." / "."/nik :  ".$nik." / ".$pecahkannik." / jk :".$jk." /tgl Lahir :".$tanggal_lahir." /Umur :".$umur."<br/>";
  //buat pengujian jika nama,alamat & telp tidak kosong
    if($nama_lengkap!=""){
      $query="REPLACE INTO tbl_tmp_vaksin_orang
      (nik, nama_lengkap, jk, tanggal_lahir, umur,hp, alamat, no_tiket, tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers, operator)
      VALUES
      ('$nik', '$nama_lengkap', '$jk', '$tanggal_lahir', '$usia','$hp','$alamat','$no_tiket', '$tgl_vaksin', '$jam_vaksin', '$keterangan_vaksin', '$kode_jenis_vaksin', '$no_batch', '$lokasi_vaksin', '$vaksinator', '$keterangan_keluhan', '$hasil_observasi', '$pengamanan', '$admin')";
      $kerjakan=mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
      if($kerjakan){
        // $dataBerhasil[]=$nama_lengkap." / "."/nik :  ".$nik." / ".$pecahkannik." / jk".$jk." /tgl Lahir :".$tanggal_lahir." /Umur :".$umur."<br/>";
        $dataBerhasil[$i]['namaOrang']="$nama_lengkap";
        $dataBerhasil[$i]['NIK']="$nik";
        $dataBerhasil[$i]['jk']="$jk";
        $dataBerhasil[$i]['tanggal_lahir']="$tanggal_lahir";
        $dataBerhasil[$i]['hp']="$hp";
        $dataBerhasil[$i]['umur']="$usia";
        $dataBerhasil[$i]['no_tiket']="$no_tiket";
        $dataBerhasil[$i]['kode_jenis_vaksin']="$kode_jenis_vaksin";
        $dataBerhasil[$i]['keterangan_vaksin']="$keterangan_vaksin";
        $dataBerhasil[$i]['hasil_observasi']="$hasil_observasi";
        $hasilKerja='Sukses';
        $error=null;
        // $baru=$dataBerhasil;
        $berhasil++;
        $jumlahBerhasil=$berhasil;
        $dataBerhasilKerja[]= $dataBerhasil[$i];
      }else{
        // $dataBerhasil=null;
        $hasilKerja='Gagal';
        $error=mysqli_error($koneksi);
        $baru=null;
        $jumlahBerhasil=null;
        unlink($target);
         // unlink($nama_file);
      }
    }
  }
//hapus kembali file .xls yang di upload tadi
  unlink($target);
  // unlink($nama_file);
  $dataKerja['hasilKerja']=$hasilKerja;
  $dataKerja['jumlahBerhasil']=$jumlahBerhasil;
  $dataKerja['error']=$error;
  $dataKerja['dataBerhasil']=$dataBerhasilKerja;
  echo json_encode($dataKerja);
  break;
  case'simpanLokasiVaksinBaru':
  $namaLokasiBaru=$_POST['namaLokasiBaru'];
  $query="INSERT INTO `tbl_lokasi_vaksin`(`nama_lokasi`) VALUES ('$namaLokasiBaru')";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  if($kerjakan){
    $data['simpan']=true;
  }else{
    $data['simpan']=false;
  }
  echo json_encode($data);
  break;
  default:
  echo 'Tidak ditemukan perintah yang tepat !';
  break;
}
?>