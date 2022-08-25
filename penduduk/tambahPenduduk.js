$(document).ready(function () {
	// 1207051009140003.
	// https://www.javascriptobfuscator.com/Javascript-Obfuscator.aspx
	$('#inputKK').focus();
	let urlAlamat = 'http://localhost/API2/alamat/v1.0.0/proses.php';
	
	propinsiReset();
	resetSemua();
	load_jenis_jalan();
	// loadAgama();
	loadJenjangPendidikan();
	loadPekerjaan();
	loadCboKawin();
	loadCboHubunganKeluarga();
	loadGolDarah();
	let nomorKK='';
	let propinsiKK='';
	let KabupatenKK='';
	let kecamatanKK='';
	let pilihanKabupaten='';
	let pilihanKecamatan='';
	let tanggalPendaftaranKK='';
	$('#inputKK').bind('keyup paste', function(){
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	$('#inputKK').change(function(event) {
		//PERIKSA NIK KE DALAM DATABASE
		let panjangKK = $(this).val().length;
		nomorKK=$(this).val().replace(/\D/g, '');
		if(panjangKK=16){
			// let PropinsiTerpilih=$('#opt_propinsi option:selected').val();
			propinsiKK=nomorKK.slice(0,2);
			KabupatenKK=nomorKK.slice(2,4);
			kecamatanKK=nomorKK.slice(4,6);
			let tanggal=nomorKK.slice(6,8);
			let bulan=nomorKK.slice(8,10);
			let tahun=nomorKK.slice(10,12);
			let kabupaten=nomorKK.slice(2,4);
			let tahunPembuatanKK='';
			if(tahun<=90){
				tahunPembuatanKK='20';
			}else if(tahun='00'){
				tahunPembuatanKK='20';
			}else{
				tahunPembuatanKK='19';
			}
			tanggalPendaftaranKK=tanggal+'-'+bulan+'-'+tahunPembuatanKK+tahun;
			pilihanKabupaten=propinsiKK+'.'+KabupatenKK;
			pilihanKecamatan=propinsiKK+'.'+KabupatenKK+'.'+kecamatanKK;
			$('#tanggalPembuatanKK').html(', Tanggal daftar KK :'+tanggalPendaftaranKK)+'.';
			load_propinsi();
			$('#namaKepalaKeluarga').focus();
		}else{
			alert('Panjang angka untuk KK harus sebanyak 16 karakter');
			$(this).focus();
			$('#tanggalPembuatanKK').html('');
			propinsiReset();
			resetSemua();
		}
	});
	$('#namaKepalaKeluarga').change(function(e) {
		e.preventDefault();
		let panjangNamaKK = $(this).val().length;
		let namaKK=$(this).val();
		$('#InputNamaWarga').val(namaKK.toUpperCase());
		// $('#InputNamaWarga').val(namaKK).toUpperCase();
		$('#CboHubunganKeluarga option').filter('[value="01"]').attr('selected', 'selected').change();
		$('#CboSesuaiAlamat option').filter('[value="Y"]').attr('selected', 'selected').change();
		$('#CboKewarganegaraan option').filter('[value="wni"]').attr('selected', 'selected').change();
		$('#modalTambahWarga').modal('show');
		$('#InputNIKWarga').focus();
		// $('#modalTambahWarga').modal.show();
	});
	function bersihkanModalDataWarga() {
		$('#modalTambahWarga').find('.modal-title').html(`TAMBAH DATA WARGA`);
		$("input[name='InputNamaWarga']").val('');
		$('#modalTambahWarga').find('.btnSimpanDataWarga').html(`Simpan`);
	}
	modalTambahWarga.addEventListener('hidden.bs.modal', function () {
		bersihkanModalDataWarga();
	});
	
	function resetSemua(){
		kabupatenReset();
		kecamatanReset();
		KelurahanReset();
		DusunReset();
		JalanReset();
		GangReset();
		NamaBangunanReset();
	}
	function propinsiReset(){
		$('#opt_propinsi').attr('disabled', 'disabled');
		$('#opt_propinsi').html(`<option value="">-No Data-</option>`);
	}
	function kabupatenReset(){
		$('#opt_kabupaten').attr('disabled', 'disabled');
		$('#opt_kabupaten').html(`<option value="">-No Data-</option>`);
	}
	function kecamatanReset(){
		$('#opt_kecamatan').attr('disabled', 'disabled');
		$('#opt_kecamatan').html(`<option value="">-No Data-</option>`);
	}
	function KelurahanReset(){
		$('#opt_kelurahan').attr('disabled', 'disabled');
		$('#opt_kelurahan').html(`<option value="">-No Data-</option>`);
	}
	function DusunReset(){
		$('#opt_dusun').attr('disabled', 'disabled');
		$('#opt_dusun').html(`<option value="">-No Data-</option>`);
		$('#buttonDusun').attr('hidden', 'true');
	}
	function JalanReset(){
		$('#opt_jalan').attr('disabled', 'disabled');
		$('#opt_jalan').html(`<option value="">-No Data-</option>`);
		$('#buttonJalan').attr('hidden', 'true');
	}
	function GangReset(){
		$('#opt_gang').attr('disabled', 'disabled');
		$('#opt_gang').html(`<option value="">-No Data-</option>`);
		$('#buttonGang').attr('hidden', 'true');
	}
	function NamaBangunanReset(){
		$('#opt_nama_bangunan').attr('disabled', 'disabled');
		$('#opt_nama_bangunan').html(`<option value="">-No Data-</option>`);
		$('#buttonNamaBangunan').attr('hidden', 'true');
	}
	
	//AWAL HUBUNGAN KELUARGA
	function loadCboHubunganKeluarga() {
		const perintah = 'loadCboHubunganKeluarga';
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data pilihan hubungan keluarga..");
			},
			type: "GET",
			data: 'perintah=' + perintah,
			url: urlUtil,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				let DataHubKeluarga=hasil['CboHubKeluarga'];
				let JumlahPilihan=`<option value="" class='disabled'>-${jumlahData} Pilihan-</option>`;
				$('#CboHubunganKeluarga').append(JumlahPilihan);
				jQuery.each(DataHubKeluarga, function(index, value){
					let id_hub_keluarga=value['id_hub_keluarga'];
					let status_hub_keluarga=value['status_hub_keluarga'];
					let Ket_hubungan=value['Keterangan_hubungan'];
					let pilihan=`<option value="${id_hub_keluarga}" ketHub="${Ket_hubungan}">${status_hub_keluarga}</option>`;
					$('#CboHubunganKeluarga').append(pilihan).change();
				});
			}
		});
	}
	//AKHIR HUBUNGAN KELUARGA
	function load_propinsi() {
		resetSemua();
		$('#opt_propinsi').removeAttr('disabled');
		$('#opt_propinsi').html(``);
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
				$('#opt_propinsi').append(JumlahPilihan);
				jQuery.each(dataPropinsi, function(index, value){
					let id_propinsi=value['id_propinsi'];
					let nama_propinsi=value['nama_propinsi'];
					let pilihan=`<option value="${id_propinsi}">${nama_propinsi}</option>`;
					$('#opt_propinsi').append(pilihan).change();
				});
				if(propinsiKK){
					$('#opt_propinsi option').filter('[value="' + propinsiKK + '"]').attr('selected', 'selected').change();
				}
				kabupatenReset();
			}
		});
	}
	$('#opt_propinsi').change(function() {
		resetSemua();
		let id_propinsi=$('#opt_propinsi option:selected').val();
		if(id_propinsi){
			loadKabupaten(id_propinsi);
			$('#opt_kabupaten').removeAttr('disabled');
		}else{
			kabupatenReset();
		}
	});
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
					$('#opt_kabupaten').html(JumlahPilihanKab);
					jQuery.each(dataKabupaten, function(index, value){
						let id_kabupaten=value['id_kabupaten'];
						let nama_kabupaten=value['nama_kab_kota'];
						let pilihan_kabupaten=`<option value="${id_kabupaten}">${nama_kabupaten}</option>`;
						$('#opt_kabupaten').append(pilihan_kabupaten).change();
					});
					if(kabupatenTerpilihDb){
						$('#opt_kabupaten').removeAttr('disabled');
						$('#opt_kabupaten option').filter('[value="' + pilihanKabupaten + '"]').attr('selected', 'selected').change();
					}
				}else{
					kabupatenReset();
				}
			}
		});
	}
	$('#opt_kabupaten').change(function() {
		let id_kabupaten=$('#opt_kabupaten option:selected').val();
		if(id_kabupaten){
			loadKecamatan(id_kabupaten);
			$('#opt_kecamatan').removeAttr('disabled');
		}else{
			kecamatanReset();
		}
	});
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
					$('#opt_kecamatan').html(JumlahPilihanKec);
					jQuery.each(dataKecamatan, function(index, value){
						let id_kecamatan=value['id_kecamatan'];
						let nama_kecamatan=value['nama_kecamatan'].toUpperCase();
						let pilihan_kecamatan=`<option value="${id_kecamatan}">${nama_kecamatan}</option>`;
						$('#opt_kecamatan').append(pilihan_kecamatan).change();
					// KelurahanReset();
				});
					if(pilihanKecamatan){
						$('#opt_kecamatan option').filter('[value="' + pilihanKecamatan + '"]').attr('selected', 'selected').change();
					}
				}else{
					KelurahanReset();
				}
			}
		});
	}
	$('#opt_kecamatan').change(function() {
		let id_kecamatan=$('#opt_kecamatan option:selected').val();
		if(id_kecamatan){
			loadKelurahan(id_kecamatan);
			$('#opt_kelurahan').removeAttr('disabled');
		}else{
			KelurahanReset();
		}
	});
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
					$('#opt_kelurahan').html(JumlahPilihanKelurahan);
					jQuery.each(dataKelurahan, function(index, value){
						let id_Kelurahan=value['id_desa_kel'];
						let nama_desa=value['nama_desa'].toUpperCase();
						let pilihan_Kelurahan=`<option value="${id_Kelurahan}">${nama_desa}</option>`;
						$('#opt_kelurahan').append(pilihan_Kelurahan).change();
					});
				}else{
					KelurahanReset();
				}
			}
		});
	}
	$('#opt_kelurahan').change(function() {
		let id_Kelurahan=$('#opt_kelurahan option:selected').val();
		if(id_Kelurahan){
			loadDusun();
			$('#opt_dusun').removeAttr('disabled');
		}else{
			DusunReset();
		}
	});
	//DUSUN AWAL
	function loadDusun() {
		const perintah = 'loadDusun';
		let id_Kelurahan=$('#opt_kelurahan option:selected').val();
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
					$('#opt_dusun').removeAttr('disabled');
					let dataDusun=hasil['data_dusun'];
					let JumlahPilihanDusun=`<option value="">-${jumlahData} Pilihan-</option>`;
					$('#opt_dusun').html(JumlahPilihanDusun);
					jQuery.each(dataDusun, function(index, value){
						let id_dusun=value['id_dusun'];
						let nama_dusun=value['nama_dusun'].toUpperCase();
						let pilihan_Dusun=`<option value="${id_dusun}">${nama_dusun}</option>`;
						$('#opt_dusun').append(pilihan_Dusun).change();
					});
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
	$('#opt_dusun').change(function() {
		let id_Dusun=$('#opt_dusun option:selected').val();
		JalanReset();
		if(id_Dusun){
			$('#buttonDusun').removeAttr('hidden');
			$('.buttonTambahDusun').removeAttr('hidden');
			$('.buttonEditDusun').removeAttr('hidden');
			$('.buttonHapusDusun').removeAttr('hidden');
		}else{
			$('.buttonEditDusun').attr('hidden','true');
			$('.buttonHapusDusun').attr('hidden','true');
		}
		loadJalan();
	});
	$(document).on('click', '.buttonTambahDusun', function(event) {
		event.preventDefault();
		let IDKelurahanTerpilih=$('#opt_kelurahan option:selected').val();
		let namaKelurahanTerpilih=$('#opt_kelurahan option:selected').text();
		if (IDKelurahanTerpilih) {
			$('#desaFormDusun').val(namaKelurahanTerpilih);
			$('#modalDusun').modal('show');
			$('#dusunForm').focus();
		} else {
			alert('Silahkan Pilih Nama Kelurahan/Desa !');
			$('#opt_kelurahan').focus();
		}
	});
	$('.btnSimpanDusun').click(function (e) {
		e.preventDefault();
		let ValueDesaTerpilih = $('#opt_kelurahan option:selected').val();
		let NamaDesaTerpilih = $('#opt_kelurahan option:selected').text();
		let DusunBaru = $('#dusunForm').val();
		let panjangNamadusun = $('#dusunForm').val().length;
		let tulisanTombol = $('#modalDusun').find('.btnSimpanDusun').html();
		if (ValueDesaTerpilih) {
			if (!DusunBaru || panjangNamadusun < 3) {
				alert('tidak ada nama dusun atau nama dusun terlalu singkat !');
				$('#dusunForm').focus();
			} else {
				if (tulisanTombol == 'Simpan') {
					let perintah = 'SimpanDusunBaru';
					let type = 'POST';
					let Data = 'perintah=' + perintah + '&id_desa=' + ValueDesaTerpilih + '&namaDusunBaru=' + DusunBaru;
					window.type = type;
					window.data = Data;
					window.url=urlAlamat;
				} else {
					let perintah = 'UpdateDusun';
					let type = 'PUT';
					let idusunUpdate = $("input[name='idusunUpdate']").val();
					let Data = encodeURI('perintah=' + perintah + '&id_desa=' + ValueDesaTerpilih + '&namaDusunBaru=' + DusunBaru + '&idusunUpdate=' + idusunUpdate);
					window.data = Data;
					window.type = type;
					window.url=urlAlamat + '/?' + data;
				}
				$.ajax({
					beforeSend: function () {
						$('#info').html("Tunggu...Sedang menyimpan data lingkungan/dusun..");
					},
					type: type,
					data: data,
					url: url,
					dataType: "json",
					success: function (hasil) {
						let berhasilSimpan = hasil['berhasilSimpan'];
						let berhasilUpdate = hasil['berhasilUpdate'];
						let duplikat = hasil['duplikat'];
						let idDusunBaru = hasil['idDusunBaru'];
						let namaDusunBaru = hasil['namaDusunBaru'];
						if (berhasilSimpan == true) {
							alert(`dusun ${namaDusunBaru} tersimpan di ${NamaDesaTerpilih} dengan ID ${idDusunBaru}\nSilahkan Tambahkan data baru, atau tutup form ini.`);
							$('#dusunForm').val('').focus();
						} else if (berhasilUpdate == true) {
							alert(`Data berhasil diupdate ke ${DusunBaru}`);
							$('#modalDusun').find('.btn-close').trigger('click');
						} else {
							if (duplikat == true) {
								alert(`Nama ${DusunBaru} Sudah ada di database !`);
								$('#dusunForm').focus();
							} else {
								alert('Terjadi Kesalahan !');
							}
						}
					}
				})
			}
		} else {
			alert('Belum ada desa yang dipilih');
			$('#desaFormDusun').focus();
		}
	});
	function bersihkanModalDusun() {
		$('#modalDusun').find('.modal-title').html(`TAMBAH DUSUN`);
		$("input[name='dusunForm']").val('');
		$('#modalDusun').find('.btnSimpanDusun').html(`Simpan`);
	}
	modalDusun.addEventListener('hidden.bs.modal', function () {
		bersihkanModalDusun();
		loadDusun();
	});
	$(document).on('click', '.buttonEditDusun', function (event) {
		event.preventDefault();
		let IdDUsunTerpilih = $('#opt_dusun option:selected').val();
		let namaDUsunTerpilih = $('#opt_dusun option:selected').text();
		let ValueDesaTerpilih = $('#opt_kelurahan option:selected').val();
		let NamaDesaTerpilih = $('#opt_kelurahan option:selected').text();
		let konfirmasi = `Anda akan mengedit ${namaDUsunTerpilih} ? \n Seluruh data alamat dibawah dusun ini akan di update.`;
		if (confirm(konfirmasi) == true) {
			$('#modalDusun').find('.modal-title').html(`EDIT ${namaDUsunTerpilih}`);
			$("input[name='desaFormDusun']").val(`${NamaDesaTerpilih}`);
			$("input[name='dusunForm']").val(`${namaDUsunTerpilih}`);
			$("input[name='idusunUpdate']").val(`${IdDUsunTerpilih}`);
			$('#modalDusun').find('.btnSimpanDusun').html(`Update`);
			$('#modalDusun').modal('show');
			$('#dusunForm').focus();
		} else {
		}
	});
	$(document).on('click', '.buttonHapusDusun', function (event) {
		event.preventDefault();
		let IdDUsunTerpilih = $('#opt_dusun option:selected').val();
		let namaDUsunTerpilih = $('#opt_dusun option:selected').text();
		let konfirmasi = `Yakin akan menghapus data ${namaDUsunTerpilih} ? \n Sistem akan melakukan pencarian alamat yang masih menggunakan data dusun ini.`;
		if (confirm(konfirmasi) == true) {
			hapusDUsun(IdDUsunTerpilih, namaDUsunTerpilih);
			alert('okelah');
		} else {
			return false;
		}
	});
// KE DEPANNYA, PERIKSA APABILA MASIH ADA DATA WARGA YANG MENGGUNAKAN NAMA DUSUN INI
function hapusDUsun(IdDUsunTerpilih, namaDUsunTerpilih) {
	if (IdDUsunTerpilih) {
		let perintah = 'hapusSatuDusun';
		let DataS = 'perintah=' + perintah + '&id_dusun=' + IdDUsunTerpilih + '&namaDUsunTerpilih=' + namaDUsunTerpilih;
		let uri = encodeURI(DataS);
		url = new URL(`${urlAlamat}/?${uri}`);
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang menghapus dusun..");
			},
			type: "DELETE",
			url: url,
			dataType: "json",
			success: function (hasil) {
				if (hasil['berhasilHapus'] == true) {
					alert(`Data ${namaDUsunTerpilih} berhasil dihapus\nData akan diresfresh.`);
					let desaTerpilih = $('#opt_kelurahan option:selected').val();
					loadDusun();
				} else {
					alert(`Terjadi kesalahan pada saat melakukan penghapusan data ${namaDUsunTerpilih}\Silahkan Ulangi, atau hubungi admin.`);
				}
			}
		})
	}
};
//DUSUN AKHIR
//JALAN AWAL
function load_jenis_jalan() {
	const perintah = 'load_jenis_jalan';
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading jenis Jalan..");
		},
		type: "GET",
		data: 'perintah=' + perintah,
		url: urlAlamat,
		dataType: "json",
		success: function (hasil) {
			let jumlahData = formatAngka(hasil['jumlahData']);
			let dataJenisJalan=hasil['dataJenisJalan'];
			let JumlahPilihanJenisJalan=`<option value="">-${jumlahData} Pilihan-</option>`;
			$('#id_type_jalan').html(JumlahPilihanJenisJalan);
			jQuery.each(dataJenisJalan, function(index, value){
				let kode_adm_jalan =value['kode_adm_jalan'];
				let nama_kode_jalan=value['nama_kode'].toUpperCase();
				let pilihan_Type_Jalan=`<option value="${kode_adm_jalan}">${nama_kode_jalan}</option>`;
				$('#id_type_jalan').append(pilihan_Type_Jalan);
			});
		}
	});
}
function loadJalan() {
	const perintah = 'loadJalan';
	let id_dusun=$('#opt_dusun option:selected').val();
	$.ajax({
		beforeSend: function () {
			$('#info').html("Tunggu...Sedang loading data dusun..");
		},
		type: "GET",
		data: 'perintah=' + perintah+'&id_dusun='+id_dusun,
		url: urlAlamat,
		dataType: "json",
		success: function (hasil) {
			let jumlahData = formatAngka(hasil['jumlahData']);
			if(jumlahData>0){
				let dataJalan=hasil['dataJalan'];
				let JumlahPilihanJalan=`<option value="">-${jumlahData} Pilihan-</option>`;
				$('#opt_jalan').html(JumlahPilihanJalan);
				$('#opt_jalan').removeAttr('disabled');
				jQuery.each(dataJalan, function(index, value){
					let id_jalan =value['id_jalan'];
					let nama_jalan=value['nama_jalan'].toUpperCase();
					let type_adm=value['type_adm'];
					let pilihan_Jalan=`<option value="${id_jalan}" IdtypeJalan=${type_adm}>${nama_jalan}</option>`;
					$('#opt_jalan').append(pilihan_Jalan).change();
				});
			}else{
				JalanReset();
				GangReset();
				NamaBangunanReset();
			}
			$('#buttonJalan').removeAttr('hidden');
			$('.buttonTambahJalan').removeAttr('hidden');
			$('.buttonEditJalan').attr('hidden','true');
			$('.buttonHapusJalan').attr('hidden','true');
		}
	});
}
$('#opt_jalan').change(function() {
	let id_Jalan=$('#opt_jalan option:selected').val();
	GangReset();
	NamaBangunanReset();
	loadSimpangGang();
	loadNamaBangunan();
	if(id_Jalan){
		$('#buttonJalan').removeAttr('hidden');
		$('.buttonTambahJalan').removeAttr('hidden');
		$('.buttonEditJalan').removeAttr('hidden');
		$('.buttonHapusJalan').removeAttr('hidden');
	}else{
		$('.buttonEditJalan').attr('hidden','true');
		$('.buttonHapusJalan').attr('hidden','true');
	}
});
$(document).on('click', '.buttonTambahJalan', function(event) {
	event.preventDefault();
	let IdDusunTerpilih=$('#opt_dusun option:selected').val();
	let namaDusunTerpilih=$('#opt_dusun option:selected').text();
	if (IdDusunTerpilih) {
		$('#dusunFormJalan').val(namaDusunTerpilih);
		$('#modalJalan').modal('show');
		$('#JalanForm').focus();
	} else {
		alert('Silahkan Pilih Nama RT/RW/Dusun/Link. !');
		$('#opt_dusun').focus();
	}
});
function bersihkanModalJalan() {
	$('#modalJalan').find('.modal-title').html(`Tambah Nama Jalan`);
		// $('#desaFormDusun option:not(:first)').remove();
		$("input[name='dusunFormJalan']").val('');
		$("input[name='JalanForm']").val('');
		$('#modalJalan').find('.btnSimpanJalan').html(`Simpan`);
	}
	modalJalan.addEventListener('hidden.bs.modal', function () {
		bersihkanModalJalan();
		loadJalan();
	});
	$('.btnSimpanJalan').click(function (e) {
		e.preventDefault();
		let ValueDusunTerpilih = $('#opt_dusun option:selected').val();
		let NamaDusunTerpilih = $('#opt_dusun option:selected').text();
		let JalanBaru = $('#JalanForm').val();
		let panjangNamaJalan = $('#JalanForm').val().length;
		let tulisanTombol = $('#modalJalan').find('.btnSimpanJalan').html();
		let IDJalanTerpilih = $('#opt_jalan option:selected').val();
		let id_type_jalan = $('#id_type_jalan option:selected').val();
		if (ValueDusunTerpilih) {
			if (!JalanBaru || panjangNamaJalan < 3) {
				alert('tidak ada nama Jalan atau nama Jalan terlalu singkat !');
				$('#JalanForm').focus();
			} else {
				if (tulisanTombol == 'Simpan') {
					let perintah = 'SimpanJalanBaru';
					let type = 'POST';
					let Data = 'perintah=' + perintah + '&ValueDusunTerpilih=' + ValueDusunTerpilih + '&namaJalanBaru=' + JalanBaru+'&id_type_jalan='+id_type_jalan;
					window.type = type;
					window.data = Data;
					window.url=urlAlamat;
				} else {
					let perintah = 'UpdateJalan';
					let type = 'PUT';
					let idJalanUpdate = $("input[name='idJalanUpdate']").val();
					let Data = encodeURI('perintah=' + perintah + '&idJalanUpdate=' + idJalanUpdate + '&namaJalanBaru=' + JalanBaru + '&id_type_jalan=' + id_type_jalan+'&ValueDusunTerpilih='+ValueDusunTerpilih);
					window.data = Data;
					window.type = type;
					window.url=urlAlamat + '/?' + data;
				}
				$.ajax({
					beforeSend: function () {
						$('#info').html("Tunggu...Sedang menyimpan data Jalan..");
					},
					type: type,
					data: data,
					url: url,
					dataType: "json",
					success: function (hasil) {
						let berhasilSimpan = hasil['berhasilSimpan'];
						let berhasilUpdate = hasil['berhasilUpdate'];
						let duplikat = hasil['duplikat'];
						let idJalanBaru = hasil['idJalanBaru'];
						let namaJalanBaru = hasil['namaJalanBaru'];
						if (berhasilSimpan == true) {
							alert(`Nama Jalan ${namaJalanBaru} tersimpan di ${NamaDusunTerpilih} dengan ID ${idJalanBaru}\nSilahkan Tambahkan data baru, atau tutup form ini.`);
							$('#JalanForm').val('').focus();
						} else if (berhasilUpdate == true) {
							alert(`Data berhasil diupdate ke ${JalanBaru}`);
							$('#modalJalan').find('.btn-close').trigger('click');
						} else {
							if (duplikat == true) {
								alert(`Nama Jalan ${JalanBaru} Sudah ada di database !`);
								$('#JalanForm').focus();
							} else {
								alert('Terjadi Kesalahan !');
							}
						}
					}
				})
			}
		} else {
			alert('Belum ada RT/RW/Dusun/Link yang dipilih');
			$('#JalanForm').focus();
		}
	});
	$(document).on('click', '.buttonEditJalan', function (event) {
		event.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let namaJalanTerpilih = $('#opt_jalan option:selected').text();
		var IdtypeJalan = $('#opt_jalan').find('option:selected').attr('idtypejalan');
		let IdDusunTerpilih = $('#opt_dusun option:selected').val();
		let NamaDusunTerpilih = $('#opt_dusun option:selected').text();
		let konfirmasi = `Anda akan mengedit ${namaJalanTerpilih} ? \n Seluruh data alamat dibawah jalan ini akan di update.`;
		if (confirm(konfirmasi) == true) {
			$('#modalJalan').find('.modal-title').html(`EDIT NAMA JALAN : ${namaJalanTerpilih}`);
			$("input[name='dusunFormJalan']").val(`${NamaDusunTerpilih}`);
			$("input[name='JalanForm']").val(`${namaJalanTerpilih}`);
			$("input[name='idJalanUpdate']").val(`${IdJalanTerpilih}`);
			$('#id_type_jalan option').filter('[value="' + IdtypeJalan + '"]').attr('selected', 'selected').change();
			$('#modalJalan').find('.btnSimpanJalan').html(`Update`);
			$('#modalJalan').modal('show');
			$('#JalanForm').focus();
		} 
	});
	$(document).on('click', '.buttonHapusJalan', function (event) {
		event.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let namaJalanTerpilih = $('#opt_jalan option:selected').text();
		let konfirmasi = `Yakin akan menghapus data jalan ${namaJalanTerpilih} ? \n Sistem akan melakukan pencarian alamat yang masih menggunakan data jalan ini.`;
		if (confirm(konfirmasi) == true) {
			hapusSatuJalan(IdJalanTerpilih, namaJalanTerpilih);
		} else {
			return false;
		}
	});
