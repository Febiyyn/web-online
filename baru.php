<?php
    $koneksi = mysqli_connect("localhost", "root", "", "toko_kue",);
    if (!$koneksi){
        die("Koneksi gagal:".mysqli_connect_error());
    }
?>