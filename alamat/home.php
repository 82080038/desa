<?php 
include '../inc/header.php'; 
?>
<h3 class="text-center">Data Alamat</h3><p id="data_jumlah_alamat"></p>
<hr>
<div class="row">
  <div class="col-sm-3">
    <h5 id="judulKeterangan">Data Utama</h5>
    <form>
      <div class="row mb-3">
        <label for="propinsi" class="col-sm-2 col-form-label">Propinsi</label>
        <div class="col-sm-10">
         <select class="form-select propinsi" aria-label="Default select example">
         </select>
       </div>
     </div>
     <div class="row mb-3">
      <label for="kabupaten" class="col-sm-2 col-form-label">Kab/Kota</label>
      <div class="col-sm-10">
       <select class="form-select kabupaten" aria-label="Default select example">
       </select>
     </div>
   </div>
   <div class="row mb-3">
    <label for="kecamatan" class="col-sm-2 col-form-label">Kec.</label>
    <div class="col-sm-10">
     <select class="form-select kecamatan" aria-label="Default select example">
     </select>
   </div>
 </div>
 <div class="row mb-3">
  <label for="desa" class="col-sm-2 col-form-label">Kel/Desa</label>
  <div class="col-sm-10">
   <select class="form-select desa" aria-label="Default select example">
   </select>
 </div>
</div>

</form>
</div>
<div class="col-sm-3" id="dataAlamat">
  <h5 id="">Data Dusun <button type="button" class="btn btn-sm btn-primary btnModalDusun" data-bs-toggle="modal" data-bs-target="#modalDusun">
    +
  </button></h5>
  <div id="dataDusun"></div>
</div>
<div class="col-sm-3 col-md-3" id="dataAlamat">
  <h5 id="judulKeterangan">Data Jalan <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalJalan">
    +
  </button></h5>
</div>

<div class="col-sm-3" id="dataAlamat">
  <h5 id="judulKeterangan">Data Tempat<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTempat">
    +
  </button></h5>
</div>
</div>
<?php 
include '../inc/footer.php'; 
?>
<script type="text/javascript" src="home.js"></script>
<div class="modal fade" id="modalDusun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Dusun</h5>
        <button type="button" class="btn-close tutupModalDusun" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="namaDusunBaru" class="form-label">Nama Dusun</label>
          <input type="text" class="form-control" id="namaDusunBaru" placeholder="Dusun">
        </div>
        <label for="namaDusunBaru" class="form-label">Aktivasi</label>
        <select class="form-select" aria-label="Default select akstivasi">
          <option value="Y">Y</option>
          <option value="N">N</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary simpanDusun">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalJalan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jalan</h5>
        <button type="button" class="btn-close tutupModalJalan" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="namaDusunJalan" class="form-label">Nama Dusun</label>
          <select class="form-select namaDusunJalan" aria-label="Default select namaDusunJalan">

          </select>
        </div>
        <div class="mb-3">
          <label for="namaJalanBaru" class="form-label">Nama Jalan</label>
          <input type="text" class="form-control" id="namaJalanBaru" placeholder="Jalan...">
        </div>
        <label for="aktivasiJalanBaru" class="form-label">Aktivasi</label>
        <select class="form-select" aria-label="Default select aktivasiJalanBaru">
          <option value="Y">Y</option>
          <option value="N">N</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary simpanJalan">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalTempat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tempat</h5>
        <button type="button" class="btn-close tutupModalJalan" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="namaDusunJalan" class="form-label">Nama Dusun</label>
          <select class="form-select namaDusunJalan" aria-label="Default select namaDusunJalan">

          </select>
        </div>
        <div class="mb-3">
          <label for="namaJalanBaru" class="form-label">Nama Jalan</label>
          <input type="text" class="form-control" id="namaJalanBaru" placeholder="Jalan...">
        </div>
        <div class="mb-3">
          <label for="namaJalanBaru" class="form-label">Nama Tempat</label>
          <input type="text" class="form-control" id="namaJalanBaru" placeholder="Jalan...">
        </div>
        <div class="mb-3">
          <label for="namaDusunJalan" class="form-label">Jenis Tempat</label>
          <select class="form-select namaDusunJalan" aria-label="Default select namaDusunJalan">

          </select>
        </div>
        <div class="mb-3">
          <label for="namaDusunJalan" class="form-label">Sub Jenis Tempat</label>
          <select class="form-select namaDusunJalan" aria-label="Default select namaDusunJalan">

          </select>
        </div>
        <label for="aktivasiJalanBaru" class="form-label">Aktivasi</label>
        <select class="form-select" aria-label="Default select aktivasiJalanBaru">
          <option value="Y">Y</option>
          <option value="N">N</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary simpanJalan">Simpan</button>
      </div>
    </div>
  </div>
</div>