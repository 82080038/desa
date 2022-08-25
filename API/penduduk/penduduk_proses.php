<?php
date_default_timezone_set('Asia/Jakarta');
include '../../inc/koneksi.php';
// include '../../function/resizeImage.php';
$perintah = $_POST['perintah'];
$tanggal_sekarang=(date('Y-m-d H:i:s'));
// $noSuite[]='Tidak ditemukan perintah yang tepat';
$data=array();
switch ($perintah) {
	case 'loadDataPenduduk':
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
		nama_lengkap,
		tpt_lahir,
		tgl_lahir,
		umur, jk, status_kawin, alamat_jalan
		From
		tbl_penduduk
		Order By
		nama_lengkap
		LIMIT 0,100
		");
	// $jumlah=mysqli_num_rows($kerjakan);
	if(mysqli_num_rows($kerjakan)>0){
		while ($hasil=mysqli_fetch_array($kerjakan)) {
			$data[]=$hasil;
		}
	}
	else{
		$data=null;
	}
	echo json_encode($data);
	break;
	case 'loadJumlahPenduduk':
	$data=array();
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
	case 'load_nik_ganda':
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT id_orang, no_kk,nama_lengkap, nik,tpt_lahir, tgl_lahir,umur,alamat_jalan FROM `tbl_penduduk` WHERE nik IN(SELECT DISTINCT nik FROM tbl_penduduk GROUP BY nik HAVING COUNT(nik) > 1) ORDER BY nik, nama_lengkap");
	while ($hasil_kerjakan=mysqli_fetch_assoc($kerjakan)) {
		$data[]=$hasil_kerjakan;
	}
	echo json_encode($data);
	break;
	case 'load_tanpa_KK':
	$data=array();
	$kerjakan=mysqli_query($koneksi,"SELECT
    nik,
    id_orang,
    nama_lengkap,
    tpt_lahir,
    tgl_lahir,
    umur,
    jk,
    status_kawin,
    alamat_jalan
From
tbl_penduduk
    Where
    no_kk = ''
Group By
    nik,
    id_orang,
    nama_lengkap,
    tpt_lahir,
    tgl_lahir,
    umur,
    jk,
    status_kawin,
    alamat_jalan
Order By
    nama_lengkap,
    alamat_jalan,
    status_kawin");
	while ($hasil_kerjakan=mysqli_fetch_assoc($kerjakan)) {
		$data[]=$hasil_kerjakan;
	}
	echo json_encode($data);
	break;
	default:
	echo json_encode('tidak ditemukan perintah yang tepat !');
	break;
}
?>