<?php
$perintah=$_GET['perintah'];
switch ($perintah) {
	case 'UpdateDataWarga':
	
	$id_warga=$_GET['id_warga'];
	$nikKepalaKeluarga=$_GET['nikKepalaKeluarga'];
	$namaKepalaKeluarga=$_GET['namaKepalaKeluarga'];
	$nikWarga=$_GET['nikWarga'];
	$namaWarga=$_GET['namaWarga'];
	$jkWarga=$_GET['jkWarga'];
	$jenisHubunganKeluargaWarga=$_GET['jenisHubunganKeluargaWarga'];
	$Tempat_Lahir=$_GET['Tempat_Lahir'];
	$tanggalLahir=$_GET['tanggalLahir'];
	$umur=$_GET['umur'];
	$statusKawin=$_GET['statusKawin'];
	$agama=$_GET['agama'];
	$golDarah=$_GET['golDarah'];
	$suku=$_GET['suku'];
	$pendidikan=$_GET['pendidikan'];
	$pekerjaan=$_GET['pekerjaan'];
	$Kewarganegaraan=$_GET['Kewarganegaraan'];
	$propinsi=$_GET['propinsi'];
	$kabupaten=$_GET['kabupaten'];
	$kecamatan=$_GET['kecamatan'];
	$desa=$_GET['desa'];
	$dusun=$_GET['dusun'];
	$alamat=$_GET['alamat'];
	$HP=$_GET['HP'];
	$pecahkan = explode('/', $tanggalLahir);
	$tanggal_lahir_db="$pecahkan[2]-$pecahkan[1]-$pecahkan[0]";
	$query="UPDATE
	tbl_warga
	SET
	id_desa = '$desa',
	Dusun = '$dusun',
	Alamat = '$alamat',
	Kode_Keluarga = '$nikKepalaKeluarga',
	Nama_Kepala_Keluarga = '$namaKepalaKeluarga',
	NIK = '$nikWarga',
	Nama_Anggota_Keluarga = '$namaWarga',
	Jenis_Kelamin = '$jkWarga',
	Hubungan = '$jenisHubunganKeluargaWarga',
	Tempat_Lahir = '$Tempat_Lahir',
	Tanggal_Lahir = '$tanggal_lahir_db',
	Usia = '$umur',
	Status = '$statusKawin',
	Agama = '$agama',
	GDarah = '$golDarah',
	Kewarganegaraan = '$Kewarganegaraan',
	Etnis_Suku = '$suku',
	Pendidikan = '$pendidikan',
	Pekerjaan = '$pekerjaan',
	no_HP = '$HP'
	WHERE
	id_warga = '$id_warga'
	";
$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
if($kerjakan){
	$hasil='berhasil';
}else{
	$hasil='gagal';
}
echo json_encode($hasil);

	break;
	case 'UpdateDusun':
	$id_desa=$_GET['id_desa'];
	$idusunUpdate=$_GET['idusunUpdate'];
	$id_desa=$_GET['id_desa'];
	$namaDusunBaru=strtoupper($_GET['namaDusunBaru']);
	$data['namaDusunBaru']=$namaDusunBaru;
	$queryDuplikat="SELECT id_dusun From tbl_dusun Where id_desa = '$id_desa' And nama_dusun = '$namaDusunBaru'"; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi))); 
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE `tbl_dusun` SET `id_desa`='$id_desa',`nama_dusun`='$namaDusunBaru' WHERE `id_dusun`='$idusunUpdate'"; 
		$kerjakanUdate=mysqli_query($koneksi,$queryUpdate)or(die(mysqli_error($koneksi)));
		if($kerjakanUdate){
			$data['berhasilUpdate']=true;
		}else{
			$data['berhasilUpdate']=false;
		}
		$data['duplikat']=false;
	}
	echo json_encode($data);
	break;
	case'perbaikiKabupaten':
	var_dump($_POST);
	break;
	default:
	echo 'Tidak ditemukan perintah yang tepat !';
	break;
}
?>