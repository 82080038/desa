<?php
require_once "../../inc/koneksi.php";
include "../../API/penduduk/v1.0.0/responcode.php";
$request_method=$_SERVER["REQUEST_METHOD"];
$server=$_SERVER['SERVER_NAME'];
$query=$_SERVER['QUERY_STRING'];
$r_time=$_SERVER['REQUEST_TIME'];
// $semua=$_SERVER;
$tanggalSekarang=date("Y-m-d H:i:s");
$data=array();
$data['jumlahData']=array();
$kodeRespon=http_response_code([0][0]);
$data['kodeRespon']=$kodeRespon;
$data['waktuProses']=array();
$data['method']=$request_method;
$data['server']=$server;
$data['query']=$query;
$data['r_time']=$r_time;
// $data['semua']=$semua;
$perintah=$_GET['perintah'];
$awal = microtime(true);
switch ($perintah) {
	case 'updateStatusKawin':
	$ambilTabelKawin="SELECT
	id_kawin,
	kawin
	FROM
	tbl_kawin";
	$kerjakanKawin=mysqli_query($koneksi,$ambilTabelKawin)or die(mysqli_error($koneksi));
	while ($r=mysqli_fetch_assoc($kerjakanKawin)) {
		$idKawin=$r['id_kawin'];
		$kawin=$r['kawin'];
		$updateStatusWarga="UPDATE
		tbl_warga
		SET
		Status = '$idKawin'
		WHERE
		Status = '$kawin'";
		$kerjakanUpdate=mysqli_query($koneksi,$updateStatusWarga)or die(mysqli_error($koneksi));
	}
	if($kerjakanUpdate){
		$hasil=mysqli_affected_rows($koneksi);
	}else{
		$hasil=mysqli_error($koneksi);
	}
	echo json_encode($hasil);
	break;
	case 'updategolonganDarah':
	$ambilTabeldarah="SELECT
	kodeGolDarah,
	GolDarah
	FROM
	tbl_gol_darah
	";
	$kerjakanDarah=mysqli_query($koneksi,$ambilTabeldarah)or die(mysqli_error($koneksi));
	while ($r=mysqli_fetch_assoc($kerjakanDarah)) {
		$kodeGolDarah=$r['kodeGolDarah'];
		$GolDarah=$r['GolDarah'];
		$updateStatusDarahWarga="UPDATE
		tbl_warga
		SET
		GDarah = '$kodeGolDarah'
		WHERE
		GDarah = '$GolDarah' AND GDarah !=''
		";
		$kerjakanUpdate=mysqli_query($koneksi,$updateStatusDarahWarga)or die(mysqli_error($koneksi));
	}
	if($kerjakanUpdate){
		$hasil=mysqli_affected_rows($koneksi);
	}else{
		$hasil=mysqli_error($koneksi);
	}
	echo json_encode($hasil);
	break;
	case 'updatePekerjaanWarga':
	$ambilseluruhPekerjaan="SELECT
	id_pekerjaan,
	namaPekerjaan
	FROM
	tbl_pekerjaan
	";
	$kerjakanPekerjaan=mysqli_query($koneksi,$ambilseluruhPekerjaan)or die(mysqli_error($koneksi));
	while ($r=mysqli_fetch_assoc($kerjakanPekerjaan)) {
		$id_pekerjaan=$r['id_pekerjaan'];
		$namaPekerjaan=$r['namaPekerjaan'];
		$updatePekerjaanWarga="UPDATE
		tbl_warga
		SET
		Pekerjaan = '$id_pekerjaan'
		WHERE
		Pekerjaan = '$namaPekerjaan'
		";
		$kerjakanUpdate=mysqli_query($koneksi,$updatePekerjaanWarga)or die(mysqli_error($koneksi));
	}
	if($kerjakanUpdate){
		$hasil=mysqli_affected_rows($koneksi);
	}else{
		$hasil=mysqli_error($koneksi);
	}
	echo json_encode($hasil);
	break;
	case 'loadAgama':
	$query="SELECT id_agama, agama FROM tbl_agama WHERE aktif = 'Y'"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilAgama[]=$hasil;
	}
	$data['CboAgama']=$hasilAgama;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadJenjangPendidikan':
	$query="SELECT
	id_pendidikan,
	jenjangPendidikan
	
