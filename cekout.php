<?php
 session_start();
 $koneksi = mysqli_connect("localhost", "root", "", "toko_kue");

 if(isset($_POST["add"])){
  if(isset($_SESSION["beli"])){
    $item_array_id = array_column($_SESSION["beli"],"id_barang");
   if (!in_array($_GET["id"],$item_array_id)){
    $count = count($_SESSION["beli"]);
    $item_array = array(
      'id_barang' => $_GET["id"],
      'item_name' => $_POST["hidden_name"],
      'product_price' => $_POST["hidden_price"],
      'item_quantity' => $_POST["stok"],
    );
    $_SESSION["beli"][$count] = $item_array;

    echo '<script>alert("Produk berhasil ditambahkan ke keranjang")</script>';
    echo '<script>window. location="cekout.php"</script>';

  }else{
    echo '<script>alert("Produk sudah ada dikeranjang")</script>';
    echo '<script>window. location="cekout.php"</script>';
  }
 }else{
  $item_array = array(
    'id_barang' => $_GET["id"],
    'item_name' => $_POST["hidden_name"],
    'product_price' => $_POST["hidden_price"],
    'item_quantity' => $_POST["stok"],
  );
  $_SESSION["beli"][0] = $item_array;

  echo '<script>alert("Produk berhasil ditambahkan")</script>';
  echo '<script>window. location="cekout.php"</script>';
 }
}
    if(isset($_GET["action"])){
      if($_GET["action"] == "delete"){
        foreach ($_SESSION["beli"] as $keys => $value){
          if ($value["id_barang"] == $_GET["id"]){
            unset($_SESSION["beli"][$keys]);
            echo '<script>alert("Produk telah dihapus")</script>';
            echo '<script>window. location="cekout.php"</script>';
          }
        }
      } elseif($_GET["action"] == "beli"){
        $total = 0;
        foreach($_SESSION["beli"] as $key => $value){
          $total = $total + ($value["item_quantity"] * $value["product_price"]);
        }

        $query = mysqli_query($koneksi, "INSERT INTO transaksi (tgl_transaksi, total) VALUES ('".date("y-m-d")."','$total')");
        $id_trans = mysqli_insert_id($koneksi);

        foreach ($_SESSION["beli"] as $key => $value){
          $id_prodk = $value['id_barang'];
          $jumlah = $value['item_quantity'];
          $sql = "INSERT INTO detail (id_barang, id_transaksi, jumlah) VALUES ('$id_prodk','$id_trans','$jumlah')";
          $res = mysqli_query($koneksi, $sql);
        }
        unset($_SESSION["beli"]);
        echo '<script>alert("Terima kasih sudah belanja disini!")</script>';
        echo "<script>window.location='cetak.php?id=".$id_trans."'</script>";
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>check out</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<body class="bg-secondary">
      <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
        <!---ini menu-->
        <nav class="d-md-flex p-5">
          <div><h1>Belanja</h1></div>
            <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        
                        <li class="list-inline-item mx-md-3"><a href="header1.php" class="text-decoration-none text-dark fw-bold">Kembali</a></li>
                    </ul>
            </div>
        </nav>
            <div class="px-4 mb-4">
            <div class="text-center"> 
      </div>
  <section class="konten">
    <div class="continer">
      <hr>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
           if(!empty($_SESSION["beli"])){
            $total = 0;
            foreach ($_SESSION["beli"] as $key => $value) {
              ?>
              <tr>
                <td><?=$value["item_name"]?></td>
                <td><?=$value["item_quantity"]?></td>
                
                <td>
                  Rp<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?>
                </td>
                <td><a href="cekout.php?action=delete&id=<?php echo $value["id_barang"]; ?>"></span
                  class="text-danger">Hapus</span></a>
                </td>
              </tr>

              <?php
              $total = $total + ($value["item_quantity"] * $value["product_price"]);
            }
              ?>
              <tr>
                <td colspan="2" align="right">Total Harga</td>
                <th align="right">Rp.<?php echo number_format($total, 2); ?></th>
                <td><a href="cekout.php?action=beli"><button type="submit" name="beli" class="btn btn-warning">Buat Pesanan</button></a></td>
              </tr>
              <?php
           }
          ?>

        </tbody>
       
      </table>
    </div>
  </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>