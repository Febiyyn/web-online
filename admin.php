<?php
 include 'baru.php';
 if(isset($_GET['aksi'])){
    if($_GET['aksi']=="edit"){
        $result = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE id_pembeli='$_GET[id_pembeli]'");
        while($data = mysqli_fetch_array($result)){
            $nama = $data['nama_pembeli'];
            $uname = $data['username'];
            $pass = $data['password'];
            $e = $data['email'];
            $a = $data['alamat'];
            $hp = $data['no_telp'];
            $foto = $data['foto'];
        }
    }elseif($_GET['aksi']=="hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM pembeli WHERE id_pembeli='$_GET[id_pembeli]'");
     if($hapus){
        header("Location: admin.php ");
     }
    }
 }
 //menyimpan data yang diedit//
 include 'baru.php';
 if(isset($_POST['login'])){
    if($_GET['aksi']="edit"){
        $id_pembeli = $_GET['id_pembeli'];
        $nama_pembeli = $_POST['nama'];
        $un = $_POST['username'];
        $passw = $_POST['password'];
        $e = $_POST['email'];
        $a = $_POST['alamat'];
        $hp = $_POST['no_hp'];
        $foto = $_FILES['foto']['name'];
        $ekstensi1 = array('png', 'jpg', 'jpeg');
        $x = explode('.',$foto);
        $ekstensi =strtolower(end($x));
        $file_tmp =$_FILES['foto']['tmp_name'];
        if(in_array($ekstensi, $ekstensi1) === true){
            move_uploaded_file($file_tmp, 'img/'.$foto);
        }else{
            echo "<script> alert('Ekstensi tidak diperbolehkan')</scrip>";
        }
        $edit = mysqli_query($koneksi, "UPDATE pembeli set nama_pembeli='$nama_pembeli', username='$un', password='$passw', email='$e', alamat='$a', no_telp='$hp', foto='$foto' where id_pembeli='$id_pembeli'");

        if($edit > 0){

            header ("Location: admin.php ");
        }
    }else{
        //menyimpan data baru//
        $nama_pembeli = $_POST['nama'];
        $un = $_POST['username'];
        $passw = $_POST['password'];
        $e = $_POST['email'];
        $a = $_POST['alamat'];
        $hp = $_POST['no_hp'];
        $foto = $_FILES['foto'];

        $result = mysqli_query($koneksi, "INSERT INTO pembeli(nama_pembeli,username,password,email,alamat,no_telp,foto) VALUES('$nama_pembeli','$un','$passw','$e','$a','$hp',$foto'");
        if($result > 0){
            header("Location: admin.php ");
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
                        <li class="list-inline-item mx-md-3"><a href="baranng.php" class="text-decoration-none text-dark fw-bold">Cek Barang</a></li>
                        <li class="list-inline-item mx-md-3"><a href="register.php" class="text-decoration-none text-dark fw-bold">Daftar</a></li>
                        <li class="list-inline-item mx-md-3"><a href="login.php" class="text-decoration-none text-dark fw-bold">Login</a></li>
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
        <td> Username </td>
        <td> <input type="text" name="username" value="<?=@$uname?>"> </td>
        </tr>
    <tr>
        <td> Password </td>
        <td> <input type="password" name="password" value="<?=@$pass?>"> </td>
    </tr>
    <tr>
        <td> Email </td>
        <td> <input type="text" name="email" value="<?=@$e?>"> </td>
        </tr>
    <tr>
        <td> Alamat </td>
        <td> <input type="text" name="alamat" value="<?=@$a?>"> </td>
        </tr>
    <tr>
        <td> No Hp </td>
        <td> <input type="text" name="no_hp" value="<?=@$hp?>"> </td>
        </tr>
        <tr>
    <td> Nama </td>
        <td> <input type="text" name="nama" value="<?=@$nama?>"> </td>
        </tr>
    <tr>
    <tr>
        <td> Foto </td>
        <td> <input type="file" name="foto" value="<?=@$foto?>"> </td>
        </tr>
    <tr>
        <td><button type="submit" name="login" class="btn btn-primary">Submit</button></td>
    </tr>
    <br></br>
    
</form>
<div class="container">
<table class="table table-bordered">
    <thead>
            <th>No.</th>
            <th>Nama Pembeli.</th>
            <th>username.</th>
            <th>Password.</th>
            <th>Email.</th>
            <th>No HP.</th>
            <th>Alamat.</th>
            <th>Foto</th>
            <th>Aksi</th>
    </thead>
    <tbody>
        <br></br>

        <?php
    include 'baru.php';
    $no=1;
    $query = mysqli_query($koneksi, "SELECT * FROM pembeli");
    while($data=mysqli_fetch_array($query)){
        echo "<tr>";
        echo "<td>".$no; $no++."<td>";
        echo "<td>".$data['nama_pembeli']."</td>";
        echo "<td>".$data['username']."</td>";
        echo "<td>".$data['password']."</td>";
        echo "<td>".$data['email']."</td>";
        echo "<td>".$data['no_telp']."</td>";
        echo "<td>".$data['alamat']."</td>";
        echo "<td>".$data['foto']."</td>";
        echo "<td> <a href='admin.php?aksi=edit&id_pembeli=".$data['id_pembeli']."'>edit</a></td>";
        echo "<td> <a href='admin.php?aksi=hapus&id_pembeli=".$data['id_pembeli']."'>hapus</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>