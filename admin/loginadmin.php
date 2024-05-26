<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/login.css" />
</head>

<body style="background-color: white;">
  <nav style="background-color: #008DDA;">
    <div class="container">
      <div class="nav_brand">
        <a href="../index.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Mahasiswa Berusara" />
        </a>
        <a href="../index.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
    </div>
  </nav>

  <div class="container">
    <main style="background-color: #F2EDD7; border-top: 10px solid #008DDA; color: #008DDA">
      <h2>LOGIN ADMIN</h2>
      <p>Please login with your account</p>
      <form action="" method="post">
        <label for="username">Username</label>
        <div class="input-form" style="outline: 1px solid #008DDA">
          <img src="../assets/img/username.png" alt="user-icon" width="24px" />
          <input type="text" style="color: #008DDA" name="username" id="username" required />
        </div>
        <label for="password">Password</label>
        <div class="input-form">
          <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" name="submit">Login Now</button>
        <a href="../mahasiswa/loginmahasiswa.php">Login as Mahasiswa</a>
      </form>
    </main>
  </div>

  <?php
  include 'conn.php';
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE nim='" . $username . "' AND password='" . $pass . "'");
    $akun = $cek->fetch_assoc();
    if (mysqli_num_rows($cek) > 0) {
      $d = mysqli_fetch_object($cek);
      $_SESSION['status_login'] = true;
      $_SESSION['a_global'] = $d;
      $_SESSION['id'] = $d->id_admin;
      $_SESSION['nim'] = $akun;
      echo '<script>window.location="dashboard.php"</script>';
    } else {
      echo '<script>alert("Username atau Password Anda Salah!")</script>';
    }
  }

  ?>
  <script src="../mahasiswa/script.js"></script>
</body>

</html>