<?php
//$queryDesa="SELECT * FROM tbl_alamat WHERE `kode` LIKE '$KodeDesa%' AND LENGTH(`kode`) =13 Order By nama"; 
$perintah=$_GET['perintah'];
switch ($perintah) {
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
  $queryPropinsi="SELECT `id_propinsi`,`nama_propinsi` FROM `tbl_propinsi` WHERE `aktif`='Y' ORDER BY `nama_propinsi`"; 
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
$id_desa=$_GET['id_desa'];
$query="SELECT `id_dusun`,`nama_dusun` FROM `tbl_dusun` WHERE `id_desa`='$id_desa' AND `aktif`='Y' ORDER BY `nama_dusun`";
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
case 'loadJalan':
$id_dusun=$_GET['id_dusun'];
$query="SELECT * FROM `tbl_jalan` WHERE `id_rt_rw_dusun`='$id_dusun' AND `aktif`='Y' ";
// $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $dataJalan=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataJalan[]=$hasil;
  }
  $data['dataJalan']=$dataJalan;
}else{
  $data['jumlahData']=null;
  $data['dataJalan']=null;
}
echo json_encode($data);
break;
case 'load_jenis_jalan':
$query="SELECT kode_adm_jalan, nama_kode FROM tbl_jalan_type WHERE aktif = 'Y'";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $dataJenisJalan=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataJenisJalan[]=$hasil;
  }
  $data['dataJenisJalan']=$dataJenisJalan;
}else{
  $data['jumlahData']=null;
  $data['dataJenisJalan']=null;
}
echo json_encode($data);
break;
case 'loadSimpangGang':
$id_Jalan=$_GET['id_Jalan'];
$query="SELECT
id_simpang_gang,
nama_simpang_gang
FROM
tbl_simpang_gang
WHERE
id_jalan = '$id_Jalan' AND
aktif = 'Y'
";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $dataSimpangGang=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataSimpangGang[]=$hasil;
  }
  $data['dataSimpangGang']=$dataSimpangGang;
}else{
  $data['jumlahData']=null;
  $data['dataSimpangGang']=null;
}
echo json_encode($data);
break;
case 'loadNamaBangunan':
$id_Jalan=$_GET['id_Jalan'];
$id_Gang=$_GET['id_Gang'];
$query='';
if($id_Jalan && $id_Gang){
  $query="SELECT id_nama_bangunan, nama_bangunan_tempat, nomor_rumah_bangunan FROM tbl_nama_tempat WHERE id_jalan = '$id_Jalan' AND id_simpang_gang = '$id_Gang' AND aktif = 'Y'"; 
  }else{
  $query="SELECT id_nama_bangunan, nama_bangunan_tempat, nomor_rumah_bangunan FROM tbl_nama_tempat WHERE id_jalan = '$id_Jalan' AND aktif = 'Y'"; 
} 
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
$jumlahData=mysqli_num_rows($kerjakan);
if($jumlahData>0){
  $data['jumlahData']=$jumlahData;
  $dataSimpangGang=array();
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $dataNamaBangunan[]=$hasil;
  }
  $data['dataNamaBangunan']=$dataNamaBangunan;
}else{
  $data['jumlahData']=null;
  $data['dataNamaBangunan']=null;
}
echo json_encode($data);
break;
case 'loadLokasiVaksin':
$hasilLokasi=array();
$query="SELECT
id_lokasi_vaksin,
nama_lokasi
FROM
db_vaksin.tbl_lokasi_vaksin
WHERE
aktif = 'y' ORDER BY nama_lokasi ASC
";
$kerjakan=mysqli_query($koneksi,$query)or die(mysql_error($koneksi));
$jumlah=mysqli_num_rows($kerjakan);
if($jumlah){
  $data['jumlahLokasi']=$jumlah;
  while($hasil=mysqli_fetch_assoc($kerjakan)){
    $hasilLokasi[]=$hasil;
  }
}else{
  $data['jumlahLokasi']=null;
  $hasilLokasi[]=null;
}
$data['hasilLokasi']=$hasilLokasi;
echo json_encode($data);
break;
default:
echo 'Tidak ditemukan perintah yang tepat !';
break;
}
?>