<?php
require 'functions.php';
$kategori = category('comic');

if (isset($_POST['editkategori'])) {
    $kategori = [];
    if (isset($_POST['kategori'])) {
        foreach ($_POST['kategori'] as $value) {
        $kategori = array_unique(array_merge($kategori,category($value)), SORT_REGULAR);
        }
    }
}

if (isset($_POST["hapus"])){
    echo "
        <script>
            document.location.href = 'hapusBuku.php';
        </script>
        ";
}

if (isset($_POST["buku"])){
    echo "
        <script>
            document.location.href = 'addBooks.php';
        </script>
        ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Halaman Admin</title>
</head>
<body>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 15px"><i class="fa fa-bars"></i> Menu</button>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" enctype="multipart/form-data" method="post">
            <div class="container">
                <?php foreach (query("SELECT * FROM categories") as $cate_name) :?>
                <input type="checkbox" name="kategori[]" value="<?=$cate_name["categories_name"]?>" 
                <?php 
                foreach($kategori as $kat){
                    if ($kat["categories_name"] == $cate_name["categories_name"]){
                        echo 'checked';
                    }
                }
                ?>> <?=$cate_name['categories_name']?>
                <?php endforeach ?>
                <br></br>
                <button type="submit" name="editkategori" style="width:200px; border-radius: 15px" id="kategori">Pilih Kategori</button>
                <br></br>
                <button type="submit" style="width:200px; border-radius: 15px" name="buku">Menambah Buku</button>
                <br></br>
                <button type="submit" style="width:200px; border-radius: 15px" name="hapus">Menghapus Buku</button>
            </div>
        </form>
    </div>
    <?php foreach ($kategori as $namaKategori) :?>
    <p style="font-size:50px"><strong><?= $namaKategori["categories_name"];?></strong></p>
    <?php $books = addCategory($namaKategori["categories_name"]);?>
    <br></br>
    
    <table cellpadding="10" cellspacing="0">

    <?php foreach ($books as $book):?>
        <th colspan="2"><img src="img/<?= $book["image"];?>" width="250px">
        </th>
    <?php endforeach;?>
        <tr>
    <?php foreach ($books as $book):?>
        <td>
            <?= $book["name"];?>
        </td>
        <td >
            <?= $book["stok"];?>
        </td>
    <?php endforeach; ?>
        </tr>
    <?php foreach ($books as $book):?>
        <td>
            <a href="pinjam.php?id=<?= $book["id"];?>"><button type="button" style="width:180px; background-color:#006effc0; border-radius: 15px;" >Pinjam</button></a>
        </td>
        <td>
            <a href="kembali.php?id=<?= $book["id"];?>"><button type="button" style="width:180px; background-color:#e0d312; border-radius: 15px;">Kembalikan</button></a>
        </td>
        
        <?php endforeach; ?>
    </table>
    <?php endforeach; ?>
    <script>
    var modal = document.getElementById('id01');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>
</html>