$(document).ready(function () {
	load_nik_ganda();
	$(".tombolKembali").click(function (event) {
		event.preventDefault();
		history.back(1);
	});

	function load_nik_ganda() {
		const perintah = 'load_nik_ganda';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data penduduk..");
			},
			type: "POST",
			data: 'perintah=' + perintah,
			url: '../API/penduduk/penduduk_proses.php',
			dataType: "json",
			success: function (hasil) {
				console.log(hasil);
				let tabelData = '';
				let nomor = 1;
				jQuery.each(hasil, function (index, item) {
					let nama_lengkap = item['nama_lengkap'];
					let id_orang = item['id_orang'];
					let nik = item['nik'];
					let no_kk = item['no_kk'];
					let tpt_lahir = item['tpt_lahir'].toUpperCase();
					let tgl_lahir = item['tgl_lahir'].toUpperCase();
					let alamat = item['alamat_jalan'].toUpperCase();
					let umur = item['umur'];
					console.log(hasil);
					tabelData += `<tr>
					<th scope="row">${nomor++}</th>
					<td>${nik}</td>
					<td>${no_kk}</td>
					<td>${nama_lengkap}</td>
					<td>${alamat}</td>
 <					
					<td>${tpt_lahir}/${tgl_lahir}</td>
					<td>${umur}</td>
					<td>Edit</td></tr>`;
				});
				$('tbody').html(tabelData);
			}
		});
	}
});