<?php
include 'conn.php';
session_start();
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
}
?>

<?php
if (isset($_GET['hapus'])) {
  $nim = $_GET['hapus'];
  $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
  $q1 = mysqli_query($conn, $query);
  header("refresh:0.5;url=datamahasiswa.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data mahasiswa | MahasiswaBersuara</title>
  <link rel="stylesheet" href="../style/datamahasiswa.css?version=<?php echo filemtime('../style/datamahasiswa.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <link rel="stylesheet" href="../assets/library/fontawesome/css/all.min.css">
  <link href="../assets/library/DataTables/datatables.min.css" rel="stylesheet">
  <script src="../assets/library/DataTables/datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabel1').DataTable();
    });
  </script>

</head>

<body>
  <nav>
    <div class="container">
      <div class="nav_brand">
        <a href="dashboard.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Mahasiswa Bersuara" />
        </a>
        <a href="dashboard.php" style="text-decoration: none;">
          <h4>
            Mahasiswa
          </h4>
          <h4>Bersuara</h4>
        </a>
      </div>
      <p>Dashboard Admin</p>
      <div class="profile_mahasiswa">
        <div class="name">
          <p><span>Selamat Datang, </span>
            <?php echo $_SESSION['nim']['nama']; ?>
          </p>
          <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
          <input type="checkbox" name="check" id="check" />
          <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="container">
      <h1>DATA MAHASISWA</h1>
      <div class="container-button">
        <div class="group-button-1">
          <button><a href="tambahdata.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-plus"></i> Tambah Data mahasiswa</a></button>
        </div>

        <div class="group-button-2">
          <button class="show-modal-2"><a href="dashboard.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-arrow-left"></i> Kembali</a></button>
        </div>
      </div>


      <div class="table-container">
        <table class="data-table" id="tabel1">
          <thead>
            <tr>
              <th>No</th>
              <th>NIM</th>
              <th>Password</th>
              <th>Nama</th>
              <th>prodi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <?php
            $no = 1;
            $query = "SELECT * FROM mahasiswa";
            $tampil = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($tampil)) :
            ?>
              <tr>
                <td><?= $no++; ?>.</td>
                <td><?= $data['nim']; ?></td>
                <td><?= $data['password']; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['prodi']; ?></td>
                <td>
                  <a href="datamahasiswa.php?hapus=<?= $data['nim']; ?>" onclick="return confirm('Yakin mau hapus?');"><button class="hapus" style="background-color: red;"><i class="fa-solid fa-trash"></i> Hapus</button></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <footer>
    <p class="container">UNW | Mahasiswa Bersuara</p>
  </footer>

  <script type="text/javascript">
    const main = document.querySelector("main"),
      showBtn = document.querySelector(".show-modal"),
      closeBtn = document.querySelector(".close-btn");

    showBtn.addEventListener("click", () =>
      main.classList.add("active")
    );
    closeBtn.addEventListener("click", () =>
      main.classList.remove("active")
    );
  </script>

</body>

</html>