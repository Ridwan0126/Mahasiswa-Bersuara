<?php

include 'conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- nama aplikasi kita  -->
  <title>Dashboard Admin | MahasiswaBersuara</title>
  <!-- link untuk css -->
  <link rel="stylesheet" href="../style/dashboardadmin.css?version=<?php echo filemtime('../style/dashboardadmin.css'); ?>">
  <!-- lib fontawesome -->
  <link rel="stylesheet" href="../assets/library/fontawesome/css/all.min.css">
</head>

<body>
  <nav>
    <div class="container">
      <!-- bagian navigation  -->
      <div class="nav_brand">
        <!-- logo aplikasi kita  -->
        <a href="dashboard.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Mahasiswa Bersuara" />
        </a>
        <!-- logo aplikasi  -->
        <a href="dashboard.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
      
      <p>Dashboard Admin</p>
      <!-- menu dropdown -->
      <div class="profile_mahasiswa">
        <div class="name">
          <p><span>Selamat Datang, </span>
          <?php echo $_SESSION['nim']['nama']; ?>
        </p>
        <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
        <input type="checkbox" name="check" id="check" />
        <ul>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </div>
      <!-- menu dropdown -->

      <!-- bagian navigation  -->
      </div>
    </div>
  </nav>

  <!-- bagian body atau menampilkan data -->
  <main>
    <div class="container">
      <h1>LAPORAN MAHASISWA</h1>
      <!-- bagian button opsi  -->
      <div class="buttonTambahDatamahasiswa">
        <div>
          <button><a href="datamahasiswa.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-user"></i> Data Semua mahasiswa</a></button>
        </div>
        <div>
          <button><a href="filter.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-filter"></i> Filter Laporan</a></button>
        </div>
        <div>
          <button><a href="tabel_laporan.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-table"></i> Lihat Laporan Dalam Bentuk Tabel</a></button>
        </div>
      </div>
      <!-- bagian button opsi  -->

      <!-- bagian search  -->
      <form action="" method="get">
        <div class="search">
          <label for="search" class="bold">Search : </label>
          <input type="text" placeholder="cari laporan..." name="search" id="search" name="search">
        </div>
      </form>
      <!-- bagian search  -->

      <!-- bagian filter data sesuai kategori -->
      <form id="search">
        <div class="category_search">
          <label for="category" class="bold">Select Category :</label>
          <span>
            <input type="checkbox" name="all" id="all">
            <label for="all" class="all">ALL</label>
          </span>
          <span>
            <input type="checkbox" name="sarpras" id="sarpras">
            <label for="sarpras" class="sarpras">Sarpras</label>
          </span>
          <span>
            <input type="checkbox" name="laboratorium" id="laboratorium">
            <label for="laboratorium" class="laboratorium">laboratorium</label>
          </span>
          <span>
            <input type="checkbox" name="dosen" id="dosen">
            <label for="dosen" class="dosen">dosen</label>
          </span>
          <span>
            <input type="checkbox" name="universitas" id="universitas">
            <label for="universitas" class="universitas">universitas</label>
          </span>
          <span>
            <input type="checkbox" name="setuju" id="setuju">
            <label for="setuju" class="setuju">Setuju</label>
          </span>
          <span>
            <input type="checkbox" name="tidakSetuju" id="tidakSetuju">
            <label for="tidakSetuju" class="tidakSetuju">Tidak Setuju</label>
          </span>
        </div>
      </form>
      <!-- bagian filter data sesuai kategori  -->

      <!-- bagian untuk menampilkan data  -->
      <div class="riwayat_laporan">
        <?php include '../process/all.php' ?>
      </div>
      <!-- bagian untuk menmpilkan data  -->


    </div>
  </main>
  <!-- bagian body atau menampilkan data -->

  <!-- bagian footer  -->
  <footer>
    <p class="container">UNW | Mahasiswa Bersuara</p>
  </footer>
  <!-- bagian footer  -->

  <!-- untuk javascript -->
  <script>
    let feedback = document.getElementById("feedback");
    let button = document.getElementById("btn_feedback");
    const riwayat = document.querySelector(".riwayat_laporan");
    const search = document.querySelector("#search")
    const span = document.querySelectorAll(".category_search");

    search.addEventListener("keyup", (e) => {
      let xhr = new XMLHttpRequest()

      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          riwayat.innerHTML = `${xhr.responseText}`
        }
      }

      xhr.open("GET", "../process/search.php?keyword=" + e.target.value, true)
      xhr.send();
    })

    span.forEach((e) => {
      e.addEventListener("click", (e) => {
        e.preventDefault()
        console.log(e)
        let xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            riwayat.innerHTML = `${xhr.responseText}`
          }
        }

        xhr.open("GET", "../process/category.php?keycat=" + e.target.className, true)
        xhr.send();
      })
    })

    feedback.addEventListener("keydown", (e) => {
      if (e.target.value.length > 0) {
        button.style.display = "block"
      } else {
        button.style.display = "none"
      }
    })
  </script>
  <!-- untuk javascript -->
</body>

</html>