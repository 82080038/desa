 <?php 
 include '../inc/header.php'; 
 ?>

 <div class="row">
  <div class="col-sm-12">
    <h3>Tambah Data Penduduk </h3>  
  </div>
</div>
<div class="row">
  <div class="col-4">
    <div class="mb-1">
      <label for="inputKK" class="form-label">Nomor KK</label><span id="tanggalPembuatanKK"></span>
      <input type="text" maxlength="16" class="form-control form-control-sm" id="inputKK" name="inputKK" aria-describedby="emailHelp" placeholder="16 digit">
    </div>
  </div>
  <div class="col-8">
   <div class="mb-1">
     <label for="exampleInputEmail1" class="form-label">Nama Kepala Keluarga</label>
     <input type="text" class="form-control form-control-sm" id="namaKepalaKeluarga" name="namaKepalaKeluarga" aria-describedby="emailHelp" placeholder=" contoh : JESNARIA BR TARIGAN">
   </div>
 </div>
</div>
<div class="row mt-2">
 <div class="col-6">
  <table class="table table-sm">
   <tr>
    <td>Provinsi</td>
    <td>:</td>
    <td>
     <select class="form-select form-select-sm" aria-label="Default select example" id="opt_propinsi" name="opt_propinsi" name="opt_propinsi" value="">
     </select>
   </td>
 </tr>
 <tr>
  <td>Kabupaten/Kota</td>
  <td>:</td>
  <td>
   <select class="form-select form-select-sm" aria-label="Default select example" id="opt_kabupaten" name="opt_kabupaten" name="opt_kabupaten" value="">
   </select>
 </td>
</tr>
<tr>
  <td>Kecamatan</td>
  <td>:</td>
  <td>
   <select class="form-select form-select-sm" aria-label="Default select example" id="opt_kecamatan" name="opt_kecamatan" name="opt_kecamatan" value="">
   </select>
 </td>
</tr>
<tr>
  <td>Desa/Kelurahan</td>
  <td>:</td>
  <td>
   <select class="form-select form-select-sm" aria-label="Default select example" id="opt_kelurahan" name="opt_kelurahan" name="opt_kelurahan" value="">
   </select>
 </td>
</tr>
<tr>
  <td>RT/RW/Dusun/Link.</td>
  <td>:</td>
  <td>
    <div class="input-group input-group-sm">
      <select class="form-select form-select-sm" aria-label="Default select example" id="opt_dusun" name="opt_dusun" name="opt_dusun" value="">
      </select>
      <span class="input-group-text input-group-sm" id="buttonDusun">
        <!-- <div class="btn-group" role="group" aria-label="Basic example"> -->
         <button type="button" class="btn btn-sm btn-primary buttonTambahDusun">+</button>
         <button type="button" class="btn btn-sm btn-warning buttonEditDusun">!</button>
         <button type="button" class="btn btn-sm btn-danger buttonHapusDusun">x</button>
         <!-- </div> -->
       </span>
     </div>
   </td>
 </tr>
</table>
</div>
<div class="col-6">
 <table class="table table-sm">
  <tr>
    <td>Alamat Jalan</td>
    <td>:</td>
    <td>
      <div class="input-group input-group-sm">
        <select class="form-select form-select-sm" aria-label="Default select example" id="opt_jalan" name="opt_jalan" name="opt_jalan" value="">
        </select>
        <span class="input-group-text input-group-sm" id="buttonJalan">
          <!-- <div class="btn-group" role="group" aria-label="Basic example"> -->
           <button type="button" class="btn btn-sm btn-primary buttonTambahJalan">+</button>
           <button type="button" class="btn btn-sm btn-warning buttonEditJalan">!</button>
           <button type="button" class="btn btn-sm btn-danger buttonHapusJalan">x</button>
           <!-- </div> -->
         </span>
       </td>
     </tr>
     <tr>
      <td>Alamat Simpang/Gang/Lorong</td>
      <td>:</td>
      <td>
       <div class="input-group input-group-sm">
        <select class="form-select form-select-sm" aria-label="Default select example" id="opt_gang" name="opt_gang" name="opt_gang" value="">
        </select>
        <span class="input-group-text input-group-sm" id="buttonGang">
         <button type="button" class="btn btn-sm btn-primary buttonTambahGang">+</button>
         <button type="button" class="btn btn-sm btn-warning buttonEditGang">!</button>
         <button type="button" class="btn btn-sm btn-danger buttonHapusGang">x</button>
       </span>
     </td>
   </tr>
   <tr>
    <td>Nama Bangunan/Tempat/Toko</td>
    <td>:</td>
    <td>
     <div class="input-group input-group-sm">
      <select class="form-select form-select-sm" aria-label="Default select example" id="opt_nama_bangunan" name="opt_nama_bangunan" name="opt_nama_bangunan" value="">
      </select>
      <span class="input-group-text input-group-sm" id="buttonNamaBangunan">
       <button type="button" class="btn btn-sm btn-primary buttonTambahBangunan">+</button>
       <button type="button" class="btn btn-sm btn-warning buttonEditNamaBangunan">!</button>
       <button type="button" class="btn btn-sm btn-danger buttonHapusNamaBangunan">x</button>
     </span>
   </td>
 </tr>
 <tr>
  <td>Nomor Rumah/Bangunan</td>
  <td>:</td>
  <td>
   <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="contoh : 123A">
 </td>
