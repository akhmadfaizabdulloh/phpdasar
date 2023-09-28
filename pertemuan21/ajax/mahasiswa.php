<?php
// simulasi seolah-olah loadingnya agak lama
sleep(1);
// atau kalau terlalu lama bisa pakai
usleep(500000);

// usleep(micro_second), karna tidak bisa sleep(0.5) >> minimal 1 detik
// 1 detik = 1000000 >>> 1jt
// 0.5 detik = 500000 >>> 500rb

require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa 
            WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' 
        ";
        
$mahasiswa = query($query);

// var_dump($mahasiswa);
?>

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