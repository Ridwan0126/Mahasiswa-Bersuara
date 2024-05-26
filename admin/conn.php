<!-- codingan untuk integrasi dengan server atau database -->

<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pengaduan";

    $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ("gagal terkoneksi");
?>