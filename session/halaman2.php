<?php

//  variabel $nama tidak akan muncul karna halaman2 tidak mengenali variabel yang ada di halaman1
// echo $nama;

session_start();
echo $_SESSION["nama"];
// nilai ini akan hilang dalam 1 sesi, yaitu saat browser di close atau komputer kita restart


?>