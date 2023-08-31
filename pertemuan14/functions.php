<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



function tambah($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();

    // if ( $gambar === false )
    if ( !$gambar ) {
        return false;
    }


    $query = "INSERT INTO mahasiswa
                VALUES
                (0, '$nama','$nrp','$email','$jurusan','$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    
    // cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $eksensiGambarValid = ['jpg', 'jpeg', 'png'];

    // explode(delimiter, string)
    $eksensiGambar = explode('.', $namaFile);
    // sandhika.jpg = ['sandhika', 'jpg']

    // jika kita pakai ini
    // $eksensiGambar = $eksensiGambar[1]
    // jika nama file-nya sandika.galih.jpg
    // maka yang di ambil "galih"

    $eksensiGambar = strtolower(end($eksensiGambar));
    // end() >>> untuk mengambil yang terakhir
    // srttolower >>> untuk mengatasi jika ada nama file "sandhika.JPG" agar di convert menjadi huruf kecil (jpg).

    if( !in_array($eksensiGambar, $eksensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // in_array(needle, haystack)
    // in_array(jarum, jerami)



    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 100000 ){
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }
    // 100.000 byte = 100 kb
    // 1.000.000 byte = 1 MB


    // lolos pengecekan, gambar siap diupload
    // generte nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eksensiGambar;

    // var_dump($namaFileBaru); die;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    // move_uploaded_file(filename, destination)

    return $namaFileBaru;
    // untuk $gambar

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // tidak perlu htmlspecialchars() karna tidak di input oleh user


    // cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    

    $query = "UPDATE mahasiswa SET
                nrp = '$nrp',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
              WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%' 
            ";
    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower( stripslashes($data["username"]) );
    // stripslashes() >>> agar karakter tertentu seperti 'backslash' tidak masuk ke dalam database
    // strtolower() >>> supaya yg diinputkan diubah menjadi huruf kecil


    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // mysqli_real_escape_string() >>> agar user memungkinkan untuk yang diinputkan ada tanda kutipnya (')

    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        
        return false;
    }

    return 1;

}


?>