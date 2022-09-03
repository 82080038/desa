<?php
// $query="";
// $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
// $jumlah=mysqli_num_rows($kerjakan);
$perintah=$_GET['perintah'];
$tanggalSekarang=date("Y-m-d H:i:s");
$hasil_kerja=array();
$data=array();
$data['kodeRespon']=http_response_code();
switch ($perintah) {
  case 'loadSudahVaksin':
  $query="SELECT
  COUNT(*) as jumlahVaksin
  FROM
  tbl_nama_warga
  ";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));

  while($hasil=mysqli_fetch_assoc($kerjakan)){
    $data['jumlahVaksin']=$hasil['jumlahVaksin'];
  }
  echo json_encode($data);
  break;
  case 'lokasiTanggalDanJumlahVaksin':

  $query1="SELECT DISTINCT lokasi_vaksin FROM tbl_vaksin_orang WHERE lokasi_vaksin !='' ORDER BY lokasi_vaksin";
  $kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  $data['jumlah']=$jumlah;
  $hasil_kerja=array();
  while($hasil=mysqli_fetch_assoc($kerjakan)){
    $lokasi_vaksin=$hasil['lokasi_vaksin'];
    $bakpao['lokasi_vaksin']=$hasil['lokasi_vaksin'];
    $query2="SELECT Count(tbl_vaksin_orang.id_vaksin) As Count_id_vaksin, tgl_vaksin FROM tbl_vaksin_orang WHERE lokasi_vaksin = '$lokasi_vaksin'Group By tgl_vaksin"; 
    $kerjakan2=mysqli_query($koneksi,$query2)or die(mysqli_error($koneksi));
    $jumlahVaksin=mysqli_num_rows($kerjakan2);
    $bakpao['jumlahVaksin']=$jumlahVaksin;  
    $bakpao['detilVaksin']=array();
    while($hasilVaksin=mysqli_fetch_assoc($kerjakan2)){
      $detilVaksin['Count_id_vaksin']=$hasilVaksin['Count_id_vaksin'];
      $detilVaksin['tgl_vaksin']=$hasilVaksin['tgl_vaksin'];
      $bakpao['detilVaksin'][]=$detilVaksin;
    }
    $hasil_kerja[]=$bakpao;
  } 
  $data['detilData']=$hasil_kerja;
  echo json_encode($data);
  // $hasilLokasi=array();
  // $queryLokasi="SELECT DISTINCT lokasi_vaksin FROM tbl_vaksin_orang WHERE lokasi_vaksin !='' ORDER BY lokasi_vaksin    LIMIT 0,5"; 
  // $kerjakanLokasi=mysqli_query($koneksi,$queryLokasi)or die(mysqli_error($koneksi));
  // $jumlahLokasi=mysqli_num_rows($kerjakanLokasi);
  // while($lokasi=mysqli_fetch_assoc($kerjakanLokasi)){
  //   $hasilLokasi['nama_lokasi'][]=$lokasi;
  //   $Carilokasi_vaksin=trim($lokasi['lokasi_vaksin']);
    // $ambilTanggal="SELECT Count(tbl_vaksin_orang.id_vaksin) As Count_id_vaksin, tgl_vaksin FROM tbl_vaksin_orang WHERE lokasi_vaksin = '$Carilokasi_vaksin'Group By tgl_vaksin "; 
    //   $kerjakanTanggal=mysqli_query($koneksi,$ambilTanggal)or die(mysqli_error($koneksi));
  //   ;
  //   $hasil_kerja=array();
  //   $hasilLokasi['tanggal']=array();
  //   while($hasilCariTanggal=mysqli_fetch_assoc($kerjakanTanggal)){
  //     // $hasil_kerja[]=$hasilCariTanggal;
  //     $detil['Count_id_vaksin']=$hasilCariTanggal['Count_id_vaksin'];
  //     $detil['tgl_vaksin']=$hasilCariTanggal['tgl_vaksin'];
  //     $hasil_kerja[]=$detil;
  //    $hasilLokasi['nama_lokasi'][]['detilData']=$hasil_kerja;
  //   }  
  // }  
  // $data['data_lokasi']=$hasilLokasi;
  // echo json_encode($data);
  break;
  case 'loadKesalahanVaksin':
  $hasil_kesalahan=array();
  $queryKesalahan="
  SELECT  
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE nik = '') AS nikKosong, 
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE LENGTH(`nik`) != 16 ) AS DigitNikSalah,
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE tanggal_lahirInput  = '0000-00-00') as tglLahirKosong, 
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE usiaInputVaksin = '') as UmurKosong, 
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE hp = '') as tidakAdaNomorHP, 
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE LENGTH(`hp`) < 11 )as DigitHPSalah, 
  (SELECT COUNT(*) FROM tbl_nama_warga WHERE alamatInput = '')as alamatKosong,
  (select COUNT(*) from tbl_nama_warga where `alamatInput` REGEXP '^-?[0-9]+$')as AlamatHanyaAngka,
  (SELECT COUNT(*) FROM tbl_tmp_vaksin_orang_perbaikan3 WHERE no_tiket = '')as tidakAdaTiketVaksin,
  (SELECT COUNT(*) FROM tbl_tmp_vaksin_orang_perbaikan3 WHERE nama_vaksin = '') as tidaAdaNamaVaksin,
  (SELECT COUNT(*) FROM tbl_tmp_vaksin_orang_perbaikan3 WHERE no_batch = '')as tidakAdaNomorBatch,
  (SELECT COUNT(*) FROM tbl_tmp_vaksin_orang_perbaikan3 WHERE keluhan = '')as tidakAdaKeluhan, 
  (SELECT COUNT(*) FROM tbl_tmp_vaksin_orang_perbaikan3 WHERE hasil_observasi = '')as tidakAdaObservasi
  ";
  $kerjakanKesalahan=mysqli_query($koneksi,$queryKesalahan)or die(mysqli_error($koneksi));
  $jumlahKesalan=mysqli_num_rows($kerjakanKesalahan);
  if($jumlahKesalan){
    $data['adaData']=true;
    $data['jumlahKesalan']=$jumlahKesalan;
    while($hasil=mysqli_fetch_assoc($kerjakanKesalahan)){
      $hasil_kesalahan[]=$hasil;
    }
  }else{
    $data['adaData']=null;
    $data['kesalahan']=null;
    $data['jumlahKesalan']=null;
  }
  $data['kesalahan']=$hasil_kesalahan;
  echo json_encode($data);
  break;
  case 'loadColumnTblVaksin':
  $query="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'db_vaksin' AND TABLE_NAME = 'tbl_tmp_vaksin_orang' ORDER BY COLUMN_NAME ASC";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  $data['jumlah']=$jumlah;
  while($hasil=mysqli_fetch_assoc($kerjakan)){
    $hasil_kerja[]=$hasil['COLUMN_NAME'];
  }
  $data['hasil_kerja']=$hasil_kerja;
  echo json_encode($data);
  break;
  case 'ambilNilaiOption':
  $nilaiComboBY=$_GET['nilaiComboBY'];
  $query="SELECT DISTINCT `$nilaiComboBY` FROM `tbl_tmp_vaksin_orang_perbaikan3` WHERE `$nilaiComboBY` !='' ORDER BY `$nilaiComboBY` ASC";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  if($jumlah>0){
    $data['jumlah']=$jumlah;
    $data['dikerjakan']=true;
    while($hasil=mysqli_fetch_assoc($kerjakan)){
      $hasil_kerja[]=$hasil[$nilaiComboBY];
    }
  }else{
    $data['jumlah']=null;
    $data['dikerjakan']=false;
    $hasil_kerja[]=null;
  }
  $data['hasil_kerja']=$hasil_kerja;
  echo json_encode($data);
  break;
  case 'ambilDataVaksin':
  $cboBy=$_GET['cboBy'];
  $cboOption=$_GET['cboOption'];
  $jumlahTampilan=$_GET['jumlahTampilan'];
  $kataKunci=$_GET['kataKunci'];
  $tambahanWhere='';
  // $query='';
  // $query.="SELECT * FROM `tbl_tmp_vaksin_orang`";
  if(!$jumlahTampilan){
    $limit="";
  }else{
    $limit="LIMIT 0,$jumlahTampilan";
  }
  if($kataKunci){
    $tambahanWhere.="WHERE `$cboBy` LIKE '%$kataKunci%' ORDER BY `nik`ASC, nama_lengkap ASC";
  }else{
    $tambahanWhere.="WHERE `$cboBy` LIKE '%$cboOption%' AND `$cboBy` !=''";
  }
  $query="SELECT * FROM `tbl_tmp_vaksin_orang_perbaikan3` 
  $tambahanWhere
  $limit";
 // var_dump($query);
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  if($jumlah>0){
    $data['jumlah']=$jumlah;
    $data['dikerjakan']=true;
    while($hasil=mysqli_fetch_assoc($kerjakan)){
      $hasil_kerja[]=$hasil;
    }
  }else{
    $data['jumlah']=null;
    $data['dikerjakan']=false;
    $hasil_kerja[]=null;
  }
  $data['hasil_kerja']=$hasil_kerja;
  echo json_encode($data);
  break;
  case 'ambilDataVaksinGanda':
  $hasil_kerja=array();
  $query="SELECT 
  `nik`, COUNT(nik) AS banyakNIK, 
  `nama_lengkap`, COUNT(nama_lengkap) as banyakNama, 
  `tahap_vaksin`, COUNT(tahap_vaksin) as BanyakTahap,
  `tgl_vaksin`, COUNT(tgl_vaksin) as BanyakTanggalVaksin
  FROM tbl_tmp_vaksin_orang 
  GROUP BY nik , nama_lengkap, tahap_vaksin, tgl_vaksin 
  HAVING 
  COUNT(banyakNIK) > 1 
  AND COUNT(nama_lengkap) > 1 
  AND COUNT(tahap_vaksin) > 1 
  AND COUNT(tgl_vaksin) > 1 
  ORDER BY COUNT(nama_lengkap) desc";
  $HAPUS="DELETE 
  FROM tbl_tmp_vaksin_orang1 
  WHERE `nik` 
  IN (
    SELECT dupid 
    FROM (
      SELECT MAX(`nik`) AS dupid,COUNT(*) AS dupcnt 
      FROM tbl_tmp_vaksin_orang1 
      GROUP BY `nik` 
      HAVING dupcnt>1) 
    AS duptable)";
  $kerjakan=mysqli_query($koneksi,$query)OR die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  if($jumlah){
    $data['jumlah']=$jumlah;
    while($hasil=mysqli_fetch_assoc($kerjakan)){
      $hasil_kerja[]=$hasil;
    }
  }else{
    $data['jumlah']=null;
    $hasil_kerja[]=null;
  }
  $data['hasil_kerja']=$hasil_kerja;
  echo json_encode($data);
  break;
  case 'ambildanPerbaikiDataVaksin':
  $dataNIK=array();
  $queryAmbil="SELECT DISTINCT `nik`,`nama_lengkap` FROM tbl_tmp_vaksin_orang1 ORDER BY `tbl_tmp_vaksin_orang1`.`nik` ASC";
  $kerjakanAmbil=mysqli_query($koneksi,$queryAmbil)or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakanAmbil);
  if($jumlah){
    $data['jumlah']=$jumlah;
    while($hasil=mysqli_fetch_assoc($kerjakanAmbil)){
      $dataNIK[]=$hasil;
      $nik=$hasil['nik'];
      $nama_lengkap=addslashes($hasil['nama_lengkap']);
      $masukkan="INSERT IGNORE INTO tbl_tmp_vaksin_orang_perbaikan (`nik`, `nama_lengkap`) VALUES ('$nik', '$nama_lengkap')";
      $masukkan=mysqli_query($koneksi,$masukkan)or die(mysqli_error($koneksi));
      if($masukkan){
        $data['masukkan']=true;
      }else{
        $data['masukkan']=false.mysqli_error($koneksi);
      }
    }
  }else{
   $data['jumlah']=null;
 }
 $data['data']=$dataNIK;
 echo json_encode($data);
 break;
 case 'ambilLagi':
 $query="SELECT DISTINCT `nik`,`nama_lengkap` FROM `tbl_tmp_vaksin_orang_perbaikan`";
 $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
 $jumlah=mysqli_num_rows($kerjakan);
 $dataKerja=array();
 if($jumlah){
  $data['jumlah']=$jumlah;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataKerja[]=$hasil;
    $nik=$hasil['nik'];
    $nama_lengkap=addslashes($hasil['nama_lengkap']);
    $masukkan="INSERT IGNORE INTO tbl_tmp_vaksin_orang_perbaikan2 (`nik`, `nama_lengkap`) VALUES ('$nik', '$nama_lengkap')";
    $masukkanKerja=mysqli_query($koneksi,$masukkan)or die(mysqli_error($koneksi));
    if($masukkanKerja){
      $data['masukkan']=true;
      $hapus="DELETE FROM tbl_tmp_vaksin_orang_perbaikan WHERE `nik`='$nik'";
      $kerjakanHapus=mysqli_query($koneksi,$hapus)or die(mysqli_error($koneksi));
    }else{
      $data['masukkan']=false.mysqli_error($koneksi);
    }
  }
}else{
  $data['jumlah']=null;
}
$data[]=$dataKerja;
echo json_encode($data);
break;
case 'ambilNIKosong':
$query="SELECT DISTINCT nama_lengkap, tanggal_lahir, umur, hp, alamat FROM tbl_tmp_vaksin_orang WHERE nik = '' ORDER BY `tbl_tmp_vaksin_orang`.`nama_lengkap` ASC";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
$dataKerja=array();
if($jumlah){
  $data['jumlah']=$jumlah;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataKerja[]=$hasil;
    $nama_lengkap=$hasil['nama_lengkap'];
    $tanggal_lahir=$hasil['tanggal_lahir'];
    $umur=$hasil['umur'];
    $hp=$hasil['hp'];
    $alamat=$hasil['alamat'];
    $masukkan="INSERT IGNORE INTO tbl_tmp_vaksin_orang_perbaikan2 (`nama_lengkap`, `tanggal_lahir`, `umur`, `hp`, `alamat` ) VALUES ('$nama_lengkap', '$tanggal_lahir', '$umur', '$hp', '$alamat')"; 
    $masukkanKerja=mysqli_query($koneksi,$masukkan)or die(mysqli_error($koneksi));
    if($masukkanKerja){
      $data['masukkan']=true;
      // $hapus="DELETE FROM tbl_tmp_vaksin_orang_perbaikan WHERE `nik`='$nik'";
      // $kerjakanHapus=mysqli_query($koneksi,$hapus)or die(mysqli_error($koneksi));
    }else{
      $data['masukkan']=false.mysqli_error($koneksi);
    }
  }
}else{
  $data['jumlah']=null;
}
$data[]=$dataKerja;
echo json_encode($data);
break;
case 'perbaikiDataDiri':
$query="SELECT `nik`,`nama_lengkap` FROM `tbl_tmp_vaksin_orang_perbaikan2` ORDER BY `nik` ASC";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
// $jumlah=mysqli_num_rows($kerjakan);
$hasilData=array();
while($hasil=mysqli_fetch_assoc($kerjakan)){
  // $hasilData[]=$hasil;
  $nik=$hasil['nik'];
  $nama_lengkap=addslashes($hasil['nama_lengkap']);
  $ambil="
  SELECT 
  MAX(`nik`) as max_nik, `nama_lengkap`, `jk`, `tanggal_lahir`, `umur`, `hp`, `alamat`, `id_alamat` 
  FROM `tbl_tmp_vaksin_orang` 
  WHERE `nik` = '$nik' AND `nama_lengkap` = '$nama_lengkap'
  ORDER BY `nama_lengkap`
  LIMIT 0,1
  " ; 
  $kerjakanAmbil=mysqli_query($koneksi,$ambil) or die(mysqli_error($koneksi));
  $jumlah=mysqli_num_rows($kerjakan);
  $data['jumlah']=$jumlah;
  while($hasil_ambil=mysqli_fetch_assoc($kerjakanAmbil)){
    $hasilData[]=$hasil_ambil;
    $jk_ambil=$hasil_ambil['jk'];
    $tanggal_lahir_ambil=$hasil_ambil['tanggal_lahir'];
    $umur_ambil=$hasil_ambil['umur'];
    $hp_ambil=$hasil_ambil['hp'];
    $alamat_ambil=$hasil_ambil['alamat'];
    $id_alamat_ambil=$hasil_ambil['id_alamat'];
    $update="UPDATE
    tbl_tmp_vaksin_orang_perbaikan2
    SET
    jk = '$jk_ambil',
    tanggal_lahir = '$tanggal_lahir_ambil',
    umur = '$umur_ambil',
    hp = '$hp_ambil',
    alamat = '$alamat_ambil',
    id_alamat = '$id_alamat_ambil'
    WHERE
    nik = '$nik' AND
    nama_lengkap = '$nama_lengkap'";
    $kerjakanUPdate=mysqli_query($koneksi,$update)or die(mysqli_error($koneksi));
    if($kerjakanUPdate){
      $data['update']='berhasilUpdate';
    }else{
      $data['update']='gagal Update'.mysqli_error($koneksi);
    }
  }
}
$data['kerja']=$hasilData;
echo json_encode($data);
break;
case 'tentukanJKUmurTglLahirALamatKTP':
$query="SELECT `id_orang`,`nik`,`nama_lengkap` FROM `tbl_tmp_vaksin_orang_perbaikan2` WHERE `nik` !=''";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
if($jumlah){
  $data['jumlah']=$jumlah;
  $dataKerja=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $idOrang=$hasil['id_orang'];
    $nik=$hasil['nik'];
    $uraiNIK=uraikanNIK($nik);
    $AlamatKTP=getAlamatKTP($nik);
    $jk=$uraiNIK['jk'];
    $tanggal_lahir=$uraiNIK['tanggal_lahir'];
    $usia=$uraiNIK['usia'];
    $alamatLahir=addslashes($AlamatKTP);
    $queryUpdate="UPDATE
    tbl_tmp_vaksin_orang_perbaikan2
    SET
    jkKTP = '$jk',
    Tgl_lahirKTP = '$tanggal_lahir',
    umurKTP = '$usia',
    id_alamat = '$alamatLahir'
    WHERE
    id_orang = '$idOrang'
    ";
    $update=mysqli_query($koneksi,$queryUpdate)or die(mysqli_error($koneksi));
    if($update){
      $data['update']=true;
    }else{
      $data['update']=false;
    }
  // array_push($dataKerja['nik'],$hasilNIK);
  // array_push($dataKerja['alamat'],$hasilAlamat);
    // $nama_lengkap=$hasil['nama_lengkap'];
    // $tanggal_lahir=$hasil['tanggal_lahir'];
    // $umur=$hasil['umur'];
    // $hp=$hasil['hp'];
    // $alamat=$hasil['alamat'];
    // $masukkan="INSERT IGNORE INTO tbl_tmp_vaksin_orang_perbaikan2 (`nama_lengkap`, `tanggal_lahir`, `umur`, `hp`, `alamat` ) VALUES ('$nama_lengkap', '$tanggal_lahir', '$umur', '$hp', '$alamat')"; 
    // $masukkanKerja=mysqli_query($koneksi,$masukkan)or die(mysqli_error($koneksi));
    // if($masukkanKerja){
    //   $data['masukkan']=true;
    //   // $hapus="DELETE FROM tbl_tmp_vaksin_orang_perbaikan WHERE `nik`='$nik'";
    //   // $kerjakanHapus=mysqli_query($koneksi,$hapus)or die(mysqli_error($koneksi));
    // }else{
    //   $data['masukkan']=false.mysqli_error($koneksi);
    // }
  }
}else{
  $data['jumlah']=null;
}
echo json_encode($data);
break;
case 'produksiALamat':
$idAlamat=$_GET['alamat'];
if($idAlamat){
  $data['hasil']=getAlamat($idAlamat);
}else{
  $data['hasil']=null;
}
echo json_encode($data);
break;
case 'uraikanNIK':
$NIK=$_GET['nik'];
if($NIK){
  $data['hasilNIK']=uraikanNIK($NIK);
  $data['alamatKTP']=getAlamatKTP($NIK);
}else{
  $data['hasilNIK']=null;
  $data['alamat']=null;
}
echo json_encode($data);
break;
// case 'GetByLokasiVaksin':
// $query1="SELECT DISTINCT
// nama_lengkap,
// nik,
// id_orang
// FROM
// tbl_tmp_vaksin_orang_perbaikan2
// ORDER BY
// nama_lengkap ASC, NIK ASC LIMIT 0,100";
// $kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
// $jumlah=mysqli_num_rows($kerjakan);
// $data['jumlah']=$jumlah;
// $hasil_kerja=array();
// while($hasil=mysqli_fetch_assoc($kerjakan)){
//   $bakpao['nama_lengkap']=$hasil['nama_lengkap'];
//   $bakpao['nik']=uraikanNIK($hasil['nik']);
//   $bakpao['alamat']=getAlamatKTP($hasil['nik']);
//   $bakpao['id_orang']=$hasil['id_orang'];
//   $hasil_kerja[]=$bakpao;
// } 
// $data['detilData']=$hasil_kerja;
// echo json_encode($data);
// break;
case 'GetByLokasiVaksin':
$query1="SELECT DISTINCT id_orang,nama_lengkap, nik,id_alamat,alamat,hp,umur, tanggal_lahir FROM tbl_nama_warga ORDER BY nama_lengkap ASC, nik ASC LIMIT 0,10";
$kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
$data['jumlah']=$jumlah;
$hasil_kerja=array();
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $nik=$hasil['nik'];
  $bakpao['id_orang']=$hasil['id_orang'];
  $bakpao['nik']=$hasil['nik'];
  $bakpao['nama_lengkap']=$hasil['nama_lengkap'];
  $uraikanNIK=uraikanNIK($hasil['nik']);
  $jk=$uraikanNIK['jk'];
  $usia=$uraikanNIK['usia'];
  $tanggal_lahir=$uraikanNIK['tanggal_lahir'];
  $bakpao['jk']=$jk; 
  $bakpao['hp']=$hasil['hp'];
  $bakpao['tanggal_lahirInput']=$hasil['tanggal_lahir'];
  $bakpao['tanggal_lahirKTP']=$tanggal_lahir;
  $bakpao['usiaKTP']=$usia; 
  $bakpao['usiaInputVaksin']=$hasil['umur'];
  $bakpao['alamatInput']=$hasil['alamat'];
  $bakpao['AlamatKTP']=getAlamatKTP($hasil['nik']);
  $nama_lengkap=addslashes($hasil['nama_lengkap']);
  $query2="SELECT tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers FROM tbl_tmp_vaksin_orang WHERE nik = '$nik' AND nama_lengkap = '$nama_lengkap'ORDER BY tahap_vaksin "; 
  $kerjakan2=mysqli_query($koneksi,$query2)or die(mysqli_error($koneksi));
  $jumlahVaksin=mysqli_num_rows($kerjakan2);
  $bakpao['jumlahVaksin']=$jumlahVaksin;  
  $bakpao['detilVaksin']=array();
  while($hasilVaksin=mysqli_fetch_assoc($kerjakan2)){
    $detilVaksin['tahap_vaksin']=$hasilVaksin['tahap_vaksin'];
    $detilVaksin['tgl_vaksin']=$hasilVaksin['tgl_vaksin'];
    $detilVaksin['jam_vaksin']=$hasilVaksin['jam_vaksin'];
    $detilVaksin['nama_vaksin']=$hasilVaksin['nama_vaksin'];
    $detilVaksin['no_batch']=$hasilVaksin['no_batch'];
    $detilVaksin['lokasi_vaksin']=$hasilVaksin['lokasi_vaksin'];
    $detilVaksin['vaksinator']=$hasilVaksin['vaksinator'];
    $detilVaksin['keluhan']=$hasilVaksin['keluhan'];
    $detilVaksin['hasil_observasi']=$hasilVaksin['hasil_observasi'];
    $detilVaksin['pam_pers']=$hasilVaksin['pam_pers'];
    $bakpao['detilVaksin'][]=$detilVaksin;
  }
  $hasil_kerja[]=$bakpao;
} 
$data['detilData']=$hasil_kerja;
echo json_encode($data);
break;
case 'SimpanKeTabelWarga':
$query1="SELECT DISTINCT id_orang,nama_lengkap, nik,id_alamat,alamat,hp,umur, tanggal_lahir FROM tbl_tmp_vaksin_orang_perbaikan2";
$kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $nik=$hasil['nik'];
  $nama_lengkap=addslashes($hasil['nama_lengkap']);
  $uraikanNIK=uraikanNIK($hasil['nik']);
  $jk=$uraikanNIK['jk'];
  $usia=$uraikanNIK['usia'];
  $tanggal_lahirKTP=$uraikanNIK['tanggal_lahir'];
  $hp=$hasil['hp'];
  $tanggal_lahirInput=$hasil['tanggal_lahir'];
  $usiaInputVaksin=$hasil['umur'];
  $alamatInput=$hasil['alamat'];
  $AlamatKTP=addslashes(getAlamatKTP($hasil['nik']));
  $query2="INSERT INTO tbl_nama_warga
  (nik, nama_lengkap, jk, hp, tanggal_lahirInput, tanggal_lahirKTP, usiaKTP, usiaInputVaksin, alamatInput, AlamatKTP, tgl_simpan)
  VALUES
  ('$nik', '$nama_lengkap', '$jk', '$hp', '$tanggal_lahirInput', '$tanggal_lahirKTP', '$usia', '$usiaInputVaksin', '$alamatInput', '$AlamatKTP', '$tanggalSekarang') "; 
  $kerjakan2=mysqli_query($koneksi,$query2)or die(mysqli_error($koneksi));
} 
break;
case 'SimpanDataVaksinWarga':
$query1="SELECT DISTINCT id_vaksin_warga,nik, nama_lengkap FROM tbl_nama_warga ORDER BY `tbl_nama_warga`.`nik` ASC"; 
$kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
$data['jumlahOrang']=$jumlah;
$detilVaksin=array();
$jumlahVaksin=array();
$berhasil=0;
$gagal=0;
while($hasil=mysqli_fetch_assoc($kerjakan)){
 $idOrang=$hasil['id_vaksin_warga'];
 $nik=$hasil['nik'];
 $nama_lengkap=addslashes($hasil['nama_lengkap']);
 $query2="SELECT no_tiket, tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers FROM tbl_tmp_vaksin_orang WHERE nik = '$nik' AND nama_lengkap = '$nama_lengkap'ORDER BY tahap_vaksin "; 
 $kerjakan2=mysqli_query($koneksi,$query2)or die(mysqli_error($koneksi));
 $jumlahKerjakan2=mysqli_num_rows($kerjakan2);
 $jumlahVaksin[]=$jumlahKerjakan2; 
 while($hasilVaksin=mysqli_fetch_assoc($kerjakan2)){
  $no_tiket=$hasilVaksin['no_tiket'];
  $tgl_vaksin=$hasilVaksin['tgl_vaksin'];
  $jam_vaksin=$hasilVaksin['jam_vaksin'];
  $tahap_vaksin=$hasilVaksin['tahap_vaksin'];
  $nama_vaksin=$hasilVaksin['nama_vaksin'];
  $no_batch=$hasilVaksin['no_batch'];
  $lokasi_vaksin=$hasilVaksin['lokasi_vaksin'];
  $vaksinator=$hasilVaksin['vaksinator'];
  $keluhan=$hasilVaksin['keluhan'];
  $hasil_observasi=$hasilVaksin['hasil_observasi'];
  $pam_pers=$hasilVaksin['pam_pers'];
  $querySimpan="INSERT INTO tbl_tmp_vaksin_orang_perbaikan
  (id_orang, no_tiket, tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers, tgl_simpan, operator)
  VALUES
  ('$idOrang', '$no_tiket', '$tgl_vaksin', '$jam_vaksin', '$tahap_vaksin', '$nama_vaksin', '$no_batch', '$lokasi_vaksin', '$vaksinator', '$keluhan', '$hasil_observasi', '$pam_pers', '$tanggalSekarang', 'MEILA')";
  $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or(die(mysqli_error($koneksi)));
  if($kerjakanSimpan){
    $berhasil++;
  }else{
    $gagal++;
  }
}
} 
$data['berhasil']=$berhasil;
$data['gagal']=$gagal;
$data['jumlahVaksin']=$jumlahVaksin;
// $data['detilData']=$detilVaksin;
echo json_encode($data);
break;
case 'UpdateTahapVaksin':
$berhasil=0;
$gagal=0;
$query="
SELECT
tbl_nama_warga.id_orang,
Count(tbl_tmp_vaksin_orang_perbaikan.id_vaksin) As Count_id_vaksin
FROM
tbl_nama_warga Inner Join
tbl_tmp_vaksin_orang_perbaikan On tbl_tmp_vaksin_orang_perbaikan.id_orang = tbl_nama_warga.id_orang
GROUP BY
tbl_nama_warga.id_orang";
$kerjakan=mysqli_query($koneksi,$query)or die($koneksi);
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $id_orang=$hasil['id_orang']; $jumlahVaksin=$hasil['Count_id_vaksin']; 
  $update="UPDATE tbl_nama_warga SET jumlahVaksin = '$jumlahVaksin'WHERE id_orang = '$id_orang'";
  $kerjakanUpdate=mysqli_query($koneksi,$update)or die(mysqli_error($koneksi));
  if($kerjakanUpdate){
    $berhasil++;
  }else{
    $gagal++;
  }
}
$data['berhasil']=$berhasil;
$data['gagal']=$gagal;
echo json_encode($data);
break;
case 'AmbilDataSemuaVaksinOrang':
$berhasilSimpan=0;
$gagalSImpan=0;
$query1="SELECT id_orang, nik, nama_lengkap, jk, hp, tanggal_lahirInput, tanggal_lahirKTP, usiaKTP, usiaInputVaksin, alamatInput, AlamatKTP, jumlahVaksin FROM tbl_nama_warga"; 
$kerjakan=mysqli_query($koneksi,$query1)or die(mysqli_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
$hasil_kerja=array();
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $id_orang=$hasil['id_orang'];
  // $bakpao['nama']=$hasil;
  // $bakpao['detilVaksin']=array();
  $query2="
  SELECT DISTINCT id_orang, no_tiket, tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers FROM tbl_tmp_vaksin_orang_perbaikan WHERE id_orang = '$id_orang'"; 
  $kerjakan2=mysqli_query($koneksi,$query2)or die(mysqli_error($koneksi));
  $jumlahVaksin=mysqli_num_rows($kerjakan2);
  $dataVaksin=array();
  $dataVaksin['jumlahDIStinct']=$jumlahVaksin;
  // $update="UPDATE tbl_nama_warga SET jumlahVaksin = '$jumlahVaksin'WHERE id_orang = '$id_orang'";
  // $kerjakanUpdate=mysqli_query($koneksi,$update)or die(mysqli_error($koneksi));
  while($hasilVaksin=mysqli_fetch_assoc($kerjakan2)){
   $dataVaksin[]=$hasilVaksin;
   // $id_orang=$hasilVaksin['id_orang'];
   $no_tiket=$hasilVaksin['no_tiket'];
   $tgl_vaksin=$hasilVaksin['tgl_vaksin'];
   $jam_vaksin=$hasilVaksin['jam_vaksin'];
   $tahap_vaksin=$hasilVaksin['tahap_vaksin'];
   $nama_vaksin=$hasilVaksin['nama_vaksin'];
   $no_batch=$hasilVaksin['no_batch'];
   $lokasi_vaksin=$hasilVaksin['lokasi_vaksin'];
   $vaksinator=$hasilVaksin['vaksinator'];
   $keluhan=$hasilVaksin['keluhan'];
   $hasil_observasi=$hasilVaksin['hasil_observasi'];
   $pam_pers =$hasilVaksin['pam_pers'];
   $simpan="INSERT INTO 
   tbl_tmp_vaksin_orang_perbaikan3
   (id_orang, no_tiket, tgl_vaksin, jam_vaksin, tahap_vaksin, nama_vaksin, no_batch, lokasi_vaksin, vaksinator, keluhan, hasil_observasi, pam_pers, operator)
   VALUES
   ('$id_orang', '$no_tiket', '$tgl_vaksin', '$jam_vaksin', '$tahap_vaksin', '$nama_vaksin', '$no_batch', '$lokasi_vaksin', '$vaksinator', '$keluhan', '$hasil_observasi', '$pam_pers', 'MEILA')";
   $kerjakanSimpan=mysqli_query($koneksi,$simpan)or die(mysqli_error($koneksi));
   if($kerjakanSimpan){
    $berhasilSimpan++;
  }else{
    $gagalSImpan++;
  }
   // SIMPAN KE DALAM DATABASE PERBAIKAN YANG BARU
}
 // $bakpao['detilVaksin'][]=$dataVaksin;
 // $data[]=$bakpao;
}
$data['berhasilSimpan']=$berhasilSimpan;
$data['gagalSImpan']=$gagalSImpan;
echo json_encode($data);
break;
default:
echo 'Tidak ditemukan perintah yang tepat !';
break;
}
?>