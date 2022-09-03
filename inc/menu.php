<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
  <div class="container">
    <a class="navbar-brand" href="../home/index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../penduduk/home.php">Penduduk</a>
        </li>
       <!--  <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../alamat/home.php">Alamat</a>
        </li> -->
        
      <!--     <li class="nav-item">
            <a class="nav-link" href="#">Layanan</a>
          </li> -->
        <!--   <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Setting
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../alamat/home.php">alamat</a></li>
              <li><a class="dropdown-item" href="../setting/bahanBakar.php">Bahan Bakar</a></li>
              <li><a class="dropdown-item" href="../dealer/home.php">Dealer</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../user/home.php">User</a></li>
                <li><a class="dropdown-item" href="../akun/home.php">Akun Medsos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../pelanggan/home.php">Pelanggan</a></li>
                <li><a class="dropdown-item" href="../testimoni/home.php">Testimoni</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../promo/home.php">Promo</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../chart/home.php">Chart</a></li>
              </ul>
            </li> -->
         <!--  <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> -->
        </ul>
    <!--   <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Penduduk/Alamat" aria-label="Cari penduduk">
        <button class="btn btn-outline-success btnCari" type="submit">Cari</button>
      </form> -->
    </div>
  </div>
</nav>
<script type="text/javascript">
  $(document).on('click', '.btnCari', function(event) {
    event.preventDefault();
   console.log('hasil cari');
  });
  // $('.btnCari').click(function(event) {
  //  console.log('hasil cari');
  // });
</script>