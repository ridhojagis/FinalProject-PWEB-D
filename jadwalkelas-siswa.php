<!-- <?php
session_start();
?> -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/389e9b29e9.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="sticky-top d-flex align-items-center" style="background-color: rgba(5, 87, 158, 0.9);">
      <div class="container d-flex align-items-center justify-content-between">
  
        <h1 class="logo"><a href="">Sekolahku</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href=index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <?php
          if(isset($_SESSION['email'])) {
        ?>
        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto" href="dashboard-siswa.php">Dashboard</a></li>
            <li>
              <div class="dropdown">
                <!-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown button
                </button> -->
                <a class="getstarted scrollto dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['email']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="profil-siswa.php">Profil</a>
                  <a class="dropdown-item" href="logout.php">Keluar</a>
                </ul>
              </div>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <?php
          }
        ?>
      </div>
    </header>
    <!-- End Header -->

    <div class="s008" style="background-image: url(./assets/img/bg-login.jpg);">
      <form>
        <div class="inner-form">
          <div class="advance-search">
            <h2 class="desc" align="center">Daftar Kelas</h2>
            <div class="row">
              <div class="col input-field">
                <span>Nama</span>
                <div class="">
                  <input type="text" class="form-control" id="nama" placeholder="Nama Guru" />
                </div>
              </div>
              <div class="input-field">
                <span>Mata Pelajaran</span>
                <div class="input-select">
                  <select id="lokasi" data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Semua Mata Pelajaran</option>
                    <option>Matematika</option>
                    <option>Fisika</option>
                    <option>Kimia</option>
                    <option>Biologi</option>
                    <option>B. Inggris</option>
                    <option>B. Indonesia</option>
                    <option>Penjaskes</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="group-btn">
                <button class="btn btn-primary" onclick="search()">Temukan</button>
              </div>
            </div>
            <div><br></div>
          </div>
        </div>
      </form>
    </div>


    <div class="foto">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col lg-12 info-panel">
            <div class="row row-cols-1 row-cols-md-4 g-4">
   
            <!-- <?php
                include_once("database/db_connection.php");
                $name = (isset($_GET['nama'])) ? $_GET['nama'] : '';
                $location = (isset($_GET['lokasi'])) ? $_GET['lokasi'] : '';
                
                $fotografer = "SELECT p.pjasa_id, p.pjasa_nama, p.pjasa_alamat, p.pjasa_foto, f.*, k.* FROM penyedia_jasa AS p
                                INNER JOIN penyedia_jasa_rangkap AS r ON p.pjasa_id = r.pjasa_id
                                INNER JOIN fotografer as f ON r.ftg_id = f.ftg_id
                                INNER JOIN fotografer_kategori fk ON fk.ftg_id = f.ftg_id
                                INNER JOIN kategori_jasa k ON k.ktg_id = fk.ktg_id
                                WHERE p.pjasa_id NOT IN ($nonaktif)";
                                // AND p.pjasa_id IN ($terverifikasi)";
                $query = "SELECT DISTINCT(pjasa_id), pjasa_nama, pjasa_alamat, ftg_id, ftg_rating, ftg_tarif 
                          FROM ($fotografer) ftg
                          WHERE pjasa_nama LIKE '%$name%'
                          AND pjasa_alamat LIKE '%$location%'
                          -- AND ftg_rating > $ratingMin AND ftg_rating <= $ratingMax
                          AND ktg_kategori LIKE '%$category%'";
                

                if($result = mysqli_query($conn, $query)) { 
                  
                } else {
                  $error = $conn->errno . ' ' . $conn->error;
                  echo $error; // 1054 Unknown column 'foo' in 'field list'
                }

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                    $nama = $row['guru_nama'];
                    $id = $row['guru_id'];
                    // $ftgid = $row['ftg_id'];
                    // $alamat = $row['pjasa_alamat'];
                  ?> -->
                  <div class="col mx-auto">
                    <div class="card h-100 text-center">
                      <img src="/assets/img/blog/comments-1.jpg" width=100px height=100px class="rounded-circle mx-auto" alt="...">
                      <div class="card-body">
                        <div class="card-title">
                          <h5><?php echo $nama; ?></h5>
                          <h7><?php echo $alamat;?></h7>
                        </div>
                        <p>
                          <?php
                            $kategori = "SELECT ktg_kategori FROM kategori_jasa AS k
                                        INNER JOIN fotografer_kategori AS fk ON k.ktg_id = fk.ktg_id
                                        INNER JOIN fotografer AS f ON fk.ftg_id = f.ftg_id
                                        WHERE f.ftg_id = $ftgid";
                            $resultKategori = mysqli_query($conn, $kategori);
                            echo "Kategori: <br>";
                            while($rowKategori = $resultKategori->fetch_assoc()){
                              ?>
                              <div class="bd-highlight">
                                <?php echo $rowKategori['ktg_kategori']; ?>
                              </div>
                              <?php                             
                            }
                          ?>
                          
                        </p>
                        <a href="profil_sediajasa.php?id=<?php echo $id; ?>" class="btn btn-primary text-white">Kunjungi Profil</a>
                      </div>
                    </div>
                  </div>     
                <?php
                  }
                } else {
                  echo "<h1>Tidak ada hasil</h1>";
                }
                ?>
            </div>
        </div>
      </div>
    </div>

    <footer id="footer">
  
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>Sekolahku</span></strong>
        </div>
      </div>
    </footer><!-- End Footer -->
    <script src="assets/js/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const choices = new Choices("select", {
        searchEnabled: false,
        itemSelectText: "",
        removeItemButton: true,
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/search.js"></script>
  </body>
  <!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
