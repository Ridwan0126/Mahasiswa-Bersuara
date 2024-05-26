<?php

session_start();
include 'admin/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | MahasiswaBersuara</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- bagian 1 - navbar -->
  <nav>
    <div class="container">
      <div class="nav_brand">
        <a href="index.php" style="text-decoration: none; margin-top: 5px;">
          <img src="assets/img/pre-logo.png" alt="Logo Mahasiswa Berusara" />
        </a>
        <a href="index.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
      <label class="burger_menu" style="top: 22px" for="burger" id="label">
        <input type="checkbox" name="burger" id="burger" />
      </label>
      <ul class="list_link" id="link">
        <li class="btn_login"><a href="mahasiswa/loginmahasiswa.php">Login</a></li>
      </ul>
      <?php if (isset($_SESSION['nim'])) { ?>
        <div class="btn">
          <a href="logout.php">Logout</a>
        </div>
      <?php } else { ?>
        <div class="btn">
          <a href="mahasiswa/loginmahasiswa.php">Login</a>
        </div>
      <?php } ?>
    </div>
  </nav>
  <!-- akhir bagian 1 - navbar -->

  <!-- bagian 2 - hero konten -->
  <main>
    <div class="container">
      <!-- hero konten - Kiri -->
      <sect ion class="left" data-aos="fade-up" data-aos-duration="1500">
        <h1 style="color: #008DDA;">Layanan Pengaduan mahasiswa Ngudi Waluyo</h1>
        <p style="color: #008DDA;">
          Suarakan keluhan anda disini, kami siap memprosesnya dengan cepat
        </p>
        <a href="mahasiswa/pengaduan.php" style="background-color: #008DDA; color: white">Laporkan!</a>
      </sect>
      <!-- akhir hero konten - kiri -->

      <!-- hero konten - Kanan -->
      <section class="right" data-aos="fade-up" data-aos-duration="1500">
        <img src="assets/img/speaker.png" style="margin-top: 68px;" alt="Speaker" />
      </section>
      <!-- akhir hero konten - Kanan -->
    </div>
  </main>


  <!-- responsive hamburger -->
  <script src="mahasiswa/script.js"></script>
  <!-- akhir responsive hamburger -->

  <!-- scroll animation -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

  <script>
    function animateCount(elementId, endValue) {
      const element = document.getElementById(elementId);
      const duration = 1500; // Durasi animasi dalam milidetik
      const frameDuration = 1000 / 60; // Durasi setiap frame animasi (60 FPS)
      const totalFrames = Math.round(duration / frameDuration);
      const step = (endValue - 0) / totalFrames;
      let currentFrame = 0;

      const animation = setInterval(() => {
        currentFrame++;
        element.innerText = Math.round(0 + step * currentFrame);
        if (currentFrame === totalFrames) {
          clearInterval(animation);
          element.innerText = endValue;
        }
      }, frameDuration);
    }

    // Fungsi untuk mengecek apakah elemen dalam tampilan atau tidak
    function handleIntersection(entries, observer) {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Saat elemen masuk dalam tampilan, panggil animateCount
          if (entry.target.id === "userCount") {
            animateCount("userCount", <?php echo $totalCount1; ?>);
          } else if (entry.target.id === "keluhanCount") {
            animateCount("keluhanCount", <?php echo $totalCount2; ?>);
          } else if (entry.target.id === "kategoriCount") {
            animateCount("kategoriCount", <?php echo $totalCount3; ?>);
          }
          observer.unobserve(entry.target);
        }
      });
    }

    const options = {
      threshold: 0.1 // Saat elemen terlihat sebagian, panggil handleIntersection
    };

    const observer = new IntersectionObserver(handleIntersection, options);

    // Amati masing-masing elemen h4
    observer.observe(document.getElementById("userCount"));
    observer.observe(document.getElementById("keluhanCount"));
    observer.observe(document.getElementById("kategoriCount"));
  </script>


  <!-- akhir scroll animation -->
</body>

</html>