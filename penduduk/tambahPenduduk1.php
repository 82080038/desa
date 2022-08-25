 <?php 
 include '../inc/header.php'; 
 ?>
 <div class="row">
 	<h5 class="text-center">TAMBAH DATA WARGA</h5>
 </div>
 <div class="row">
 	<div class="col lg-6 col-md-6 col-sm-12 col-xs-12">
 		<form>
 			<input type="text" class="form-control d-none" id="IdWargaUPdate" name='IdWargaUPdate'>
 			<div class="mb-0">
 				<label for="InputNIKWarga" class="form-label">NIK</label>
 				<input type="text" class="form-control form-control-sm" name="InputNIKWarga" id="InputNIKWarga">
 			</div>
 			<div class="mb-2">
 				<label for="InputNamaWarga" class="form-label">Nama</label>
 				<input type="text" class="form-control form-control-sm" name="InputNamaWarga" id="InputNamaWarga">
 			</div>
 			<div class="mb-0">
 				<label for="InputNamaWarga" class="form-label">Gender : </label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboGender" id="CboGender">
 					<option value="">-2 Pilihan-</option>
 					<option value="01">Laki-Laki</option>
 					<option value="02">Perempuan</option>
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="InputTempatlahir" class="form-label">Tempat Lahir</label>
 				<input type="text" class="form-control form-control-sm" name="InputTempatlahir" id="InputTempatlahir">
 			</div>
 			<div class="mb-0">
 				<label for="InputTanggalLahir" class="form-label">Tanggal Lahir</label>
 				<input type="date" class="form-control form-control-sm" name="InputTanggalLahir" id="InputTanggalLahir">
 			</div>
 			<div class="mb-0">
 				<label for="CboAgama" class="form-label">Agama</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboAgama" id="CboAgama">
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="CboPendidikan" class="form-label">Pendidikan</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboPendidikan" id="CboPendidikan">
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="CboPekerjaan" class="form-label">Pekerjaan</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboPekerjaan" id="CboPekerjaan">
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="CboStatusKawin" class="form-label">Status Kawin</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboStatusKawin" id="CboStatusKawin">
 				</select>
 			</div>
 		</div>
 		<div class="col lg-6 col-md-6 col-sm-12 col-xs-12">
 			<!-- <div class="mb-0">
 				<label for="CboHubunganKeluarga" class="form-label">Hubungan Keluarga</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboHubunganKeluarga" id="CboHubunganKeluarga">
 				</select>
 			</div>  -->
 			<div class="mb-0">
 				<label for="CboGolDarah" class="form-label">Gol Darah</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboGolDarah" id="CboGolDarah">
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="CboKewarganegaraan" class="form-label">Kewarganegaraan</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboKewarganegaraan" id="CboKewarganegaraan">
 					<option value="">-Pilih-</option>
 					<option value="01">Indonesia</option>
 					<option value="02">WNA</option>
 				</select>
 			</div>
 			<div class="mb-0">
 				<label for="InputNoPasspor" class="form-label">No Passpor</label>
 				<input type="text" class="form-control form-control-sm" name="InputNoPasspor" id="InputNoPasspor">
 			</div>
 			<div class="mb-0">
 				<label for="InputNoKitas" class="form-label">No KITAS/KITAP</label>
 				<input type="text" class="form-control form-control-sm" name="InputNoKitas" id="InputNoKitas">
 			</div>
 			<div class="mb-0">
 				<label for="InputNamaAyah" class="form-label">Nama Ayah</label>
 				<input type="text" class="form-control form-control-sm" name="InputNamaAyah" id="InputNamaAyah">
 			</div>
 			<div class="mb-0">
 				<label for="InputNamaIbu" class="form-label">Nama Ibu</label>
 				<input type="text" class="form-control form-control-sm" name="InputNamaIbu" id="InputNamaIbu">
 			</div>
 			<div class="mb-0">
 				<label for="InputNoHp" class="form-label">Nomor HP</label>
 				<input type="text" class="form-control form-control-sm" name="InputNoHp" id="InputNoHp">
 			</div>
 			<div class="mb-0">
 				<label for="CboSesuaiAlamat" class="form-label">Domisili Permanen</label>
 				<select class="form-select form-select-sm" aria-label="Default select example" name="CboSesuaiAlamat" id="CboSesuaiAlamat">
 					<option value="">-Pilih-</option>
 					<option value="Y">Ya</option>
 					<option value="N">Tidak</option>
 				</select>
 			</div>
 			<div class="mt-2">
 				<button class="btn btn-sm btn-primary">Simpan</button>
 			<button class="btn btn-sm btn-warning">Reset</button>
 			<button class="btn btn-sm btn-danger">Batal</button>
 				
 			</div>

 		</div>
 		<!-- <div class="col-12 text-center mt-2">
 			
 		</div> -->
 	</form>
 </div>
</div>
<?php 
include '../inc/footer.php'; 
?>
<script type="text/javascript" src="tambahPenduduk1.js"></script>
<script type="text/javascript" src="../inc/main.js"></script>