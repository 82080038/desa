<?php
function ambilJumlahKeluarga($Kode_Keluarga){
  // include "../inc/koneksi.php";
  $query="SELECT
  Count(tbl_warga.id_warga) As jumlahWarga
  From
  tbl_warga
  Where
  tbl_warga.Kode_Keluarga = $Kode_Keluarga";
  $kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
  while ($hasil=mysqli_fetch_assoc($kerjakan)) {
    $jumlahWarga=$hasil['jumlahWarga'];
  }
  return $jumlahWarga;
}

function getNamaByNIK($nik){
	// include "koneksi.php";
	$nik=$nik;
	$query="SELECT id_orang, no_kk, nik, nama_lengkap, jk, tgl_lahir, tpt_lahir, umur, kawin, id_alamat, tulisan_alamat FROM tbl_dps WHERE nik ='$nik'"; 
	$kerjakan=mysqli_query($koneksi,$query)or die(mysqli_error($koneksi));
	$hasilData=array();
	$data_orang=array();
	$alamat=array();
	while($hasil=mysqli_fetch_assoc($kerjakan)){
		$hasilData[]=$hasil;
		// $alamat[]=json_decode($hasil['tulisan_alamat']);
		// array_push($alamat, $hasilData);
	}
	$data_orang['detil']=$hasilData;
	// $data_orang['detil']['alamat']=$alamat;
	return $data_orang;
}
function getAlamat($alamat){
	// include "koneksi.php";
	$id_alamat=$alamat;
	if($id_alamat){
		$pecahkanalamat=explode('.', $alamat);
		$arrayPropinsi=$pecahkanalamat[0];
		$arrayKabupaten=$pecahkanalamat[1];
		$arrayKecamatan=$pecahkanalamat[2];
		$arrayDesa=$pecahkanalamat[3];
		$arrayDusun=$pecahkanalamat[4];
		$result = array();
		$ambilPropinsi=mysqli_query($koneksi,"SELECT nama_propinsi FROM db_vaksin.tbl_propinsi WHERE id_propinsi = '$arrayPropinsi'") or die(mysqli_error($koneksi));
		$ambilKabupaten=mysqli_query($koneksi,"SELECT nama_kab_kota FROM db_vaksin.tbl_kabupaten WHERE id_kabupaten = '$arrayPropinsi.$arrayKabupaten'") or die(mysqli_error($koneksi)); 
		$ambilKecamatan=mysqli_query($koneksi,"SELECT nama_kecamatan FROM db_vaksin.tbl_kecamatan WHERE id_kecamatan = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan'") or die(mysqli_error($koneksi)); 
		$ambilDesa=mysqli_query($koneksi,"SELECT nama_desa FROM db_vaksin.tbl_desa_kel WHERE id_desa_kel = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan.$arrayDesa'") or die(mysqli_error($koneksi)); 
		$ambildusun=mysqli_query($koneksi,"SELECT nama_dusun FROM db_vaksin.tbl_dusun WHERE id_dusun = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan.$arrayDesa.$arrayDusun'") or die(mysqli_error($koneksi)); 
		while($hasilPropinsi=mysqli_fetch_array($ambilPropinsi)){
			$result['propinsi']="PROP.".$hasilPropinsi['nama_propinsi'];
		};
		while($hasilKabupaten=mysqli_fetch_array($ambilKabupaten)){
			$result['kabupaten']="KAB/KOTA.".$hasilKabupaten['nama_kab_kota'];
		};
		while($hasilKecamatan=mysqli_fetch_array($ambilKecamatan)){
			$result['kecamatan']="KEC.".$hasilKecamatan['nama_kecamatan'];
		};
		while($hasilDesa=mysqli_fetch_array($ambilDesa)){
			$result['desa']="KEL/DESA.".$hasilDesa['nama_desa'];
		};
		while($hasilDusun=mysqli_fetch_array($ambildusun)){
			$result['dusun']="DUSUN/LINK.".$hasilDusun['nama_dusun'];
		};
		$kalimat = implode(" ",$result);
		return $result;
	}else{
		return "tidak ada alamat";	
	}
}
function getAlamatKTP($NIK){
	// include "koneksi.php";
	$id_alamat=$NIK;
	$nik = preg_replace("/[^0-9]/", "", $NIK);
	$id_alamat=substr($nik,0,6);
	$result = array();
	if($id_alamat){
		$arrayPropinsi=substr($id_alamat, 0,2);
		$arrayKabupaten=substr($id_alamat, 2,2);
		$arrayKecamatan=substr($id_alamat, 4,2);
		$ambilPropinsi=mysqli_query($koneksi,"SELECT nama_propinsi FROM db_vaksin.tbl_propinsi WHERE id_propinsi = '$arrayPropinsi'") or die(mysqli_error($koneksi));
		$ambilKabupaten=mysqli_query($koneksi,"SELECT nama_kab_kota FROM db_vaksin.tbl_kabupaten WHERE id_kabupaten = '$arrayPropinsi.$arrayKabupaten'") or die(mysqli_error($koneksi)); 
		$ambilKecamatan=mysqli_query($koneksi,"SELECT nama_kecamatan FROM db_vaksin.tbl_kecamatan WHERE id_kecamatan = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan'") or die(mysqli_error($koneksi)); 
		// $ambilDesa=mysqli_query($koneksi,"SELECT nama_desa FROM db_vaksin.tbl_desa_kel WHERE id_desa_kel = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan.$arrayDesa'") or die(mysqli_error($koneksi)); 
		// $ambildusun=mysqli_query($koneksi,"SELECT nama_dusun FROM db_vaksin.tbl_dusun WHERE id_dusun = '$arrayPropinsi.$arrayKabupaten.$arrayKecamatan.$arrayDesa.$arrayDusun'") or die(mysqli_error($koneksi)); 
		while($hasilKecamatan=mysqli_fetch_array($ambilKecamatan)){
			$result['kecamatan']="KEC.".$hasilKecamatan['nama_kecamatan'].", ";
		};
		while($hasilKabupaten=mysqli_fetch_array($ambilKabupaten)){
			$result['kabupaten']=$hasilKabupaten['nama_kab_kota'].", ";
		};
		while($hasilPropinsi=mysqli_fetch_array($ambilPropinsi)){
			$result['propinsi']="PROP.".$hasilPropinsi['nama_propinsi'].".";
		};
		// while($hasilDesa=mysqli_fetch_array($ambilDesa)){
		// 	$result['desa']="KEL/DESA.".$hasilDesa['nama_desa'];
		// };
		// while($hasilDusun=mysqli_fetch_array($ambildusun)){
		// 	$result['dusun']="DUSUN/LINK.".$hasilDusun['nama_dusun'];
		// };
		// $kalimat = implode(" ",$result);
	}
	$satukan=strtoupper(implode("",$result));
	return $satukan;
}
function uraikanNIK($nik)
{
	$hasilPecahNIK=array();
	$nik = preg_replace("/[^0-9]/", "", $nik);
	$pecahkannik=substr($nik,6,6);
	$hari_lahir=substr($pecahkannik,0,2);
	if($hari_lahir>=40){
		$jk='P';
		$Hasil_hitung=$hari_lahir-40;
		if($Hasil_hitung==0){
			$hari_lahir='01';
		}else{
			$hari_lahir=$Hasil_hitung;
		}
	}else{
		$jk='L';
		$hari_lahir=$hari_lahir;
	}
	$hasilPecahNIK['jk']=$jk;
	$bulanLahir=substr($pecahkannik,2,2);
	$tahunLahir=substr($pecahkannik,4,2);
	$tahun_sekarang=date('y');
	if($tahun_sekarang<$tahunLahir){
		$tambahanTahun=intval("19".$tahunLahir);
	}else{
		$tambahanTahun=intval("20".$tahunLahir);
	}
	$tanggal_lahir=$tambahanTahun."-".$bulanLahir."-".sprintf("%02d", "$hari_lahir");
	$unixTimeSaatIni = time();
	$unixTimeTahunLahir= strtotime($tanggal_lahir);
	$unixTimeDalamSetahun = 31536000;
	$hitungUsia = ($unixTimeSaatIni - $unixTimeTahunLahir) / $unixTimeDalamSetahun;
	$usia=floor($hitungUsia);
	$hasilPecahNIK['tanggal_lahir']=$tanggal_lahir;
	$hasilPecahNIK['jk']=$jk;
	$hasilPecahNIK['usia']=$usia;
	return $hasilPecahNIK;
}
?>