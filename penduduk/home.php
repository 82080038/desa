 <?php
 include '../inc/header.php';

 ?>

 <div class="row">
    <div class="col-sm-12">
       <h3>Data Penduduk 
       </h3>
    </div>
 </div>
 <div class="row">
    <div class="col-sm-2">
       <div class="input-group input-group-sm mb-3">
          <select class="form-select" aria-label="Default select example" id="pilihanDusun" hidden>
          </select>
       </div>
    </div>
 </div>
 <div class="row">
   <div class="col-sm-6">
      <div id="jumlahDataPenduduk"></div>
      <!-- <a class="btn btn-sm btn-outline-primary float-end" id="tambahKKBaru" role="button" modeForm='tambahKK'><i class="fa-solid fa-plus me-2"></i>Tambah KK Baru</a> -->
      <a class="btn btn-sm btn-outline-primary mt-4" id="tambahKKBaru" role="button" modeForm='tambahKK'><i class="fa-solid fa-plus me-2"></i>Tambah KK Baru</a>
   </div>
   <div class="col-sm-6" id="rowDetilDusun">
    <div class="accordion" id="accordionExample">
       <!-- pertama status KK -->
       <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <text id="judulStatusKK"></text>
             </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                <div id="seluruhHubunganKK"></div>
             </div>
          </div>
       </div>
       <!-- kedua  status Perkawinan-->
       <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <text id="JudulStatusPerkawinan"></text>
             </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                <div id="seluruhPerkawinan"></div>
             </div>
          </div>
       </div>
       <!-- ketiga  hubungan keluarga-->
       <div class="accordion-item">
          <h2 class="accordion-header" id="headingThere">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThere" aria-expanded="true" aria-controls="collapseThere">
                <text id="JudulHubunganKeluarga"></text>
             </button>
          </h2>
          <div id="collapseThere" class="accordion-collapse collapse" aria-labelledby="headingThere" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                <div id="seluruhHubungan"></div>
             </div>
          </div>
       </div>
       <!-- keempat jenjang pendidikan-->
       <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                <text id="JudulJenjangPendidikan"></text>
             </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                <div id="seluruhPendidikan"></div>
             </div>
          </div>
       </div>
       <!-- keempat jenis pekerjaan-->
       <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                <text id="JudulJenisPekerjaan"></text>
             </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                <div id="PekerjaanSemuanya"></div>
             </div>
          </div>
       </div>
    </div>
 </div>
</div>
<div class="row mt-2">
   <hr/>
   <div class="col" id="dataLengkap" style="font-size: 1em; ">
   </div>
</div>
<script type="text/javascript" src="home.js"></script>
<!-- <script type="text/javascript" src="array.js"></script> -->
<?php
include '../inc/footer.php';
?>

<!-- <a class="btn btn-primary" data-bs-toggle="modal" href="#modalKK" role="button">Open first modal</a> -->
<div class="modal fade" id="modalKK" aria-hidden="true" aria-labelledby="modalKKToggleLabel" tabindex="-1">
 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
       <div class="modal-header">
          <h5 class="modal-title judulModalKK">DATA KELUARGA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
          <div id="contohTabelKeluarga"></div>
       </div>
    </div>
 </div>
</div>
<div class="modal fade" id="modalDetilWarga" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
       <div class="modal-header">
          <h5 class="modal-title judulModalDetilWarga">DATA KELUARGA</h5>
          <button class="btn btn-primary btn-sm btn-close btn_tutup_keluarga" data-bs-target="#modalKK" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <?php include 'formPenduduk.php' ?>
    </div>
 </div>
</div>
<!-- //MODAL CARI KK BARU  -->
<div class="modal" tabindex="-1" id="modalKKBaru">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">KELUARGA BARU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        <form>
           <div class="mb-3">
            <input type="text" class="form-control" id="nikwargabaru" hidden>
            <label for="nikKKbaru" class="form-label">NIK KEPALA KELUARGA</label>
            <input type="text" class="form-control" id="nikKKbaru">
            <div id="nikKKbaruHelp" class="form-text">Kartu keluarga baru dimulai dari adanya NIK kepala keluarga.</div>
         </div>
         <div class="mb-3">
          <label for="namaKKbaru" class="form-label">NAMA KEPALA KELUARGA</label>
          <input type="text" class="form-control" id="namaKKbaru">
       </div>
       <div class="mb-3">
          <label for="nomorKKbaru" class="form-label">Masukkan nomor KK baru</label>
          <input type="email" class="form-control" id="nomorKKbaru" aria-describedby="emailHelp">
       </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
 </div> -->
 <!-- <button type="button" class="btn btn-primary">Ok</button> -->
</form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary btn_dismiss_modalKKBaru" data-bs-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary">OK</button>
</div>
</div>
</div>
</div>
<!-- //MODAL CARI KK BARU  -->