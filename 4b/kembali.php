<?php
$id = $_GET["id"];
require 'functions.php';
if (addStock($id) > 0){  
    echo "
        <script>
            alert('buku berhasil di kembalikan');
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
?>