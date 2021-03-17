<?php
require 'functions.php';
$kategori = category('comic');

// jika tombol submit sudah di pencet
if (isset($_POST["submit"])){
    //ambil data dari formulir
    //cek apakah data berhasil ditambahkan atau tidak
    if ( addBook($_POST) > 0 ){
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Gagal !!!');
        </script>";
        
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="a.css" />
    <title>Tambah Buku</title>
</head>
<body>
    <button onclick="document.location.href='index.php'" style="width:auto; border-radius: 15px"><i class="fa fa-home"></i> Home</button>
    <h1>Tambah Buku</h1>
    <form method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Judul :</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="deskripsi">Deskripsi :</label>
        <input type="text" name="deskripsi" id="deskripsi" required>
        <br><br>
        <label for="stok">Stok :</label>
        <input type="number" name="stok" min="1" id="stok" required>
        <br><br>
        <?php foreach (query("SELECT * FROM categories") as $cate_name) :?>
                <input type="checkbox" name="id" value="<?=$cate_name["id"]?>"><?=$cate_name['categories_name']?>
                <?php endforeach ?>
        <br></br>
        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" id="gambar" required>
        <br></br>
        <button type="submit" name="submit" style="width:auto; border-radius: 15px">Tambah</button>
        </fieldset>
    </form>
    
</body>
</html>