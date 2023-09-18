// untuk test apakah js-nya sudah dipanggil oleh htmlnya atau belum
// console.log('ok'); 


// ambil elemen2 yang dibutuhkan
var keywoard = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// dalam javascript penamaan variabel harus tombolCari, tidak bisa tombol-cari karna akan di kira pengurangan matematika


// contoh studi kasus
// halo javascript, tolong carikan saya 'tombolCari', kalau ketemu lakukan sesuatu ketika ada sebuah event yang dijalankan.
// macam-macam event javascript yang bisa dilakukan ada banyak

// contoh event clik, jadi saat tombol-cari di klik, maka jalankan fungsi berikut
// tombolCari.addEventListener('click', function() {
//     alert('berhasil!!!')
// });

// contoh event mouseover
// tombolCari.addEventListener('mouseover', function() {
//     alert('berhasil!!!')
// });


// tambahkan event ketika keyworad ditulis
keywoard.addEventListener('keyup', function() {
    // alert('ok');
    // console.log(keywoard.value);

    // buat object ajax
    var xhr = new XMLHttpRequest();
    // object ajax hanya ada di browser tertentu


    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            // 4 >>> ready
            // 200 >>> OK!

            // console.log('ajax ok!');

            // console.log(xhr.responseText);
            // untuk menampilkan isi dari ajax/coba.txt

            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    // xhr.open('GET', 'ajax/coba.txt', true);
    // true >>> ashyncronus

    // xhr.open('GET', 'ajax/test.php', true);


    xhr.send();
    
});

// keypress/keyup