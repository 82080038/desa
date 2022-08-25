$(document).ready(function () {
	loadDataJumlahAlamat();
	load_propinsi();
	let nomor_alamat = '';
	let dataPilihanDusun;
	let noOption = '<option value="">-No Data-</option>';

	function formatAngka(angka) {
		nomorBaru = Intl.NumberFormat('id-ID').format(angka)
		return nomorBaru;
	}

	function loadDataJumlahAlamat() {
		const perintah = 'loadDataJumlahAlamat';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data alamat");
			},
			type: "POST",
			data: 'perintah=' + perintah,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let jumlah_desa = formatAngka(hasil['jumlah_desa']);
				let jumlah_kabupaten = formatAngka(hasil['jumlah_kabupaten']);
				let jumlah_kecamatan = formatAngka(hasil['jumlah_kecamatan']);
				let jumlah_dusun = formatAngka(hasil['jumlah_dusun']);
				let jumlah_propinsi = hasil['jumlah_propinsi'];
				let tulisanJumlahAlamat = '';
				tulisanJumlahAlamat += `
				Propinsi : <b>${jumlah_propinsi}</b> |
				Kabupaten/Kota : <b>${jumlah_kabupaten}</b> |
				Kecamatan : <b>${jumlah_kecamatan}</b> |
				Desa : <b>${jumlah_desa}</b>|
				Dusun : <b>${jumlah_dusun}</b><br/>
				`;
				$('#data_jumlah_alamat').html(tulisanJumlahAlamat);
				console.log(Intl.NumberFormat('de-DE').format(jumlah_desa));
			}
		});
	}
	$('.propinsi').change(function () {
		let id_propinsi = $('.propinsi').val();
		$('.kabupaten').empty().change();
		$('.kabupaten').html(noOption);
		if (id_propinsi) {
			console.log('id_propinsi' + id_propinsi);
			nomor_alamat += id_propinsi;
			console.log('nomor_alamat' + nomor_alamat);
			load_kabupaten(id_propinsi);
		}
	});
	$('.kabupaten').change(function () {
		let id_kabupaten = $('.kabupaten').val();
		$('.kecamatan').empty().change();
		$('.kecamatan').html(noOption);
		if (id_kabupaten) {
			console.log('id_kabupaten' + id_kabupaten);
			load_kecamatan(id_kabupaten);
			nomor_alamat += id_kabupaten;
			console.log('nomor_alamat' + nomor_alamat);
		}
	});
	$('.kecamatan').change(function () {
		let id_kecamatan = $('.kecamatan').val();
		$('.desa').empty().change();
		$('.desa').html(noOption);
		if (id_kecamatan) {
			console.log('id_kecamatan' + id_kecamatan);
			load_desa(id_kecamatan);
			nomor_alamat += id_kecamatan;
			console.log('nomor_alamat' + nomor_alamat);
		}
	});
	$('.desa').change(function () {
		let id_desa = $('.desa').val();
		$('#dataDusun').html("");
		$('.namaDusunJalan').html("");
		if (id_desa) {
			load_dusun(id_desa);
		}
	});

	function load_propinsi() {
		const perintah = 'load_propinsi';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data propinsi..");
			},
			type: "POST",
			data: 'perintah=' + perintah,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let panjangData = hasil.length;
				let pilihan_propinsi = '';
				if (panjangData > 0) {
					pilihan_propinsi += `<option selected value=''>-${panjangData} pilihan-</option>`;
					for (let i = 0; i < panjangData; i++) {
						let id_propinsi = hasil[i].id_propinsi;
						let nama_propinsi = hasil[i].nama_propinsi;
						pilihan_propinsi += `<option value="${id_propinsi}">${nama_propinsi}</option>`;;
					}
				} else {
					pilihan_propinsi += `<option selected>-No Data-</option>`;
				}
				$('.propinsi').append(pilihan_propinsi).change();
			}
		});
	}

	function load_kabupaten(id_propinsi) {
		const perintah = 'load_kabupaten';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_propinsi=' + id_propinsi,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				$('.kabupaten').html('');
				let panjangData = hasil.length;
				let pilihan_kabupaten = '';
				if (panjangData > 0) {
					pilihan_kabupaten += `<option selected value="">-${panjangData} pilihan-</option>`;
					for (let i = 0; i < panjangData; i++) {
						let id_kabupaten = hasil[i].id_kabupaten;
						let nama_kabupaten = hasil[i].nama_kabupaten;
						pilihan_kabupaten += `<option value="${id_kabupaten}">${nama_kabupaten}</option>`;;
					}
				} else {
					pilihan_kabupaten += `<option selected>-No Data-</option>`;
				}
				$('.kabupaten').append(pilihan_kabupaten);
			}
		});
	}

	function load_kecamatan(id_kabupaten) {
		const perintah = 'load_kecamatan';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_kabupaten=' + id_kabupaten,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				$('.kecamatan').html('');
				console.log(hasil);
				let panjangData = hasil.length;
				let pilihan_kecamatan = '';
				if (panjangData > 0) {
					pilihan_kecamatan += `<option selected value="">-${panjangData} pilihan-</option>`;
					for (let i = 0; i < panjangData; i++) {
						let id_kecamatan = hasil[i].id_kecamatan;
						let nama_kecamatan = hasil[i].nama_kecamatan;
						pilihan_kecamatan += `<option value="${id_kecamatan}">${nama_kecamatan}</option>`;;
					}
				} else {
					pilihan_kecamatan += `<option selected>-No Data-</option>`;
				}
				$('.kecamatan').append(pilihan_kecamatan);
			}
		});
	}

	function load_desa(id_kecamatan) {
		const perintah = 'load_desa';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data kabupaten..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_kecamatan=' + id_kecamatan,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				$('.desa').html('');
				let panjangData = hasil.length;
				let pilihan_desa = '';
				if (panjangData > 0) {
					pilihan_desa += `<option selected value="">-${panjangData} pilihan-</option>`;
					for (let i = 0; i < panjangData; i++) {
						let id_desa = hasil[i].id_desa;
						let nama_desa = hasil[i].nama_desa;
						pilihan_desa += `<option value="${id_desa}">${nama_desa}</option>`;;
					}
				} else {
					pilihan_desa += `<option selected>-No Data-</option>`;
				}
				$('.desa').append(pilihan_desa).change();
			}
		});
	}

	function load_dusun(id_desa) {
		const perintah = 'load_dusun';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data dusun..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_desa=' + id_desa,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let tampilkanDusun = '';
				let dataPilihanDusun = '';
				tampilkanDusun += `<ul class="daftarDusun">
				`;
				if (hasil !== null) {
					let panjangData = hasil.length;
					let aktif_dusun = hasil['aktif'];
					let id_dusun = hasil['id_dusun'];
					let nama_dusun = hasil['nama_dusun'];
					for (let i = 0; i < panjangData; i++) {
						let aktif_dusun = hasil[i]['aktif'];
						let id_dusun = hasil[i]['id_dusun'];
						let nama_dusun = hasil[i]['nama_dusun'];
						tampilkanDusun += ` <li class="list-group-item iddaftardusun" idDaftarDusun=${id_dusun}>${nama_dusun} -> ${aktif_dusun}</li>`;
						dataPilihanDusun += `<option value="${id_dusun}">${nama_dusun}</option>`;
					}
					$('.namaDusunJalan').html(dataPilihanDusun);
					$('#judulKeteranganDusun').prepend(`${panjangData}`);
				} else {
					tampilkanDusun += `
					Tidak ada data dusun.
					`;
				}
				$('#dataDusun').html(tampilkanDusun);
			}
		});
	}
	$('.simpanDusun').click(function (e) {
		e.preventDefault();
		let id_desa = $('.desa option:selected').val();
		let namadusunBaru = $('#namaDusunBaru').val();
		const perintah = 'simpanDusun';
		nomor_alamat += id_desa;
		console.log('nomor_alamat panjang' + nomor_alamat);
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang menyimpan data dusun..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_desa=' + id_desa + '&namadusunBaru=' + namadusunBaru,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let hasil_server = hasil['pesan'];
				let status = hasil['status'];
				if (hasil_server === "ok") {
					alert(`data ${namadusunBaru.toUpperCase()} berhasil disimpan`);
					$('#namaDusunBaru').val("").focus();
					load_dusun();
				} else if (hasil_server === "gagal") {
					alert(`data ${namadusunBaru.toUpperCase()} GAGAL disimpan`);
				} else if (hasil_server === "duplikat") {
					alert(`data ${namadusunBaru.toUpperCase()} sudah ada di database, data TIDAK disimpan`);
					$('#namaDusunBaru').val("").focus();
				} else {
					alert('Terjadi kesalahan jaringan');
				}
			}
		});
	});
	$(document).on('click', '.iddaftardusun', function (event) {
		event.preventDefault();
		// console.log('hai document');
		let id_daftar_Dusun = $(this).attr('idDaftarDusun');
		load_data_jalan(id_daftar_Dusun);
		// console.log('id_daftar_Dusun' + id_daftar_Dusun);
	});

	function load_data_jalan(id_daftar_Dusun) {
		const perintah = 'load_data_jalan';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data jalan..");
			},
			type: "POST",
			data: 'perintah=' + perintah + '&id_daftar_Dusun=' + id_daftar_Dusun,
			url: '../API/alamat/alamat_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				// let tampilkanDusun = '';
				// tampilkanDusun += `<ul class="daftarDusun">`;
				// if (hasil !== null) {
				// 	let panjangData = hasil.length;
				// 	let aktif_dusun = hasil['aktif'];
				// 	let id_dusun = hasil['id_dusun'];
				// 	let nama_dusun = hasil['nama_dusun'];
				// 	for (let i = 0; i < panjangData; i++) {
				// 		let aktif_dusun = hasil[i]['aktif'];
				// 		let id_dusun = hasil[i]['id_dusun'];
				// 		let nama_dusun = hasil[i]['nama_dusun'];
				// 		tampilkanDusun += ` <li class="list-group-item iddaftardusun" idDaftarDusun=${id_dusun}>${nama_dusun} -> ${aktif_dusun}</li>`;
				// 	}
				// 	$('#judulKeteranganDusun').prepend(`${panjangData}`);
				// } else {
				// 	tampilkanDusun += `Tidak ada data dusun.`;
				// }
				// tampilkanDusun += `</ul>`;
				// $('#dataDusun').html(tampilkanDusun);
			}
		});
	};
	$('#modalDusun').on('shown.bs.modal', function () {
		console.log('modal dusun tampil');
		// let pilihanDesa = $('.desa').val();
		let pilihanDesa = $('.desa').find(":selected").val();
		console.log('pilihan desa' + pilihanDesa);
		if (!pilihanDesa) {
			alert('Tidak dapat mengisi data, karena tidak ada pilihan desa/kel !');
			$('.tutupModalDusun').trigger('click');
			$('.desa').trigger('click');
		}
		$('#namaDusunBaru').empty().focus();

	});
	$('#modalJalan').on('shown.bs.modal', function () {
		console.log('modal jalan tampil');
		$('#namaJalanBaru').empty().focus();
		let pilihanDesa = $('.desa').find(":selected").val();
		let pilihanDusun = $('.namaDusunJalan option:selected').val();
		console.log('pilihanDusun' + pilihanDusun);
		if (!pilihanDusun) {
			alert('Tidak dapat mengisi data, karena tidak ada pilihan dusun !');
			$('.tutupModalJalan').trigger('click');
			$('.btnModalDusun').trigger('click');
		}

	});
	$('#modalJalan').on('hidden.bs.modal', function () {
		console.log('modal jalan ditutup');
	});
	//akhir program
});