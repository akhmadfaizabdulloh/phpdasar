<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "phpdasar");

// ambil data dari tabel mahasiswa / query data mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// echo $result;
// hasilnya >>>  error : Object of class mysqi_result could not be converted to string in.
// sama halnya echo sebuah array (tidak boleh)

// maka dari itu kita pakai
// var_dump($result);
// hasilnya >>> object(mysqli_result)#2 (5) { ["current_field"]=> int(0) ["field_count"]=> int(6) ["lengths"]=> NULL ["num_rows"]=> int(1) ["type"]=> int(0) }
// tapi cara var_dump($result); ini sama saja dengan analoginya, minta lihatin baju teman dalam lemari.. tapi satu lemari yang di bawa dan di tutup lagi


// jadi perintah yg benar adalah

// ambil data (fetch) mahasiswa dari object result
// ada 4 cara :
// mysqli_fetch_row() || mengembalikan array numerik /array yg indexnya angka
// mysqli_fetch_assoc() || mengembalikan array associative 
// mysqli_fetch_array() || mengembalikan keduanya (kekurangannya : kalau mengambil semua data, hasilnya double)
// mysqli_fetch_object()    

// $mhs = mysqli_fetch_row($result);
// // var_dump($mhs);
// var_dump($mhs[3])

// $mhs = mysqli_fetch_assoc($result);
// var_dump($mhs["jurusan"]);

// $mhs = mysqli_fetch_array($result);
// var_dump($mhs);
// var_dump($mhs["nrp"]);
// var_dump($mhs[1]);

// $mhs = mysqli_fetch_object($result);
// var_dump($mhs->email)

// agar data yg ditampilkan semuanya, maka pakai looping
// while( $mhs = mysqli_fetch_assoc($result) ){
//     var_dump($mhs);

// }


// if (!$result){
//     echo mysqli_error($conn);
// }
 
// $mhs =mysqli_fetch_row($result);
// var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

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
    <?php while( $row = mysqli_fetch_assoc($result) ) : ?>
    <tr>
        <td><?= $i ?></td>
        <td>
            <a href="">ubah</a> | 
            <a href="">hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"] ?>" width="60"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>

    </table>
</body>
</html>