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

        if(isset($_POST['aksi'])){
            $aksi = $_POST['aksi'];
            $kategori = $_POST['kategori'];
            $id = $_POST['id'];
            $makanan = $_POST['makanan'];
            $stok = $_POST['stok'];
            $deskripsi = $_POST['deskripsi'];
            $gambar = "tes.jpg";

             
			$namaGambar = $_FILES['gambar']['name'];
			$x = explode('.', $namaGambar);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['gambar']['size'];
			$file_tmp = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($file_tmp, 'image/'.$namaGambar);

            
            if($aksi=="tambah"){
                $sql = "INSERT INTO foods (category_id, name, stok, deskripsi, image)
                VALUES ($kategori, '$makanan', $stok, '$deskripsi', '$namaGambar')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: makanan.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else if($aksi=="ubah"){
                $sql = "UPDATE foods SET category_id='$kategori',name='$makanan',stok='$stok',deskripsi='$deskripsi',image='$namaGambar' where id=$id";

                if ($conn->query($sql) === TRUE) {
                    header("Location: makanan.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
        }

        if(isset($_GET['hapus'])){
            $id = $_GET['hapus']; 
             
            $sql = "DELETE FROM foods WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                header("Location: makanan.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            
        }
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="kategori.php">Data Kategori</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Data Makanan</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>

    </div>
    <div class="container">
        <br>
        <?php
            if(isset($_GET['a'])){
                $aksi = $_GET['a'];

                if($aksi=='tambah' || $aksi=='ubah' || $aksi=='detail') {
                    
                    $sqlKategori = "SELECT * FROM categories";
                    $resultKategori = $conn->query($sqlKategori); 
                    $id=0;
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sqlSelect = "SELECT * FROM foods where id=$id";
                        $resultSelect = mysqli_query($conn, $sqlSelect);
                        $makanan = mysqli_fetch_assoc($resultSelect); 
                    }                
                ?>
                <br>
                <div class="row border" style="padding:20px">
                    <div class="col-md-8">
                        <form  method="POST" action="makanan.php"  enctype="multipart/form-data">
                            
                            <input type="hidden" name="aksi" value="<?= $id!=0 ? 'ubah' : 'tambah' ?>">
                            <input type="hidden" name="id" value="<?= $id!=0 ? $id : '0' ?>">
                            <div class="form-group row">
                                
                            <div class="col-sm-10">
                            <h5> Form <?= $id!=0 ? 'Ubah' : 'Tambah' ?> Makanan </h5>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputKategori3" class="col-sm-4 col-form-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="inputKategori3" name="kategori" required <?= $aksi=='detail' ? 'disabled' : '' ?> >
                                        <option value="">Pilih Makanan</option>
                                        <?php
                                            while($kategori = $resultKategori->fetch_assoc()) {
                                                if($makanan['category_id']==$kategori['id']){
                                                    echo '<option value="'.$kategori['id'].'" selected>'.$kategori['name'].'</option>';

                                                } else {
                                                    echo '<option value="'.$kategori['id'].'" >'.$kategori['name'].'</option>';

                                                }
                                            }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputMakanan3" class="col-sm-4 col-form-label">Makanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputMakanan3" name="makanan" <?= $aksi=='detail' ? 'disabled' : '' ?>  required value="<?= $id!=0 ? $makanan['name'] : '' ?>"  placeholder="Nama Makanan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStok3" class="col-sm-4 col-form-label">Stok</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputStok3" name="stok" <?= $aksi=='detail' ? 'disabled' : '' ?>  required value="<?= $id!=0 ? $makanan['stok'] : '' ?>"  placeholder="Stok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStok3" class="col-sm-4 col-form-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea  class="form-control"  name="deskripsi" id="" cols="30" rows="3" <?= $aksi=='detail' ? 'disabled' : '' ?>  required placeholder="Deskripsi Makanan"><?= $id!=0 ? $makanan['deskripsi'] : '' ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputMakanan3" class="col-sm-4 col-form-label">Gambar Makanan</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="inputMakanan3" name="gambar" <?= $aksi=='detail' ? 'disabled' : '' ?>  required placeholder="Nama Makanan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-8">
                                <?= $aksi=='detail' ? '<a href="makanan.php?a=ubah&id='.$id.'" class="btn btn-info">Ubah Data</a>' : '<button type="submit" class="btn btn-primary">Simpan</button>' ?>
                                    
                                    <a href="makanan.php" class="btn btn-light">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 border" >
                        <img src="image/<?= $id!=0 ? $makanan['image'] : '' ?>" alt="" width="100%">
                    </div>
                </div>           

                <?php
                }else  {
                    echo '<a href="makanan.php?a=tambah" class="btn btn-primary">Tambah</a>';
                }
            } else {
                echo '<a href="makanan.php?a=tambah" class="btn btn-primary">Tambah</a>';
            }


        ?>
        <br>
        <br>
        <?php  
            $sql = "SELECT foods.*, categories.name as category_name FROM foods join categories on foods.category_id=categories.id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
 
        ?> 

            <table class="table table-striped ">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kategori Makanan</th>
                    <th scope="col">Nama Makanan</th>
                    <th scope="col">Stok</th>
                    <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['category_name'] ?></td> 
                    <td><?= $row['name'] ?></td> 
                    <td><?= $row['stok'] ?></td> 
                    <td class="text-center">
                    <a href="makanan.php?a=detail&id=<?= $row['id'] ?>" class="btn btn-light btn-sm">Detail</a> |
                    <a href="makanan.php?a=ubah&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ubah</a> |
                    <a href="makanan.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus data ini?');" class="btn btn-danger btn-sm">Hapus</a> 
                    </td> 
                    </tr> 
                    <?php
                        }
                    ?>
                </tbody>
            </table>


        <?php 
    
} else {
    echo '<h1 class="display-5 text-center">Data Makanan Kosong</h1>';
}
        ?>
    </div>

</body>

</html>