// KE DEPANNYA, PERIKSA APABILA MASIH ADA DATA WARGA YANG MENGGUNAKAN NAMA DUSUN INI
function hapusSatuJalan(IdJalanTerpilih, namaJalanTerpilih) {
	if (IdJalanTerpilih) {
		let perintah = 'hapusSatuJalan';
		let DataS = 'perintah=' + perintah + '&IdJalan=' + IdJalanTerpilih;
		let uri = encodeURI(DataS);
		url = new URL(`${urlAlamat}/?${uri}`);
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang menghapus dusun..");
			},
			type: "DELETE",
			url: url,
			dataType: "json",
			success: function (hasil) {
				if (hasil['berhasilHapus'] == true) {
					alert(`Data ${namaJalanTerpilih} berhasil dihapus\nData akan diresfresh.`);
					// let desaTerpilih = $('#opt_kelurahan option:selected').val();
					loadJalan();
				} else {
					alert(`Terjadi kesalahan pada saat melakukan penghapusan data jalan ${namaJalanTerpilih}\Silahkan Ulangi, atau hubungi admin.`);
				}
			}
		})
	}
};
	//JALAN AKHIR
	//GANG AWAL
	function loadSimpangGang() {
		const perintah = 'loadSimpangGang';
		let id_Jalan=$('#opt_jalan option:selected').val();
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data simpang/Gang/Lorong..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_Jalan='+id_Jalan,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					let dataSimpangGang=hasil['dataSimpangGang'];
					let JumlahPilihanJalan=`<option value="">-${jumlahData} Pilihan-</option>`;
					$('#opt_gang').html(JumlahPilihanJalan);
					$('#opt_gang').removeAttr('disabled');
					jQuery.each(dataSimpangGang, function(index, value){
						let id_simpang_gang =value['id_simpang_gang'];
						let nama_simpang_gang=value['nama_simpang_gang'];
						let type_adm=value['type_adm'];
						let pilihan_Jalan=`<option value="${id_simpang_gang}">${nama_simpang_gang}</option>`;
						$('#opt_gang').append(pilihan_Jalan);
					});
				}else{
					GangReset();
				}
				$('#buttonGang').removeAttr('hidden');
				$('.buttonTambahGang').removeAttr('hidden');
				$('.buttonEditGang').attr('hidden','true');
				$('.buttonHapusGang').attr('hidden','true');
			}
		});
	}
	$('#opt_gang').change(function() {
		let id_Gang=$('#opt_gang option:selected').val();
		loadNamaBangunan();
		if(id_Gang){
			$('#buttonGang').removeAttr('hidden');
			$('.buttonTambahGang').removeAttr('hidden');
			$('.buttonEditGang').removeAttr('hidden');
			$('.buttonHapusGang').removeAttr('hidden');
		}else{
			NamaBangunanReset();
			$('#buttonGang').removeAttr('hidden');
			$('.buttonTambahGang').removeAttr('hidden');
			$('.buttonEditGang').attr('hidden','true');
			$('.buttonHapusGang').attr('hidden','true');
		}
	});
	$(document).on('click', '.buttonTambahGang', function(event) {
		event.preventDefault();
		let IdJalanTerpilih=$('#opt_jalan option:selected').val();
		let namaJalanTerpilih=$('#opt_jalan option:selected').text();
		if (IdJalanTerpilih) {
			$('#JalanFormSimpangGang').val(namaJalanTerpilih);
			$('#modalSimpangGang').modal('show');
			$('#SimpangGangFormSimpang').focus();
		} else {
			alert('Silahkan Pilih Nama Jalan. !');
			$('#opt_jalan').focus();
		}
	});
	$(document).on('click', '.buttonEditGang', function (event) {
		event.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let namaJalanTerpilih = $('#opt_jalan option:selected').text();
		let IdGangTerpilih = $('#opt_gang option:selected').val();
		let namaGangTerpilih = $('#opt_gang option:selected').text();
		let konfirmasi = `Anda akan mengedit ${namaGangTerpilih} ? \n Seluruh data alamat di lokasi ini akan di update.`;
		if (confirm(konfirmasi) == true) {
			$('#modalSimpangGang').find('.modal-title').html(`EDIT : ${namaGangTerpilih}`);
			$("input[name='IdSimpangGangUpdate']").val(`${IdGangTerpilih}`);
			$("input[name='JalanFormSimpangGang']").val(`${namaJalanTerpilih}`);
			$("input[name='SimpangGangFormSimpang']").val(`${namaGangTerpilih}`);
			$('#modalSimpangGang').find('.btnSimpanSimpangGang').html(`Update`);
			$('#modalSimpangGang').modal('show');
			$('#SimpangGangFormSimpang').focus();
		} 
	});
	function bersihkanModalSimpangGang() {
		$('#modalSimpangGang').find('.modal-title').html(`Tambah Nama Persimpangan/Gang/Lorong`);
		$("input[name='IdSimpangGangUpdate']").val('');
		$("input[name='JalanFormSimpangGang']").val('');
		$("input[name='SimpangGangFormSimpang']").val('');
		$('#modalJalan').find('.btnSimpanSimpangGang').html(`Simpan`);
	}
	modalSimpangGang.addEventListener('hidden.bs.modal', function () {
		bersihkanModalSimpangGang();
		loadSimpangGang();
	});
	$('.btnSimpanSimpangGang').click(function (e) {
		e.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let NamaJalanTerpilih = $('#opt_jalan option:selected').text();
		let NamaSimpangGangBaru = $('#SimpangGangFormSimpang').val();
		let panjangNamaJalan = $('#SimpangGangFormSimpang').val().length;
		let tulisanTombol = $('#modalSimpangGang').find('.btnSimpanSimpangGang').html();
		let IdSimpangUpdate = $('#IdSimpangGangUpdate').val();
		if (IdJalanTerpilih) {
			if (!NamaSimpangGangBaru || panjangNamaJalan < 3) {
				alert('tidak ada nama Persimpangan/Gang/Lorong atau penamaan alamat terlalu singkat !');
				$('#SimpangGangFormSimpang').focus();
			} else {
				if (tulisanTombol == 'Simpan') {
					let perintah = 'SimpanSimpangGangBaru';
					let type = 'POST';
					let Data = 'perintah=' + perintah + '&IdJalanTerpilih=' + IdJalanTerpilih + '&NamaSimpangGangBaru=' + NamaSimpangGangBaru;
					window.type = type;
					window.data = Data;
					window.url=urlAlamat;
				} else {
					let perintah = 'UpdateSimpangGangBaru';
					let type = 'PUT';
					let IdSimpangGangUpdate = $("input[name='IdSimpangGangUpdate']").val();
					let Data = encodeURI('perintah=' + perintah + '&IdSimpangGangUpdate=' + IdSimpangGangUpdate + '&NamaSimpangGangBaru=' + NamaSimpangGangBaru+'&IdJalanTerpilih='+IdJalanTerpilih);
					window.data = Data;
					window.type = type;
					window.url=urlAlamat + '/?' + data;
				}
				$.ajax({
					beforeSend: function () {
						$('#info').html("Tunggu...Sedang menyimpan data Persimpangan/Gang/Lorong..");
					},
					type: type,
					data: data,
					url: url,
					dataType: "json",
					success: function (hasil) {
						let berhasilSimpan=hasil['berhasilSimpan'];
						let duplikat=hasil['duplikat'];
						let idGangBaru=hasil['idGangBaru'];
						let jumlah_Duplikat=hasil['jumlah_Duplikat'];
						let jumlah_Gang=hasil['jumlah_Gang'];
						let kodeRespon=hasil['kodeRespon'];
						let namaGangBaru=hasil['namaGangBaru'];
						let berhasilUpdate=hasil['berhasilUpdate'];
						if (berhasilSimpan == true) {
							alert(`Nama Persimpangan/Gang/Lorong ${namaGangBaru} tersimpan di Jalan ${NamaJalanTerpilih} dengan ID ${idGangBaru}\nSilahkan Tambahkan data baru, atau tutup form ini.`);
							$('#JalanFormSimpangGang').val('').focus();
						} 
						else if (berhasilUpdate == true) {
							alert(`Data berhasil diupdate ke ${NamaSimpangGangBaru}`);
							$('#modalSimpangGang').find('.btn-close').trigger('click');
						} 
						else {
							if (duplikat == true) {
								alert(`Nama Persimpangan/Gang/Lorong ${NamaSimpangGangBaru} Sudah ada di database !`);
								$('#SimpangGangFormSimpang').focus();
							} else {
								alert('Terjadi Kesalahan !');
							}
						}
					}
				})
			}
		} else {
			alert('Belum ada Persimpangan/Gang/Lorong yang dipilih');
			$('#opt_jalan').focus();
		}
	});
	$(document).on('click', '.buttonHapusGang', function (event) {
		event.preventDefault();
		let IdGangTerpilih = $('#opt_gang option:selected').val();
		let namaGangTerpilih = $('#opt_gang option:selected').text();
		let konfirmasi = `Yakin akan menghapus data Persimpangan/Gang/Lorong ${namaGangTerpilih} ? \n Sistem akan melakukan pencarian alamat yang masih menggunakan data lokasi ini.`;
		if (confirm(konfirmasi) == true) {
			hapusSatuGang(IdGangTerpilih, namaGangTerpilih);
		} else {
			return false;
		}
	});
