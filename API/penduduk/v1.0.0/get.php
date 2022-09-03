<?php
//$queryDesa="SELECT * FROM tbl_alamat WHERE `kode` LIKE '$KodeDesa%' AND LENGTH(`kode`) =13 Order By nama"; 
// $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
 // $jumlahData=mysqli_num_rows($kerjakan);

$perintah=$_GET['perintah'];
switch ($perintah) {
  case 'cariNomorKK':
  $nomorKK=$_GET['nomorKK'];
  $hasil=array();
  $dataKK=array();
  $query="SELECT
  tbl_warga.Alamat,
  tbl_warga.`Nomor Bangunan`,
  tbl_warga.Nama_Kepala_Keluarga,
  Min(Distinct tbl_warga.No) As Min_No,
  Min(Distinct tbl_warga.NIK) As Min_NIK,
  tbl_desa_kel.nama_desa,
  tbl_dusun.nama_dusun,
  tbl_kecamatan.nama_kecamatan,
  tbl_kabupaten.nama_kab_kota,
  tbl_propinsi.nama_propinsi
  From
  tbl_warga Left Join
  tbl_desa_kel On tbl_desa_kel.id_desa_kel = tbl_warga.id_desa Left Join
  tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Inner Join
  tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan Inner Join
  tbl_kabupaten On tbl_kabupaten.id_kabupaten = tbl_kecamatan.id_kabupaten Inner Join
  tbl_propinsi On tbl_propinsi.id_propinsi = tbl_kabupaten.id_propinsi
  Where
  tbl_warga.Kode_Keluarga = $nomorKK
  Group By
  tbl_warga.Alamat,
  tbl_warga.`Nomor Bangunan`,
  tbl_warga.Nama_Kepala_Keluarga,
  tbl_desa_kel.nama_desa,
  tbl_dusun.nama_dusun,
  tbl_kecamatan.nama_kecamatan,
  tbl_kabupaten.nama_kab_kota,
  tbl_propinsi.nama_propinsi"; 
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlahData=mysqli_num_rows($kerjakan);
  if($jumlahData>0){
    $hasil['jumlahData']=$jumlahData;
    while ($r=mysqli_fetch_assoc($kerjakan)) {
      $hasil['dataKK']=$r;
    }
  }else{
    $hasil['jumlahData']=0;
    $hasil['dataKK']='';
  }
  echo json_encode($hasil);
  break;
case 'cariNIKkkBaru':
$nomorNIK=$_GET['nomorNIK'];
$hasil=array();
$query="SELECT
    tbl_warga.id_warga,
    tbl_warga.id_desa,
    tbl_warga.Dusun,
    tbl_warga.Alamat,
    tbl_warga.`Nomor Bangunan`,
    tbl_warga.Kode_Keluarga,
    tbl_warga.Nama_Kepala_Keluarga,
    tbl_warga.Nama_Anggota_Keluarga,
    tbl_warga.Hubungan,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_dusun.nama_dusun,
    tbl_desa_kel.nama_desa,
    tbl_kecamatan.nama_kecamatan
From
    tbl_warga Inner Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan Inner Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Inner Join
    tbl_desa_kel On tbl_desa_kel.id_desa_kel = tbl_warga.id_desa Inner Join
    tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan
Where
    tbl_warga.NIK = $nomorNIK";
    $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlahData=mysqli_num_rows($kerjakan);
  if($jumlahData>0){
    $hasil['jumlahData']=$jumlahData;
    while ($r=mysqli_fetch_assoc($kerjakan)) {
      $hasil['dataNik']=$r;
    }
  }else{
    $hasil['jumlahData']=0;
    $hasil['dataNik']='';
  }
  echo json_encode($hasil);

  break;
  case 'cariduplikatKK':
$nomorKKBaru=$_GET['nomorKKBaru'];
$hasil=array();
$query="SELECT
    v_daftar_kk.Nama_Kepala_Keluarga,
    tbl_desa_kel.nama_desa,
    tbl_dusun.nama_dusun,
    tbl_kecamatan.nama_kecamatan
From
    v_daftar_kk Inner Join
    tbl_desa_kel On tbl_desa_kel.id_desa_kel = v_daftar_kk.id_desa Inner Join
    tbl_dusun On tbl_dusun.id_dusun = v_daftar_kk.Dusun Inner Join
    tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan
Where
    v_daftar_kk.Kode_Keluarga = $nomorKKBaru";
    $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlahData=mysqli_num_rows($kerjakan);
  if($jumlahData>0){
    $hasil['jumlahData']=$jumlahData;
    while ($r=mysqli_fetch_assoc($kerjakan)) {
      $hasil['dataKK']=$r;
    }
  }else{
    $hasil['jumlahData']=0;
    $hasil['dataKK']='';
  }
  echo json_encode($hasil);

  break;

  case 'cariNomorNIK':
  $nomorNIK=$_GET['nomorNIK'];
  $hasil=array();
  $dataNik=array();
  $query="SELECT
  tbl_warga.id_warga,
  tbl_warga.NIK,
  tbl_warga.Alamat,
  tbl_warga.`Nomor Bangunan`,
  tbl_warga.Nama_Kepala_Keluarga,
  tbl_warga.No,
  tbl_desa_kel.nama_desa,
  tbl_dusun.nama_dusun,
  tbl_kecamatan.nama_kecamatan,
  tbl_kabupaten.nama_kab_kota,
  tbl_propinsi.nama_propinsi,
  tbl_warga.Nama_Anggota_Keluarga,
  tbl_warga.Jenis_Kelamin,
  tbl_hub_keluarga.status_hub_keluarga,
  tbl_warga.Usia,
  tbl_warga.Status
  From
  tbl_warga Left Join
  tbl_desa_kel On tbl_desa_kel.id_desa_kel = tbl_warga.id_desa Left Join
  tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Inner Join
  tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan Inner Join
  tbl_kabupaten On tbl_kabupaten.id_kabupaten = tbl_kecamatan.id_kabupaten Inner Join
  tbl_propinsi On tbl_propinsi.id_propinsi = tbl_kabupaten.id_propinsi Inner Join
  tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan
  Where
  tbl_warga.NIK = $nomorNIK
  Group By
  tbl_warga.id_warga,
  tbl_warga.NIK,
  tbl_warga.Alamat,
  tbl_warga.`Nomor Bangunan`,
  tbl_warga.Nama_Kepala_Keluarga,
  tbl_desa_kel.nama_desa,
  tbl_dusun.nama_dusun,
  tbl_kecamatan.nama_kecamatan,
  tbl_kabupaten.nama_kab_kota,
  tbl_propinsi.nama_propinsi,
  tbl_warga.Nama_Anggota_Keluarga,
  tbl_warga.Jenis_Kelamin,
  tbl_hub_keluarga.status_hub_keluarga,
  tbl_warga.Usia,
  tbl_warga.Status"; 
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlahData=mysqli_num_rows($kerjakan);
  if($jumlahData>0){
    $hasil['jumlahData']=$jumlahData;
    while ($r=mysqli_fetch_assoc($kerjakan)) {
      $hasil['dataNik']=$r;
    }
  }else{
    $hasil['jumlahData']=0;
    $hasil['dataNik']='';
  }
  echo json_encode($hasil);
  break;
  case 'loadDataDuplikat':
  $query="SELECT
  tbl_warga.Kode_Keluarga,
  `Nama_Kepala_Keluarga`,
  COUNT(tbl_warga.Kode_Keluarga) As Count_Kode_Keluarga
  From
  tbl_warga
  Where
  tbl_warga.id_desa = '12.07.05.2007'
  Group By
  tbl_warga.Kode_Keluarga
  HAVING COUNT(Kode_Keluarga) > 1"; 
  $querykedua="SELECT
  tbl_warga.Kode_Keluarga,
  tbl_warga.Nama_Kepala_Keluarga,
  tbl_dusun.nama_dusun,
  COUNT(tbl_warga.Kode_Keluarga) As Count_Kode_Keluarga
  From
  tbl_warga Left Join
  tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun
  Where
  tbl_warga.id_desa = '12.07.05.2007'
  Group By
  tbl_warga.Kode_Keluarga
  HAVING COUNT(Kode_Keluarga) > 1
  ORDER BY tbl_dusun.nama_dusun, tbl_warga.Nama_Kepala_Keluarga;";
  break;
  case 'loadHubunganKeluarga':
  $data=array();
  $dataHubungan=array();
  $query="SELECT
  id_hub_keluarga,
  status_hub_keluarga
  FROM
  tbl_hub_keluarga
  WHERE
  aktif = 'Y'";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  $jumlahData=mysqli_num_rows($kerjakan);
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataHubungan[]=$hasil;
  }
  $data['jumlahData']=$jumlahData;
  $data['hubunganKeluarga']=$dataHubungan;
  echo json_encode($data);
  break;
  case 'LoadDataPendudukDesa':
  error_reporting(0);
  $id_desa='12.07.05.2007';
  $pilihanDusun=$_GET['pilihanDusun'];
  $tambahanWhere="";
  if($pilihanDusun){
   $tambahanWhere="AND tbl_warga.Dusun='$pilihanDusun'";
 }else{
   $tambahanWhere="";
 }
 $data=array();
 $KKjumlah=array();
 $jumlahKeluarga=array();
 $kepalaKeluarga=array();
 $KKlakiLaki=array();
 $KKhubungan=array();
 $KKUsia=array();
 $KKStatus=array();
 $KKAgama=array();
 $KKwargaNegara=array();
 $KKEtnis_Suku=array();
 $KKPendidikan=array();
 $KKPekerjaan=array();

 $KKnamaPekerjaan=array();
 $WargaJenisKelamin=array();
 $WargaHubungan=array();
 $WargaUsia=array();
 $WargaJumlahKeluarga=array();
 $KKidKepalaKeluarga=array();
 $WargaId=array();
 $WargaPendidikan=array();
 $WargaPkerjaan=array();

 $WargaNamaPekerjaan=array();
 $WargaStatus=array();
 $ambilPerKK="SELECT
    tbl_warga.id_warga,
    tbl_dusun.nama_dusun,
    tbl_warga.Alamat,
    tbl_warga.`Nomor Bangunan`,
    tbl_warga.Kode_Keluarga,
    tbl_warga.Nama_Kepala_Keluarga,
    tbl_warga.No,
    tbl_warga.NIK,
    tbl_warga.Nama_Anggota_Keluarga,
    tbl_warga.Jenis_Kelamin,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_warga.Tempat_Lahir,
    tbl_warga.Tanggal_Lahir,
    tbl_warga.Usia,
    tbl_warga.Status,
    tbl_agama.agama,
    tbl_warga.GDarah,
    tbl_warga.Kewarganegaraan,
    tbl_suku.nama_suku,
    tbl_warga.Pendidikan,
    tbl_warga.Pekerjaan,
    tbl_pekerjaan.namaPekerjaan,
    tbl_kawin.kawin
