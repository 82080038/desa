<?php
// KE DEPANNYA, PERIKSA APABILA MASIH ADA DATA WARGA YANG MENGGUNAKAN NAMA DUSUN INI
$perintah=$_GET['perintah'];
switch ($perintah) {
	case 'hapusSatuDusun':
	$id_dusun=$_GET['id_dusun'];
	$query="DELETE FROM `tbl_dusun` WHERE `id_dusun`='$id_dusun'";
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	case 'hapusSatuJalan':
	$IdJalan=$_GET['IdJalan'];
	$query="DELETE FROM tbl_jalan WHERE id_jalan = '$IdJalan'"; 
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	case 'hapusSatuGang':
	$IdGang=$_GET['IdGang'];
	$query="DELETE
	FROM
	tbl_simpang_gang
	WHERE
	id_simpang_gang = '$IdGang'";
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	case 'hapusSatuJalan':
	$IdJalan=$_GET['IdJalan'];
	$query="DELETE FROM tbl_jalan WHERE id_jalan = '$IdJalan'"; 
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	case 'hapusSatuBangunan':
	$idBangunan=$_GET['IdBangunanTerpilih'];
	$query="DELETE
	FROM
	tbl_nama_tempat
	WHERE
	id_nama_bangunan = '$idBangunan'";
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	case 'hapusSatuJalan':
	$IdJalan=$_GET['IdJalan'];
	$query="DELETE FROM tbl_jalan WHERE id_jalan = '$IdJalan'"; 
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
	}else{
		$data['berhasilHapus']=false;
	}
	echo json_encode($data);
	break;
	default:
	echo 'Tidak ditemukan perintah yang tepat !';
	break;
}
?>