FROM
	db_vaksin.tbl_pendidikan2
	ORDER BY kelompok
"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilPendidikan[]=$hasil;
	}
	$data['CboPendidikan']=$hasilPendidikan;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadPekerjaan':
	$query="SELECT id_pekerjaan, namaPekerjaan FROM tbl_pekerjaan WHERE aktif='Y'ORDER BY namaPekerjaan"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilPekerjaan[]=$hasil;
	}
	$data['pekerjaan']=$hasilPekerjaan;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadCboKawin':
	$query="SELECT id_kawin, kawin FROM tbl_kawin WHERE aktif = 'Y'"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilKawin[]=$hasil;
	}
	$data['Cbokawin']=$hasilKawin;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadGolDarah':
	$query="SELECT
	kodeGolDarah,
	GolDarah
	FROM
	tbl_gol_darah
	WHERE
	Aktif = 'Y'
	"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilDarah[]=$hasil;
	}
	$data['CboDarah']=$hasilDarah;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadCboHubunganKeluarga':
	$query="SELECT id_hub_keluarga, status_hub_keluarga, Keterangan_hubungan FROM tbl_hub_keluarga WHERE aktif = 'Y'"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilHubungan[]=$hasil;
	}
	$data['CboHubKeluarga']=$hasilHubungan;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'loadSuku':
	$query="SELECT
	id_suku,
	nama_suku
	FROM
	tbl_suku
	WHERE
	aktif = 'Y'
	ORDER BY nama_suku"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($kerjakan);
	while ($hasil=mysqli_fetch_assoc($kerjakan)) {
		$hasilSuku[]=$hasil;
	}
	$data['CboSuku']=$hasilSuku;
	$data['berhasil']=true;
	$data['jumlahData']=$jumlahData;
	echo json_encode($data);
	break;
	case 'updateDataPendidikanWarga':
	$jenisPendidikan=array();
	$ambilDataDariWarga=mysqli_query($koneksi,"SELECT DISTINCT Pendidikan FROM tbl_warga
		WHERE Pendidikan NOT IN(SELECT
			JenjangPendidikan
			FROM
			db_vaksin.tbl_pendidikan)
		")or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($ambilDataDariWarga);
	while ($r=mysqli_fetch_array($ambilDataDariWarga)) {
		$namaPendidikan=$r['Pendidikan'];
		$jenisPendidikan[]=$namaPendidikan;
		mysqli_query($koneksi, "INSERT INTO tbl_pendidikan2
			(jenjangPendidikan, aktif)
			VALUES
			('$namaPendidikan', 'Y')")OR die(mysqli_error($koneksi));
	}
	$akhir = microtime(true);
	$lama = $akhir - $awal;
	$data['tanggal']=$tanggalSekarang;
	$data['waktuProses']=$lama;
	$data['jumlahData']=$jumlahData;
	$data['pendidikan']=$jenisPendidikan;
	echo json_encode($data);
	break;
	case 'updateIdPendidikanWarga':
	$jenjangPendidikan=array();
	$ambilDataDariWarga=mysqli_query($koneksi,"SELECT id_pendidikan,jenjangPendidikan FROM tbl_pendidikan2")or die(mysqli_error($koneksi));
	$jumlahData=mysqli_num_rows($ambilDataDariWarga);
	while ($r=mysqli_fetch_array($ambilDataDariWarga)) {
		$id_pendidikan=$r['id_pendidikan'];
		$jenjangPendidikan=$r['jenjangPendidikan'];
		// $jenisPendidikan[]=$namaPendidikan;
		mysqli_query($koneksi, "UPDATE
			db_vaksin.tbl_warga
			SET
			Pendidikan = '$id_pendidikan'
			WHERE
			Pendidikan = '$jenjangPendidikan'")OR die(mysqli_error($koneksi));
	}
	$akhir = microtime(true);
	$lama = $akhir - $awal;
	$data['tanggal']=$tanggalSekarang;
	$data['waktuProses']=$lama;
	$data['jumlahData']=$jumlahData;
	$data['pendidikan']=$jenjangPendidikan;
	echo json_encode($data);
	break;
	default:
	$data['jumlahData']=null;
	$data['berhasil']=false;
	$data['perintah']="Tidak ditemukan perintah yang tepat !";
	echo json_encode($data);
	break;
}
?>