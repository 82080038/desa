<?php
$perintah=$_POST['perintah'];
switch ($perintah) {
  case 'SimpanDusunBaru':
  $id_desa=$_POST['id_desa'];
  $maksimal='';
  $namaDusunBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_POST['namaDusunBaru'])));
  $periksaJumlahDusun="SELECT * FROM `tbl_dusun` WHERE `id_desa`='$id_desa'"; 
  $periksaDuplikat="SELECT * FROM `tbl_dusun` WHERE `id_desa`='$id_desa' AND `nama_dusun`='$namaDusunBaru'";
  $periksaIDmaksimal="SELECT MAX(`id_dusun`) as maks FROM `tbl_dusun` WHERE `id_desa`='$id_desa'";
  $kerjakanPeriksaJumlahDusun=mysqli_query($koneksi,$periksaJumlahDusun) or die (mysqli_error($koneksi));
  $kerjakanPeriksaDuplikatDusun=mysqli_query($koneksi,$periksaDuplikat) or die (mysqli_error($koneksi));
  $kerjakanMaksimald=mysqli_query($koneksi,$periksaIDmaksimal) or die (mysqli_error($koneksi));
  while ($nilaiMaksimal=mysqli_fetch_assoc($kerjakanMaksimald)) {
    $maksimal=intval(trim($nilaiMaksimal['maks']));
  }
  $jumlah_dusun=mysqli_num_rows($kerjakanPeriksaJumlahDusun);
  $jumlah_Duplikat=mysqli_num_rows($kerjakanPeriksaDuplikatDusun);
  if($jumlah_Duplikat<1){
    $data['duplikat']=false;
    $tambahanDusun=$jumlah_dusun+1;
    $IDHanyadusunBaru=sprintf("%02d", "$tambahanDusun"); 
    $idDusunBaru=$id_desa.".".$IDHanyadusunBaru;
    $data['idDusunBaru']=$idDusunBaru;
    $data['jumlah_dusun']=$jumlah_dusun;
    $data['jumlah_Duplikat']=$jumlah_Duplikat;
    $data['namaDusunBaru']=$namaDusunBaru;
    $querySimpan="INSERT INTO `tbl_dusun`(`id_dusun`, `id_desa`, `nama_dusun`,`aktif`) VALUES ('$idDusunBaru','$id_desa','$namaDusunBaru','Y')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['berhasilSimpan']=true;
    }else{
      $data['berhasilSimpan']=false;
      $data['kesalahan']=true;
    }
  }else{
    $data['berhasilSimpan']=false;
    $data['idDusunBaru']=null;
    $data['duplikat']=true;
    $data['namaDusunBaru']=$namaDusunBaru;
  }
  echo json_encode($data);
  break;
  case 'SimpanJalanBaru':
  $idDusun=$_POST['ValueDusunTerpilih'];
  $namaJalanBaru=trim(mysqli_real_escape_string($koneksi,$_POST['namaJalanBaru']));
  $id_type_jalan=$_POST['id_type_jalan'];
  $maksimal='';
  $periksaJumlahJalan="SELECT * FROM `tbl_jalan` WHERE `id_rt_rw_dusun`='$idDusun'"; 
  $periksaDuplikat="SELECT * FROM `tbl_jalan` WHERE `id_rt_rw_dusun`='$idDusun' AND `nama_jalan`='$namaJalanBaru'";
  $periksaIDmaksimal="SELECT MAX(`id_jalan`) as maks FROM `tbl_jalan` WHERE `id_rt_rw_dusun`='$idDusun'";
  $KerjakanPeriksaJumlahJalan=mysqli_query($koneksi,$periksaJumlahJalan) or die (mysqli_error($koneksi));
  $kerjakanPeriksaDuplikatJalan=mysqli_query($koneksi,$periksaDuplikat) or die (mysqli_error($koneksi));
  $kerjakanMaksimald=mysqli_query($koneksi,$periksaIDmaksimal) or die (mysqli_error($koneksi));
  while ($nilaiMaksimal=mysqli_fetch_assoc($kerjakanMaksimald)) {
    $maksimal=intval(trim($nilaiMaksimal['maks']));
  }
  $jumlah_Jalan=mysqli_num_rows($KerjakanPeriksaJumlahJalan);
  $jumlah_Duplikat=mysqli_num_rows($kerjakanPeriksaDuplikatJalan);
  if($jumlah_Duplikat<1){
    $data['duplikat']=false;
    $tambahanJalan=$jumlah_Jalan+1;
    $IdHanyaJalanBaru=sprintf("%02d", "$tambahanJalan"); 
    $idJalanBaru=$idDusun.".".$IdHanyaJalanBaru;
    $data['idJalanBaru']=$idJalanBaru;
    $data['jumlah_Jalan']=$jumlah_Jalan;
    $data['jumlah_Duplikat']=$jumlah_Duplikat;
    $data['namaJalanBaru']=$namaJalanBaru;
    
    $querySimpan="INSERT INTO tbl_jalan
    (id_jalan, type_adm, id_rt_rw_dusun, nama_jalan, aktif) VALUES ('$idJalanBaru','$id_type_jalan','$idDusun','$namaJalanBaru','Y')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['berhasilSimpan']=true;
    }else{
      $data['berhasilSimpan']=false;
      $data['kesalahan']=true;
    }
  }else{
    $data['berhasilSimpan']=false;
    $data['idJalanBaru']=null;
    $data['duplikat']=true;
    $data['namaJalanBaru']=$namaJalanBaru;
  }
  echo json_encode($data);
  break;
  case 'SimpanSimpangGangBaru':
  $IdJalanTerpilih=$_POST['IdJalanTerpilih'];
  $NamaSimpangGangBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_POST['NamaSimpangGangBaru'])));
 
  $maksimal='';
  $periksaJumlahGang="SELECT id_simpang_gang FROM tbl_simpang_gang WHERE id_jalan = '$IdJalanTerpilih'"; 
  $periksaDuplikatGang="SELECT id_simpang_gang FROM tbl_simpang_gang WHERE id_jalan = '$IdJalanTerpilih' AND nama_simpang_gang = '$NamaSimpangGangBaru'";
  $periksaIDmaksimal="SELECT MAX(id_simpang_gang)as maks FROM tbl_simpang_gang WHERE id_jalan = '$IdJalanTerpilih'";
  $KerjakanPeriksaJumlahGang=mysqli_query($koneksi,$periksaJumlahGang) or die (mysqli_error($koneksi));
  $kerjakanPeriksaDuplikatGang=mysqli_query($koneksi,$periksaDuplikatGang) or die (mysqli_error($koneksi));
  $kerjakanMaksimald=mysqli_query($koneksi,$periksaIDmaksimal) or die (mysqli_error($koneksi));
  while ($nilaiMaksimal=mysqli_fetch_assoc($kerjakanMaksimald)) {
    $maksimal=intval(trim($nilaiMaksimal['maks']));
  }
  $jumlahGang=mysqli_num_rows($KerjakanPeriksaJumlahGang);
  $jumlah_Duplikat=mysqli_num_rows($kerjakanPeriksaDuplikatGang);
  if($jumlah_Duplikat<1){
    $data['duplikat']=false;
    $tambahanGang=$jumlahGang+1;
    $IdHanyaGangBaru=sprintf("%02d", "$tambahanGang"); 
    $idGangBaru=$IdJalanTerpilih.".".$IdHanyaGangBaru;
    $data['idGangBaru']=$idGangBaru;
    $data['jumlah_Gang']=$jumlahGang;
    $data['jumlah_Duplikat']=$jumlah_Duplikat;
    $data['namaGangBaru']=$NamaSimpangGangBaru;
    $querySimpan="INSERT INTO tbl_simpang_gang
    (id_simpang_gang, id_jalan, nama_simpang_gang, aktif)
    VALUES
    ('$idGangBaru', '$IdJalanTerpilih', '$NamaSimpangGangBaru', 'Y')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['berhasilSimpan']=true;
    }else{
      $data['berhasilSimpan']=false;
      $data['kesalahan']=true;
    }
  }else{
    $data['berhasilSimpan']=false;
    $data['idJalanBaru']=null;
    $data['duplikat']=true;
    $data['namaGangBaru']=$NamaSimpangGangBaru;
  }
  echo json_encode($data);
  break;

  case 'SimpanNamaBangunanBaru':
  $IdJalanTerpilih=$_POST['IdJalanTerpilih'];
  $IdSimpangTerpilih=$_POST['IdSimpangTerpilih'];
  if($IdSimpangTerpilih !==''){
   
    $Id_simpang=$IdSimpangTerpilih;
    $tambahanWhere="AND id_simpang_gang = '$Id_simpang'";
    $ambilAkhiranSimpang=substr($Id_simpang, strrpos($Id_simpang, '.') + 1);
  }else{
    $Id_simpang='';
    $ambilAkhiranSimpang='00';
    
    $tambahanWhere="";
    
  }
  $NamaBangunanBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_POST['NamaBangunanBaru'])));
  $maksimal='';
  $periksaJumlahBangunan="SELECT id_nama_bangunan FROM tbl_nama_tempat WHERE id_jalan = '$IdJalanTerpilih'".$tambahanWhere; 
  $periksaDuplikatBangunan="SELECT
  nama_bangunan_tempat
