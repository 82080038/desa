<?php
$perintah=$_GET['perintah'];
switch ($perintah) {
	case 'UpdateDusun':
	$id_desa=$_GET['id_desa'];
	$idusunUpdate=$_GET['idusunUpdate'];
	$id_desa=$_GET['id_desa'];
	$namaDusunBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_GET['namaDusunBaru'])));
	$data['namaDusunBaru']=$namaDusunBaru;
	$queryDuplikat="SELECT id_dusun From tbl_dusun Where id_desa = '$id_desa' And nama_dusun = '$namaDusunBaru'"; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi))); 
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE `tbl_dusun` SET `nama_dusun`='$namaDusunBaru' WHERE `id_dusun`='$idusunUpdate'"; 
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
	case 'UpdateJalan':
	$idJalanUpdate=$_GET['idJalanUpdate'];
	$namaJalanBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_GET['namaJalanBaru'])));
	$id_type_jalan=$_GET['id_type_jalan'];
	$id_dusun=$_GET['ValueDusunTerpilih'];
	$queryDuplikat="SELECT id_jalan FROM tbl_jalan WHERE id_rt_rw_dusun = '$id_dusun' AND nama_jalan = '$namaJalanBaru' AND type_adm = '$id_type_jalan'"; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi)));
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE
		tbl_jalan
		SET
		type_adm = '$id_type_jalan',
		nama_jalan = '$namaJalanBaru'
		WHERE
		id_jalan = '$idJalanUpdate'"; 
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
	case 'UpdateSimpangGangBaru':
	$IdSimpangGangUpdate=$_GET['IdSimpangGangUpdate'];
	$IdJalanTerpilih=$_GET['IdJalanTerpilih'];
	$NamaSimpangGangBaru=trim(mysqli_real_escape_string($koneksi,$_GET['NamaSimpangGangBaru']));
	// $id_dusun=$_GET['ValueDusunTerpilih'];
	$queryDuplikat="SELECT
	id_simpang_gang
	FROM
	tbl_simpang_gang
	WHERE
	id_jalan = '$IdJalanTerpilih' AND
	nama_simpang_gang = '$NamaSimpangGangBaru'"; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi)));
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE
		tbl_simpang_gang
		SET
		id_jalan = '$IdJalanTerpilih',
		nama_simpang_gang = '$NamaSimpangGangBaru'
		WHERE
		id_simpang_gang = '$IdSimpangGangUpdate'"; 
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
	case 'UpdateJalan':
	$idJalanUpdate=$_GET['idJalanUpdate'];
	$namaJalanBaru=strtoupper(trim(mysqli_real_escape_string($koneksi,$_GET['namaJalanBaru'])));
	$id_type_jalan=$_GET['id_type_jalan'];
	$id_dusun=$_GET['ValueDusunTerpilih'];
	$queryDuplikat="SELECT id_jalan FROM tbl_jalan WHERE id_rt_rw_dusun = '$id_dusun' AND nama_jalan = '$namaJalanBaru' AND type_adm = '$id_type_jalan'"; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi)));
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE
		tbl_jalan
		SET
		type_adm = '$id_type_jalan',
		nama_jalan = '$namaJalanBaru'
		WHERE
		id_jalan = '$idJalanUpdate'"; 
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
	case 'UpdateNamaBangunanBaru':

	$IdNamaBangunanUpdate=$_GET['IdNamaBangunanUpdate'];
	$IdJalanTerpilih=$_GET['IdJalanTerpilih'];
	$IdSimpangTerpilih=$_GET['IdSimpangTerpilih'];
	$NamaBangunanBaru=trim(mysqli_real_escape_string($koneksi,$_GET['NamaBangunanBaru']));
	if($IdSimpangTerpilih){
		$tambahanWhere="AND	id_simpang_gang = '$IdSimpangTerpilih'";
	}else{
		$tambahanWhere="";
	}
	$queryDuplikat="SELECT
	nama_bangunan_tempat
	FROM
	tbl_nama_tempat
	WHERE
	id_jalan = '$IdJalanTerpilih' AND
	nama_bangunan_tempat = '$NamaBangunanBaru'".$tambahanWhere; 
	$kerjakanQueryDuplikat=mysqli_query($koneksi,$queryDuplikat)or(die(mysqli_error($koneksi)));
	$jumlah_Duplikat=mysqli_num_rows($kerjakanQueryDuplikat);
	$data['jumlah_Duplikat']=$jumlah_Duplikat;
	$data['NamaBangunanBaru']=$NamaBangunanBaru;
	if($jumlah_Duplikat>0){
		$data['berhasilUpdate']=false;
		$data['duplikat']=true;
	}else{
		$queryUpdate="UPDATE
		tbl_nama_tempat
		SET
		nama_bangunan_tempat = '$NamaBangunanBaru'
		WHERE
		id_nama_bangunan = '$IdNamaBangunanUpdate'"; 
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
	default:
	echo 'Tidak ditemukan perintah yang tepat !';
	break;
}
?>