From
    tbl_warga Inner Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Left Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan Left Join
    tbl_agama On tbl_agama.id_agama = tbl_warga.Agama Left Join
    tbl_suku On tbl_suku.id_suku = tbl_warga.Etnis_Suku Left Join
    tbl_pekerjaan On tbl_pekerjaan.id_pekerjaan = tbl_warga.Pekerjaan Left Join
    tbl_kawin On tbl_kawin.id_kawin = tbl_warga.Status
 Where
 tbl_warga.id_desa = '$id_desa' AND
 tbl_warga.No = '1' AND
 tbl_warga.aktif_warga = 'Y' $tambahanWhere
 ORDER BY Nama_Kepala_Keluarga,Dusun, NIK ASC
 ";
 $kerjakanKK=mysqli_query($koneksi,$ambilPerKK)or die(mysqli_error($koneksi));
 $jumlahKK=mysqli_num_rows($kerjakanKK);
 $KKjumlah[]=$jumlahKK;
 while ($hasilKK=mysqli_fetch_assoc($kerjakanKK)) {
  $anggotaKeluarga=array();
  $kepalaKeluarga['kepalaKeluarga']=$hasilKK;
  $Kode_Keluarga=$hasilKK['Kode_Keluarga'];
  $NIK=$hasilKK['NIK'];
  $KKLaki_laki[]=$hasilKK['Jenis_Kelamin'];
  $KKhubungan[]=($hasilKK['status_hub_keluarga']);
  $KKUsia[]=$hasilKK['Usia'];
  $KKStatus[]=$hasilKK['Status'];
  $KKkawin[]=$hasilKK['kawin'];
  $KKAgama[]=$hasilKK['agama'];
  $KKwargaNegara[]=$hasilKK['Kewarganegaraan'];
  $KKEtnis_Suku[]='';
  if(!$hasilKK['nama_suku']){
    $KKEtnis_Suku[]="";
  }else{
    $KKEtnis_Suku[]=$hasilKK['nama_suku'];
  }
  $KKPendidikan[]=$hasilKK['Pendidikan'];
  $KKPekerjaan[]=$hasilKK['Pekerjaan'];
  $KKnamaPekerjaan[]=strval($hasilKK['namaPekerjaan']);
  $KKidKepalaKeluarga[]=$hasilKK['id_warga'];
  $ambilKeluarga="SELECT
    tbl_warga.id_warga,
    tbl_dusun.nama_dusun,
    tbl_warga.Alamat,
    tbl_warga.`Nomor Bangunan`,
    tbl_warga.Kode_Keluarga,
    tbl_warga.Nama_Kepala_Keluarga,
    tbl_warga.No,
    tbl_warga.NIK,
    tbl_warga.Nama_Anggota_Keluarga,
    tbl_warga.Jenis_Kelamin,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_warga.Tempat_Lahir,
    tbl_warga.Tanggal_Lahir,
    tbl_warga.Usia,
    tbl_warga.Status,
    tbl_agama.agama,
    tbl_warga.GDarah,
    tbl_warga.Kewarganegaraan,
    tbl_suku.nama_suku,
    tbl_warga.Pendidikan,
    tbl_warga.Pekerjaan,
    tbl_pekerjaan.namaPekerjaan,
    tbl_kawin.kawin
From
    tbl_warga Inner Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Left Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan Left Join
    tbl_agama On tbl_agama.id_agama = tbl_warga.Agama Left Join
    tbl_suku On tbl_suku.id_suku = tbl_warga.Etnis_Suku Left Join
    tbl_pekerjaan On tbl_pekerjaan.id_pekerjaan = tbl_warga.Pekerjaan Left Join
    tbl_kawin On tbl_kawin.id_kawin = tbl_warga.Status
  WHERE
  tbl_warga.Kode_Keluarga =($Kode_Keluarga) AND
  tbl_warga.NIK !=($NIK) AND
  tbl_warga.aktif_warga = 'Y'
  ORDER BY tanggal_lahir asc
  ";
  $KerjakanambilKeluarga=mysqli_query($koneksi,$ambilKeluarga)or die(mysqli_error($koneksi));
  $jumlahKeluarga=mysqli_num_rows($KerjakanambilKeluarga);
  $kepalaKeluarga['jumlahKeluarga']=$jumlahKeluarga;
  $kepalaKeluarga['NamaKeluarga']=array();
  while ($hasilKeluarga=mysqli_fetch_assoc($KerjakanambilKeluarga)) {
    $anggotaKeluarga[]=$hasilKeluarga;
    $WargaJenisKelamin[]=$hasilKeluarga['Jenis_Kelamin'];
    $WargaHubungan[]=($hasilKeluarga['status_hub_keluarga']);
    $WargaUsia[]=$hasilKeluarga['Usia'];
    $WargaJumlahKeluarga[]=$hasilKeluarga['id_warga'];
    $WargaId[]=$hasilKeluarga['id_warga'];
    $WargaPendidikan[]=$hasilKeluarga['Pendidikan'];
    $WargaPkerjaan[]=$hasilKeluarga['Pekerjaan'];
    $WargaNamaPekerjaan[]=strval($hasilKeluarga['namaPekerjaan']);
    $WargaStatus[]=$hasilKeluarga['Status'];
    $WargaKawin[]=$hasilKeluarga['kawin'];
    $WargaSuku[]='';
    if(!$hasilKK['nama_suku']){
      $WargaSuku[]="";
    }else{
      $WargaSuku[]=$hasilKeluarga['nama_suku'];
    }
    $WargaAgama[]=$hasilKeluarga['agama'];
  }
  $kepalaKeluarga['NamaKeluarga'][]=$anggotaKeluarga;
  if($pilihanDusun !==''){
    $data['warga'][]=$kepalaKeluarga;
  }
}
// $KKPekerjaan=array_count_values($KKPekerjaan);
$data['KKPekerjaan']=array_count_values($KKnamaPekerjaan);
$data['WargaPkerjaan']=array_count_values($WargaNamaPekerjaan);
$seluruhPekerjaan=[
  $dariKK=$data['KKPekerjaan'],
  $dariKeluarga=$data['WargaPkerjaan']
];
$finalPekerjaan = array();
array_walk_recursive($seluruhPekerjaan, function($item, $key) use (&$finalPekerjaan){
  $finalPekerjaan[$key] = isset($finalPekerjaan[$key]) ?  $item + $finalPekerjaan[$key] : $item;
});
$data['seluruhPekerjaan']=($finalPekerjaan);
// $data['KKEtnis_Suku']=array_count_values($KKEtnis_Suku);
// $data['WargaEtnis_Suku']=array_count_values($WargaSuku);
$data['Kewarganegaraan']=array_count_values($KKwargaNegara);
$data['KKStatus']=array_count_values($KKkawin);
$data['WargaStatus']=array_count_values($WargaKawin);
$data['KKAgama']=array_count_values($KKAgama);
$data['WargaAgama']=array_count_values($WargaAgama);
$seluruhAgama=[
  $dariKK=$data['KKAgama'],
  $dariKeluarga=$data['WargaAgama']
];
$finalDataAgama = array();
array_walk_recursive($seluruhAgama, function($item, $key) use (&$finalDataAgama){
  $finalDataAgama[$key] = isset($finalDataAgama[$key]) ?  $item + $finalDataAgama[$key] : $item;
});
$seluruhStatus=[
  $dariKK=$data['KKStatus'],
  $dariKeluarga=$data['WargaStatus']
];
// $seluruhEtnis=[
//   $dariKK=$data['KKEtnis_Suku'],
// $dariKeluarga=$data['WargaEtnis_Suku']
// ];
// $finalDataSuku = array();
// array_walk_recursive($seluruhEtnis, function($item, $key) use (&$finalDataSuku){
//     $finalDataSuku[$key] = isset($finalDataSuku[$key]) ?  $item + $finalDataSuku[$key] : $item;
// });
$finalStatusPerkawinan = array();
array_walk_recursive($seluruhStatus, function($item, $key) use (&$finalStatusPerkawinan){
  $finalStatusPerkawinan[$key] = isset($finalStatusPerkawinan[$key]) ?  $item + $finalStatusPerkawinan[$key] : $item;
});
$data['seluruhAgama']=($finalDataAgama);
// $data['seluruhEtnisSuku']=($finalDataSuku);
$data['seluruhStatusKawin']=($finalStatusPerkawinan);
$data['KKUsia']=array_count_values($KKUsia);
$data['KKlakiLaki']=array_count_values($KKLaki_laki);
$data['KKhubungan']=(array_count_values($KKhubungan));
$data['WargaJenisKelamin']=array_count_values($WargaJenisKelamin);
$data['WargaHubungan']=array_count_values($WargaHubungan);
$data['WargaUsia']=array_count_values($WargaUsia);
$data['jumlahKK']=$jumlahKK;
$data['WargaJumlahKeluarga']=count($WargaJumlahKeluarga);
$data['jumlahSeluruhWarga']=$data['jumlahKK']+$data['WargaJumlahKeluarga'];
$data['KKPendidikan'][]=array_count_values($KKPendidikan);
$data['WargaPendidikan'][]=array_count_values($WargaPendidikan);
$seluruhUsia=[
  $dariKK=$data['KKUsia'],
  $dariKeluarga=$data['WargaUsia']
];
$finalUsia = array();
array_walk_recursive($seluruhUsia, function($item, $key) use (&$finalUsia){
  $finalUsia[$key] = isset($finalUsia[$key]) ?  $item + $finalUsia[$key] : $item;
});
$seluruhHubungan=[
  $dariKK=$data['KKhubungan'],
  $dariKeluarga=$data['WargaHubungan']
];
$finalHubungan = array();
array_walk_recursive($seluruhHubungan, function($item, $key) use (&$finalHubungan){
  $finalHubungan[$key] = isset($finalHubungan[$key]) ?  $item + $finalHubungan[$key] : $item;
});
$seluruhPendiidikan=[
  $dariKK=$data['KKPendidikan'],
  $dariKeluarga=$data['WargaPendidikan']
];
$finalPendidikan = array();
array_walk_recursive($seluruhPendiidikan, function($item, $key) use (&$finalPendidikan){
  $finalPendidikan[$key] = isset($finalPendidikan[$key]) ?  $item + $finalPendidikan[$key] : $item;
});
$data['seluruhHubungan']=($finalHubungan);
$data['SeluruhPendidikan']=($finalPendidikan);
$data['SeluruhUsia']=($finalUsia);
echo json_encode($data);
break;
case 'loadSebagianDataKK':
$nomorKK=$_GET['nomorKK'];
$query="SELECT
tbl_warga.Kode_Keluarga,
tbl_warga.Nama_Kepala_Keluarga,
tbl_warga.id_desa,
tbl_warga.Dusun,
tbl_warga.Alamat,
tbl_warga.`Nomor Bangunan`,
tbl_desa_kel.id_kecamatan,
tbl_kecamatan.id_kabupaten,
tbl_kabupaten.id_propinsi,
tbl_warga.Agama,
tbl_warga.Kewarganegaraan,
tbl_warga.Etnis_Suku
From
tbl_warga Inner Join
tbl_desa_kel On tbl_desa_kel.id_desa_kel = tbl_warga.id_desa Inner Join
tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan Inner Join
tbl_kabupaten On tbl_kabupaten.id_kabupaten = tbl_kecamatan.id_kabupaten Inner Join
tbl_propinsi On tbl_propinsi.id_propinsi = tbl_kabupaten.id_propinsi
Where
tbl_warga.Kode_Keluarga = '$nomorKK'
LIMIT 1";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
// $data=array();
$hasil='';
while ($row=mysqli_fetch_assoc($kerjakan)) {
  $hasil=$row;
}
$data=$hasil;
echo json_encode($data);
break;
case 'loadDataKeluargaByKK':
$nomorKK=$_GET['NoKK'];
$query="SELECT
    tbl_warga.id_warga,
    tbl_warga.Dusun,
    tbl_dusun.nama_dusun,
    tbl_warga.Alamat,
    tbl_warga.`Nomor Bangunan` As nomorBangunan,
    tbl_warga.Kode_Keluarga,
    tbl_warga.Nama_Kepala_Keluarga,
    tbl_warga.No,
    tbl_warga.NIK,
    tbl_warga.Nama_Anggota_Keluarga,
    tbl_warga.Jenis_Kelamin,
    tbl_warga.Tempat_Lahir,
    tbl_warga.Tanggal_Lahir,
    tbl_warga.Usia,
    tbl_warga.Status,
    tbl_agama.agama,
    tbl_warga.GDarah,
    tbl_warga.Kewarganegaraan,
    tbl_suku.nama_suku,
    tbl_warga.Pendidikan,
    tbl_warga.Pekerjaan,
    tbl_warga.aktif_warga,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_kawin.kawin,
    tbl_pekerjaan.namaPekerjaan
