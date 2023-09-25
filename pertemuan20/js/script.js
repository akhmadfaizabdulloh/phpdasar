// jika <script src="js/script.js"></script> di letakkan pada head, maka tidak akan terdeteksi element yg id-nya "keyword" karna script di eksekusi dari atas kebawah

// var keyword = document.getElementById('keyword');
// keyword.addEventListener('keyup', function() {
//     console.log('ok');
// });


// dengan ini kita menunggu semua dokumen sudah ready, baru kita jalankan fungsinya
// $(document).ready(function() {
//     var keyword = document.getElementById('keyword');keyword.addEventListener('keyup', function() {
//         console.log('ok');
//     });
// });


// $(document) >>> sama dengan jquey(document)

$(document).ready(function() {
    // event ketika keyword ditulis
    $('#keyword').on('keyup', function() {
        $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
    });
});


// fungsi load memiliki keterbatasan karna hanya bisa menggunakan GET saja, tidak bisa POST 