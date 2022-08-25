$(document).ready(function () {
	load_tanpa_KK();
	$(".tombolKembali").click(function (event) {
		event.preventDefault();
		history.back(1);
	});

	function load_tanpa_KK() {
		const perintah = 'load_tanpa_KK';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data penduduk..");
			},
			type: "POST",
			data: 'perintah=' + perintah,
			url: '../API/penduduk/penduduk_proses.php',
			dataType: "json",
			success: function (hasil) {
				// console.log(hasil);
				let panjangData = hasil['length'];
				$('#judul').prepend(panjangData);
				let tabelData = '';
				let nomor = 1;
				jQuery.each(hasil, function (index, item) {
					let nama_lengkap = item['nama_lengkap'];
					let alamat_jalan = item['alamat_jalan'];
					let id_orang = item['id_orang'];
					let JK = item['jk'];
					let nik = item['nik'];
					let status_kawin = item['status_kawin'];
					let tpt_lahir = item['tpt_lahir'];
					let tgl_lahir = item['tgl_lahir'];
					let lahiran = tgl_lahir.split('-');
					let tahunLahir = lahiran[0];
					let bulanLahir = lahiran[1];
					let hariLahir = lahiran[2];
					let tanggalLahirTampil = `${hariLahir}-${bulanLahir}-${tahunLahir}`;
					// let alamat = item['alamat_jalan'];
					let umur = item['umur'];
					console.log(tanggalLahirTampil);
					tabelData += `<tr>
					<th scope="row">${nomor++}</th>
					<td>${nik}</td>
					<td>${nama_lengkap}</td>
					<td>${JK}</td>
					<td>${umur}</td>
					<td>${status_kawin}</td>
					<td>${alamat_jalan}</td>
					<td>${tpt_lahir} / ${tanggalLahirTampil}</td>
					<td>Aksi</td></tr>`;
				});
				$('tbody').html(tabelData);
			}
		});
	}
});