<?php 
$conn = mysqli_connect("localhost", "root", "kocam", "perpustakaan");

function query($query) {
    global $conn ;
    $result = mysqli_query($conn, $query);
    if (!$result){
        echo mysqli_error($conn, $query);
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row ;
    }
    return $rows;
}

function minusStock($keyword){
    global $conn;
    $query = "UPDATE books SET stok = stok - 1 WHERE id = '$keyword'";
    mysqli_query($conn, $query);
    $query2 = "SELECT stok FROM books WHERE id = '$keyword'";
    return query($query2);
}

function addStock($keyword){
    global $conn;
    $query = "UPDATE books SET stok = stok + 1 WHERE id = '$keyword'";
    mysqli_query($conn, $query);
    $query2 = "SELECT stok FROM books WHERE id = '$keyword'";
    return query($query2);
}

function addBook($data){
    global $conn; 
    $judul = htmlspecialchars($data["name"]);
    $stok = htmlspecialchars($data["stok"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $categoriesId = htmlspecialchars($data["id"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar){
        return false;
    }

    $query = "INSERT INTO books VALUES (Null,'$judul','$stok','$gambar','$deskripsi','$categoriesId');";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpFile = $_FILES['gambar']['tmp_name'];

    // check apakah ada gambar yang diupload
    if ($error == 4){
        echo "
        <script>
            alert('Upload Gambar Terlebih Dahulu');
        </script>";
        return false;
    }
    // check apakah file yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
        <script>
            alert('Ekstensi Gambar yang Diperbolehkan : .jpg, .jpeg, dan .png');
        </script>"; 
        return false;
    }
    // check apakah ukuranFile terlalu besar
    if ($ukuranFile > 1048576 ){
        echo "
        <script>
            alert('Ukuran Gambar Maksimal 1MB !!');
        </script>";
        return false;
    }
    // lolos check generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpFile, 'img/' . $namaFileBaru);
    return $namaFileBaru; 
}

function deleteBuku($id){
    global $conn;
    $query = "DELETE FROM books WHERE id = $id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addCategory($keyword){
    $query = "SELECT books.name, books.stok, books.image, books.id, categories.categories_name
    FROM books
    JOIN categories
    ON books.categories_id = categories.id
    WHERE categories.categories_name Like '%$keyword%'
    ";
    return query($query);
}
function category($keyword){
    $query = "SELECT categories_name
    FROM categories
    WHERE categories_name Like '%$keyword%'
    ";
    return query($query);
}

?>