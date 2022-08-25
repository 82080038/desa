<?php
date_default_timezone_set('Asia/Jakarta');
include '../../inc/koneksi.php';
// include '../../function/resizeImage.php';
$perintah = $_POST['perintah'];
$tanggal_sekarang=(date('Y-m-d H:i:s'));
// $noSuite[]='Tidak ditemukan perintah yang tepat';
$data=array();
switch ($perintah) {
	case 'loadDataJumlahAlamat':
	$data=array();
	$propinsi=mysqli_query($koneksi,"SELECT	COUNT(*) as jumlah_propinsi FROM tbl_propinsi");
	$kabupaten=mysqli_query($koneksi,"SELECT COUNT(*)as jumlah_kabupaten FROM tbl_kabupaten"); 
	$kecamatan=mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_kecamatan FROM tbl_kecamatan "); 
	$desa=mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_desa FROM tbl_desa "); 
	$dusun=mysqli_query($koneksi,"SELECT COUNT(*) as jumlah_dusun FROM tbl_dusun "); 
	// $dusun=mysqli_query($koneksi,"");
	$hasil_propinsi=mysqli_fetch_assoc($propinsi);
	$hasil_kabupaten=mysqli_fetch_assoc($kabupaten);
	$hasil_kecamatan=mysqli_fetch_assoc($kecamatan);
	$hasil_desa=mysqli_fetch_assoc($desa);
	$hasil_dusun=mysqli_fetch_assoc($dusun);
	$data +=$hasil_propinsi;
	$data +=$hasil_kabupaten;
	$data +=$hasil_kecamatan;
	$data +=$hasil_desa;
	$data +=$hasil_dusun;
	echo json_encode($data);
	break;
	case 'load_propinsi':
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		id_propinsi,
		nama_propinsi
		FROM
		tbl_propinsi
		Order By
		nama_propinsi");
	$jumlah=mysqli_num_rows($kerjakan);
	if($jumlah){
		while ($hasil=mysqli_fetch_assoc($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'load_kabupaten':
	$id_propinsi=$_POST['id_propinsi'];
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		id_kabupaten,
		nama_kabupaten
		FROM
		tbl_kabupaten
		WHERE
		id_propinsi = '$id_propinsi'
		Order By
		nama_kabupaten");
	$jumlah=mysqli_num_rows($kerjakan);
	if($jumlah){
		while ($hasil=mysqli_fetch_assoc($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'load_kecamatan':
	$id_kabupaten=$_POST['id_kabupaten'];
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		id_kecamatan,
		nama_kecamatan
		FROM
		tbl_kecamatan
		WHERE
		id_kabupaten = '$id_kabupaten'
		Order By
		nama_kecamatan");
	$jumlah=mysqli_num_rows($kerjakan);
	if($jumlah){
		while ($hasil=mysqli_fetch_assoc($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'load_desa':
	$id_kecamatan=$_POST['id_kecamatan'];
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		id_desa,
		nama_desa
		FROM
		tbl_desa
		WHERE
		id_kecamatan = '$id_kecamatan'
		Order By
		nama_desa");
	$jumlah=mysqli_num_rows($kerjakan);
	if($jumlah){
		while ($hasil=mysqli_fetch_assoc($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'load_dusun':
	$id_desa=$_POST['id_desa'];
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		id_dusun,
		nama_dusun,
		aktif
		FROM
		db_penduduk.tbl_dusun
		WHERE
		id_desa = '$id_desa'
		order by nama_dusun
		");
	$jumlah=mysqli_num_rows($kerjakan);
	if($jumlah){
		while ($hasil=mysqli_fetch_assoc($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'simpanDusun':
	// print_r($_POST);
	$hasil=array();
	$id_desa=$_POST['id_desa'];
	$namadusunBaru=strtoupper($_POST['namadusunBaru']);
	$cari_nama_dusun_duplikat=mysqli_query($koneksi,"SELECT
		nama_dusun,
		aktif
		FROM
		tbl_dusun
		WHERE
		id_desa = '$id_desa' AND
		nama_dusun = '$namadusunBaru'");
	$jumlah_duplikat=mysqli_num_rows($cari_nama_dusun_duplikat);
	if($jumlah_duplikat>0){
		while($status=mysqli_fetch_array($cari_nama_dusun_duplikat)){
			$hasil['status']=$status['aktif'];
			$hasil['pesan']='duplikat';
		}
	}else{
		$cari_nomor_Dusun_max=mysqli_query($koneksi, "SELECT
			COUNT(*) as banyaknya,
			MAX(id_dusun) as max_id_dusun
			FROM
			tbl_dusun
			WHERE
			id_desa = '$id_desa'
			");
		while($hasil_cari=mysqli_fetch_array($cari_nomor_Dusun_max)){
			$jumlah_cari=$hasil_cari['banyaknya'];
			if($jumlah_cari>0){
				$max_id_dusun=$hasil_cari['max_id_dusun'];
				$potong=substr($max_id_dusun,10);
				$tambahan=sprintf("%03d",$potong+1);
				$id_dusun_baru=$id_desa.$tambahan;
			}else{
				$bentukan_baru=sprintf("%03d",1);
				$id_dusun_baru=$id_desa.$bentukan_baru;
			}
		}
		$simpanDusun=mysqli_query($koneksi,"INSERT INTO tbl_dusun
			(id_dusun, id_desa, nama_dusun)
			VALUES
			('$id_dusun_baru', '$id_desa', '$namadusunBaru')")or die(mysql_error($koneksi));
		if($simpanDusun){
			$hasil['pesan']='ok';
		}else{
			$hasil['pesan']='gagal';
		}
	}
	echo json_encode($hasil);

	break;
	case 'load_data_jalan':
	print_r($_POST);
	break;
	//ALAMAT PENDUDUK AWAL
	case 'cariPendudukTanpaAlamat':
	$hasil=array();
	$cariTanpaDusun=mysqli_query($koneksi,"SELECT COUNT(*) as TanpaDusun FROM tbl_penduduk WHERE id_alamat_dusun IS NULL AND aktif = 'Y'");
$hasil_alamat_Dusun=mysqli_fetch_array($cariTanpaDusun);
$data['tanpaDusun']=number_format($hasil_alamat_Dusun['TanpaDusun']);
// $tanpaDusun=$tanpaDusun;
$data['nggakJelas']=100;
$hasil=$data;
echo json_encode($hasil);

		break;
	//ALAMAT PENDUDUK AKHIR
	default:
	echo json_encode('tidak ditemukan perintah yang tepat !');
	break;
}
?>