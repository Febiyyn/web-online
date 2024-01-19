<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php
    include 'baru.php';
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql1 = "SELECT * FROM penjual where username='$username' and password='$password'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_assoc($q1);
        if(mysqli_num_rows($q1)>0){
            $_SESSION['id_penjual'] = $r1['id_penjual'];
            header("Location: admin.php");
        }else{
            echo "<script>alert('Something Wrong ! ')</script>";
            header("Location: loginadmin.php");
        }
    }
    ?>
    <body class="bg-secondary">
    <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
            <!---ini menu-->
            <nav class="d-md-flex p-5">
                <div><h1>Login Admin</h1></div>
                <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item mx-md-3"><a href="register.php" class="text-decoration-none text-dark fw-bold">Daftar</a></li>
                    </ul>
                </div>
            </nav>

            <div class="px-4 mb-4">
            <div class="text-center">
            <img src="logo.png" class="rounded" alt="...">
    </div>
    <br></br><br></br>
    <form action="loginadmin.php" method="POST" enctype="multipart/form-data">
        <table width="25%"  align="center">
    <tr>
        <td> Username </td>
        <td> <input type="text" name="username"> </td>
        </tr>
    <tr>
        <td> Password </td>
        <td> <input type="password" name="password"> </td>
    </tr>
    <tr>
        <td><button type="submit" name="login" class="btn btn-primary">Submit</button></td>
    </tr>
    </form>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</body>
</html>