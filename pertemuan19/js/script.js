// ambil elemen2 yang dibutuhkan
var keywoard = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// tambahkan event ketika keyworad ditulis
keywoard.addEventListener('keyup', function() {

    // buat object ajax
    var xhr = new XMLHttpRequest();


    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keywoard.value , true);
    xhr.send();
    
});
