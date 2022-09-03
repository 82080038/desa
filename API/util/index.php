<?php
include 'koneksi.php';
//masukkan data ini ke dalam database
//  $dataSPekerjaan=array(
// "Belum/ Tidak Bekerja",
// "Mengurus Rumah Tangga",
// "Pelajar/ Mahasiswa",
// "Pensiunan",
// "Pewagai Negeri Sipil",
// "Tentara Nasional Indonesia",
// "Kepolisisan RI",
// "Perdagangan",
// "Petani/ Pekebun",
// "Peternak",
// "Nelayan/ Perikanan",
// "Industri",
// "Konstruksi",
// "Transportasi",
// "Karyawan Swasta",
// "Karyawan BUMN",
// "Karyawan BUMD",
// "Karyawan Honorer",
// "Buruh Harian Lepas",
// "Buruh Tani/ Perkebunan",
// "Buruh Nelayan/ Perikanan",
// "Buruh Peternakan",
// "Pembantu Rumah Tangga",
// "Tukang Cukur",
// "Tukang Listrik",
// "Tukang Batu",
// "Tukang Kayu",
// "Tukang Sol Sepatu",
// "Tukang Las/ Pandai Besi",
// "Tukang Jahit",
// "Tukang Gigi",
// "Penata Rias",
// "Penata Busana",
// "Penata Rambut",
// "Mekanik",
// "Seniman",
// "Tabib",
// "Paraji",
// "Perancang Busana",
// "Penterjemah",
// "Imam Masjid",
// "Pendeta",
// "Pastor",
// "Wartawan",
// "Ustadz/ Mubaligh",
// "Juru Masak",
// "Promotor Acara",
// "Anggota DPR-RI",
// "Anggota DPD",
// "Anggota BPK",
// "Presiden",
// "Wakil Presiden",
// "Anggota Mahkamah Konstitusi",
// "Anggota Kabinet/ Kementerian",
// "Duta Besar",
// "Gubernur",
// "Wakil Gubernur",
// "Bupati",
// "Wakil Bupati",
// "Walikota",
// "Wakil Walikota",
// "Anggota DPRD Provinsi",
// "Anggota DPRD Kabupaten/ Kota",
// "Dosen",
// "Guru",
// "Pilot",
// "Pengacara",
// "Notaris",
// "Arsitek",
// "Akuntan",
// "Konsultan",
// "Dokter",
// "Bidan",
// "Perawat",
// "Apoteker",
// "Psikiater/ Psikolog",
// "Penyiar Televisi",
// "Penyiar Radio",
// "Pelaut",
// "Peneliti",
// "Sopir",
// "Pialang",
// "Paranormal",
// "Pedagang",
// "Perangkat Desa",
// "Kepala Desa",
// "Biarawati",
// "Wiraswasta"
//  );

 $datasKawin=array(
"Belum kawin",
"Kawin (Tercatat)",
"Kawin (Belum Tercatat)",
"Cerai hidup",
"Cerai mati"
 );

 $dataHubKeluarga=array(
array("Suami","Suami dari kepala keluarga"),
array("Istri","Istri dari kepala keluarga"),
array("Anak","Mencakup anak kandung, anak tiri, atau anak angkat dari kepala keluarga."),
array("Menantu","suami atau istri dari anak kandung, anak tiri, atau anak angkat"),
array("Cucu","Anak dari anak kandung, anak tiri, atau anak angkat"),
array("Orang Tua","Ayah atau ibu dari kepala keluarga"),
array("Mertua","Orang tua dari suami atau istri kepala keluarga"),
array("Famili Lain","Mereka yang ada hubungan famili dengan kepala keluarga atau dengan suami/istri kepala keluarga, misalnya adik, kakak, bibi, paman, kakek, atau nenek"),
array("Pembantu","Orang yang bekerja sebagai pembantu/sopir yang menginap di keluarga tersebut dengan menerima upah/gaji baik berupa uang ataupun barang. Yang termasuk pembantu: Sopir, Anak Pembantu, Tukang Kebun")

 );

$dataHubKeluarga2=array(
01 : Kepala Keluarga
02 : Suami
03 : Istri
04 : Anak
05 : Menantu
06 : Cucu
07 : Orangtua
08 : Mertua
09 : Famili Lain
10 : Pembantu
11 : Lainnya

);
 $dataJenjangPendidikan=array(

array("01","Tidak / Belum Sekolah"),
array("02","Belum Tamat SD/Sederajat"),
array("03","Tamat SD / Sederajat"),
array("04","SLTP / Sederajat"),
array("05","SLTA / Sederajat"),
array("06","Diploma I / II"),
array("07","Akademi / Diploma III / Sarjana Muda"),
array("08","Diploma IV / Sastra I"),
array("09","Sastra II"),
array("10","Sastra III")

 );

 01 : A
02 : B
03 : AB
04 : O
05 : A+
06 : B+ 
$jumlahSimpan=0;
 // foreach($dataSPekerjaan as $data) {
 foreach($dataJenjangPendidikan as $data) {
// $perintahSimpan="INSERT INTO `tbl_pekerjaan`(`id_pekerjaan`, `namaPekerjaan`, `aktif`) VALUES (null,'$data','Y')"; 
$dataKode=$data[0];
$dataJenjang=$data[1];
	
	$perintahSimpan="INSERT INTO tbl_pendidikan
	(kode_pendidikan, JenjangPendidikan, aktif)
VALUES
	('$dataKode', '$dataJenjang', 'Y')"; 
$kerjakanSimpan=mysqli_query($koneksi,$perintahSimpan)or die(mysqli_error($koneksi));
$jumlahSimpan++;

}

if($kerjakanSimpan){
	
	echo "Berhasil Simpan Sebanyak : ".$jumlahSimpan;
}else{
	echo 'gagal Melakukan penyimpanan';
}

?>