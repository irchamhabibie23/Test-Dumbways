<?php
$id = $_GET["id"];
require 'functions.php';
if (query("SELECT stok FROM books WHERE id =$id")[0]['stok'] > 0){
    if (minusStock($id) > 0){  
        echo "
            <script>
                alert('Buku berhasil di pinjam');
                document.location.href = 'index.php';
            </script>
            ";
    }else{
            echo "
            <script>
                alert('Gagal !!!');
                document.location.href = 'index.php';
            </script>";
            echo "<br>";
            echo mysqli_error($conn);
    }
}else {
    echo "
    <script>
    alert ('Peminjaman Gagal : Stok buku sudah habis');
    document.location.href = 'index.php';
    </script>
    ";
}

?>