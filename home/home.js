$(document).ready(function () {
	let url = 'http://localhost/API2/penduduk/v1.0.0/proses.php/';
	loadJumlahPenduduk();
	loadDusun();
	var d = new Date();
	var b = d.getDay();
	var c = d.getDate();
	var tambahan_hari_han=20;
	d.setDate(d.getDate() + tambahan_hari_han);
	var a='10.5a';
	if(isFinite(a)){
		console.log('adalah merupakan nomor');
	}else{
		console.log('bukan merupakan number');
	}
	if(isNaN(a)){
		console.log('bukan merupakan nomor NaN');
	}else{
		console.log('adalah nomor NaN');
	}
	let menjadi_nomor=Number(a);
	let nilai_parseFloat=parseFloat(a);
	let nilai_parseInt=parseInt(a);
	console.log(d);
	console.log(b);
	console.log(c);
	console.log('menjadi_nomor'+menjadi_nomor);
	console.log('nilai_parseFloat'+nilai_parseFloat);
	console.log('nilai_parseInt'+nilai_parseInt);
	function loadJumlahPenduduk() {
		const perintah = 'LoadDataPendudukDesa';
		const type_perintah = 'GET';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&pilihanDusun='+'',
			url: `${url}${type_perintah}.php`,
			dataType: "json",
			success: function (hasil) {
				
				let jumlahKK=hasil['jumlahKK'];
				let KKlakiLaki=hasil['KKlakiLaki']['LAKI-LAKI'];
				let KKPerempuan=hasil['KKlakiLaki']['PEREMPUAN'];
				let jumlahWarga=hasil['WargaJumlahKeluarga'];
				let jumlahSeluruhWarga=hasil['jumlahSeluruhWarga'];
				$('#JudulJumlahWarga').html(`JUMLAH WARGA <span class="badge bg-primary ">${jumlahSeluruhWarga}</span>`)
				let KeluargaLakiLaki=hasil['WargaJenisKelamin']['LAKI-LAKI'];
				let KeluargaPerempuan=hasil['WargaJenisKelamin']['PEREMPUAN'];
				let seluruhLakiLaki=KKlakiLaki+KeluargaLakiLaki;
				let seluruhPerempuan=KKPerempuan+KeluargaPerempuan;
				let seluruhPekerjaan=hasil.seluruhPekerjaan;
				let seluruhStatusKawin=hasil.seluruhStatusKawin;
				let seluruhEtnisSuku=hasil.seluruhEtnisSuku;
				let seluruhAgama=hasil.seluruhAgama;
				let SeluruhPendidikan=hasil.SeluruhPendidikan;
				$('#jumlahKK').html(`<ul>
					<li>${jumlahKK} Kepala Keluarga (${KKlakiLaki} laki-laki, ${KKPerempuan} Perempuan)</li><li>${jumlahWarga} Angota Keluarga (${KeluargaLakiLaki} Laki-laki, ${KeluargaPerempuan} perempuan)</li></ul>
					${jumlahSeluruhWarga} Total seluruh warga (${seluruhLakiLaki} Laki-laki, ${seluruhPerempuan} Perempuan)`);

				let SeluruhHubunganKel=hasil['seluruhHubungan'];
				
				let SeluruhUsia=hasil['SeluruhUsia'];
				let listSeluruhHubungan='';
				let listSeluruhUmur='';
				let listPekerjaan='';
				let listStatusKawin='';
				let listSeluruhSuku='';
				let listSeluruhAgama='';
				let listSeluruhPendidikan='';
				let nomor=0;
				let nomorPendidikan=0;
				let jumlahHubunganKel = $.map(SeluruhHubunganKel, function(n, i) { return i; }).length;
				let jumlahStatusPerkawinan = $.map(seluruhStatusKawin, function(n, i) { return i; }).length;
				let jumlahRentangUmur = $.map(SeluruhUsia, function(n, i) { return i; }).length;
				let jumlahAgama= $.map(seluruhAgama, function(n, i) { return i; }).length;
				let jumlahPekerjaan= $.map(seluruhPekerjaan, function(n, i) { return i; }).length;
				let jumlahPendidikan= $.map(SeluruhPendidikan, function(n, i) { return i; }).length;

				$('#JudulHubunganKeluarga').html(`Hubungan Keluarga <span class="badge bg-primary ">${jumlahHubunganKel}</span>`);
				$('#JudulStatusPerkawinan').html(`Status Perkawinan <span class="badge bg-primary ">${jumlahStatusPerkawinan}</span>`);
				$('#JudulRentangUmur').html(`Rentang Umur <span class="badge bg-primary ">${jumlahRentangUmur}</span>`);
				$('#JudulJumlahAgama').html(`Agama <span class="badge bg-primary ">${jumlahAgama}</span>`);
				$('#JudulJumlahPekerjaan').html(`Jenis Pekerjaan <span class="badge bg-primary ">${jumlahPekerjaan}</span>`);
				$('#JudulTingkatPendidikan').html(`Tingkat Pendidikan <span class="badge bg-primary ">${jumlahPendidikan}</span>`);
				
				$.each(SeluruhHubunganKel, function(index, val) {
					let namaHubungan=index;
					let JumlahHubungan=val;

					listSeluruhHubungan+=`<li class="list"><b>${namaHubungan}</b> : ${JumlahHubungan} org</li>`;
				});
				
				$.each(SeluruhUsia, function(index, val) {
					let rentangUmur=index;
				
					let jumlahUmur=val;
					listSeluruhUmur+=`<li class=""><b>${rentangUmur} thn</b> : ${jumlahUmur} org</li>`;
				});
				$.each(seluruhPekerjaan, function(index, val) {
					 let namaPekerjaan=index;
					 let JumlahPekerjaan=val;
					 nomor++;
					
					 // listPekerjaan+=`<li class="list-item">${nomor}. ${namaPekerjaan} : ${JumlahPekerjaan}</li>`;
					 listPekerjaan+=`${nomor}. ${namaPekerjaan} : <b>${JumlahPekerjaan}</b><br/>`;
				});
				$.each(seluruhStatusKawin, function(index, val) {
				  let statusKawin=index;
				  let jumlahStatusKawin=val;
				  listStatusKawin+=`<li class="list"><b>${statusKawin}</b> : ${jumlahStatusKawin} </li>`;
				});
				$.each(seluruhEtnisSuku, function(index, val) {
				  let namaEtnisSuku=index;
				  let jumlahEtnisSuku=val;
				  listSeluruhSuku+=`<li class="list-inline-item"><b>${namaEtnisSuku}</b> : ${jumlahEtnisSuku}, </li>`;
				});
				$.each(seluruhAgama, function(index, val) {
				  let namaAgama=index;
				  let jumlahAgama=val;
				  listSeluruhAgama+=`<li class=""><b>${namaAgama}</b> : ${jumlahAgama} </li>`;
				});
				$.each(SeluruhPendidikan, function(index, val) {
				  let namaPendidikan=index;
				  let jumlahPendidikan=val;
				  nomorPendidikan++;
				  // listSeluruhPendidikan+=`<li class="list-item">${namaPendidikan} : ${jumlahPendidikan}.</li>`;
				  listSeluruhPendidikan+=`${nomorPendidikan}. ${namaPendidikan} : <b>${jumlahPendidikan}</b><br/>`;
				});

				$('#seluruhHubungan').html(listSeluruhHubungan);
				$('#listUmur').html(listSeluruhUmur);
				$('#listPekerjaan').html(listPekerjaan);
				$('#seluruhPerkawinan').html(listStatusKawin);
				$('#listSuku').html(listSeluruhSuku);
				$('#listAgama').html(listSeluruhAgama);
				$('#listPendidikan').html(listSeluruhPendidikan);
			}
		});
	}
	function loadDusun() {
		const perintah = 'loadDusun';
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
				let hasilDataDusun=hasil.data_dusun;
				let jumlahDusun=hasilDataDusun.length;
				$('#judulDusun').html(`Dusun <span class="badge bg-primary ">${jumlahDusun}</span>`)

				let list='';
				$('#jumlahDusun').html(`${jumlahDusun} dusun.`);
				$.each(hasilDataDusun, function(index, val) {
					let id_dusun=val['id_dusun'];
					let nama_dusun=val['nama_dusun'];
					list+=`<a href="../view/dusun.php?&id_dusun=${id_dusun}" class="list-group-item list-group-item-action" aria-current="true">
					${nama_dusun}
					</a>`;
					});
				$('#listDusun').append(list);
			}
		});
	}
});
function lihatdusun(){
	location.href = '../view/dusun.php';
}