</tr>
<tr>
 <td>Kode Pos</td>
 <td>:</td>
 <td>
  <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="12345">
</td>
</tr>
</table>
</div>
</div>
<div class="row">
  <div class="col">
    <button class="btn btn-sm btn-primary">Tambah</button>
  </div>
</div>
<div class="row mt-2">
 <div class="col-12">
  <table class="table table-bordered table-sm table-responsive table-hover">
    <thead>
      <tr class="text-center bg-primary text-light">
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">NIK</th>
        <th scope="col">JK</th>
        <th scope="col">Tempat Lahir</th>
        <th scope="col">Tgl.Lahir</th>
        <th scope="col">Agama</th>
        <th scope="col">Pendidikan</th>
        <th scope="col">Pekerjaan</th>
      </tr>
      <tr class="text-center bg-secondary">
        <th scope="col" >#</th>
        <th scope="col" >(1)</th>
        <th scope="col" >(2)</th>
        <th scope="col" >(3)</th>
        <th scope="col" >(4)</th>
        <th scope="col" >(5)</th>
        <th scope="col" >(6)</th>
        <th scope="col" >(7)</th>
        <th scope="col" >(8)</th>
      </tr>
    </thead>
    <tbody>
     <tr>
       <td>1</td>
       <td>JESNARIA BR TARIGAN</td>
       <td>1207056304720001</td>
       <td class="text-center">P</td>
       <td>PANCUR BATU</td>
       <td>20/04/1972</td>
       <td>PROTESTAN</td>
       <td>AKADEMI D3 DIPLOMA</td>
       <td>TIDAK BEKERJA</td>
     </tr>
   </tbody>
 </table>
</div>
<div class="col-12">
  <table class="table table-bordered table-sm">
   <thead class="text-center align-middle"> 
    <tr class="bg-primary text-light">
     <th scope="col"  rowspan="2" >#</th>
     <th scope="col" rowspan="2" >Stat.Kawin</th>
     <th scope="col" rowspan="2" >Stat.Hubungan<br/>Keluarga</th>
     <th scope="col" rowspan="2">Kewarganegaraan</th>
     <th scope="col col-2" colspan="2" >Dokumen Imigrasi
     </th>
     <th scope="col" colspan="2" >Nama Orang Tua</th>
     <th scope="col"  rowspan="2" >HP</th>
   </tr>
   <tr class="bg-primary text-light">
     <th scope="col" >No.Passpor</th>
     <th scope="col" >No. KITAS/KITAP</th>
     <th scope="col" >Ayah</th>
     <th scope="col" >Ibu</th>
   </tr>
   <tr class="text-center bg-secondary">
     <th scope="col" >#</th>
     <th scope="col" >(9)</th>
     <th scope="col" >(10)</th>
     <th scope="col" >(11)</th>
     <th scope="col col-2" colspan="2" rowspan="2" >(12)<br/>
     </th>
     <th scope="col" colspan="2" >(13)</th>
     <th scope="col" colspan="2" >(14)</th>
   </tr>
 </thead>
 <tbody class="align-middle">
  <tr>
    <th scope="row">1</th>
    <td>BELUM KAWIN</td>
    <td>KEPALA KELUARGA</td>
    <td>INDONESIA</td>
    <td>12345</td>
    <td>12345</td>
    <td>SI ANU</td>
    <td>SI ANI</td>
    <td>081265511982</td>
  </tr>
