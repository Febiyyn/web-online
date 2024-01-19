<?php
include 'baru.php';
session_start();
if($_SESSION['id'] == ""){
    header("Location: login.php");
}else{
    $id = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <body class="bg-secondary">
        <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
            <!---ini menu-->
            <nav class="d-md-flex p-5">
                <div><h1>Cake store</h1></div>
                <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item mx-md-3"><a href="cekout.php" class="text-decoration-none text-dark fw-bold">Beli</a></li>
                        <li class="list-inline-item mx-md-3"><a href="logout.php" class="text-decoration-none text-dark fw-bold">Logout</a></li>
                    </ul>
                </div>
            </nav>

            <div class="px-4 mb-4">
            <div class="text-center">
            <img src="logo.png" class="rounded" alt="...">
        </div>
        

    <h3 class="text-center">Selamat Datang</h3>
    <div class="text-center w-50 mx-auto fw-light">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi cumque cum error ea nisi, optio enim delectus alias ab provident ad laborum corporis ipsum quas, tenetur reprehenderit corrupti commodi aut.</div>
    <br></br><hr>

    
    <div class="row row-cols-md-3 row-cols-2 gx-5 p-5">
    <?php
    include 'baru.php';
    $query= "SELECT * FROM barang";
    $result= mysqli_query($koneksi, $query);
    while($data=mysqli_fetch_array($result)){ ?>
    <div class="col mb-5">
    <form method="post" action="cekout.php?id=<?=$data["id_barang"]?>">
        <div class="card shadow">
            <img src="img/<?=$data['foto']?>" class="card-img-top"/>
            <div class="card-body">
                <h3><?=$data['nama_barang']?></h3>
                <h5><?=$data['deskripsi']?></h5>
                <input type="number" name="stok" value="1" min="1" max="5">
                <input type="hidden" name="hidden_name" value="<?=$data['nama_barang']?>">
                <input type="hidden" name="hidden_price" value="<?=$data['harga']?>">
            </div>
            <div class="card-footer d-md-flex">
                <center>
                <input type="submit" name="add" class="btn btn-sm btn-primary d-block" value="Add"></a>
                </center>
                <div class="caption">
                <span class="ms-auto text-danger fw-bold d-block text-center"> Rp.<?php echo $data["harga"];?></span>
                </div>
            </div>
        </div>
    </div>
    </form>
    <?php } ?>
    </div>
    </div>
  </div>
</div>
    
    <!--tentang kami-->
    <div class="px-4 py-4 bg-secondary text-center">
        <div class="mx-auto w-75">
            <h3 class="text-white">tentang kami</h3>
            <p class="text-center text-white">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque ullam obcaecati quaerat quia, nam est.
            </p>
        </div>
    </div>
    
    <!--copyright-->
    <div class="text-center p-4 border-top">&copy; 2023 - cake store</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </body>
</body>
</html>