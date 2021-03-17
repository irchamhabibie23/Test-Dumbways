<?php
require 'functions.php';
$kategori = category('comic');

if (isset($_POST['editkategori'])) {
    
    if (isset($_POST['kategori'])) {
        foreach ($_POST['kategori'] as $value) {
        $kategori = array_unique(array_merge($kategori,category($value)), SORT_REGULAR);
        }
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
    <title>Halaman Admin</title>
</head>
<body>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fa fa-search"></i> Kategori</button>
    <button onclick="document.location.href='index.php'" style="width:auto;"><i class="fa fa-home"></i> Home</button>
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
                <button type="submit" name="editkategori" id="kategori" style="width:auto">Pilih Kategori</button>
                <br></br>
            </div>
        </form>
    </div>
    <script>
    var modal = document.getElementById('id01');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    
    <?php foreach ($kategori as $namaKategori) :?>
    <p><?= $namaKategori["categories_name"];?></p>
    <?php $books = addCategory($namaKategori["categories_name"]);?>
    <br></br>
    
    <table border="0" cellpadding="10" cellspacing="0">

    <?php foreach ($books as $book):?>
        <th colspan="2"><img src="img/<?= $book["image"];?>" width="300">
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
        <td colspan="2">
            <a href="delete.php?id=<?= $book["id"];?>"><button type="button" style="width:300px; background-color: #ce3824; border-radius: 15px">Hapus</button></a>
        </td>
        <?php endforeach; ?>
    </table>
    <?php endforeach; ?>
   
</body>
</html>