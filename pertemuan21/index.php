<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari ditekan
if ( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 40px;
            position: absolute;
            top: 133px;
            left: 365px;
            z-index: -1;
            display: none;
        }


        @media print {
            .logout, .tambah, .form-cari, .aksi {
                display: none;
            }
        }

    </style>
</head>
<body>


    <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>


    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php" class="tambah">Tambah data mahasiswa</a>
    <br><br>

    <form action="" method="post" class="form-cari">

        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

        <img src="img/loader.gif" class="loader">

    </form>

    <br>

    <!-- kita buat sebuah wadah dengan div untuk tabelna, karna ini yang nanti datanya akan berubah-->
    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th class="aksi">Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>


    <?php $i = 1; ?>
    <?php foreach ($mahasiswa as $row) : ?>
    <tr>
        <td><?= $i ?></td>
        <td class="aksi">
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> | 
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="60"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

    </table>
    </div> 

    <!-- pastikan memanggil jquery-nya sebelum memanggil script punya kita sendiri atau letakkan di head-->
    <script src="js/code.jquery.com_jquery-3.7.1.min.js"></script>

    <!-- Supaya JS-nya mudah untuk mengambil element2 didalam HTML-nya/DOM-nya, Tandai setiap element yang di butuhkan -->
    <script src="js/script.js"></script>
</body>
</html>