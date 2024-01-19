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
    <body class="bg-secondary">
        <div class="container border mb-4 mt-4 rounded-3 shadow bg-white">
            <!---ini menu-->
            <nav class="d-md-flex p-5">
                <div><h1>Cake store</h1></div>
                <div class="ms-auto my-auto">
                    <ul class="list-inline m-0">
                        <li class="list-inline-item mx-md-3"><a href="header1.php" class="text-decoration-none text-dark fw-bold">Home</a></li>
                        <li class="list-inline-item mx-md-3"><a href="cekout.php" class="text-decoration-none text-dark fw-bold">Keranjang</a></li>
                    </ul>
                </div>
            </nav>
            <div class="container" style="width: 65%">
    <?php 
        $koneksi = mysqli_connect("localhost","root","","toko_kue");
        $id = $_GET['id'];
        //Menampilkan data pada tabel detail (id transaksi, nama barang dan jumlah barang)
        $trans = "SELECT * FROM detail 
        inner join transaksi on detail.id_transaksi = transaksi.id_transaksi 
        where detail.id_transaksi='$id'";
        $query = mysqli_query($koneksi, $trans);
        $data = mysqli_fetch_array($query);
    ?>
        <div style="clear: both"></div>
        <h3 class="title2">Nota Pembelian</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            No : <?=$id?> <br>
            Tanggal Pembelian: <?=$data['tgl_transaksi']?>
            <tr>
                <th width="30%">Nama Barang</th>
                <th width="10%">jumlah</th>
            </tr>

            <?php
            $prod = "SELECT * FROM detail 
            inner join barang on detail.id_barang = barang.id_barang 
            where detail.id_transaksi='$id'";
            $query2 = mysqli_query($koneksi, $prod);
                while($row = mysqli_fetch_array($query2)){ ?>
                        <tr>   
                            <td><?=$row["nama_barang"]?></td>
                            <td><?=$row["jumlah"]?></td>
                        </tr>
                        <?php } ?>
                    <tr>
                        <td>Total</td>
                        <td align="right">Rp <?php echo number_format($data['total'],2); ?></td>
                    </tr>
                        
            </table>
        </div>

    </div>
    
    <script>window.print();</script>

</body>
</html>
        </div>
    </body>
</body>
</html>