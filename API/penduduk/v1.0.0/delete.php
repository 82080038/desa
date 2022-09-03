<?php
$perintah=$_GET['perintah'];
switch ($perintah) {
	case 'hapusSatuDusun':
	// print_r($_GET);
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
	case 'hapusDataWarga':
	// print_r($_GET);
	$id_warga=$_GET['id_warga'];
	$nomorKK=$_GET['nomorKK'];
	$query="DELETE
	FROM
	tbl_warga
	WHERE
	id_warga = '$id_warga'";
	$kerjakan=mysqli_query($koneksi,$query)or(die(mysqli_error($koneksi)));
	$hasilKerja=mysqli_affected_rows($koneksi);
	if($hasilKerja){
		$data['berhasilHapus']=true;
		$cariJumlahWarga="SELECT
		COUNT(*) as jumlahWarga
		FROM
		tbl_warga
		WHERE
		Kode_Keluarga = '$nomorKK'
		";
		$kerjakaJumlahWarga=mysqli_query($koneksi,$cariJumlahWarga)or die(mysqli_error($koneksi));
		while ($r=mysqli_fetch_assoc($kerjakaJumlahWarga)) {
			$jumlahWarga=$r['jumlahWarga'];
		}
		$data['jumlahKeluarga']=$jumlahWarga;
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