// KE DEPANNYA, PERIKSA APABILA MASIH ADA DATA WARGA YANG MENGGUNAKAN NAMA DUSUN INI
function hapusSatuGang(IdGangTerpilih, namaGangTerpilih) {
	if (IdGangTerpilih) {
		let perintah = 'hapusSatuGang';
		let DataS = 'perintah=' + perintah + '&IdGang=' + IdGangTerpilih;
		let uri = encodeURI(DataS);
		url = new URL(`${urlAlamat}/?${uri}`);
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang menghapus Persimpangan/Gang/Lorong..");
			},
			type: "DELETE",
			url: url,
			dataType: "json",
			success: function (hasil) {
				if (hasil['berhasilHapus'] == true) {
					alert(`Data ${namaGangTerpilih} berhasil dihapus\nData akan diresfresh.`);
					loadSimpangGang();
				} else {
					alert(`Terjadi kesalahan pada saat melakukan penghapusan data Persimpangan/Gang/Lorong ${namaGangTerpilih}\n Silahkan Ulangi, atau hubungi admin.`);
				}
			}
		})
	}
};
	//GANG AKHIR
	//NAMA BANGUNAN AWAL
	function loadNamaBangunan() {
		const perintah = 'loadNamaBangunan';
		let id_Jalan=$('#opt_jalan option:selected').val();
		let id_Gang=$('#opt_gang option:selected').val();
		$.ajax({
			beforeSend: function () {
				$('#info').html("Tunggu...Sedang loading data Nama Bangunan/Tempat/Toko..");
			},
			type: "GET",
			data: 'perintah=' + perintah+'&id_Jalan='+id_Jalan+'&id_Gang='+id_Gang,
			url: urlAlamat,
			dataType: "json",
			success: function (hasil) {
				let jumlahData = formatAngka(hasil['jumlahData']);
				if(jumlahData>0){
					let dataNamaBangunan=hasil['dataNamaBangunan'];
					let JumlahPilihanBanguan=`<option value="">-${jumlahData} Pilihan-</option>`;
					$('#opt_nama_bangunan').html(JumlahPilihanBanguan);
					$('#opt_nama_bangunan').removeAttr('disabled');
					jQuery.each(dataNamaBangunan, function(index, value){
						let id_nama_bangunan =value['id_nama_bangunan'];
						let nama_bangunan_tempat=value['nama_bangunan_tempat'];
						let nomor_rumah_bangunan=value['nomor_rumah_bangunan'];
						let pilihan_Bangunan=`<option value="${id_nama_bangunan}">${nama_bangunan_tempat}</option>`;
						$('#opt_nama_bangunan').append(pilihan_Bangunan);
					});
					$('#buttonNamaBangunan').removeAttr('hidden');
					$('.buttonTambahBangunan').removeAttr('hidden');
					$('.buttonEditNamaBangunan').attr('hidden','true');
					$('.buttonHapusNamaBangunan').attr('hidden','true');
				}else{
					NamaBangunanReset();
					$('#buttonNamaBangunan').removeAttr('hidden');
					$('.buttonTambahBangunan').removeAttr('hidden');
					$('.buttonEditNamaBangunan').attr('hidden','true');
					$('.buttonHapusNamaBangunan').attr('hidden','true');
				}
			}
		});
	}
	$('#opt_nama_bangunan').change(function() {
		let idBangunanTerpilih=$('#opt_nama_bangunan option:selected').val();
		if(idBangunanTerpilih){
			$('#buttonNamaBangunan').removeAttr('hidden');
			$('.buttonTambahBangunan').removeAttr('hidden');
			$('.buttonEditNamaBangunan').removeAttr('hidden');
			$('.buttonHapusNamaBangunan').removeAttr('hidden');
		}else{
			NamaBangunanReset();
			$('#buttonNamaBangunan').removeAttr('hidden');
			$('.buttonTambahBangunan').removeAttr('hidden');
			$('.buttonEditNamaBangunan').attr('hidden','true');
			$('.buttonHapusNamaBangunan').attr('hidden','true');
		}
	});
	$(document).on('click', '.buttonTambahBangunan', function(event) {
		event.preventDefault();
		let id_Jalan=$('#opt_jalan option:selected').val();
		let Nama_Jalan=$('#opt_jalan option:selected').text();
		let id_Gang=$('#opt_gang option:selected').val();
		let Nama_Gang=$('#opt_gang option:selected').text();
		if (id_Jalan) {
			$('#JalanFormNamaBangunan').val(Nama_Jalan);
			if(id_Gang){
				$('#SimpangGangFormNamaBangunan').val(Nama_Gang);
			}else{
				$('#SimpangGangFormNamaBangunan').attr('disabled', 'true');
				$('#SimpangGangFormNamaBangunan').val('');
			}
			$('#modalNamaBangunan').modal('show');
			$('#InputFormNamaBangunan').focus();
		} else {
			alert('Silahkan Pilih Nama Jalan. !');
			$('#opt_jalan').focus();
		}
	});
	$(document).on('click', '.buttonHapusNamaBangunan', function (event) {
		event.preventDefault();
		let IdBangunanTerpilih = $('#opt_nama_bangunan option:selected').val();
		let namaBangunanTerpilih = $('#opt_nama_bangunan option:selected').text();
		let konfirmasi = `Yakin akan menghapus data bangunan/tempat ${namaBangunanTerpilih} ? \n Sistem akan melakukan pencarian alamat yang masih menggunakan data lokasi ini.`;
		if (confirm(konfirmasi) == true) {
			hapusSatuBangunan(IdBangunanTerpilih, namaBangunanTerpilih);
		} else {
			return false;
		}
	});
	function hapusSatuBangunan(IdBangunanTerpilih, namaBangunanTerpilih) {
		if (IdBangunanTerpilih) {
			let perintah = 'hapusSatuBangunan';
			let DataS = 'perintah=' + perintah + '&IdBangunanTerpilih=' + IdBangunanTerpilih;
			let uri = encodeURI(DataS);
			url = new URL(`${urlAlamat}/?${uri}`);
			$.ajax({
				beforeSend: function () {
					$('#info').html("Tunggu...Sedang menghapus data bangunan/tempat..");
				},
				type: "DELETE",
				url: url,
				dataType: "json",
				success: function (hasil) {
					if (hasil['berhasilHapus'] == true) {
						alert(`Data bangunan/tempat ${namaBangunanTerpilih} berhasil dihapus\nData akan diresfresh.`);
						loadNamaBangunan();
					} else {
						alert(`Terjadi kesalahan pada saat melakukan penghapusan data bangunan/tempat ${namaBangunanTerpilih}\Silahkan Ulangi, atau hubungi admin.`);
					}
				}
			})
		}
	};
	function bersihkanModalNamaBangunan() {
		$('#modalNamaBangunan').find('.modal-title').html(`Tambah Nama Bangunan/Tempat/Toko`);
		$("input[name='JalanFormNamaBangunan']").val('');
		$("input[name='SimpangGangFormNamaBangunan']").val('');
		$("input[name='SimpangGangFormNamaBangunan']").removeAttr('disabled');
		$("input[name='InputFormNamaBangunan']").val('');
		$('#modalJalan').find('.btnSimpanNamaBangunan').html(`Simpan`);
	}
	modalNamaBangunan.addEventListener('hidden.bs.modal', function () {
		bersihkanModalNamaBangunan();
		loadNamaBangunan();
	});
	$(document).on('click', '.buttonEditNamaBangunan', function (event) {
		event.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let namaJalanTerpilih = $('#opt_jalan option:selected').text();
		let IdGangTerpilih = $('#opt_gang option:selected').val();
		let namaGangTerpilih = $('#opt_gang option:selected').text();
		let idBangunanTerpilih=$('#opt_nama_bangunan option:selected').val();
		let namaBangunanTerpilih=$('#opt_nama_bangunan option:selected').text();
		let konfirmasi = `Anda akan mengedit nama bangunan/tempat ${namaBangunanTerpilih} ? \n Seluruh data alamat di lokasi ini akan di update.`;
		if (confirm(konfirmasi) == true) {
			$('#modalNamaBangunan').find('.modal-title').html(`EDIT : ${namaBangunanTerpilih}`);
			$("input[name='IdNamaBangunanUPdate']").val(`${idBangunanTerpilih}`);
			$("input[name='JalanFormNamaBangunan']").val(`${namaJalanTerpilih}`);
			if(IdGangTerpilih){
				$("input[name='SimpangGangFormNamaBangunan']").val(`${namaGangTerpilih}`);
			}else{
				$("input[name='SimpangGangFormNamaBangunan']").val(``).attr('disabled', 'disabled');;
			}
			$("input[name='InputFormNamaBangunan']").val(`${namaBangunanTerpilih}`);
			$('#modalNamaBangunan').find('.btnSimpanNamaBangunan').html(`Update`);
			$('#modalNamaBangunan').modal('show');
			$('#InputFormNamaBangunan').focus();
		} 
	});
	$('.btnSimpanNamaBangunan').click(function (e) {
		e.preventDefault();
		let IdJalanTerpilih = $('#opt_jalan option:selected').val();
		let NamaJalanTerpilih = $('#opt_jalan option:selected').text();
		let IdSimpangTerpilih = $('#opt_gang option:selected').val();
		let NamaSimpangTerpilih = $('#SimpangGangFormSimpang').val();
		let NamaBangunanBaru = $('#InputFormNamaBangunan').val();
		let panjangNamaBangunan = $('#InputFormNamaBangunan').val().length;
		let IdNamaBangunanUpdate = $('#IdNamaBangunanUPdate').val();
		let tulisanTombolBangunan = $('#modalNamaBangunan').find('.btnSimpanNamaBangunan').html();
		if (IdJalanTerpilih) {
			if (!NamaBangunanBaru || panjangNamaBangunan < 3) {
				alert('tidak ada nama Bangunan atau penamaan alamat terlalu singkat !');
				$('#InputFormNamaBangunan').focus();
			} else {
				if (tulisanTombolBangunan == 'Simpan') {
					let perintah = 'SimpanNamaBangunanBaru';
					let type = 'POST';
					let Data = 'perintah=' + perintah + '&IdJalanTerpilih=' + IdJalanTerpilih + '&IdSimpangTerpilih=' + IdSimpangTerpilih+'&NamaBangunanBaru='+NamaBangunanBaru;
					window.type = type;
					window.data = Data;
					window.url=urlAlamat;
				} else {
					let perintah = 'UpdateNamaBangunanBaru';
					let type = 'PUT';
					// let IdSimpangGangUpdate = $("input[name='IdSimpangGangUpdate']").val();
					let Data = encodeURI('perintah=' + perintah + '&IdNamaBangunanUpdate=' + IdNamaBangunanUpdate + '&IdJalanTerpilih=' + IdJalanTerpilih+'&IdSimpangTerpilih='+IdSimpangTerpilih+'&NamaBangunanBaru='+NamaBangunanBaru);
					window.data = Data;
					window.type = type;
					window.url=urlAlamat + '/?' + data;
				}
				$.ajax({
					beforeSend: function () {
						$('#info').html("Tunggu...Sedang menyimpan data Bangunan..");
					},
					type: type,
					data: data,
					url: url,
					dataType: "json",
					success: function (hasil) {
						let NamaBangunanBaru=hasil['NamaBangunanBaru'];
						let berhasilSimpan=hasil['berhasilSimpan'];
						let duplikat=hasil['duplikat'];
						let idBangunanBaru=hasil['idBangunanBaru'];
						let jumlahBangunan=hasil['jumlahBangunan'];
						let jumlah_Duplikat=hasil['jumlah_Duplikat'];
						let kodeRespon=hasil['kodeRespon'];
						let berhasilUpdate=hasil['berhasilUpdate'];
						if (berhasilSimpan == true) {
							alert(`Nama Bangunan ${NamaBangunanBaru} tersimpan di Jalan ${NamaJalanTerpilih} dengan ID ${idBangunanBaru}\nSilahkan Tambahkan data baru, atau tutup form ini.`);
							$('#InputFormNamaBangunan').val('').focus();
						} 
						else if (berhasilUpdate == true) {
							alert(`Data berhasil diupdate ke ${NamaBangunanBaru}`);
							$('#modalNamaBangunan').find('.btn-close').trigger('click');
						} 
						else {
							if (duplikat == true) {
								alert(`Nama bangunan ${NamaBangunanBaru} Sudah ada di database !`);
								$('#InputFormNamaBangunan').focus();
							} else {
								alert('Terjadi Kesalahan !');
							}
						}
					}
				})
			}
		} else {
			alert('Belum ada nama jalan dipilih');
			$('#opt_jalan').focus();
		}
	});
	//NAMA BANGUNAN AKHIR
	//akhir dari kode.
});