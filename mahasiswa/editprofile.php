<?php

session_start();
include '../admin/conn.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile mahasiswa | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/editprofile.css" />
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
          <p><?php echo $_SESSION['nim']['nama']; ?></p>
          <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
          <input type="checkbox" name="check" id="check" />
          <ul>
            <li><a href="dashboardmahasiswa.php">Dashboard</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <main style="margin-top: 60px;">
    <div class="container" style="color: #008DDA; margin-top: 180px;">
      <h1 style="color: #008DDA;">HALAMAN EDIT PROFILE</h1>
      <form action="" method="post">
        <input type="hidden" name="nim" value="<?= $_SESSION['nim']['nim']; ?>">
        <label for="nama">Nama mahasiswa</label>
        <input type="text" name="nama" value="<?php echo $_SESSION['nim']['nama']; ?>" id="nama" />
        <label for="prodi">prodi</label>
        <input type="text" name="prodi" value="<?php echo $_SESSION['nim']['prodi']; ?>" id="prodi" />
        <label for="username">NIM</label>
        <input type="text" name="username" value="<?php echo $_SESSION['nim']['nim']; ?>" id="username" readonly />
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php echo $_SESSION['nim']['password']; ?>" id="password" />
        <button type="submit" style="background-color: #008DDA" name="submit">Edit Profile</button>
      </form>
    </div>
  </main>

  <?php
  if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', password='$password', prodi='$prodi' WHERE nim='$nim'";

    $conn->query($query);

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>location='loginmahasiswa.php';</script>";
  }
  ?>

  <footer>
    <p class="container">UNW | Mahasiswa Berusara</p>
  </footer>

  <script>
    const username = document.getElementById("username")
    username.addEventListener("click", () => alert("Username Tidak Dapat Diubah!"))
  </script>
</body>

</html>