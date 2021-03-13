<?php
$id = $_GET["id"];
require 'functions.php';
if (deleteBuku($id) > 0){  
    echo "
        <script>
            alert('data berhasil di hapus');
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