From
    tbl_warga Left Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Left Join
    tbl_agama On tbl_agama.id_agama = tbl_warga.Agama Left Join
    tbl_suku On tbl_suku.id_suku = tbl_warga.Etnis_Suku Left Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan Left Join
    tbl_kawin On tbl_kawin.id_kawin = tbl_warga.Status Left Join
    tbl_pekerjaan On tbl_pekerjaan.id_pekerjaan = tbl_warga.Pekerjaan
Where
    tbl_warga.Kode_Keluarga = $nomorKK
Order By
    tbl_warga.No
";
$data=array();
$dataKeluarga=array();
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
while ($hasil=mysqli_fetch_assoc($kerjakan)) {
  $dataKeluarga[]=$hasil;
}
$data['jumlahData']=$jumlahData;
$data['keluarga']=$dataKeluarga;
echo json_encode($data);
break;
case 'loadDataKeluargaBaru':
$nomorKK=$_GET['NoKK'];
$query="SELECT
    tbl_kk_baru_temp.id_warga,
    tbl_kk_baru_temp.Dusun,
    tbl_dusun.nama_dusun,
    tbl_kk_baru_temp.Alamat,
    tbl_kk_baru_temp.`Nomor Bangunan` As nomorBangunan,
    tbl_kk_baru_temp.Kode_Keluarga,
    tbl_kk_baru_temp.Nama_Kepala_Keluarga,
    tbl_kk_baru_temp.No,
    tbl_kk_baru_temp.NIK,
    tbl_kk_baru_temp.Nama_Anggota_Keluarga,
    tbl_kk_baru_temp.Jenis_Kelamin,
    tbl_kk_baru_temp.Tempat_Lahir,
    tbl_kk_baru_temp.Tanggal_Lahir,
    tbl_kk_baru_temp.Usia,
    tbl_kk_baru_temp.Status,
    tbl_agama.agama,
    tbl_kk_baru_temp.GDarah,
    tbl_kk_baru_temp.Kewarganegaraan,
    tbl_suku.nama_suku,
    tbl_kk_baru_temp.Pendidikan,
    tbl_kk_baru_temp.Pekerjaan,
    tbl_kk_baru_temp.aktif_warga,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_kawin.kawin,
    tbl_pekerjaan.namaPekerjaan
