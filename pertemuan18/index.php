<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// pagination

// $mahasiswa = query("SELECT * FROM mahasiswa");

// $mahasiswa = query("SELECT * FROM mahasiswa LIMIT 1,2");

// $mahasiswa = query("SELECT * FROM mahasiswa LIMIT 5,3");

// konfigurasi
$jumlahDataPerhalaman = 4;

// jumlah halaman = total data / data perhalaman

// mencari total data
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
$jumlahData = mysqli_num_rows($result);
var_dump($jumlahData); 

// atau bisa mencari total data menggunakan query yg sudah kita punya
$jumlahData = count(query("SELECT * FROM mahasiswa"));
var_dump($jumlahData);

// mencari jumlah halaman
// mencoba menggunakan round() , floor(), ceil()
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
var_dump($jumlahHalaman);

// round() >>> untuk membulatkan bilangan pecahan ke desimal terdekatnya. (dibulatkan ke atas)
// floor() >>> pembuatannya ke bawah (floor = lantai)
// ceil() >>> pembulatannya ke atas (ceiling = langit-langit)


// mengecek halaman yang aktif
// $halaamnAktif = $_GET["halaman"];
// var_dump($halaamnAktif);
// http://localhost/phpdasar/pertemuan18/index.php?halaman=2


// agar tidak error saat tidak menuliskan index.php?halaman=2 (tampilkan saja halaman pertama)
if(isset($_GET["halaman"])) {
    $halaamnAktif = $_GET["halaman"];
} else {
    $halaamnAktif = 1;
}
var_dump($halaamnAktif);

// agar if else bisa lebih singkat (efektif) kita gunakan operator ternari
$halaamnAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

// cara baca :
// (?) = jika kondisinya bernilai true 
// maka $halamanAktif di isi dengan $_GET["halaman"]
// (:) = jika false $halamanAktif diisi dengan ankga 1







$mahasiswa = query("SELECT * FROM mahasiswa LIMIT 0, $jumlahDataPerhalaman");




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
</head>
<body>


    <a href="logout.php">Logout</a>


    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>

    <form action="" method="post">

        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">Cari!</button>

    </form>

    <br>

    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
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
        <td>
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
</body>
</html>