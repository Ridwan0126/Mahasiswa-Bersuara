<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Data | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/login.css?version=<?php echo filemtime('../style/login.css'); ?>">
</head>

<body>
  <nav>
    <div class="container">
      <div class="nav_brand">
        <a href="dashboard.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Mahasiswa Berusara" />
        </a>
        <a href="dashboard.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
    </div>
  </nav>

  <div class="container login">
    <main>
      <h2>TAMBAH DATA mahasiswa</h2>
      <form action="" method="post">
        <label for="nama">Nama Lengkap</label>
        <div class="input-form">
          <img src="../assets/img/nama.png" alt="user-icon" width="24px" />
          <input type="text" name="nama" id="nama" />
        </div>
        <label for="prodi">prodi</label>
        <div class="select">
          <select name="prodi" id="prodi">
            <option value="">prodi Laporan</option>
            <option value="TI">TI</option>
            <option value="SASJEP">SASJEP</option>
            <option value="SASING">SASING</option>
            <option value="HUKUM">HUKUM</option>
          </select>
        </div>
        <label for="username">NIM</label>
        <div class="input-form">
          <img src="../assets/img/username.png" alt="user-icon" width="24px" />
          <input type="text" name="username" id="username" />
        </div>
        <label for="password">Password</label>
        <div class="input-form">
          <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
          <input type="password" name="password" id="password" />
        </div>
        <button type="submit" name="submit">Tambah Data</button>
        <button><a href="datamahasiswa.php" style="text-decoration: none; color: white;">Kembali</a></button>
      </form>
    </main>
  </div>

  <?php
  include '../admin/conn.php';
  if (isset($_POST['submit'])) {
    $name = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO mahasiswa (nim, password, nama, prodi) VALUES('$username', '$password', '$name', '$prodi')";
    mysqli_query($conn, $query);
    echo "<script>location='datamahasiswa.php';</script>";
  }
  ?>

  <footer>
    <p class="container">UNW | Mahasiswa Berusara</p>
  </footer>
  <script src="script.js"></script>
</body>

</html>