<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login mahasiswa | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/login.css?version=<?php echo filemtime('../style/login.css'); ?>">
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
    </div>
  </nav>

  <div class="container">
    <main>
      <h2>LOGIN MAHASISWA</h2>
      <p>Please login with your account</p>
      <form action="" method="post">
        <label for="username">NIM</label>
        <div class="input-form">
          <img src="../assets/img/username.png" alt="user-icon" width="24px" />
          <input type="text" name="username" id="username" required />
        </div>
        <label for="password">Password</label>
        <div class="input-form">
          <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" name="submit">Login Now</button>
        <a href="../admin/loginadmin.php">Login as Admin</a>
      </form>
    </main>
  </div>

  <?php
  include '../admin/conn.php';
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $ambil = $conn->query("SELECT * FROM mahasiswa where '$username'=nim AND '$pass'=password ");
    $akunyangcocok = $ambil->num_rows;
    if ($akunyangcocok == 1) {
      $akun = $ambil->fetch_assoc();
      $_SESSION['nim'] = $akun;

      echo "<script>location='dashboardmahasiswa.php';</script>";
    } else {
      echo "<script>alert('Username atau Password Salah!');</script>";
      echo "<script>location='loginmahasiswa.php';</script>";
    }
  }
  ?>

  <script src="script.js"></script>
</body>

</html>