load_propinsi();
load_kabupaten();
load_kecamatan();
load_desa();

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
			// console.log('ok');
			console.log(hasil);
			let kembalianData = hasil[0];
			let panjangData = hasil.length;
			// console.log('ok');
			console.log('panjang data' + panjangData);
			let TulisanTemuan = '';

			let keTabel = '';
			let KepalaTabel = `<table class="table table-striped">
			<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Nama Propinsi</th>
			
			<th scope="col">Aksi</th>
			</tr>
			</thead>
			<tbody>`;
			let ekorTabel = `</tbody>
			</table>`;
			let isiTabel = '';
			if (kembalianData) {
				TulisanTemuan += `<i>${panjangData} Data.</i>`;
				for (let i = 0; i < panjangData; i++) {
					let nomor = i + 1;
					let namaPropinsi = hasil[i].nama_propinsi;
					let IdPropinsi = hasil[i].id_propinsi;

					isiTabel += `<tr id_propinsi=${IdPropinsi}>
					<th scope="row">${nomor}</th>
					<td>${namaPropinsi.toUpperCase()}</td>
					
					<td>
					<span style="font-size: 1.3em; color: Tomato;">
					<i class="fas fa-edit editProduk"></i>
					
					</span>
					</td >
					</tr>`;
					// console.log(isiTabel);
				}
			} else {
				TulisanTemuan += '<p class="text-muted">Belum ada data Poduk</p>';
				alert('Data Produk Tidak Ditemukan !');
				$('#daftarProduk').attr('hidden', 'hidden');
				let konfirmasi = 'Apakah anda akan menambahkan data produk ?';
				if (confirm(konfirmasi) == true) {
					window.location.replace("../produk/produk_tambah.php");
				}
			}
			$('#jumlahData').append(TulisanTemuan);
			keTabel += `${KepalaTabel}${isiTabel}${ekorTabel}`;
			$('#daftarPropinsi').append(keTabel);
		}
	});
}

function load_kabupaten() {
	const perintah = 'load_kabupaten';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data kabupaten..");
		},
		type: "POST",
		data: 'perintah=' + perintah,
		url: '../API/alamat/alamat_proses.php',
		dataType: "json",
		success: function (kabupaten) {
			console.log('ok');
			console.log(kabupaten);
			let kembalianData = kabupaten[0];
			let panjangData = kabupaten.length;
			// console.log('ok');
			console.log('panjang data kabuapten' + panjangData);
			let TulisanTemuanKabupaten = '';

			let keTabel = '';
			let KepalaTabel = `<table class="table table-striped table-auto">
							<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Nama kabupaten</th>

							<th scope="col">Aksi</th>
							</tr>
							</thead>
							<tbody>`;
			let ekorTabel = `</tbody>
							</table>`;
			let isiTabel = '';
			if (kembalianData) {
				TulisanTemuanKabupaten += `<i>${panjangData} Data.</i>`;
				for (let i = 0; i < panjangData; i++) {
					let nomor = i + 1;
					let nama_kabupaten = kabupaten[i].nama_kabupaten;
					let id_kabupaten = kabupaten[i].id_kabupaten;

					isiTabel += `<tr id_propinsi=${id_kabupaten}>
									<th scope="row">${nomor}</th>
									<td>${nama_kabupaten.toUpperCase()}</td>

									<td>
									<span style="font-size: 1.3em; color: Tomato;">
									<i class="fas fa-edit editProduk"></i>

									</span>
									</td >
									</tr>`;
					// console.log(isiTabel);
				}
			} else {
				TulisanTemuanKabupaten += '<p class="text-muted">Belum ada data Poduk</p>';
				alert('Data Produk Tidak Ditemukan !');
				$('#daftarProduk').attr('hidden', 'hidden');
				let konfirmasi = 'Apakah anda akan menambahkan data produk ?';
				if (confirm(konfirmasi) == true) {
					window.location.replace("../produk/produk_tambah.php");
				}
			}
			$('#jumlahDataKabupaten').append(TulisanTemuanKabupaten);
			keTabel += `${KepalaTabel}${isiTabel}${ekorTabel}`;
			$('#daftarKabupaten').append(keTabel);
		}
	});
}


