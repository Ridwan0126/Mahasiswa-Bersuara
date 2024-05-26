<?php
session_start();
if ($_SESSION['nim'] != true  or !isset($_SESSION['nim'])) {
  echo "<script>alert('Login terlebih dahulu, agar dapat melapor');</script>";
  echo "<script>location='loginmahasiswa.php';</script>";
}

include '../admin/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengaduan | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/pengaduan.css?version=<?php echo filemtime('../style/pengaduan.css'); ?>">
</head>

<body>
  <nav>
    <div class="container">
      <div class="nav_brand">
        <a href="dashboardmahasiswa.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Mahasiswa Berusara" />
        </a>
        <a href="dashboardmahasiswa.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
      <p>Dashboard mahasiswa</p>
      <div class="profile_mahasiswa">
        <div class="name">
          <p><?php echo $_SESSION['nim']['nama'] ?></p>
          <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
          <input type="checkbox" name="check" id="check">
          <ul>
            <li><a href="dashboardmahasiswa.php">Dashboard</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="loginmahasiswa.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="container" style="margin-top: 180px;">
      <h1>PENGADUAN MAHASISWA</h1>
      <p>Laporkan masalahmu di sini</p>
      <form action="" method="post" enctype="multipart/form-data">
        <label for="kategori">Kategori</label>
        <div class="select">
          <select name="kategori" id="kategori">
            <option value="">Kategori Laporan</option>
            <option value="1">Sarpras</option>
            <option value="2">Laboratorium</option>
            <option value="3">Dosen</option>
            <option value="4">Universitas</option>
          </select>
        </div>
        <label for="bukti">Bukti Foto</label>
        <label class="requirenment">Gambar harus sesuai dengan apa yang dilpaorkan</label>
        <label class="bukti">
          <input type="file" name="bukti" id="bukti" required />
          <span>Pilih Foto Laporan</span>
        </label>
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
        <button type="submit" name="submit">Kirim Laporan</button>
        <button><a href="dashboardmahasiswa.php" style="text-decoration: none; color: white; margin-top: 5px;">Kembali</a></button>
      </form>
    </div>
  </main>
  <?php
  include '../admin/conn.php';
  if (isset($_POST['submit'])) {
    $nim = $_SESSION['nim']['nim'];
    $ekstensi_diperbolehkan  = array('png', 'jpg', 'jpeg');
    $nama_foto = $_FILES['bukti']['name'];
    $x = explode('.', $nama_foto);
    $ekstensi = strtolower(end($x));
    $ukuran  = $_FILES['bukti']['size'];
    $lokasi = $_FILES['bukti']['tmp_name'];
    $keluhan = htmlspecialchars($_POST['deskripsi']);
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 3544070) {
        move_uploaded_file($lokasi, "../assets/fotobukti/$nama_foto");
        $conn->query("INSERT INTO status_laporan (status,feedback) VALUE('terkirim',' ')");
        //mengambil id dari status
        $status_barusan = $conn->insert_id;
        $hasil = $conn->query("INSERT INTO laporan (foto,keluhan,id_kategori,nim,id_status) VALUE ('$nama_foto','$keluhan','$_POST[kategori]','$nim','$status_barusan')");
        echo "<script>alert('Laporan Terkirim')</script>";
      } else {
        echo "<script>alert('Ukuran File Terlalu Besar')</script>";
      }
    } else {
      echo "<script>alert('Ekstensi File yang di Upload Tidak Diperbolehkan')</script>";
    }

    echo "<script>location='dashboardmahasiswa.php';</script>";
  }
  ?>

  <footer>
    <p class="container">UNW | Mahasiswa Berusara</p>
  </footer>
</body>

</html>