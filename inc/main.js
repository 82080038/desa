// https://sqlizer.io/#
$(document).ready(function() {
	window.urlUtil = 'http://localhost/API2/util/utils.php';
	window.urlPenduduk= 'http://localhost/API2/penduduk/v1.0.0/proses.php';
	window.urlAlamat = 'http://localhost/API2/alamat/v1.0.0/proses.php';
	window.propinsiTerpilihDb='';
	window.kabupatenTerpilihDb='';
	window.kecamatanTerpilihDb='';
	window.desaTerpilihDb='';
	window.dusunTerpilihDb='';

	if (!propinsiTerpilihDb) {
		propinsiTerpilihDb='12';
  
} else {
  propinsiTerpilihDb=propinsiTerpilihDb;
}
if (!kabupatenTerpilihDb) {
		kabupatenTerpilihDb='12.07';
  
} else {
  kabupatenTerpilihDb=kabupatenTerpilihDb;
}
if (!kecamatanTerpilihDb) {
		kecamatanTerpilihDb='12.07.05';
  
} else {
  kecamatanTerpilihDb=kecamatanTerpilihDb;
}
if (!desaTerpilihDb) {
		desaTerpilihDb='12.07.05.2007';
  
} else {
  desaTerpilihDb=desaTerpilihDb;
}
// if (dusunTerpilihDb) {
// 		desaTerpilihDb='12.07.05.2007';
  
// } else {
//   desaTerpilihDb=desaTerpilihDb;
// }
// propinsiTerpilihDb ? propinsiTerpilihDb : 12;
	console.log('desaTerpilihDb'+desaTerpilihDb);
	console.log('dusunTerpilihDb'+dusunTerpilihDb);
	loadAgama();
	loadJenjangPendidikan();
	loadPekerjaan();
	loadCboKawin();
	loadGolDarah();
	loadSuku();
	load_propinsi();
	function HitungText(){
		var Teks = $('#inputKK').val().length;
		var total = document.getElementById('hasil');
		total.innerHTML = Teks + ' Karakter';
	}
	function formatAngka(angka) {
		nomorBaru = Intl.NumberFormat('id-ID').format(angka)
		return nomorBaru;
	}
	//AGAMA AWAL
	function loadAgama() {
		const perintah = 'loadAgama';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data agama..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				console.log('hasil Agama'+hasil);
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataAgama=hasil['CboAgama'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				$('#CboAgama,#optAgamaWarga').append(JumlahPilihan);
				let pilihanAgama='';
				jQuery.each(DataAgama, function(index, value){
					let id_agama=value['id_agama'];
					let agama=value['agama'];
					pilihanAgama+=`<option value="${id_agama}">${agama}</option>`;
					// $('#optAgamaWarga').append(pilihan).change();
				});
				$('#CboAgama,#optAgamaWarga').append(pilihanAgama).change();
			}
		});
	}
	//AGAMA AKHIR
	//PENDIDIKAN AWAL
	function loadJenjangPendidikan() {
		const perintah = 'loadJenjangPendidikan';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data agama..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataJenjangPendidikan=hasil['CboPendidikan'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				$('#CboPendidikan, #optPendidikanWarga').append(JumlahPilihan);
				jQuery.each(DataJenjangPendidikan, function(index, value){
					let Pendidikan=value['Pendidikan'];
					// let JenjangPendidikan=value['Pendidikan'];
					let pilihan=`<option value="${Pendidikan}">${Pendidikan}</option>`;
					$('#CboPendidikan,#optPendidikanWarga').append(pilihan).change();
				});
			}
		});
	}
	//PENDIDIKAN AKHIR
	//PEKERJAAN AWAL
	function loadPekerjaan() {
		const perintah = 'loadPekerjaan';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data pekerjaan..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataPekerjaan=hasil['pekerjaan'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				let belumBekerja=`<option value="Belum Bekerja">Belum Bekerja</option>`;
				$('#CboPekerjaan,#optPekerjaanWarga').append(JumlahPilihan);
				$('#CboPekerjaan,#optPekerjaanWarga').append(belumBekerja);
				jQuery.each(DataPekerjaan, function(index, value){
					let id_pekerjaan=value['id_pekerjaan'];
					let namaPekerjaan=value['namaPekerjaan'];
					let pilihan=`<option value="${id_pekerjaan}">${namaPekerjaan}</option>`;
					$('#CboPekerjaan,#optPekerjaanWarga').append(pilihan).change();
				});
			}
		});
	}
	//PEKERJAAN AKHIR
	//KAWIN AWAL
	function loadCboKawin() {
		const perintah = 'loadCboKawin';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data pilihan perkawinan..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataCboKawin=hasil['Cbokawin'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				$('#CboStatusKawin,#optStatusKawinWarga').append(JumlahPilihan);
				jQuery.each(DataCboKawin, function(index, value){
					let id_kawin=value['id_kawin'];
					let StatusKawin=value['kawin'];
					let pilihan=`<option value="${id_kawin}">${StatusKawin}</option>`;
					$('#CboStatusKawin,#optStatusKawinWarga').append(pilihan).change();
				});
			}
		});
	}
	//KAWIN AKHIR
	//GOL DARAH AWAL
	function loadGolDarah() {
		const perintah = 'loadGolDarah';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data pilihan perkawinan..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataCboDarah=hasil['CboDarah'];
				let JumlahPilihan=`<option value="" class='bg-secondary'>-${jumlahData} Pilihan-</option>`;
				$('#CboGolDarah,#optGolDarahWarga').append(JumlahPilihan);
				let pilihanDarah='';
				jQuery.each(DataCboDarah, function(index, value){
					let kodeGolDarah=value['kodeGolDarah'];
					let GolDarah=value['GolDarah'];
					pilihanDarah+=`<option value="${kodeGolDarah}">${GolDarah}</option>`;
				});
				$('#CboGolDarah,#optGolDarahWarga').append(pilihanDarah).change();
			}
		});
	}
	//GOL DARAH AKHIR
	//SUKU AWAL
	function loadSuku() {
		const perintah = 'loadSuku';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data pilihan SUKU..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataCboSuku=hasil['CboSuku'];
				let JumlahPilihan=`<option value="" class='bg-secondary'>-${jumlahData} Pilihan-</option>`;
				$('#optSukuWarga').append(JumlahPilihan);
				let pilihanSuku='';
				jQuery.each(DataCboSuku, function(index, value){
					let id_suku=value['id_suku'];
					let nama_suku=value['nama_suku'];
					pilihanSuku+=`<option value="${id_suku}">${nama_suku}</option>`;
				});
				$('#optSukuWarga').append(pilihanSuku).change();
			}
		});
	}
	//SUKU AKHIR
	// PROPINSI AWAL
	function load_propinsi() {
		// resetSemua();
		$('#opt_propinsi, #optPropinsiWarga').removeAttr('disabled');
		$('#opt_propinsi, #optPropinsiWarga').html(``);
		const perintah = 'load_propinsi';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data propinsi..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahPropinsi']);
				let dataPropinsi=hasil['data_propinsi'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				$('#opt_propinsi, #optPropinsiWarga').append(JumlahPilihan);
				jQuery.each(dataPropinsi, function(index, value){
					let id_propinsi=value['id_propinsi'];
					let nama_propinsi=value['nama_propinsi'];
					let pilihan=`<option value="${id_propinsi}">${nama_propinsi}</option>`;
					$('#opt_propinsi, #optPropinsiWarga').append(pilihan).change();
				});
				if(propinsiTerpilihDb){
					$('#opt_propinsi, #optPropinsiWarga option').filter('[value="' + propinsiTerpilihDb + '"]').attr('selected', 'selected').change();
				}
				kabupatenReset();
			}
		});
	}
	$('#opt_propinsi, #optPropinsiWarga').change(function() {
		// resetSemua();
		let id_propinsi=$('#opt_propinsi, #optPropinsiWarga option:selected').val();
		if(id_propinsi){
			loadKabupaten(id_propinsi);
			$('#opt_kabupaten,#optKabupatenWarga').removeAttr('disabled');
		}else{
			kabupatenReset();
		}
	});
	// PROPINSI AKHIR
	//KABUPATEN AWAL
	// 	function loadKabupaten(id_propinsi) {
	// 	const perintah = 'loadKabupaten';
	// 	$.ajax({
	// 		beforeSend: function () {
	// 			$('#info').html("Tunggu...Sedang loading data kabupaten..");
	// 		},
	// 		type: "GET",
	// 		data: 'perintah=' + perintah+'&id_propinsi='+id_propinsi,
	// 		url: urlAlamat,
	// 		dataType: "json",
	// 		success: function (hasil) {
	// 			let jumlahData = formatAngka(hasil['jumlahData']);
	// 			if(jumlahData>0){
	// 				let dataKabupaten=hasil['data_kabupaten'];
	// 				let JumlahPilihanKab=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
	// 				$('#opt_kabupaten,#optKabupatenWarga').html(JumlahPilihanKab);
	// 				jQuery.each(dataKabupaten, function(index, value){
	// 					let id_kabupaten=value['id_kabupaten'];
	// 					let nama_kabupaten=value['nama_kab_kota'];
	// 					let pilihan_kabupaten=`<option value="${id_kabupaten}">${nama_kabupaten}</option>`;
	// 					$('#opt_kabupaten,#optKabupatenWarga').append(pilihan_kabupaten).change();
	// 				});
	// 			}else{
	// 				kabupatenReset();
	// 			}
	// 		}
	// 	});
	// }
	function loadKabupaten(id_propinsi) {
		const perintah = 'loadKabupaten';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_propinsi='+id_propinsi,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					let dataKabupaten=hasil['data_kabupaten'];
					let JumlahPilihanKab=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
					$('#opt_kabupaten,#optKabupatenWarga').html(JumlahPilihanKab);
					jQuery.each(dataKabupaten, function(index, value){
						let id_kabupaten=value['id_kabupaten'];
						let nama_kabupaten=value['nama_kab_kota'];
						let pilihan_kabupaten=`<option value="${id_kabupaten}">${nama_kabupaten}</option>`;
						$('#opt_kabupaten,#optKabupatenWarga').append(pilihan_kabupaten).change();
					});
					if(kabupatenTerpilihDb){
						$('#opt_kabupaten,#optKabupatenWarga').removeAttr('disabled');
						$('#opt_kabupaten,#optKabupatenWarga option').filter('[value="' + kabupatenTerpilihDb + '"]').attr('selected', 'selected').change();
					}
				}else{
					kabupatenReset();
				}
			}
		});
	}
	function kabupatenReset(){
		$('#opt_kabupaten,#optKabupatenWarga').attr('disabled', 'disabled');
		$('#opt_kabupaten,#optKabupatenWarga').html(`<option value="">-No Data-</option>`);
	}
	$('#opt_kabupaten,#optKabupatenWarga').change(function() {
		let id_kabupaten=$('#opt_kabupaten,#optKabupatenWarga option:selected').val();
		if(id_kabupaten){
			loadKecamatan(id_kabupaten);
			$('#opt_kecamatan, #optKecamatanWarga').removeAttr('disabled');
		}else{
			kecamatanReset();
		}
	});
	//KABUPATEN AKHIR
	//KECAMATAN AWAL
	function loadKecamatan(id_kabupaten) {
		const perintah = 'loadkecamatan';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_kabupaten='+id_kabupaten,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					let dataKecamatan=hasil['data_kecamatan'];
					let JumlahPilihanKec=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
					$('#opt_kecamatan, #optKecamatanWarga').html(JumlahPilihanKec);
					jQuery.each(dataKecamatan, function(index, value){
						let id_kecamatan=value['id_kecamatan'];
						let nama_kecamatan=value['nama_kecamatan'].toUpperCase();
						let pilihan_kecamatan=`<option value="${id_kecamatan}">${nama_kecamatan}</option>`;
						$('#opt_kecamatan, #optKecamatanWarga').append(pilihan_kecamatan).change();
					// KelurahanReset();
				});
					if(kecamatanTerpilihDb){
						$('#opt_kecamatan, #optKecamatanWarga option').filter('[value="' + kecamatanTerpilihDb + '"]').attr('selected', 'selected').change();
					}
				}else{
					KelurahanReset();
				}
			}
		});
	}
	function kecamatanReset(){
		$('#opt_kecamatan, #optKecamatanWarga').attr('disabled', 'disabled');
		$('#opt_kecamatan, #optKecamatanWarga').html(`<option value="">-No Data-</option>`);
	}
	$('#opt_kecamatan, #optKecamatanWarga').change(function() {
		let id_kecamatan=$('#opt_kecamatan, #optKecamatanWarga option:selected').val();
		if(id_kecamatan){
			loadKelurahan(id_kecamatan);
			$('#opt_kelurahan,#optDesaWarga').removeAttr('disabled');
		}else{
			KelurahanReset();
		}
	});
	//KECAMATAN AKHIR
	//DESA AWAL
	function KelurahanReset(){
		$('#opt_kelurahan,#optDesaWarga').attr('disabled', 'disabled');
		$('#opt_kelurahan,#optDesaWarga').html(`<option value="">-No Data-</option>`);
	}
	function loadKelurahan(id_kecamatan) {
		const perintah = 'load_desa';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_kecamatan='+id_kecamatan,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					let dataKelurahan=hasil['data_desa'];
					let JumlahPilihanKelurahan=`<option value="">-${jumlahData} Pilihan-</option>`;
					$('#opt_kelurahan,#optDesaWarga').html(JumlahPilihanKelurahan);
					jQuery.each(dataKelurahan, function(index, value){
						let id_Kelurahan=value['id_desa_kel'];
						let nama_desa=value['nama_desa'].toUpperCase();
						let pilihan_Kelurahan=`<option value="${id_Kelurahan}">${nama_desa}</option>`;
						$('#opt_kelurahan,#optDesaWarga').append(pilihan_Kelurahan).change();
					});
					if(desaTerpilihDb){
						$('#opt_kelurahan,#optDesaWarga option').filter('[value="' + desaTerpilihDb + '"]').attr('selected', 'selected').change();
					}
				}else{
					DusunReset();
				}
			}
		});
	}
	$('#opt_kelurahan,#optDesaWarga').change(function() {
		let id_Kelurahan=$('#opt_kelurahan,#optDesaWarga option:selected').val();
		if(id_Kelurahan){
			loadDusun();
			$('#opt_dusun,#optDesaWarga').removeAttr('disabled');
		}else{
			DusunReset();
		}
	});
	//DESA AKHIR
	//DUSUN AWAL
	function DusunReset(){
		$('#opt_dusun,#optDusunWarga').attr('disabled', 'disabled');
		$('#opt_dusun,#optDusunWarga').html(`<option value="">-No Data-</option>`);
		$('#buttonDusun').attr('hidden', 'true');
	}
	function loadDusun() {
		const perintah = 'loadDusun';
		let id_Kelurahan=$('#opt_kelurahan,#optDesaWarga option:selected').val();
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data dusun..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_desa='+id_Kelurahan,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					$('#opt_dusun,#optDusunWarga').removeAttr('disabled');
					let dataDusun=hasil['data_dusun'];
					let JumlahPilihanDusun=`<option value="">-${jumlahData} Pilihan-</option>`;
					$('#opt_dusun,#optDusunWarga').html(JumlahPilihanDusun);
					jQuery.each(dataDusun, function(index, value){
						let id_dusun=value['id_dusun'];
						let nama_dusun=value['nama_dusun'].toUpperCase();
						let pilihan_Dusun=`<option value="${id_dusun}">${nama_dusun}</option>`;
						$('#opt_dusun,#optDusunWarga').append(pilihan_Dusun).change();
					});
					if(dusunTerpilihDb){
						$('#opt_dusun,#optDusunWarga option').filter('[value="' + dusunTerpilihDb + '"]').attr('selected', 'selected').change();
					}
				}else{
					DusunReset();
				}
				$('#buttonDusun').removeAttr('hidden');
				$('.buttonTambahDusun').removeAttr('hidden');
				$('.buttonEditDusun').attr('hidden','true');
				$('.buttonHapusDusun').attr('hidden','true');
			}
		});
	}
	//DUSUN AKHIR
});