FROM
  tbl_nama_tempat
WHERE
  id_jalan = '$IdJalanTerpilih' AND
  
  nama_bangunan_tempat = '$NamaBangunanBaru'

  ".$tambahanWhere;

  $ambilAkhiranJalan=substr($IdJalanTerpilih, strrpos($IdJalanTerpilih, '.') + 1);
  
  $periksaIDmaksimal="SELECT MAX(id_nama_bangunan) as maks FROM db_vaksin.tbl_nama_tempat WHERE id_jalan = '$IdJalanTerpilih'".$tambahanWhere;
  $KerjakanPeriksaJumlahBangunan=mysqli_query($koneksi,$periksaJumlahBangunan) or die (mysqli_error($koneksi));
  $kerjakanPeriksaDuplikatBangunan=mysqli_query($koneksi,$periksaDuplikatBangunan) or die (mysqli_error($koneksi));
  $kerjakanMaksimald=mysqli_query($koneksi,$periksaIDmaksimal) or die (mysqli_error($koneksi));
  while ($nilaiMaksimal=mysqli_fetch_assoc($kerjakanMaksimald)) {
    $maksimal=intval(trim($nilaiMaksimal['maks']));
  }
  $jumlahBangunan=mysqli_num_rows($KerjakanPeriksaJumlahBangunan);
  $jumlah_Duplikat=mysqli_num_rows($kerjakanPeriksaDuplikatBangunan);
  if($jumlah_Duplikat<1){
    $data['duplikat']=false;
    $tambahanBangunan=$jumlahBangunan+1;
    $IdHanyaBangunanBaru=sprintf("%02d", "$tambahanBangunan"); 
    $idBangunanBaru=$IdJalanTerpilih.".".$ambilAkhiranSimpang.".".$IdHanyaBangunanBaru;
    $data['idBangunanBaru']=$idBangunanBaru;
    $data['jumlahBangunan']=$jumlahBangunan;
    $data['jumlah_Duplikat']=$jumlah_Duplikat;
    $data['NamaBangunanBaru']=$NamaBangunanBaru;
    $querySimpan="INSERT INTO tbl_nama_tempat
    (id_nama_bangunan, id_jalan, id_simpang_gang, nama_bangunan_tempat, aktif)
    VALUES
    ('$idBangunanBaru', '$IdJalanTerpilih', '$Id_simpang', '$NamaBangunanBaru', 'Y')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($kerjakanSimpan){
      $data['berhasilSimpan']=true;
      $data['idBangunanBaru']=$idBangunanBaru;
      $data['NamaBangunanBaru']=$NamaBangunanBaru;
    }else{
      $data['berhasilSimpan']=false;
      $data['kesalahan']=true;
    }
  }else{
    $data['berhasilSimpan']=false;
    $data['idJalanBaru']=null;
    $data['duplikat']=true;
    $data['NamaBangunanBaru']=$NamaBangunanBaru;
  }
  echo json_encode($data);
  break;
  case 'loadJumlahPenduduk':
  $kerjakan=mysqli_query($koneksi,"SELECT count(*) From tbl_penduduk "); 
  $cariTanpaKK=mysqli_query($koneksi,"SELECT count(no_kk) From tbl_penduduk where no_kk='' ");
  $cariTanpaNIK=mysqli_query($koneksi,"SELECT count(nik) From tbl_penduduk where nik='' ");
  // $cariNIKganda=mysqli_query($koneksi,"SELECT COUNT(nik) duplikat FROM tbl_penduduk GROUP BY nik HAVING COUNT(duplikat) > 1");
  // $cariNIKganda=mysqli_query($koneksi,"SELECT nik, COUNT(nik) duplikat FROM tbl_penduduk GROUP BY nik HAVING duplikat");
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
  // SELECT nik, COUNT(*) duplikat FROM tb_anggota GROUP BY nik HAVING COUNT(duplikat) > 1
  $hasilJumlahData=mysqli_fetch_array($kerjakan);
  $hasilTanpaKK=mysqli_fetch_array($cariTanpaKK);
  $hasilTanpaNIK=mysqli_fetch_array($cariTanpaNIK);
  $hasilCariNIKganda=mysqli_fetch_assoc($cariNIKganda);
  $hasilDisabilitas=mysqli_fetch_assoc($cariDisabilitas);
  $hasilJumlahTPS=mysqli_fetch_assoc($cariJumlahTPS);
  $jumlahBarisNIKGanda=mysqli_num_rows($cariNIKganda);
  $data['jumlahData']=$hasilJumlahData['0'];
  $data['tanpaKK']=$hasilTanpaKK['0'];
  $data['tanpaNIK']=$hasilTanpaNIK['0'];
  $data['NIKganda']=$jumlahBarisNIKGanda;
  $data['disabilitas']=$hasilDisabilitas['disabilitas'];
  // $data['JumlaTPS']=$hasilJumlahTPS;
  $data['JumlaTPS']=$hasilJumlahTPS['Count_tps'];
  // $data['jumlahBarisNIKGanda']=$jumlahBarisNIKGanda;
  echo json_encode($data);
  break;
  case'simpanLokasiVaksinBaru':
  $namaLokasiBaru=addslashes(trim($_POST['namaLokasiBaru']));
  $queryPeriksa="SELECT * FROM tbl_lokasi_vaksin WHERE nama_lokasi ='$namaLokasiBaru'";
  $kerjakanPeriksa=mysqli_query($koneksi,$queryPeriksa)or die(mysqli_error($koneksi));
  $queryJumlahPeriksa=mysqli_num_rows($kerjakanPeriksa);
  if($queryJumlahPeriksa>0){
    $data['dataGanda']=true;
    $data['kerjakanSimpan']='Gagal';
    $data['alasanGagal']='Data Ganda';
    $data['jumlahSukses']=null;
  }else{
    $data['dataGanda']=false;
    $querySimpan="INSERT INTO tbl_lokasi_vaksin (`nama_lokasi`) VALUES ('$namaLokasiBaru')";
    $kerjakanSimpan=mysqli_query($koneksi,$querySimpan)or die(mysqli_error($koneksi));
    if($querySimpan){
      $data['kerjakanSimpan']='sukses';
      $data['jumlahSukses']=1;
    }else{
      $data['kerjakanSimpan']='Gagal';
      $data['alasanGagal']='Error Query';
      $data['jumlahSukses']=null;
    }
  }
  echo json_encode($data);
  break;
  default:
  echo 'Tidak ditemukan perintah yang tepat !';
  break;
}
?>