From
    tbl_kk_baru_temp Left Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_kk_baru_temp.Dusun Left Join
    tbl_agama On tbl_agama.id_agama = tbl_kk_baru_temp.Agama Left Join
    tbl_suku On tbl_suku.id_suku = tbl_kk_baru_temp.Etnis_Suku Left Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_kk_baru_temp.Hubungan Left Join
    tbl_kawin On tbl_kawin.id_kawin = tbl_kk_baru_temp.Status Left Join
    tbl_pekerjaan On tbl_pekerjaan.id_pekerjaan = tbl_kk_baru_temp.Pekerjaan
Where
    tbl_kk_baru_temp.Kode_Keluarga = $nomorKK
Order By
    tbl_kk_baru_temp.No
";
$data=array();
$dataKeluarga=array();
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
while ($hasil=mysqli_fetch_assoc($kerjakan)) {
  $dataKeluarga[]=$hasil;
}
$data['jumlahData']=$jumlahData;
$data['keluarga']=$dataKeluarga;
echo json_encode($data);
break;
case 'loadDetilWarga':
$nomorNIK=$_GET['nomorNIK'];
$query="SELECT
    tbl_warga.*,
    tbl_desa_kel.nama_desa,
    tbl_kecamatan.id_kecamatan,
    tbl_kecamatan.nama_kecamatan,
    tbl_kabupaten.id_kabupaten,
    tbl_kabupaten.nama_kab_kota,
    tbl_hub_keluarga.status_hub_keluarga,
    tbl_agama.agama As agama1,
    tbl_suku.nama_suku,
    tbl_propinsi.nama_propinsi,
    tbl_propinsi.id_propinsi,
    tbl_hub_keluarga.id_hub_keluarga,
    tbl_kawin.kawin,
    tbl_pekerjaan.namaPekerjaan,
    tbl_gol_darah.GolDarah,
    tbl_dusun.nama_dusun
