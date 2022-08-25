<!-- AWAL MODAL TAMBAH DATA PENDUDUK -->
<!-- https://www.scribd.com/document/383950380/Kode-Pengisian-Data-Kk -->
<!-- https://kependudukanpemdadiy.files.wordpress.com/2010/07/petunjuk-pengisian-data-kepala-keluarga-kk-formulir-f-1-01-per-keluarga.pdf -->
<div class="modal" tabindex="-1" id="modalTambahWarga">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">TAMBAH DATA WARGA</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       <form>
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <input type="text" class="form-control d-none" id="IdWargaUPdate" name='IdWargaUPdate'>
              <!--  <div class="mb-0">
                <label for="CboSesuaiAlamat" class="form-label">Kepala Keluarga</label>
                <select class="form-select form-select-sm" aria-label="Default select example" name="CboSesuaiAlamat" id="CboSesuaiAlamat">
                  <option value="N">Tidak</option>
                  <option value="Y">Ya</option>
                </select>
              </div>
            -->
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
                <!-- <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                  <label class="form-check-label" for="inlineCheckbox1">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                </div> -->
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
            <div class="col">
              <div class="mb-0">
                <label for="CboHubunganKeluarga" class="form-label">Hubungan Keluarga</label>
                <select class="form-select form-select-sm" aria-label="Default select example" name="CboHubunganKeluarga" id="CboHubunganKeluarga">
                </select>
              </div> 

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
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-sm btn-primary btnSimpanDataWarga">Simpan</button>
   </div>
 </div>
</div>
</div>
<!-- AKHIR MODAL NAMA BANGUNAN