<?php
 include 'baru.php';
 if(isset($_GET['aksi'])){
    if($_GET['aksi']=="edit"){
        $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$_GET[id_barang]'");
        while($data = mysqli_fetch_array($result)){
            $nama = $data['nama_barang'];
            $h = $data['harga'];
            $s = $data['stok'];
            $f = $data['foto'];
            $d = $data['deskripsi'];
        }
    }elseif($_GET['aksi']=="hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$_GET[id_barang]'");
     if($hapus){
        header("Location: barang.php ");
     }
    }
 }
 //menyimpan data yang diedit//
 include 'baru.php';
 if(isset($_POST['login'])){
    if($_GET['aksi']="edit"){
        $id_barang = $_GET['id_barang'];
        $nama_barang = $_POST['nama_barang'];
        $har = $_POST['harga'];
        $stok = $_POST['stok'];
        $des = $_POST['deskripsi'];
        $foto = $_FILES['foto']['name'];
        $ekstensi1 = array('png', 'jpg', 'jpeg');
        $x = explode('.',$foto);
        $ekstensi =strtolower(end($x));
        $file_tmp =$_FILES['foto']['tmp_name'];
        if(in_array($ekstensi, $ekstensi1) === true){
            move_uploaded_file($file_tmp, 'img/'.$foto);
        }else{
            echo "<script> alert('Ekstensi tidak diperbolehkan')</script>";
        }
        $edit = mysqli_query($koneksi, "UPDATE barang set nama_barang='$nama_barang', harga='$har', stok='$stok', foto='$foto', deskripsi='$des' where id_barang='$id_barang'");

        if($edit > 0){

            header ("Location: baranng.php ");
        }
    }else{
        //menyimpan data baru//
        $nama_barang = $_POST['nama_barang'];
        $har = $_POST['harga'];
        $stok = $_POST['stok'];
        $des = $_POST['deskripsi'];
        $foto = $_FILES['foto'];

        $result = mysqli_query($koneksi, "INSERT INTO barang(nama_barang,harga,stok,foto,deskripsi) VALUES('$nama_barang','$har','$stok','$des','$foto',");
        if($result > 0){
            header("Location: baranng.php ");
        }
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hal Pembeli</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<body class="bg-secondary">
        <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
            <!---ini menu-->
            <nav class="d-md-flex p-5">
                <div><h1>Halaman edit</h1></div>
                <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item mx-md-3"><a href="login.php" class="text-decoration-none text-dark fw-bold">Login</a></li>
                        <li class="list-inline-item mx-md-3"><a href="register.php" class="text-decoration-none text-dark fw-bold">Daftar</a></li>
                    </ul>
                </div>
            </nav>

            <div class="px-4 mb-4">
            <div class="text-center">
        
        </div>
</body>
<form action="" method="POST" enctype="multipart/form-data">
        <table width="25%" align="center">
    <tr>
        <td> Nama barang </td>
        <td> <input type="text" name="nama_barang" value="<?=@$nama?>"> </td>
        </tr>
    <tr>
        <td> Harga </td>
        <td> <input type="text" name="harga" value="<?=@$h?>"> </td>
    </tr>
    <tr>
        <td> Stok </td>
        <td> <input type="number" name="stok" value="<?=@$s?>"> </td>
        </tr>
    <tr>
        <td> Deskripsi </td>
        <td> <input type="text" name="deskripsi" value="<?=@$d?>"> </td>
        </tr>
    <tr>
    <tr>
        <td> Foto </td>
        <td> <input type="file" name="foto" value="<?=@$f?>"> </td>
        </tr>
    <tr>
        <td><button type="submit" name="login" class="btn btn-primary">Submit</button></td>
    </tr>
    <br></br>
    
</form>
<table class="table table-bordered">
    <thead>
            <th>No.</th>
            <th>Nama barang.</th>
            <th>Harga.</th>
            <th>Stok.</th>
            <th>Foto.</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
    </thead>
    <tbody>
        <br></br>

        <?php
    include 'baru.php';
    $no=1;
    $query = mysqli_query($koneksi, "SELECT * FROM barang");
    while($data=mysqli_fetch_array($query)){
        echo "<tr>";
        echo "<td>".$no; $no++."<td>";
        echo "<td>".$data['nama_barang']."</td>";
        echo "<td>".$data['harga']."</td>";
        echo "<td>".$data['stok']."</td>";
        echo "<td>".$data['foto']."</td>";
        echo "<td>".$data['deskripsi']."</td>";
        echo "<td> <a href='baranng.php?aksi=edit&id_barang=".$data['id_barang']."'>edit</a></td>";
        echo "<td> <a href='baranng.php?aksi=hapus&id_barang=".$data['id_barang']."'>hapus</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>