From
    tbl_warga Left Join
    tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun Left Join
    tbl_desa_kel On tbl_desa_kel.id_desa_kel = tbl_warga.id_desa Left Join
    tbl_kecamatan On tbl_kecamatan.id_kecamatan = tbl_desa_kel.id_kecamatan Left Join
    tbl_kabupaten On tbl_kabupaten.id_kabupaten = tbl_kecamatan.id_kabupaten Left Join
    tbl_hub_keluarga On tbl_hub_keluarga.id_hub_keluarga = tbl_warga.Hubungan Left Join
    tbl_agama On tbl_agama.id_agama = tbl_warga.Agama Left Join
    tbl_suku On tbl_suku.id_suku = tbl_warga.Etnis_Suku Left Join
    tbl_propinsi On tbl_propinsi.id_propinsi = tbl_kabupaten.id_propinsi Left Join
    tbl_kawin On tbl_kawin.id_kawin = tbl_warga.Status Left Join
    tbl_pekerjaan On tbl_pekerjaan.id_pekerjaan = tbl_warga.Pekerjaan Left Join
    tbl_gol_darah On tbl_gol_darah.kodeGolDarah = tbl_warga.GDarah
Where
    tbl_warga.id_warga = $nomorNIK
";
$data=array();
$detilWarga=array();
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
while ($hasil=mysqli_fetch_assoc($kerjakan)) {
  $detilWarga[]=$hasil;
}
$data['jumlahData']=$jumlahData;
$data['detilWarga']=$detilWarga;
echo json_encode($data);
break;
case'loadAlamatTerbaru':
$query="SELECT
tbl_desa.nama_desa,
tbl_kecamatan.nama_kecamatan,
tbl_kabupaten.nama_kabupaten,
tbl_propinsi.nama_propinsi
From
tbl_propinsi Inner Join
tbl_kabupaten On tbl_kabupaten.id_propinsi = tbl_propinsi.id_propinsi Inner Join
tbl_kecamatan On tbl_kecamatan.id_kabupaten = tbl_kabupaten.id_kabupaten Inner Join
tbl_desa On tbl_desa.id_kecamatan = tbl_kecamatan.id_kecamatan
Group By
tbl_desa.nama_desa,
tbl_kecamatan.nama_kecamatan,
tbl_kabupaten.nama_kabupaten,
tbl_propinsi.nama_propinsi
Order By
tbl_propinsi.nama_propinsi
LIMIT 0,100
";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
$dataAlamat=array();
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $dataAlamat[]=$hasil;
}
$data['alamat']=$dataAlamat;
echo json_encode($data);
break;
case 'loadJumlahAlamat':
$query= "SELECT
(SELECT COUNT(*) FROM tbl_alamat WHERE LENGTH(`kode`) = 2) AS propinsi,
(SELECT COUNT(*) FROM tbl_alamat WHERE LENGTH(`kode`) =5) AS kabupaten,
(SELECT COUNT(*) FROM tbl_alamat WHERE LENGTH(`kode`) =8) AS kecamatan,
(SELECT COUNT(*) FROM tbl_alamat WHERE LENGTH(`kode`) =13) AS desa,
(SELECT COUNT(*) FROM tbl_dusun) AS dusun
";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahALamat='';
while($hasil=mysqli_fetch_assoc($kerjakan)){
  $jumlahALamat=$hasil;
}
$data['jumlahALamat']=$jumlahALamat;
echo json_encode($data);
break;
case 'loadAlamat':
$id_propinsi=$_GET['id_propinsi'];
$idKabupaten=$_GET['idKabupaten'];
$idKecamatan=$_GET['idKecamatan'];
$KodeKecamatan="$id_propinsi.$idKabupaten";
$KodeDesa="$id_propinsi.$idKabupaten.$idKecamatan";
// echo "KodeDesa $KodeDesa";
$queryPropinsi="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) = 2 Order By nama"; 
$kerjakanPropinsi=mysqli_query($koneksi,$queryPropinsi)or die(mysql_error($koneksi));
$jumlahPropinsi=mysqli_num_rows($kerjakanPropinsi);
if($jumlahPropinsi){
  $data['jumlahPropinsi']=$jumlahPropinsi;
  $dataPropinsi=array();
  while ($hasilPropinsi=mysqli_fetch_assoc($kerjakanPropinsi)) {
    $data_propinsi[]=$hasilPropinsi;
  }
  $data['data_propinsi']=$data_propinsi;
}else{
  $data['jumlahPropinsi']=null;
}
$queryKabupaten="SELECT * FROM tbl_alamat WHERE `kode` LIKE '$id_propinsi%' AND LENGTH(`kode`) =5 Order By nama"; 
$kerjakanKabupaten=mysqli_query($koneksi,$queryKabupaten)or die(mysql_error($koneksi));
$jumlahKabupaten=mysqli_num_rows($kerjakanKabupaten);
if($jumlahKabupaten){
  $data['jumlahKabupaten']=$jumlahKabupaten;
  $dataKabupaten=array();
  while ($hasilKabupaten=mysqli_fetch_assoc($kerjakanKabupaten)) {
    $dataKabupaten[]=$hasilKabupaten;
  }
  $data['data_kabupaten']=$dataKabupaten;
}else{
  $data['jumlahKabupaten']=null;
}
$queryKecamatan="SELECT * FROM tbl_alamat WHERE `kode` LIKE '$KodeKecamatan%' AND LENGTH(`kode`) =8 Order By nama"; 
$kerjakanKecamatan=mysqli_query($koneksi,$queryKecamatan)or die(mysql_error($koneksi));
$jumlahKecamatan=mysqli_num_rows($kerjakanKecamatan);
if($jumlahKecamatan){
  $data['jumlahKecamatan']=$jumlahKecamatan;
  $dataKecamatan=array();
  while ($hasilKecamatan=mysqli_fetch_assoc($kerjakanKecamatan)) {
    $dataKecamatan[]=$hasilKecamatan;
  }
}else{
  $data['jumlahKecamatan']=null;
  $dataKecamatan[]=null;
}
$data['dataKecamatan']=$dataKecamatan;
$queryDesa="SELECT * FROM tbl_alamat WHERE `kode` LIKE '$KodeDesa%' AND LENGTH(`kode`) =13 Order By nama"; 
$kerjakanDesa=mysqli_query($koneksi,$queryDesa)or die(mysql_error($koneksi));
$jumlahDesa=mysqli_num_rows($kerjakanDesa);
if($jumlahDesa>0){
  $data['jumlahDesa']=$jumlahDesa;
  $dataDesa=array();
  while ($hasilDesa=mysqli_fetch_assoc($kerjakanDesa)) {
    $dataDesa[]=$hasilDesa;
  }
}else{
  $data['jumlahDesa']=null;
  $dataDesa[]=null;
}
$data['dataDesa']=$dataDesa;
echo json_encode($data);
break;
case 'load_propinsi':
$queryPropinsi="SELECT * FROM `tbl_propinsi` ORDER BY `nama_propinsi`"; 
$kerjakanPropinsi=mysqli_query($koneksi,$queryPropinsi)or die(mysqli_error($koneksi));
$jumlahPropinsi=mysqli_num_rows($kerjakanPropinsi);
if($jumlahPropinsi){
  $data['jumlahPropinsi']=$jumlahPropinsi;
  $dataPropinsi=array();
  while ($hasilPropinsi=mysqli_fetch_assoc($kerjakanPropinsi)) {
    $data_propinsi[]=$hasilPropinsi;
  }
  $data['data_propinsi']=$data_propinsi;
}else{
  $data['jumlahPropinsi']=null;
}
echo json_encode($data);
break;
case 'loadSeluruhKabupaten':
$query="SELECT * FROM `tbl_kabupaten` ORDER BY `nama_kab_kota`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_kabupaten=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_kabupaten[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
  $data_kabupaten[]=null;
}
$data['data_kabupaten']=$data_kabupaten;
echo json_encode($data);
break;
case 'UbahSeluruhKabupaten':
$query="SELECT * FROM `tbl_kabupaten` ORDER BY `nama_kab_kota`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_kabupaten=array();
  $idBaru=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $idKabupaten=$hasil['id_kabupaten'];
    $id_propinsi=$hasil['id_propinsi'];
    $nama_kab_kota=$hasil['nama_kab_kota'];
    $pecahkanIDKabupaten=substr($idKabupaten,2,2);
    $hasilInsert = substr_replace($idKabupaten, '.', 2, 0);
    $update="UPDATE `tbl_kabupaten` SET `id_kabupaten_baru`=$hasilInsert WHERE `id_kabupaten`=$idKabupaten";
    $kerjakanUPdate=mysqli_query($koneksi,$update)or die(mysqli_error($koneksi));
    $data_kabupaten[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
  $data_kabupaten[]=null;
}
$data['data_kabupaten']=$data_kabupaten;
  // $data['idBaru']=$idBaru;
