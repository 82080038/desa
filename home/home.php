<?php 
include '../inc/header.php'; 
?>
<h6>Desa Hulu, Kec. Pancur Batu, Kab. Deli serdang, Prop. Sumatera Utara</h6><hr>
<div class="row">
  <div class="col-sm-4">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <text id="judulDusun"></text>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div id="jumlahDusun"></div>
            <div class="list-group" id="listDusun">
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <text id="JudulJumlahWarga"></text>
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p class="text-dark" id="jumlahKK"></p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <!-- Hubungan Keluarga -->
              <text id="JudulHubunganKeluarga"></text>
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body text-dark">
             <ul class="list" id="seluruhHubungan"></ul>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="col-sm-4">
  <div class="accordion" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          <text id="JudulStatusPerkawinan"></text>
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
         <ul class="list-inline text-dark" id="seluruhPerkawinan"></ul>
       </div>
     </div>
   </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
       <text id="JudulRentangUmur"></text>
     </button>
   </h2>
   <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body">
     <ul class="list-inline text-dark" id="listUmur"></ul>
   </div>
 </div>
</div>
<div class="accordion-item">
  <h2 class="accordion-header" id="flush-headingThree">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      <!-- Agama -->
      <text id="JudulJumlahAgama"></text>
    </button>
  </h2>
  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body">
     <ul class="text-dark" id="listAgama"></ul>
   </div>
 </div>
</div>
</div>
</div>
<div class="col-sm-4">
  <div class="accordion" id="accordianKetiga">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingSatuKetiga">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseKetigaSatu" aria-expanded="false" aria-controls="flush-collapseKetigaSatu">
          <text id="JudulJumlahPekerjaan"></text>
          <!-- Pekerjaan -->
        </button>
      </h2>
      <div id="flush-collapseKetigaSatu" class="accordion-collapse collapse" aria-labelledby="flush-headingSatuKetiga" data-bs-parent="#accordianKetiga">
        <div class="accordion-body text-dark">
          <div id="listPekerjaan"></div>
          <!-- <ul class="list" id="listPekerjaan"></ul> -->
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingDuaKetiga">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseKetigaDua" aria-expanded="false" aria-controls="flush-collapseKetigaDua">
         <text id="JudulTingkatPendidikan"></text>
         <!-- Tingkat Pendidikan -->
       </button>
     </h2>
     <div id="flush-collapseKetigaDua" class="accordion-collapse collapse" aria-labelledby="flush-headingDuaKetiga" data-bs-parent="#accordianKetiga">
      <div class="accordion-body text-dark">
        <div id="listPendidikan"></div>
        <!-- <ul class="list" id="listPendidikan"></ul> -->
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script src="home.js" type="text/javascript" /></script>
<?php 
include '../inc/footer.php'; 
?>
<!--  http://gcctech.org/csc/javascript/javascript_keycodes.htm
 JavaScript KeyCode
In every browser there are three possible kinds of client-side events triggered when a keyboard key is pressed or released:
keydown event
keypress event
keyup event
The keydown event occurs when the keyboard key is pressed, and it is followed at once by the execution of keypress event.
The keyup event is generated when the key is released.
Here is a sample program using the keycodes You can view it's source to the the actual coding
  -->