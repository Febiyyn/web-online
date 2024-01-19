<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Cake Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<?php
include 'baru.php';
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $foto = $_POST['foto'];

    $query = mysqli_query($koneksi, "INSERT INTO pembeli(username,password,email,alamat,nama_pembeli,no_telp,foto)values('$username','$password','$email','$alamat','$nama','$no_telp','$foto')");
    if($query >0){
      header("Location: header1.php ");
    }
  }
?> 
<body class="bg-secondary">
        <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
            <!---ini menu-->
            <nav class="d-md-flex p-5">
                <div><h1>Cake store</h1></div>
                <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item mx-md-3"><a href="login.php" class="text-decoration-none text-dark fw-bold">Login</a></li>
                    </ul>
                </div>
            </nav>

            <h3 class="text-center">isi biodata</h3>

            <div class="px-4 mb-4">
            <div class="text-center">
            <br><br>
        </div>
</body>
<br>
    <form method="POST" class="row g-md-4" enctype="multipart/form-data">
      <center>
      <div class="col-6">
       <label for="inputEmail" class="form-label">Email</label>
       <input type="email" class="form-control" id="inputEmail4" name="email">
    </div>
    <br>

    <div class="col-6">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password">
    </div>
    <br>

    <div class="col-6">
      <label for="inputUserName" class="form-label">Username</label>
      <input type="text" class="form-control" id="inputAddress" name="username">
  </div>
  <br>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Alamat</label>
    <input type="text" class="form-control" id="inputAddress" name="alamat">
  </div>
  <br>

  <div class="col-6">
    <label for="inputNumberPhone" class="form-label">No telp</label>
    <input type="text" class="form-control" id="inputNumberPhone" name="no_telp">
  </div>
  <br>

  <div class="col-6">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama" name="nama">
  </div>
  <br>

  <div class="col-6">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" class="form-control" id="foto" name="foto">
  </div>
  <br>

  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
  </div>
  <br></br>
  </form>
    </center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>