function load_kecamatan() {
	const perintah = 'load_kecamatan';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data kecamatan..");
		},
		type: "POST",
		data: 'perintah=' + perintah,
		url: '../API/alamat/alamat_proses.php',
		dataType: "json",
		success: function (kecamatan) {
			console.log('ok');
			console.log(kecamatan);
			let kembalianData = kecamatan[0];
			let panjangDataKecamatan = kecamatan.length;
			console.log('ok');
			console.log('panjang data kecamatan' + panjangDataKecamatan);
			let TulisanTemuankecamatan = '';

			let keTabel = '';
			let KepalaTabel = `<table class="table table-striped table-auto">
							<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Nama kecamatan</th>

							<th scope="col">Aksi</th>
							</tr>
							</thead>
							<tbody>`;
			let ekorTabel = `</tbody>
							</table>`;
			let isiTabel = '';
			if (kembalianData) {
				TulisanTemuankecamatan += `<i>${panjangDataKecamatan} Data.</i>`;
				for (let i = 0; i < panjangDataKecamatan; i++) {
					let nomor = i + 1;
					let nama_kecamatan = kecamatan[i].nama_kecamatan;
					let id_kecamatan = kecamatan[i].id_kecamatan;

					isiTabel += `<tr id_kecamatan=${id_kecamatan}>
									<th scope="row">${nomor}</th>
									<td>${nama_kecamatan.toUpperCase()}</td>

									<td>
									<span style="font-size: 1.3em; color: Tomato;">
									<i class="fas fa-edit editProduk"></i>

									</span>
									</td >
									</tr>`;
					// console.log(isiTabel);
				}
			} else {
				TulisanTemuankecamatan += '<p class="text-muted">Belum ada data Poduk</p>';
				alert('Data Produk Tidak Ditemukan !');
				$('#daftarProduk').attr('hidden', 'hidden');
				let konfirmasi = 'Apakah anda akan menambahkan data produk ?';
				if (confirm(konfirmasi) == true) {
					window.location.replace("../produk/produk_tambah.php");
				}
			}
			$('#jumlahDatakecamamtan').append(panjangDataKecamatan);
			keTabel += `${KepalaTabel}${isiTabel}${ekorTabel}`;
			$('#daftarkecamatan').append(keTabel);
		}
	});
}

function load_desa() {
	const perintah = 'load_desa';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data kecamatan..");
		},
		type: "POST",
		data: 'perintah=' + perintah,
		url: '../API/alamat/alamat_proses.php',
		dataType: "json",
		success: function (desa) {
			console.log('ok');
			console.log(desa);
			let kembalianData = desa[0];
			let panjangDataDesa = desa.length;
			console.log('ok');
			console.log('panjang data desa' + panjangDataDesa);
			let TulisanTemuankecamatan = '';

			let keTabel = '';
			let KepalaTabel = `<table class="table table-striped table-auto">
							<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Nama kecamatan</th>

							<th scope="col">Aksi</th>
							</tr>
							</thead>
							<tbody>`;
			let ekorTabel = `</tbody>
							</table>`;
			let isiTabel = '';
			if (kembalianData) {
				TulisanTemuankecamatan += `<i>${panjangDataDesa} Data.</i>`;
				for (let i = 0; i < panjangDataDesa; i++) {
					let nomor = i + 1;
					let namaDesa = desa[i].nama_desa;
					let id_desa = desa[i].id_desa;

					isiTabel += `<tr id_desa=${id_desa}>
									<th scope="row">${nomor}</th>
									<td>${namaDesa.toUpperCase()}</td>

									<td>
									<span style="font-size: 1.3em; color: Tomato;">
									<i class="fas fa-edit editProduk"></i>

									</span>
									</td >
									</tr>`;
					// console.log(isiTabel);
				}
			} else {
				TulisanTemuankecamatan += '<p class="text-muted">Belum ada data Poduk</p>';
				alert('Data Produk Tidak Ditemukan !');
				$('#daftarProduk').attr('hidden', 'hidden');
				let konfirmasi = 'Apakah anda akan menambahkan data produk ?';
				if (confirm(konfirmasi) == true) {
					window.location.replace("../produk/produk_tambah.php");
				}
			}
			$('#jumlahDatadesa').append(panjangDataDesa);
			keTabel += `${KepalaTabel}${isiTabel}${ekorTabel}`;
			$('#daftarDesa').append(keTabel);
		}
	});
}



// function load_produk() {
// 	const perintah = 'load_produk';
// 	$.ajax({
// 		beforeSend: function () {
// 			$('#info').html("Tunggu...Sedang loading data..");
// 		},
// 		type: "POST",
// 		data: 'perintah=' + perintah,
// 		url: '../API/produk/proses.php',
// 		dataType: "json",
// 		success: function (hasil) {