echo json_encode($data);
break;
case 'loadKabupaten':
$id_propinsi=$_GET['id_propinsi'];
$query="SELECT `id_kabupaten`, `nama_kab_kota` FROM `tbl_kabupaten` WHERE `id_propinsi`='$id_propinsi' ORDER BY `nama_kab_kota`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_kabupaten=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_kabupaten[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
  $data_kabupaten[]=null;
}
$data['data_kabupaten']=$data_kabupaten;
echo json_encode($data);
break;
case 'perbaikiKabupaten':
$query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =5 Order By nama";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_kabupaten=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_kabupaten[]=$hasil;
    $id_kabupaten=$hasil['kode'];
    $namaKabupaten=$hasil['nama'];
    $kodePropinsi=substr($id_kabupaten,0,2);
    $perintahSimpan="INSERT IGNORE INTO `tbl_kabupaten`(`id_kabupaten`, `id_propinsi`, `nama_kab_kota`) VALUES ('$id_kabupaten','$kodePropinsi','$namaKabupaten')";
    $kerjakanSimpan=mysqli_query($koneksi,$perintahSimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['simpan']=true;
    }else{
      $data['simpan']=true;
    }
  }
}else{
  $data['jumlahData']=null;
  $data_kabupaten[]=null;
}
$data['data_kabupaten']=$data_kabupaten;
echo json_encode($data);
break;
case 'loadkecamatan':
$id_kabupaten=$_GET['id_kabupaten'];
  // echo "id kabupapten : $id_kabupaten";