</tbody>
</table>
</div>
</div>
<script type="text/javascript" src="tambahPenduduk.js">
</script>
<?php 
include '../inc/footer.php'; 
include 'modalTambahPenduduk.php'; 

?>

<!-- awal modal dusun -->
<div class="modal" tabindex="-1" id="modalDusun">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lingkungan/Dusun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form>
        <input type="text" class="form-control d-none" id="idusunUpdate" name='idusunUpdate'>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Desa</label>
          <input type="text" class="form-control" name="desaFormDusun" id="desaFormDusun">
          <!-- <select class="form-select" aria-label="Default select example" id="desaFormDusun">
          </select> -->
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nama Lingkungan / Dusun</label>
          <input type="text" class="form-control" id="dusunForm" name='dusunForm' autofocus placeholder="Mulai dengan tulisan LINGK. atau DUSUN, diikuti nama lingk/dusun">
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary btnSimpanDusun">Simpan</button>
   </div>
 </div>
</div>
</div>
<!-- Akhir modal dusun -->
<!-- AWAL MODAL JALAN -->
<div class="modal" tabindex="-1" id="modalJalan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Tambah Nama Jalan</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       <form>
        <input type="text" class="form-control d-none" id="idJalanUpdate" name='idJalanUpdate'>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Dusun</label>
          <input type="text" class="form-control" name="dusunFormJalan" id="dusunFormJalan">
          <!-- <select class="form-select" aria-label="Default select example" id="desaFormDusun">
          </select> -->
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nama Jalan</label>
          <input type="text" class="form-control" id="JalanForm" name='JalanForm' autofocus placeholder="Mulai dengan tulisan jl. (diikuti dengan titik)">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Type Jalan</label>
          <select class="form-select form-select-sm" aria-label="Default select example" name="id_type_jalan" id="id_type_jalan">
          </select>
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary btnSimpanJalan">Simpan</button>
   </div>
 </div>
</div>
</div>
<!-- AKHIR MODAL JALAN -->
<!-- AWAL MODAL SIMPANG GANG -->
<div class="modal" tabindex="-1" id="modalSimpangGang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Tambah Nama Persimpangan/Gang/Lorong</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       <form>
        <input type="text" class="form-control d-none" id="IdSimpangGangUpdate" name='IdSimpangGangUpdate'>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Jalan</label>
          <input type="text" class="form-control" name="JalanFormSimpangGang" id="JalanFormSimpangGang">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nama Persimpangan/Gang/Lorong</label>
          <input type="text" class="form-control" id="SimpangGangFormSimpang" name='SimpangGangFormSimpang' autofocus placeholder="Mulai dengan tulisan Simpang, atau Gg, atau Lr.">
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary btnSimpanSimpangGang">Simpan</button>
   </div>
 </div>
</div>
</div>
<!-- AKHIR MODAL SIMPANG GANG -->
<!-- AWAL MODAL NAMA BANGUNAN -->
<div class="modal" tabindex="-1" id="modalNamaBangunan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title">Tambah Nama Bangunan/Tempat/Toko</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
       <form>
         <input type="text" class="form-control d-none" id="IdNamaBangunanUPdate" name='IdNamaBangunanUPdate'>
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Jalan</label>
          <input type="text" class="form-control" name="JalanFormNamaBangunan" id="JalanFormNamaBangunan">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nama Persimpangan/Gang/Lorong</label>
          <input type="text" class="form-control" id="SimpangGangFormNamaBangunan" name='SimpangGangFormNamaBangunan'>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nama Bangunan</label>
          <input type="text" class="form-control" id="InputFormNamaBangunan" name='InputFormNamaBangunan'/>
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary btnSimpanNamaBangunan">Simpan</button>
   </div>
 </div>
</div>
</div>
<!-- AKHIR MODAL NAMA BANGUNAN -->