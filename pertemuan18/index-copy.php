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
$jumlahDataPerhalaman = 2;

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
// $halamanAktif = $_GET["halaman"];
// var_dump($halamanAktif);
// http://localhost/phpdasar/pertemuan18/index.php?halaman=2


// agar tidak error saat tidak menuliskan index.php?halaman=2 (tampilkan saja halaman pertama)
if(isset($_GET["halaman"])) {
    $halamanAktif = $_GET["halaman"];
} else {
    $halamanAktif = 1;
}
var_dump($halamanAktif);

// agar if else bisa lebih singkat (efektif) kita gunakan operator ternari
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

// cara baca :
// (?) = jika kondisinya bernilai true 
// maka $halamanAktif di isi dengan $_GET["halaman"]
// (:) = jika false $halamanAktif diisi dengan ankga 1



// mencari awal data setiap halaman

// jika $jumlahDataPerhalaman = 2;
// halaman2, awalData = 2 (karna halaman1 dimulai dari 0)
// halaman3, awalData = 4

$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;



$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerhalaman");




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
    

    <!-- navigasi -->

    <?php if( $halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo; &lt;</a>
    <?php endif; ?>


    <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
        <?php if( $i == $halamanAktif ) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?> 


    <?php if( $halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1; ?>">&gt; &raquo;</a>
    <?php endif; ?>


    <br>
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