$query="SELECT `id_kecamatan`,`nama_kecamatan` FROM `tbl_kecamatan` WHERE `id_kabupaten`='$id_kabupaten' AND `aktif`='Y' ORDER BY `nama_kecamatan`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$data_kecamatan=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_kecamatan[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
  $data_kecamatan[]=null;
}
$data['data_kecamatan']=$data_kecamatan;
echo json_encode($data);
break;
case 'loadSeluruhkecamatan':
$query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =8 Order By nama";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$data_kecamatan=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_kecamatan[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
  $data_kecamatan[]=null;
}
$data['data_kecamatan']=$data_kecamatan;
echo json_encode($data);
break;
case 'ubahSeluruhkecamatan':
$query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =8";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$dataSemua=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
   $kode_kecamatan=$hasil['kode'];
   $nama_kecamatan=addslashes($hasil['nama']);
   $dataSemua[]=$hasil;
   $QuerySimpan="INSERT INTO `tbl_kecamatan`(`id_kecamatan`, `nama_kecamatan`) VALUES ('$kode_kecamatan','$nama_kecamatan')";
   $kerjakanSimpan=mysqli_query($koneksi,$QuerySimpan)or die(mysqli_error($koneksi));
   if($kerjakanSimpan){
    $dataSemua['hasilSimpan']=true;
  }else{
   $dataSemua['hasilSimpan']=false;
 }
}
}else{
  $data['jumlahData']=null;
  $data_kecamatan[]=null;
}
$data['semua']=$dataSemua;
echo json_encode($data);
break;
case 'updateIDKabupatenKecamatan':
$query="SELECT * FROM `tbl_kecamatan`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$dataSemua=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
   $kode_kecamatan=$hasil['id_kecamatan'];
   $pecahkanIDKecamatan=substr($kode_kecamatan,0,5);
   $queryUpdate="UPDATE `tbl_kecamatan` SET `id_kabupaten`='$pecahkanIDKecamatan' WHERE `id_kecamatan`='$kode_kecamatan'";
   $kerjakanUdate=mysqli_query($koneksi,$queryUpdate)or die(mysqli_error($koneksi));
   if($kerjakanUdate){
    $dataSemua['hasilSimpan']=true;
  }else{
   $dataSemua['hasilSimpan']=false;
 }
}
}else{
  $data['jumlahData']=null;
  $data_kecamatan[]=null;
}
$data['semua']=$dataSemua;
echo json_encode($data);
break;
case 'load_desa':
$id_kecamatan=$_GET['id_kecamatan'];
$query="SELECT `id_desa_kel`,`nama_desa` FROM `tbl_desa_kel` WHERE `id_kecamatan`='$id_kecamatan' AND `aktif`='Y' ORDER BY `nama_desa`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_desa[]=$hasil;
  }
  $data['data_desa']=$data_desa;
}else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case 'load_desa_Json':
$query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =13 Order By nama";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_desa[]=$hasil;
  }
  $data['data_desa']=$data_desa;
}else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case 'loadSemuaDesa':
$query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =13 Order By nama";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  // $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    // $data_desa[]=$hasil;
    $kodeDesa=$hasil['kode'];
    $namaDesa=addslashes($hasil['nama']);
    // $pecahkanIDKecamatan=substr($kodeDesa,0,8);
    $querySimpan="INSERT IGNORE INTO `tbl_desa_kel`(`id_desa_kel`, `nama_desa`) VALUES ('$kodeDesa','$namaDesa')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['jumlahSimpan']=mysqli_affected_rows($koneksi);
      $data['tersimpan']=true;
    }else{
     $data['jumlahSimpan']=mysqli_error($koneksi);
     $data['tersimpan']=false;
   }
 }
  // $data['data_desa']=$data_desa;
}else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case 'loadSemuaDesa1':
$query="SELECT * FROM `tbl_desa_kel`ORDER BY `nama_desa`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_desa[]=$hasil;
    // $pecahkanIDKecamatan=substr($kodeDesa,0,8);
  }
  $data['data_desa']=$data_desa;
}else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case 'updateSemuaKecamatanDesa':
$query="SELECT * FROM `tbl_desa_kel`ORDER BY `nama_desa`";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  // $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $id_desa_kel =$hasil['id_desa_kel'];
    $pecahkanIDKecamatan=substr($id_desa_kel,0,8);
    $queryUpdate="UPDATE `tbl_desa_kel` SET `id_kecamatan`='$pecahkanIDKecamatan' WHERE `id_desa_kel`='$id_desa_kel'";
    $kerjakanUdate=mysqli_query($koneksi,$queryUpdate)or die(mysqli_error($koneksi));
    if($kerjakanUdate){
      $data['update']=true;
    }else{
      $data['update']=mysqli_error($koneksi);
    }
    // $data_desa[]=$hasil;
    // $pecahkanIDKecamatan=substr($kodeDesa,0,8);
  }
  // $data['data_desa']=$data_desa;
}else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case 'loadSemuaDesaTidakAda':
// $query="SELECT nama FROM tbl_alamat WHERE LENGTH(`kode`) =13 WHERE NOT EXISTS (SELECT nama_desa FROM tbl_desa_kel)";
// $query="SELECT nama FROM tbl_alamat WHERE NOT EXISTS (SELECT nama_desa FROM tbl_desa_kel WHERE tbl_alamat.nama = tbl_desa_kel.nama_desa)";
// $query="SELECT * FROM tbl_a WHERE nama='$nama' AND kd_a NOT IN (SELECT kd_a FROM tbl_b WHERE id='$id')";
$query="SELECT id_desa_kel, nama_desa, COUNT(nama_desa) as sejumlah FROM tbl_desa_kel GROUP BY nama_desa HAVING nama_desa > 1 ORDER BY nama_desa";
// $query="SELECT nama_desa, COUNT(*) nama_desa FROM tbl_desa_kel GROUP BY id_desa_kel HAVING COUNT(nama_desa) > 1";
// $query="SELECT * FROM tbl_alamat WHERE LENGTH(`kode`) =13 Order By nama";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  // $data_desa=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_desa[]=$hasil;
    // $kodeDesa=$hasil['kode'];
    // $namaDesa=addslashes($hasil['nama']);
    // // $pecahkanIDKecamatan=substr($kodeDesa,0,8);
    // $querySimpan="INSERT INTO `tbl_desa_kel`(`id_desa_kel`, `nama_desa`) VALUES ('$kodeDesa','$namaDesa')";
    // $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    // if($kerjakanSimpan){
    //   $data['jumlahSimpan']=mysqli_affected_rows($koneksi);
    //   $data['tersimpan']=true;
    // }else{
    //    $data['jumlahSimpan']=mysqli_error($koneksi);
    //   $data['tersimpan']=false;
    // }
  }
  $data['data_desa']=$data_desa;
}
else{
  $data['jumlahData']=null;
}
echo json_encode($data);
break;
case'loadDusun':
// $id_desa=$_GET['id_desa'];
$id_desa='12.07.05.2007';
$query="SELECT
tbl_dusun.nama_dusun,
tbl_dusun.id_dusun
From
tbl_dusun
Where
tbl_dusun.id_desa = '$id_desa' And
tbl_dusun.aktif = 'Y'
Order By
tbl_dusun.nama_dusun";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $data_dusun=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $data_dusun[]=$hasil;
  }
  $data['data_dusun']=$data_dusun;
}else{
  $data['jumlahData']=null;
  $data['data_dusun']=null;
}
echo json_encode($data);
break;
case'loadCboDusun':
// $id_desa=$_GET['id_desa'];
$id_desa='12.07.05.2007';
$query="SELECT Distinct
tbl_dusun.nama_dusun,
tbl_warga.Dusun As idDusun
From
tbl_warga Inner Join
tbl_dusun On tbl_dusun.id_dusun = tbl_warga.Dusun
Where
tbl_warga.id_desa = '$id_desa'
Order By
tbl_dusun.nama_dusun
";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  // $idDusun=array();
  $namadusunHasil=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $namadusunHasil[]=$hasil;
      // if($namadusunHasil==""||null){
      //   $namaDusun="";
      // }else{
      //   $namaDusun=$namadusunHasil;
      // }
    // $data_dusun[]=$namadusunHasil;
  }
  $data['data_dusun']=$namadusunHasil;
}else{
  $data['jumlahData']=null;
  $data['data_dusun']=null;
}
echo json_encode($data);
break;
case 'ambil_terbaru':
$data=array();
$query="";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$kerjakan=mysqli_query($koneksi,"SELECT count(*) From tbl_penduduk "); 
$cariTanpaKK=mysqli_query($koneksi,"SELECT count(no_kk) From tbl_penduduk where no_kk='' ");
$cariTanpaNIK=mysqli_query($koneksi,"SELECT count(nik) From tbl_penduduk where nik='' ");
$cariTanpaDusun=mysqli_query($koneksi,"SELECT COUNT(*) as TanpaDusun FROM tbl_penduduk WHERE id_alamat_dusun IS NULL AND aktif = 'Y'");
$cariTanpaDesa=mysqli_query($koneksi,"SELECT COUNT(*) as TanpaDesa FROM tbl_penduduk WHERE id_alamat_desa IS NULL AND aktif = 'Y'");
$cariTanpaJalan=mysqli_query($koneksi,"SELECT COUNT(*) as TanpaJalan FROM tbl_penduduk WHERE alamat_jalan IS NULL AND aktif = 'Y'");
$cariTanpapekerjaan=mysqli_query($koneksi,"SELECT COUNT(*) as tanpaPekerjaan FROM tbl_penduduk WHERE id_pekerjaan='0' and aktif = 'Y'");
$cariNIKganda=mysqli_query($koneksi,"SELECT 
  DISTINCT nik, 
  COUNT(*) 
  FROM 
  tbl_penduduk 
  GROUP BY 
  nik 
  HAVING 
  COUNT(*) > 1 
  ORDER BY 
  COUNT(*) DESC");
$cariDisabilitas=mysqli_query($koneksi,"SELECT count(id_disabilitas) disabilitas From tbl_penduduk where id_disabilitas !=0 ");
$cariJumlahTPS=mysqli_query($koneksi,"Select
  Count(Distinct tbl_penduduk.tps) As Count_tps
  From
  tbl_penduduk");
$hasilJumlahData=mysqli_fetch_array($kerjakan);
$hasilTanpaKK=mysqli_fetch_array($cariTanpaKK);
$hasilTanpaNIK=mysqli_fetch_array($cariTanpaNIK);
$hasilCariNIKganda=mysqli_fetch_assoc($cariNIKganda);
$hasilDisabilitas=mysqli_fetch_assoc($cariDisabilitas);
$hasilJumlahTPS=mysqli_fetch_assoc($cariJumlahTPS);
$jumlahBarisNIKGanda=mysqli_num_rows($cariNIKganda);
$hasil_alamat_Dusun=mysqli_fetch_array($cariTanpaDusun);
$hasil_alamat_Desa=mysqli_fetch_array($cariTanpaDesa);
$hasil_tanpa_jalan=mysqli_fetch_array($cariTanpaJalan);
$hasil_tanpa_pekerjaan=mysqli_fetch_array($cariTanpapekerjaan);
$data['jumlahData']=$hasilJumlahData['0'];
$data['tanpaKK']=$hasilTanpaKK['0'];
$data['tanpaNIK']=$hasilTanpaNIK['0'];
$data['NIKganda']=$jumlahBarisNIKGanda;
$data['disabilitas']=$hasilDisabilitas['disabilitas'];
$data['tanpaPekerjaan']=$hasil_tanpa_pekerjaan['tanpaPekerjaan'];
$data['JumlaTPS']=$hasilJumlahTPS['Count_tps'];
$data['tanpaDusun']=$hasil_alamat_Dusun['TanpaDusun'];
$data['tanpaDesa']=$hasil_alamat_Desa['TanpaDesa'];
$data['tanpaJalan']=$hasil_tanpa_jalan['TanpaJalan'];
echo json_encode($data);
break;
case'nikKurangdari16':
$query="SELECT * FROM `tbl_warga` WHERE LENGTH(`NIK`) !=16 ORDER BY NIK DESC, Nama_Anggota_Keluarga ASC";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData){
  $data['jumlahData']=$jumlahData;
  $hasil_orang=array();
  while($hasil=mysqli_fetch_assoc($kerjakan)){
   $alamat=getAlamat($hasil['Nama_Anggota_Keluarga']);
   $hasil['alamat']=$alamat;
   $hasil_orang[]=$hasil;
 }
}else{
  $data['jumlahData']=null;
}
// $data['alamat']=$alamat;
$data['hasil_orang']=$hasil_orang;
echo json_encode($data);
break;
case'cariNIkDuplikat':
$query="SELECT 'nama', `nik`, COUNT(*) duplikat FROM tbl_dps GROUP BY nik HAVING duplikat > 1 ORDER by nik";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $nik=array();
  $duplikat=array();
  while($hasil=mysqli_fetch_assoc($kerjakan)){
    // $nik=$hasil['nik'];
    $nik[]=getNamaByNIK($hasil['nik']);
  }
}else{
  $data['jumlahData']=null;
}
$data['orang']=$nik;
// foreach ($data['nik'] as $niks) {
//   getNamaByNIK($niks);
// }
echo json_encode($data);
break;
case 'getNamaByNIK':
$nik=$_GET['nik'];
$query="SELECT no_kk, nik, nama_lengkap, jk, tpt_lahir, umur, kawin, id_alamat FROM tbl_dps WHERE nik ='$nik'"; 
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$hasil_orang=array();
$data_orang=array();
while($hasil=mysqli_fetch_assoc($kerjakan)){
    // $hasilData[]=$hasil;
  $alamat=getAlamat($hasil['id_alamat']);
  $hasil['alamat']=$alamat;
  $hasil_orang[]=$hasil;
}
$data['detilOrang']=$hasil_orang;
echo json_encode($data);
break;
case'ambiltglLahirSalah':
$query="SELECT id_orang, nik, nama_lengkap, jk, umur, tpt_lahir, tgl_lahir, tgl_lahir_excel, tulisan_alamat FROM tbl_dps WHERE tgl_lahir<>tgl_lahir_excel ORDER BY nik";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$dataSalah=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataSalah[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
}
$data['salah']=$dataSalah;
echo json_encode($data);
break;
case'HitunganNIKSalah':
$query="SELECT * FROM `tbl_warga` WHERE `usia` LIKE '%0000-00-00%' ORDER BY NIK";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
$nikSalah=array();
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $nikSalah[]=$hasil;
  }
}else{
  $data['jumlahData']=null;
}
$data['nikSalah']=$nikSalah;
echo json_encode($data);
break;
case'ambilDataPribadiByNIK':
// var_dump($_GET);
$id_orang=$_GET['id_orang'];
$kk=$_GET['kk'];
$queryDataPribadi="SELECT
id_orang,
nik,
nama_lengkap,
no_kk,
jk,
tpt_lahir,
tgl_lahir,
tgl_lahir_excel,
umur,
kawin,
id_alamat,
tulisan_alamat,
date_update
FROM
tbl_dps
WHERE
id_orang = '$id_orang' ";
$queryDataKeluarga="SELECT DISTINCT
id_orang,
nik,
nama_lengkap,
jk,
tpt_lahir,
tgl_lahir,
tgl_lahir_excel,
umur,
kawin,
id_alamat,
tulisan_alamat,
date_update
FROM
tbl_dps
WHERE
no_kk = '$kk' ORDER BY nama_lengkap
";
$kerjakanDataPribadi=mysqli_query($koneksi,$queryDataPribadi)or die(mysqli_error($koneksi));
$kerjakanDataKeluarga=mysqli_query($koneksi,$queryDataKeluarga)or die(mysqli_error($koneksi));
// $hasilDataPribadi=array();
$hasilDataKeluarga=array();
while($hasilPribadi=mysqli_fetch_assoc($kerjakanDataPribadi)){
  $hasilDataPribadi=$hasilPribadi;
}
while($hasilKeluarga=mysqli_fetch_assoc($kerjakanDataKeluarga)){
  $hasilDataKeluarga[]=$hasilKeluarga;
}
$data['pribadi']=$hasilDataPribadi;
$data['keluarga']=$hasilDataKeluarga;
echo json_encode($data);
break;
default:
echo 'Tidak ditemukan perintah yang tepat !';
break;
}
?>