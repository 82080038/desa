$(document).ready(function () {
	console.log('propinsiTerpilihDb'+propinsiTerpilihDb);
	console.log('kabupatenTerpilihDb'+kabupatenTerpilihDb);
	$("#inputTanggalLahirWarga").typeADate();
	$("#inputTanggalLahirWarga").on('blur', function(event) {
		event.preventDefault();
		var reg = /(0[1-9]|[12][0-9]|3[01]|DD)[\/](0[1-9]|1[012]|MM)[\/](19[0-9][0-9]|20[0-9][0-9]|YYYY)/;
		let tanggal=$(this).val();
		if (reg.test(tanggal) === true) { 
			console.log(tanggal);
			var explode = tanggal.split("/");
			console.log(explode);
			let tanggalLahir=explode[0];
			let bulanLahir=explode[1]-1;
			let tahunLahir=explode[2];
			var dob = new Date();
			dob.setFullYear(tahunLahir, bulanLahir, tanggalLahir);
			var today = new Date();
			console.log('tanggal : '+dob);
			console.log('today : '+today);
			// console.log('d3 : '+d3);
			var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
			// return (age>0)?$('#inputUmurWarga').val(age):alert('orangnya belum lahir');
			// 	$(this).val("");
			// 	$('#inputUmurWarga').val("");
			// 	return false;
			if(age>0){
				$('#inputUmurWarga').val(age);
			}else{
				alert('orangnya belum lahir');
				$(this).val("").focus();
				$('#inputUmurWarga').val("");
				return false;
			}
		}else{
			$(this).val("");
		}
	});
	$('#jumlahDataPenduduk').hide();
	$('#rowDetilDusun').hide();
	$('#rowDetilKeluarga').hide();
	resetForm();
	function formatAngka(angka) {
		nomorBaru = Intl.NumberFormat('id-ID').format(angka);
		return nomorBaru;
	}
	loadCboDusun();
	loadHubunganKeluarga();
	function loadCboDusun() {
		$('#jumlahDataPenduduk').hide();
		$('#rowDetilDusun').hide();
		const perintah = 'loadCboDusun';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data dusun..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlPenduduk,
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let jumlahData = formatAngka(hasil['jumlahData']);
				let datadusun=hasil['data_dusun'];
				let jumlahDusun=datadusun.length;
				$('#pilihanDusun').append(`<option value="">-${jumlahData} dusun-</option>`);
				let pilihanDusun='';
				jQuery.each(datadusun, function(index, value){
					console.log(value);
					let namadusun=value.nama_dusun;
					let idDusun=value.idDusun;
					pilihanDusun+=`<option value="${idDusun}">${namadusun}</option>`;
				});
				$('#pilihanDusun').append(pilihanDusun).change();
				$('#pilihanDusun').removeAttr('hidden');
			}
		});
	}
	function loadHubunganKeluarga() {
		$('#jumlahDataPenduduk').hide();
		$('#rowDetilDusun').hide();
		const perintah = 'loadHubunganKeluarga';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data dusun..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlPenduduk,
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let jumlahData = formatAngka(hasil['jumlahData']);
				let datahubunganKeluarga=hasil['hubunganKeluarga'];
				// let jumlahDusun=datadusun.length;
				$('#optHubKeluargaWarga').append(`<option value="">-${jumlahData} Pilihan-</option>`);
				let pilihanHubunganKeluarga='';
				jQuery.each(datahubunganKeluarga, function(index, value){
					console.log(value);
					let namaHubungan=value.status_hub_keluarga;
					let idHubungan=value.id_hub_keluarga;
					pilihanHubunganKeluarga+=`<option value="${idHubungan}">${namaHubungan}</option>`;
				});
				$('#optHubKeluargaWarga').append(pilihanHubunganKeluarga).change();
			}
		});
	}
	$('#pilihanDusun').change(function(event) {
		event.preventDefault();
		$('#jumlahDataPenduduk').empty();
		$('#dataLengkap').empty();
		$('#rowDetilDusun,#rowDetilKeluarga').hide();
		LoadDataPendudukDesa();
		$('#jumlahDataPenduduk').show();
	});
	function GetSortOrder(prop) {    
		return function(a, b) {    
			if (a[prop] > b[prop]) {    
				return 1;    
			} else if (a[prop] < b[prop]) {    
				return -1;    
			}    
			return 0;    
		}    
	}  
	function LoadDataPendudukDesa() {
		const perintah = 'LoadDataPendudukDesa';
		let pilihanDusun=$('#pilihanDusun option:selected').val();
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data Penduduk Desa..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&pilihanDusun='+pilihanDusun,
			url: urlPenduduk,
			dataType: "json",
			success: function (hasil) {
				console.log('data penduduk desa'+hasil);
				let jumlahData = formatAngka(hasil['jumlahSeluruhWarga']);
				let jumlahKK = formatAngka(hasil['jumlahKK']);
				let KKlaki_laki = formatAngka(hasil['KKlakiLaki']['LAKI-LAKI']);
				let KKPerempuan = formatAngka(hasil['KKlakiLaki']['PEREMPUAN']);
				let WargaJenisKelaminL = formatAngka(hasil['WargaJenisKelamin']['LAKI-LAKI']);
				let WargaJenisKelaminP = formatAngka(hasil['WargaJenisKelamin']['PEREMPUAN']);
				let laki_laki=hasil['KKlakiLaki']['LAKI-LAKI']+hasil['WargaJenisKelamin']['LAKI-LAKI'];
				let perempuan=hasil['KKlakiLaki']['PEREMPUAN']+hasil['WargaJenisKelamin']['PEREMPUAN'];
				$('#jumlahDataPenduduk').html(`Ditemukan sebanyak ${jumlahData} <b>data warga</b> (${laki_laki} laki-laki, ${perempuan} Perempuan), dari ${jumlahKK} <b>Kepala Keluarga</b> (${KKlaki_laki} Laki-laki, ${KKPerempuan} Perempuan).`);
				let datawarga=hasil['warga'];
				let KKPekerjaan=hasil['KKPekerjaan'];
				let WargaPkerjaan=hasil['WargaPkerjaan'];
				let seluruhPekerjaan=hasil['seluruhPekerjaan'];
				let SeluruhPendidikan=hasil['SeluruhPendidikan'];
				let KKhubungan=hasil['KKhubungan'];
				let seluruhHubungan=hasil['seluruhHubungan'];
				let seluruhStatusKawin=hasil['seluruhStatusKawin'];
				let KepalaTabel=`<table class="table table-sm">
				<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Kepala Keluarga</th>
				<th scope="col">Hubungan</th>
				<th scope="col">Keluarga</th>
				<th scope="col">Alamat</th>
				</tr>
				</thead>
				<tbody>`;
				let isiTabel="";
				let nomor=1;
				let EkorTabel=` </tbody>
				</table>`;
				let KepalaListKerjaanKK=`<ol class="list-group list-group-numbered">`;
				let IsiHubunganKK='';
				let IsiseluruhKawin='';
				let IsiseluruhHubungan='';
				let IsiSeluruhPendidikan='';
				let IsiListKerjaanWarga='';
				let IsiListKerjaanKK='';
				let IsiListSeluruhpekerjaan='';
				let jumlahStatusKK = $.map(KKhubungan, function(n, i) { return i; }).length;
				let jumlahStatusPerkawinan = $.map(seluruhStatusKawin, function(n, i) { return i; }).length;
				let jumlahHubunganKeluarga = $.map(seluruhHubungan, function(n, i) { return i; }).length;
				let jumlahJenjangPendidikan = $.map(SeluruhPendidikan, function(n, i) { return i; }).length;
				let jumlahJenisPekerjaan= $.map(seluruhPekerjaan, function(n, i) { return i; }).length;
				$('#judulStatusKK').html(`Jenis Status KK <span class="badge bg-primary "> ${jumlahStatusKK}</span>`);
				$('#JudulStatusPerkawinan').html(`Status Perkawinan <span class="badge bg-primary "> ${jumlahStatusPerkawinan}</span>`);
				$('#JudulHubunganKeluarga').html(`Hubungan Keluarga <span class="badge bg-primary "> ${jumlahHubunganKeluarga}</span>`);
				$('#JudulJenjangPendidikan').html(`Jenjang Pendidikan <span class="badge bg-primary "> ${jumlahJenjangPendidikan}</span>`);
				$('#JudulJenisPekerjaan').html(`Jenis Pekerjaan <span class="badge bg-primary "> ${jumlahJenisPekerjaan}</span>`);
				let EkorListKerjaanKK=`</ol>`;
				$.each(KKhubungan, function(index,val){
					IsiHubunganKK+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(seluruhStatusKawin, function(index,val){
					IsiseluruhKawin+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(SeluruhPendidikan, function(index,val){
					IsiSeluruhPendidikan+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(seluruhHubungan, function(index,val){
					IsiseluruhHubungan+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(KKPekerjaan, function(index,val){
					IsiListKerjaanKK+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(WargaPkerjaan, function(index,val){
					IsiListKerjaanWarga+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$.each(seluruhPekerjaan, function(index,val){
					IsiListSeluruhpekerjaan+=`
					<li class="list-group-item d-flex justify-content-between align-items-start">
					<div class="ms-2 me-auto">
					<div class="text">${index}</div>
					</div>
					<span class="badge bg-primary rounded-pill">${val}</span>
					</li>
					`;
				});
				$('#seluruhHubunganKK').html(`${KepalaListKerjaanKK}${IsiHubunganKK}${EkorListKerjaanKK}`);
				$('#seluruhPerkawinan').html(`${KepalaListKerjaanKK}${IsiseluruhKawin}${EkorListKerjaanKK}`);
				$('#seluruhHubungan').html(`${KepalaListKerjaanKK}${IsiseluruhHubungan}${EkorListKerjaanKK}`);
				$('#PekerjaanKepalaKeluarga').html(`${KepalaListKerjaanKK}${IsiListKerjaanKK}${EkorListKerjaanKK}`);
				$('#PekerjaanAnggotaKeluarga').html(`${KepalaListKerjaanKK}${IsiListKerjaanWarga}${EkorListKerjaanKK}`);
				$('#PekerjaanSemuanya').html(`${KepalaListKerjaanKK}${IsiListSeluruhpekerjaan}${EkorListKerjaanKK}`);
				$('#seluruhPendidikan').html(`${KepalaListKerjaanKK}${IsiSeluruhPendidikan}${EkorListKerjaanKK}`);
				$.each(datawarga, function(index, val) {
					let jumlahKeluarga=val['jumlahKeluarga'];
					let kepalaKeluarga=val['kepalaKeluarga'];
					let AgamaKepalaKeluarga=val['kepalaKeluarga']['Agama'];
					let DusunKepalaKeluarga=val['kepalaKeluarga']['nama_dusun'];
					let Etnis_SukuKepalaKeluarga=val['kepalaKeluarga']['Etnis_Suku'];
					let GDarahKepalaKeluarga=val['kepalaKeluarga']['GDarah'];
					let HubunganKepalaKeluarga=val['kepalaKeluarga']['status_hub_keluarga'];
					let Jenis_KelaminKepalaKeluarga=val['kepalaKeluarga']['Jenis_Kelamin'];
					let TampilanJenisKelaminKK = Jenis_KelaminKepalaKeluarga == "LAKI-LAKI" ? "L" : "P";
					let KewarganegaraanKepalaKeluarga=val['kepalaKeluarga']['Kewarganegaraan'];
					let Kode_KeluargaKepalaKeluarga=val['kepalaKeluarga']['Kode_Keluarga'];
					let NIKKepalaKeluarga=val['kepalaKeluarga']['NIK'];
					let Nama_Kepala_KeluargaKepalaKeluarga=val['kepalaKeluarga']['Nama_Kepala_Keluarga'];
					let AlamatKepalaKeluarga=val['kepalaKeluarga']['Alamat'];
					let NoKepalaKeluarga=val['kepalaKeluarga']['No'];
					let PekerjaanKepalaKeluarga=val['kepalaKeluarga']['Pekerjaan'];
					let PendidikanKepalaKeluarga=val['kepalaKeluarga']['Pendidikan'];
					let StatusKepalaKeluarga=val['kepalaKeluarga']['Status'];
					let Tanggal_LahirKepalaKeluarga=val['kepalaKeluarga']['Tanggal_Lahir'];
					let Tempat_LahirKepalaKeluarga=val['kepalaKeluarga']['Tempat_Lahir'];
					let UsiaKepalaKeluarga=val['kepalaKeluarga']['Usia'];
					let id_wargaKepalaKeluarga=val['kepalaKeluarga']['id_warga'];
					let DaftarKeluarga=val['NamaKeluarga'];
					isiTabel+=`<tr rowspan=${jumlahKeluarga} idKK=${Kode_KeluargaKepalaKeluarga} id="barisKepalaKeluarga">
					<td>${nomor++}</td>
					<td><b>${Nama_Kepala_KeluargaKepalaKeluarga}</b><br/>${NIKKepalaKeluarga}(<small>NIK</small>)<br/>${Kode_KeluargaKepalaKeluarga}(KK)</td>
					<td>${HubunganKepalaKeluarga}<br/>${TampilanJenisKelaminKK}, ${UsiaKepalaKeluarga} Thn.</td>
					<td>
					`;
					let nomor1=1;
					if(jumlahKeluarga>0){
						$.each(DaftarKeluarga, function (i) {
							$.each(DaftarKeluarga[i], function (key, val) {
								let AgamaAnggotaKeluarga=val['Agama'];
								let Etnis_SukuAnggotaKeluarga=val['Etnis_Suku'];
								let GDarahAnggotaKeluarga=val['GDarah'];
								let HubunganAnggotaKeluarga=val['status_hub_keluarga'];
								let Jenis_KelaminAnggotaKeluarga=val['Jenis_Kelamin'];
								let TampilanJenisKelaminKeluarga= Jenis_KelaminAnggotaKeluarga == "LAKI-LAKI" ? "L" : "P";
								let KewarganegaraanAnggotaKeluarga=val['Kewarganegaraan'];
								let NIKAnggotaKeluarga=val['NIK'];
								let Nama_Anggota_KeluargaAnggotaKeluarga=val['Nama_Anggota_Keluarga'];
								let NoAnggotaKeluarga=val['No'];
								let PekerjaanAnggotaKeluarga=val['Pekerjaan'];
								let PendidikanAnggotaKeluarga=val['Pendidikan'];
								let StatusAnggotaKeluarga=val['Status'];
								let Tanggal_LahirAnggotaKeluarga=val['Tanggal_Lahir'];
								let Tempat_LahirAnggotaKeluarga=val['Tempat_Lahir'];
								let UsiaAnggotaKeluarga=val['Usia'];
								let id_wargaAnggotaKeluarga=val['id_warga'];
								isiTabel+=`${nomor1++}. ${Nama_Anggota_KeluargaAnggotaKeluarga} (${HubunganAnggotaKeluarga}), ${TampilanJenisKelaminKeluarga}, ${UsiaAnggotaKeluarga} Thn.<br/>`;
							});
						});
					}
					isiTabel+=`</td><td>${AlamatKepalaKeluarga}<br/>${DusunKepalaKeluarga}</td></tr>`;
				})
				$('#rowDetilDusun,#rowDetilKeluarga').show();
				if(pilihanDusun !==''){
					$('#dataLengkap').html(`<h5 class="text-center">DAFTAR KELUARGA</h5>${KepalaTabel}${isiTabel}${EkorTabel}`);
					return;
				}
			}
		})
}
$(document).on('click', '#barisKepalaKeluarga', function(event) {
	event.preventDefault();
	let nomorKK=$(this).attr('idKK');
	loadDataKeluarga(nomorKK);
});
function loadDataKeluarga(nomorKK) {
	const perintah = 'loadDataKeluargaByKK';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&NoKK='+nomorKK,
		url: urlPenduduk,
		dataType: "json",
		success: function (hasil) {
			// console.log('load data keluarga'+hasil);
			console.log(hasil);
			$('.judulModalKK').html('');
			let jumlahData=hasil.jumlahData;
			let dataKeluarga=hasil.keluarga;
			let nomor=1;
			let tabelKeluarga='';
			let kepalaTabel=`
			<table class="table table-sm  lh-sm mb-0" id='tabelKeluarga'>
			<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">NIK</th>
			<th scope="col">JK</th>
			<th scope="col">U</th>
			<th scope="col">Hubungan</th>
			<th scope="col">Kawin</th>
			<th scope="col">Pekerjaan</th>
			<th scope="col">Agama</th>
			<th scope="col">Suku</th>
			<th scope="col">Pendidikan</th>
			<th scope="col">Alamat</th>
			<th scope="col">Aksi</th>
			</tr>
			</thead>
			<tbody>`;
			let ekorTabel=` </tbody>
			</table>`;
			let isiTabel='';
			let jumlahWarga= $.map(dataKeluarga, function(n, i) { return i; }).length;
			let jumlahTerbanyak=Math.max(jumlahWarga);
			console.log(jumlahTerbanyak);
			$.each(dataKeluarga, function(index, val) {
					// console.log(val);
					let Alamat=val['Alamat'];
					let Dusun=val['Dusun'];
					let GDarah=val['GDarah'];
					let Jenis_Kelamin=val['Jenis_Kelamin'];
					let Kewarganegaraan=val['Kewarganegaraan'];
					let Kode_Keluarga=val['Kode_Keluarga'];
					let NIK=val['NIK'];
					let Nama_Anggota_Keluarga=val['Nama_Anggota_Keluarga'];
					let Nama_Kepala_Keluarga=val['Nama_Kepala_Keluarga'];
					let No=val['No'];
					let Nomor_Bangunan=val['nomorBangunan'];
					let Pekerjaan=val['Pekerjaan'];
					let Pendidikan=val['Pendidikan'];
					let Status=val['Status'];
					let Tanggal_Lahir=val['Tanggal_Lahir'];
					let Tempat_Lahir=val['Tempat_Lahir'];
					let Usia=val['Usia'];
					let agama=val['agama'];
					let aktif_warga=val['aktif_warga'];
					let id_warga=val['id_warga'];
					let nama_dusun=val['nama_dusun'];
					let nama_suku=val['nama_suku'];
					let status_hub_keluarga=val['status_hub_keluarga'];
					let TampilanJenisKelamin = Jenis_Kelamin == "LAKI-LAKI" ? "L" : "P";
					let TampilanSuku = '';
					if(nama_suku){
						TampilanSuku+=nama_suku;
					}else{
						TampilanSuku+='';
					}
					isiTabel+=` <tr class='barisDetilWarga' id_warga=${id_warga}>
					<td>${nomor++}.</td>
					<td class="text-break">${Nama_Anggota_Keluarga}</td>
					<td>${NIK}</td>
					<td>${TampilanJenisKelamin}</td>
					<td>${Usia}</td>
					<td>${status_hub_keluarga}</td>
					<td>${Status}</td>
					<td>${Pekerjaan}</td>
					<td><p class"text-capitalize">${agama}</p></td>
					<td class="text-capitalize">${TampilanSuku}</td>
					<td>${Pendidikan}</td>
					<td class="text-break">${Alamat} ${Nomor_Bangunan}<br/><p class="fst-italic fw-bolder">${nama_dusun}</p></td>
					<td>
					<div class="btn-group" role="group" aria-label="Basic example">
					<button class="btn btn-sm btn-outline-primary" data-bs-target="#modalDetilWarga" data-bs-toggle="modal" data-bs-dismiss="modal"
					id="btnLihatWarga" modeForm='update' id_warga=${id_warga} nomorNIK=${NIK} nomorKK=${Kode_Keluarga}
					><i class="fa-solid fa-eye"></i></button>
					<button class='btn btn-sm btn-outline-danger btnHapusWarga' id_warga=${id_warga} nomorNIK=${NIK} nomorKK=${Kode_Keluarga} namaOrang="${Nama_Anggota_Keluarga}" ><i class="fa-solid  fa-trash-can"></i></button>
					</div>
					</td>
					</tr>`;
					$('.judulModalKK').html(`${jumlahWarga} Orang, Data Keluarga ${Nama_Kepala_Keluarga} | <text class="text-end fst-italic">${Kode_Keluarga} 
						<button class="btn btn-sm btn-primary" data-bs-target="#modalDetilWarga" data-bs-toggle="modal" data-bs-dismiss="modal"
						id="btnTambahKeluarga" modeForm='tambah' id_warga=${id_warga} nomorNIK=${NIK} nomorKK=${Kode_Keluarga}
						><i class="fa-solid fa-plus"></i></button></text>
						`);
				});
			if(jumlahData>0){
				$('#modalKK').modal('show');
				tabelKeluarga+=`${kepalaTabel}${isiTabel}${ekorTabel}`;
				$('#contohTabelKeluarga').html(tabelKeluarga);
			}else{
				alert('Data tidak Ditemukan')
			}
		}
	});
}
$(document).on('click', '#btnTambahKeluarga,#btnLihatWarga,#tambahKKBaru', function(event) {
	event.preventDefault();
	resetForm();
	let modeForm=$(this).attr('modeForm');
	console.log('mode dari tombol'+ modeForm);
	$('#modeForm option').filter('[value="'+modeForm+'"]').attr('selected', 'selected').change();
	let modeDariForm=$('#modeForm option:selected').val();
	console.log('modeDariForm'+ modeDariForm);
	let nomorKK=$(this).attr('nomorKK');
	let nomorNIK=$(this).attr('id_warga');
	if(modeForm==='update'){
		loadDetilWarga(nomorNIK);
	}else if(modeForm==='tambah'){
		loadSebagianDataKK(nomorKK);
	} else if(modeForm==='tambahKK'){
		$("#formDetilWarga").find('#inputNikKK').focus();
		$('.judulModalDetilWarga').html('TAMBAH KEPALA KELUARGA');
		$('#inputNikKK').attr('placeholder', 'masukkan nomor KK 16 digit');
		$('.tombolSimpan').html('Simpan');
		$('.tombolBatal').html('Batal');
		$('#inputKepalaKeluarga').attr('disabled', true);
		$('#inputKepalaKeluarga').attr('disabled', true);
		$('#inputNikWarga').attr('disabled', true);
		$('#inputNamaWarga').attr('disabled', true);
		$('#modalDetilWarga').modal('show');
	}
	else{
		alert('mode form belum dibuat');
	}
});
function loadSebagianDataKK(nomorKK){
	let perintah='loadSebagianDataKK';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&nomorKK='+nomorKK,
		url: urlPenduduk,
		dataType: "json",
		success: function (hasil) {
			console.log(hasil);
			let Agama=hasil['Agama'];
			let Alamat=hasil['Alamat'];
			dusunTerpilihDb+=hasil['Dusun'];
			let Etnis_Suku=hasil['Etnis_Suku'];
			let Kewarganegaraan=hasil['Kewarganegaraan'];
			let Kode_Keluarga=hasil['Kode_Keluarga'];
			let Nama_Kepala_Keluarga=hasil['Nama_Kepala_Keluarga'];
			let Nomor_Bangunan=hasil['Nomor Bangunan'];
			desaTerpilihDb+=hasil['id_desa'];
			kabupatenTerpilihDb+=hasil['id_kabupaten'];
			kecamatanTerpilihDb+=hasil['id_kecamatan'];
			propinsiTerpilihDb+=hasil['id_propinsi'];
			console.log('Nama_Kepala_Keluarga'+Nama_Kepala_Keluarga);
			$('.judulModalDetilWarga').html(`TAMBAH DATA KELUARGA : ${Nama_Kepala_Keluarga}`);
			$('#inputKepalaKeluarga').val(Nama_Kepala_Keluarga).attr('disabled', 'disabled');
			$('#inputNikKK').val(Kode_Keluarga).attr('disabled', 'disabled');;
			$('#optAgamaWarga option').filter('[value="' + Agama + '"]').attr('selected', 'selected').change();
			$('#optSukuWarga option').filter('[value="' + Etnis_Suku + '"]').attr('selected', 'selected').change();
			$('#optKewarganeraanWarga option').filter('[value="' + Kewarganegaraan + '"]').attr('selected', 'selected').change();
			$('#optPropinsiWarga option').filter('[value="' + propinsiTerpilihDb + '"]').attr('selected', 'selected').change();
			// $('#optPropinsiWarga option:selected').val(propinsiTerpilihDb).change();
			$('#inputAlamatWarga').val(Alamat);
			$('.tombolSimpan').html(`Simpan <i class="fa-regular fa-floppy-disk"></i>`);
			$('.tombolBatal').html('Batal');
			console.log('propinsiTerpilihDb'+propinsiTerpilihDb);
		}
	});
}
function loadDetilWarga(nomorNIK) {
	let perintah = 'loadDetilWarga';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&nomorNIK='+nomorNIK,
		url: urlPenduduk,
		dataType: "json",
		success: function (hasil) {
			console.log('loadDetilWarga'+hasil['detilWarga'][0]['Dusun']);
			let idAgama= hasil['detilWarga'][0]['Agama'];
			let Etnis_Suku=hasil['detilWarga'][0]['Etnis_Suku'];
			let GDarah=hasil['detilWarga'][0]['GDarah'];
			let Hubungan=hasil['detilWarga'][0]['Hubungan'];
			let Jenis_Kelamin=hasil['detilWarga'][0]['Jenis_Kelamin'];
			let Kewarganegaraan=hasil['detilWarga'][0]['Kewarganegaraan'];
			let Kode_Keluarga=hasil['detilWarga'][0]['Kode_Keluarga'];
			let NIK=hasil['detilWarga'][0]['NIK'];
			let Nama_Anggota_Keluarga=hasil['detilWarga'][0]['Nama_Anggota_Keluarga'];
			let Nama_Kepala_Keluarga=hasil['detilWarga'][0]['Nama_Kepala_Keluarga'];
			let No=hasil['detilWarga'][0]['No'];
			let Nomor_Bangunan=hasil['detilWarga'][0]['Nomor Bangunan'];
			let Pekerjaan=hasil['detilWarga'][0]['Pekerjaan'];
			let Pendidikan=hasil['detilWarga'][0]['Pendidikan'];
			let RT=hasil['detilWarga'][0]['RT'];
			let RW=hasil['detilWarga'][0]['RW'];
			let Status=hasil['detilWarga'][0]['Status'];
			let Tanggal_Lahir=hasil['detilWarga'][0]['Tanggal_Lahir'];
			let Tempat_Lahir=hasil['detilWarga'][0]['Tempat_Lahir'];
			let Usia=hasil['detilWarga'][0]['Usia'];
			let namaAgama=hasil['detilWarga'][0]['agama1'];
			let aktif_warga=hasil['detilWarga'][0]['aktif_warga'];
			let Alamat=hasil['detilWarga'][0]['Alamat'];
			dusunTerpilihDb='';
			dusunTerpilihDb+=hasil['detilWarga'][0]['Dusun'];
			// console.log('dusunTerpilihDb'+dusunTerpilihDb);
			desaTerpilihDb='';
			desaTerpilihDb+=hasil['detilWarga'][0]['id_desa'];
			kabupatenTerpilihDb+=hasil['detilWarga'][0]['id_kabupaten'];
			kecamatanTerpilihDb+=hasil['detilWarga'][0]['id_kecamatan'];
			propinsiTerpilihDb+=hasil['detilWarga'][0]['id_propinsi'];
			let id_warga=hasil['detilWarga'][0]['id_warga'];
			let nama_desa=hasil['detilWarga'][0]['nama_desa'];
			let nama_dusun=hasil['detilWarga'][0]['nama_dusun'];
			let nama_kab_kota=hasil['detilWarga'][0]['nama_kab_kota'];
			let nama_kecamatan=hasil['detilWarga'][0]['nama_kecamatan'];
			let nama_propinsi=hasil['detilWarga'][0]['nama_propinsi'];
			let nama_suku=hasil['detilWarga'][0]['nama_suku'];
			let status_hub_keluarga=hasil['detilWarga'][0]['status_hub_keluarga'];
			let id_hub_keluarga=hasil['detilWarga'][0]['id_hub_keluarga'];
			// let propinsiTerpilih='';
			let jumlahPilihanKabupaten=0;
			$('.judulModalDetilWarga').html(`Detil Warga, ${Nama_Anggota_Keluarga}`);
			$('#inputKepalaKeluarga').val(Nama_Kepala_Keluarga);
			$('#inputNikKK').val(Kode_Keluarga);
			$('#inputNikWarga').val(NIK);
			$('#inputNamaWarga').val(Nama_Anggota_Keluarga);
			$('#optGenderWarga option').filter('[value="' + Jenis_Kelamin + '"]').attr('selected', 'selected').change();
			$('#optHubKeluargaWarga option').filter('[value="' + id_hub_keluarga + '"]').attr('selected', 'selected').change();
			$('#inputTempatLahirWarga').val(Tempat_Lahir);
			$('#inputTanggalLahirWarga').val(Tanggal_Lahir);
			$('#inputUmurWarga').val(Usia);
			$("#optStatusKawinWarga option:contains('"+Status+"')").attr('selected', 'selected');
			$("#optGolDarahWarga option:contains('"+GDarah+"')").attr('selected', 'selected');
			if(Etnis_Suku !==""){
				$('#optSukuWarga option').filter('[value="' + Etnis_Suku + '"]').attr('selected', 'selected').change();
			}else{
				$("#optSukuWarga option").attr("selected", false);
			}
			$('#optAgamaWarga option').filter('[value="' + idAgama + '"]').attr('selected', 'selected').change();
			$("#optPendidikanWarga option:contains('"+Pendidikan+"')").attr('selected', 'selected');
			$("#optPekerjaanWarga option:contains('"+Pekerjaan+"')").attr('selected', 'selected');
			$("#optKewarganeraanWarga option:contains('"+Kewarganegaraan+"')").attr('selected', 'selected');
			$('#optPropinsiWarga option').filter('[value="' + propinsiTerpilihDb + '"]').attr('selected', 'selected').change();
			$('#optDusunWarga option').filter('[value="' + dusunTerpilihDb + '"]').attr('selected', 'selected').change();
			$('#inputAlamatWarga').val(Alamat);
			$('.tombolSimpan').html('Update');
			$('.tombolBatal').html('Batal');
		}
	});
}
$('#modalDetilWarga').on('shown.bs.modal', function (event) {
	console.log('show');
	event.stopPropagation();
	// $("#inputTanggalLahirWarga").datetimepicker({
	// 	format: 'dd-mm-yyyy',
	// 	autoclose: true,
	// 	// todayBtn: true,
	// 	startView: 4,
	// 	// beforeShowDay:'enabled',
	// 	viewSelect: 'year',
	// 	// minuteStep: 15
	// 	container: '#modalDetilWarga'
	// });
	periksaInputValid();
})
$('#modalDetilWarga').on('hidden.bs.modal', function () {
	resetForm();
	console.log('hidden');
})
function resetForm(){
	$('#formDetilWarga')[0].reset();
	$('#modeForm option:selected').removeAttr('selected');
	$('#optGenderWarga option:selected').removeAttr('selected');
	$('#optHubKeluargaWarga option:selected').removeAttr('selected');
	$('#optStatusKawinWarga option:selected').removeAttr('selected');
	$('#optAgamaWarga option:selected').removeAttr('selected');
	$('#optGolDarahWarga option:selected').removeAttr('selected');
	$('#optSukuWarga option:selected').removeAttr('selected');
	$('#optPendidikanWarga option:selected').removeAttr('selected');
	$('#optPekerjaanWarga option:selected').removeAttr('selected');
	$('#optKewarganeraanWarga option:selected').removeAttr('selected');
	$("input,select").each(function() {
		$(this).removeClass('error');
	});
}
$('#formDetilWarga').on('change', 'input,select', function(event) {
	event.preventDefault();
	periksaInputValid();
});
function periksaInputValid(){
	let isValid;
	$("input,select").each(function() {
		var element = $(this);
		if (element.val() == "") {
			isValid = false;
			$(this).addClass('error');
		}else{
			$(this).removeClass('error');
		}
	});
}
$(document).on('click', '.tombolBatal', function(event) {
	event.preventDefault();
	console.log('batal');
	$('.btn_tutup_keluarga').trigger('click');
	// resetForm();
});
$(document).on('click', '.tombolSimpan', function(event) {
	event.preventDefault();
	// let pilihanForm=$('#modeForm option:selected').val();
	let tujuanForm=$('.tombolSimpan').html();
	// console.log('#pilihanForm'+pilihanForm);
	console.log('#tujuanForm'+tujuanForm);
	if(tujuanForm=='Update'){
		doUpdate();
	}else{
		doSimpan();
	}
});
$(document).on('click', '.btnHapusWarga', function(event) {
	event.preventDefault();
	let id_warga=$(this).attr('id_warga');
	let nomorNIK=$(this).attr('nomorNIK');
	let nomorKK=$(this).attr('nomorKK');
	let namaOrang=$(this).attr('namaOrang');
	console.log(namaOrang);
	let konfirmasi=`Apakah anda yakin akan menghapus data warga atas nama ${namaOrang} ini ?\nTindakan persetujuan tidak dapat mengembalikan data`;
	if(confirm(konfirmasi)==true){
		console.log('Akan melakukan penghapusan');
	}else{
		console.log('Tidak akan melakukan penghapusan');
// return;
}
// nomorNIK=${NIK} nomorKK=${Kode_Keluarga} namaOrang=${Nama_Anggota_Keluarga}
});
function doUpdate(){
	console.log('sedang Update');
}
function doSimpan(){
	console.log('sedang simpan baru');
}
function loadJumlahPenduduk() {
	const perintah = 'loadJumlahPenduduk';
	const type_perintah = 'GET';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah,
		url: `${url}${type_perintah}.php`,
		dataType: "json",
		success: function (hasil) {
			let jumlahData = formatAngka(hasil['detilWarga']['jumlahData']);
			let tanpaKK = formatAngka(hasil['tanpaKK']);
			let disabilitas = formatAngka(hasil['disabilitas']);
			let tanpaNIK = formatAngka(hasil['tanpaNIK']);
			let tanpaDataPekerjaan = formatAngka(hasil['tanpaPekerjaan']);
			let NIKganda = formatAngka(hasil['NIKganda']);
			let tanpaDusun = formatAngka(hasil['tanpaDusun']);
			let tanpaDesa = formatAngka(hasil['tanpaDesa']);
			let tanpaAlamatJalan = formatAngka(hasil['tanpaJalan']);
			let tulisanNIK = '';
			let tulisanNIKganda = '';
			let dataLengkap = '';
			if (jumlahData === '0') {
				tulisanJumlahDataPenduduk = 'Maaf..Belum ada data penduduk.';
			} else {
				tulisanJumlahDataPenduduk = `<label class='text text-primary jumlahPenduduk'>Ditemukan ${jumlahData} data penduduk di dalam database.</label><br/>`;
			}
			if (tanpaDataPekerjaan === '0') {
				tulisantanpaDataPekerjaan = '';
			} else {
				tulisantanpaDataPekerjaan = `<label class='text text-danger tanpa_pekerjaan'>Ditemukan ${tanpaDataPekerjaan} penduduk tanpa data pekerjaan.</label><br/>`;
			}
			if (disabilitas === '0') {
				tulisanDisabilitas = '';
			} else {
				tulisanDisabilitas = `<label class='text text-danger disabilitas'>Ditemukan ${disabilitas} penduduk penyandang disabilitas.</label><br/>`;
			}
			if (NIKganda === '0') {
				tulisanNIKganda = '';
			} else {
				tulisanNIKganda = `<label class='text text-danger nik_ganda'>Ditemukan ${NIKganda} NIK Ganda.</label><br/>`;
			}
			if (tanpaKK === '0') {
				tulisanTanpaKK = '';
			} else {
				tulisanTanpaKK = `<label class='text text-danger tanpaKK'>Ditemukan ${tanpaKK} penduduk tanpa nomor KK.</label><br/>`;
			}
			if (tanpaNIK === '0') {
				tulisanNIK = '';
			} else {
				tulisanNIK = `<label class='text text-danger tanpaNIK'>Ditemukan ${tanpaNIK} Penduduk tanpa NIK sebanyak  data.</label></br>`;
			}
			if (tanpaDusun === '0') {
				tulisanTanpaDusun = '';
			} else {
				tulisanTanpaDusun = `<label class='text text-danger tanpaDusun'>Ditemukan sebanyak ${tanpaDusun} penduduk tanpa alamat dusun.</label><br/>`;
			}
			if (tanpaDesa === '0') {
				tulisanTanpaDesa = '';
			} else {
				tulisanTanpaDesa = `<label class='text text-danger tanpaDesa'>Ditemukan sebanyak ${tanpaDesa} penduduk tanpa alamat desa.</label></br>`;
			}
			if (tanpaAlamatJalan === '0') {
				tulisantanpaAlamatJalan = '';
			} else {
				tulisantanpaAlamatJalan = `<label class='text text-danger tanpaAlamatRumah'>Ditemukan sebanyak ${tanpaAlamatJalan} yang tidak memiliki alamat rumah.</label><br/>`;
			}
			dataLengkap += `
			${tulisantanpaDataPekerjaan}
			${tulisanDisabilitas}
			${tulisanTanpaKK}
			${tulisanNIK}
			${tulisanNIKganda}
			${tulisanTanpaDesa}
			${tulisanTanpaDusun}
			${tulisantanpaAlamatJalan}
			`;
			if (dataLengkap === '') {
				tulisanDataLengkap = 'Data penduduk Lengkap';
			} else {
				tulisanDataLengkap = dataLengkap;
			}
			$('#jumlahDataPenduduk').html(tulisanJumlahDataPenduduk);
			$('#dataLengkap').html(tulisanDataLengkap);
		}
	});
}
$(document).on('change', '#inputNikWarga', function(event) {
	event.preventDefault();
	let modeForm=$('#modeForm option:selected').val();
	if(modeForm==='tambah' || modeForm==='tambahKK'){
		let nomorNIK=$('#inputNikWarga').val();
		let panjangnomorNIK=nomorNIK.length;
		if (panjangnomorNIK!=16){
			alert('Panjang nomor NIK harus 16 digit, anda memasukkan '+panjangnomorKK+'digit');
			$('#inputNikWarga').focus();
			$('#inputNikWarga').addClass('error');
		}else{
			cariNomorNIK(nomorNIK);
		}
	}else{
		console.log('belum ditentukan');
	}
});
// $(document).on('change', '#inputNikWarga', function(event) {
// 	event.preventDefault();
// 	let modeForm=$('#modeForm option:selected').val();
// 	if(modeForm='tambahKK'){
// 		let NikWarga=$(this).val();
// 		let panjangnomorNIKWarga=NikWarga.length;
// 		if (panjangnomorNIKWarga!=16){
// 			alert(`NIK yang anda masukkan ${NikWarga} sebanyak ${panjangnomorNIKWarga}, harus 16 digit\nMohon perbaikan !`);
// 			$(this).focus();
// 		}else{
// 			$('#inputNamaWarga').removeAttr('disabled');
// 			$('#inputNamaWarga').focus();
// 		}
// 	}
// });
$('#inputNikKK').on('change', function(event) {
	event.preventDefault();
	let modeForm=$('#modeForm option:selected').val();
	if(modeForm='tambahKK'){
		let nomorKK=$('#inputNikKK').val();
		let panjangnomorKK=nomorKK.length;
		if (panjangnomorKK!=16){
			alert('Panjang nomor KK harus 16 digit, anda memasukkan '+panjangnomorKK+'digit');
			$('#inputNikKK').focus();
			$('#inputNikKK').addClass('error');
		}else{
			cariNomorKK(nomorKK);
		}
	}
	console.log('change input KK');
}).on('blur', function(event) {
	event.preventDefault();
	/* Act on the event */
	console.log('input nik kk');
}).on('focus', function(event) {
	event.preventDefault();
	console.log('sedang focus');
});
$(document).on('change', '#inputKepalaKeluarga', function(event) {
	event.preventDefault();
	let modeForm=$('#modeForm option:selected').val();
	if(modeForm='tambahKK'){
		let namaKK=$(this).val();
		let panjangnomorNamaKK=namaKK.length;
		if (panjangnomorNamaKK<3){
			alert(`Nama ${namaKK} masih terlalu pendek\npelit amat !`);
			$('#inputKepalaKeluarga').focus();
		}else{
			$('#inputNikWarga').removeAttr('disabled');
			$('#inputNikWarga').focus();
		}
	}
});
$(document).on('focus keyup change', '#inputKepalaKeluarga', function(event) {
	event.preventDefault();
	console.log('masuk ke input nama kepala keluarga');
	// console.log('pemeriksaan error kk'+adaErrorKK);
	let modeForm=$('#modeForm option:selected').val();
	let adaErrorKK=$('#inputNikKK').hasClass('error');
	console.log('berubah dari input masuk KK');
	// console.log('adaErrorKK'+adaErrorKK);
	console.log('pemeriksan error KK: '+adaErrorKK);
	if(modeForm='tambahKK' && adaErrorKK===true){
		alert('nomor KK masih salah !');
		console.log('pemeriksan error KK dari IF: '+adaErrorKK);
		$('#inputNikKK').focus();
	}
});
function cariNomorKK(nomorKK){
	let perintah = 'cariNomorKK';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&nomorKK='+nomorKK,
		url: urlPenduduk,
		dataType: "json",
		success: function (hasil) {
			let jumlahData=hasil.jumlahData;
			if(jumlahData>0){
				let detildata=hasil.dataKK;
				let Alamat=hasil.dataKK['Alamat'];
				let Min_NIK=hasil.dataKK['Min_NIK'];
				let Min_No=hasil.dataKK['Min_No'];
				let Nama_Kepala_Keluarga=hasil.dataKK['Nama_Kepala_Keluarga'];
				let Nomor_bangunan=hasil.dataKK['Nomor Bangunan'];
				let nama_desa=hasil.dataKK['nama_desa'];
				let nama_dusun=hasil.dataKK['nama_dusun'];
				let nama_kab_kota=hasil.dataKK['nama_kab_kota'];
				let nama_kecamatan=hasil.dataKK['nama_kecamatan'];
				let nama_propinsi=hasil.dataKK['nama_propinsi'];
				alert(`Maaf...\nNomor KK ${nomorKK}, sudah terdaftar di database, atas nama Kepala Keluarga ${Nama_Kepala_Keluarga}\nDi alamat : ${Alamat} ${nama_dusun}, DESA/KEL. ${nama_desa}, KEC. ${nama_kecamatan}, ${nama_kab_kota}, PROP.${nama_propinsi}\nSilahkan hubungi admin di tempat tersebut.`);
				// $('#inputNikKK').addClass('error');
				// $('#inputNikKK').attr('error', 'true');
				$('#inputKepalaKeluarga').attr('disabled', true);
				$('#inputNikWarga').attr('disabled', true);
				$('#inputNamaWarga').attr('disabled', true);
				// console.log('ada error dari pencarian KK:'+adaErrorKK);
				$('#inputNikKK').focus();
				// return false;
			}else{
				$('#inputKepalaKeluarga').removeAttr('disabled');
				// $('#inputNikWarga').removeAttr('disabled');
				// $('#inputNamaWarga').removeAttr('disabled');
				$('#inputKepalaKeluarga').focus();
			}
		}
	});
}
function cariNomorNIK(nomorNIK){
	let perintah = 'cariNomorNIK';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&nomorNIK='+nomorNIK,
		url: urlPenduduk,
		dataType: "json",
		success: function (hasil) {
			let hasilNIK=hasil.dataNik;
			let jumlahData=hasil.jumlahData;
			if(jumlahData>0){
				let Alamat=hasil.dataNik['Alamat'];
				let Jenis_Kelamin=hasil.dataNik['Jenis_Kelamin'];
				let NIK=hasil.dataNik['NIK'];
				let Nama_Anggota_Keluarga=hasil.dataNik['Nama_Anggota_Keluarga'];
				let Nama_Kepala_Keluarga=hasil.dataNik['Nama_Kepala_Keluarga'];
				let No=hasil.dataNik['No'];
				let Nomor_Bangunan=hasil.dataNik['Nomor Bangunan'];
				let Status=hasil.dataNik['Status'];
				let Usia=hasil.dataNik['Usia'];
				let id_warga=hasil.dataNik['id_warga'];
				let nama_desa=hasil.dataNik['nama_desa'];
				let nama_dusun=hasil.dataNik['nama_dusun'];
				let nama_kab_kota=hasil.dataNik['nama_kab_kota'];
				let nama_kecamatan=hasil.dataNik['nama_kecamatan'];
				let nama_propinsi=hasil.dataNik['nama_propinsi'];
				let status_hub_keluarga=hasil.dataNik['status_hub_keluarga'];
				alert(`Maaf...\nNIK ${NIK}, sudah terdaftar di database, atas nama ${Nama_Anggota_Keluarga},sebagai ${status_hub_keluarga} di keluarga ${Nama_Kepala_Keluarga}\n Di alamat : ${Alamat} ${nama_dusun}, DESA/KEL. ${nama_desa}, KEC. ${nama_kecamatan}, ${nama_kab_kota}, PROP.${nama_propinsi}\nSilahkan hubungi admin di tempat tersebut.`);
				$('#inputNikWarga').focus();
				$('#inputNikWarga').addClass('error');
				// return false;
			}else{
				// $('#inputKepalaKeluarga').removeAttr('disabled');
				$('#inputNamaWarga').removeAttr('disabled');
				$('#inputNamaWarga').focus();
			}
		}
	});
}
// function cariPendudukTanpaAlamat() {
// 	const perintah = 'cariPendudukTanpaAlamat';
// 	$.ajax({
// 		beforeSend: function () {
// 			$('#info').html("Tunggu...Sedang loading data penduduk..");
// 		},
// 		type: "POST",
// 		data: 'perintah=' + perintah,
// 		url: '../API/alamat/alamat_proses.php',
// 		dataType: "json",
// 		success: function (hasil) {
// 				// console.log('Tanpa ALAMAT dusun' + hasil);
// 				console.log('hasil dusun :' + hasil);
// 				let tanpaDusun = hasil['tanpaDusun'];
// 				let tanpaJelas = hasil['nggakJelas'];
// 				console.log('Tanpa ALAMAT dusun' + tanpaDusun);
// 				console.log('Tanpa ALAMAT jelas' + tanpaJelas);
// 			}
// 		});
// }
// $(document).on('click', '.nik_ganda', function (event) {
// 	event.preventDefault();
// 	console.log('ok');
// 	$(location).attr('href', '../penduduk/nik_ganda.php');
// });
// $(document).on('click', '.tanpaKK', function (event) {
// 	event.preventDefault();
// 	console.log('ok');
// 	$(location).attr('href', '../penduduk/tanpaKK.php');
// });
// $('#tanpaKK').click(function (e) {
// 	e.preventDefault();
// 	console.log('ok');
// 	$(location).attr('href', '../penduduk/tanpaKK.php');
// });
});