// 			console.log(hasil);
// 			let kembalianData = hasil[0];
// 			let panjangData = hasil.length;
// 			let TulisanTemuan = '';
// 			let PanjangbahanBakar = '';
// 			let keTabel = '';
// 			let KepalaTabel = `<table class="table table-striped">
// 			<thead>
// 			<tr>
// 			<th scope="col">#</th>
// 			<th scope="col">Produk</th>
// 			<th scope="col">Harga Dasar</th>
// 			<th scope="col">Warna</th>
// 			<th scope="col">Bahan Bakar</th>
// 			<th scope="col">Foto Produk</th>
// 			<th scope="col">Aksi</th>
// 			</tr>
// 			</thead>
// 			<tbody>`;
// 			let ekorTabel = `</tbody>
// 			</table>`;
// 			let isiTabel = '';
// 			if (kembalianData) {
// 				TulisanTemuan += `<i>Ditemukan Produk sebanyak ${panjangData} (${terbilang(panjangData)}) Data.</i>`;
// 				for (let i = 0; i < panjangData; i++) {
// 					let nomor = i + 1;
// 					let aktif = hasil[i].produk.aktif;
// 					let bahanBakar = hasil[i].produk.bahanBakar;
// 					let baru = hasil[i].produk.baru;
// 					let bestSeller = hasil[i].produk.bestSeller;
// 					let fileKatalogProduk = hasil[i].produk.fileKatalogProduk;
// 					let foto_produk = hasil[i].produk.foto_produk;
// 					let banyakFotoProduk = foto_produk.length;
// 					let fotoUtama = hasil[i].produk.fotoUtama;
// 					let hargaDasar = hasil[i].produk.hargaDasar;
// 					let idPilihanWarna = hasil[i].produk.idPilihanWarna;
// 					let id_bahan_bakar = hasil[i].produk.id_bahan_bakar;
// 					let id_kategori = hasil[i].produk.id_kategori;
// 					let id_produk = hasil[i].produk.id_produk;
// 					let kategori = hasil[i].produk.kategori;
// 					let nama_produk = hasil[i].produk.nama_produk;
// 					let nominalDP = hasil[i].produk.nominalDP;
// 					let persenDP = hasil[i].produk.persenDP;
// 					let jumlahFoto = hasil[i].produk.jumlahFoto;
// 					// console.log(jumlahFoto);
// 					let warna = hasil[i].produk.warna;
// 					let nama_bahan_bakar = '';
// 					let kumpulanWarna = '';
// 					let kumpulanFoto = '';
// 					let fotoTampil = '';
// 					if (bahanBakar) {
// 						let PanjangbahanBakar = hasil[i]['produk']['bahanBakar'].length;
// 						for (var j = 0; j < PanjangbahanBakar; j++) {
// 							let id_bahan_bakarj = bahanBakar[j].id_bahan_bakar;
// 							nama_bahan_bakar += bahanBakar[j].nama_bahan_bakar;
// 							nama_bahan_bakar += `<br/>`;
// 						}
// 					}
// 					if (warna) {
// 						let PanjangWarna = hasil[i]['produk']['warna'].length;
// 						for (var k = 0; k < PanjangWarna; k++) {
// 							let namaWarna = warna[k].namaWarna;
// 							let rgb = warna[k].rgb;
// 							kumpulanWarna += `<span style="font-size: 1em; color: ${rgb};"><i class="fas fa-circle"></i></span> ${namaWarna}`;
// 							kumpulanWarna += `<br/>`;
// 						}
// 					}
// 					if (fotoUtama) {
// 						let kumpulanFoto = '';
// 						if (jumlahFoto < 1) {
// 							kumpulanFoto += `<p class='text-muted small'>Produk ini belum memiliki dokumentasi extensi</p>`;
// 						} else {
// 							kumpulanFoto += `<p class='text-muted small'>${jumlahFoto} Dokumentasi extensi</p>`;
// 						}
// 						fotoTampil = `<img class='img img-thumbnail gambar_mobil' src='../foto/produk/utama/${fotoUtama}'>${kumpulanFoto}`;
// 					}

// 					$('#daftarProduk').removeAttr('hidden');
// 					isiTabel += `<tr>
// 					<th scope="row">${nomor}</th>
// 					<td><b>${nama_produk.toUpperCase()}</b></td>
// 					<td>Rp ${numberWithCommas(hargaDasar)}<br>DP: ${persenDP}% (Rp ${numberWithCommas(nominalDP)})</td>
// 					<td>${kumpulanWarna}</td>
// 					<td>${nama_bahan_bakar}</td>
// 					<td>${fotoTampil}</td>
// 					<td>
// 					<span style="font-size: 1.3em; color: Tomato;">
// 					<i class="fas fa-edit editProduk"></i>
// 					<i class="fas fa-trash-alt hapusProduk" id_produk=${id_produk}></i>
// 					</span>
// 					</td >
// 					</tr>`;
// 					// console.log(isiTabel);
// 				}
// 			} else {
// 				TulisanTemuan += '<p class="text-muted">Belum ada data Poduk</p>';
// 				alert('Data Produk Tidak Ditemukan !');
// 				$('#daftarProduk').attr('hidden', 'hidden');
// 				let konfirmasi = 'Apakah anda akan menambahkan data produk ?';
// 				if (confirm(konfirmasi) == true) {
// 					window.location.replace("../produk/produk_tambah.php");
// 				}
// 			}
// 			$('#jumlahData').append(TulisanTemuan);
// 			keTabel += `${KepalaTabel}${isiTabel}${ekorTabel}`;
// 			$('#daftarProduk').append(keTabel);
// 		}
// 	});
// }