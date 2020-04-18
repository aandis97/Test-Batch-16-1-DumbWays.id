<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <?php
        include('koneksi.php');
    ?>
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Warteg Andi</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kategori.php">Data Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="makanan.php">Data Makanan</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>

    </div>
    <div class="container">
        <?php  

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {

        $sqlMakanan = "SELECT * FROM foods where category_id=".$row['id'];
        $resultMakanan = $conn->query($sqlMakanan);

        if ($resultMakanan->num_rows > 0) {
                    
            while($makanan = $resultMakanan->fetch_assoc()) { 
        ?>
            <h1 class="display-5 text-center"><?= $row['name'] ?></h1>
            <div class="row text-center">
                <div class="col-md-3 border">
                    <img src="image/<?= $makanan['image'] ?>" class="bd-placeholder-img mt-10" style="margin-top:10px" width="200" height="200" alt="">
                    <h3><?= $makanan['name'] ?></h3>
                    <h6>Stok : <?= $makanan['stok'] ?></h6>
                    <p>Deskripsi: <?= $makanan['deskripsi'] ?></p>
                    <p><button class="btn btn-info" href="#" role="button" <?= (($makanan['stok']==0) ? 'disabled' : '') ?> onclick="alert('Terima Kasih telah membeli ini :)')">Beli »</button></p>
                </div>
            </div>
        <?php
            }
        }
    }
} else {
    echo '<h1 class="display-5 text-center">Data Makanan Kosong</h1>';
}
        ?>
    </div>

</body>

</html>