<?php
    include "./database.php";
     if($_SERVER['REQUEST_METHOD'] == 'POST')
     {
         $productname = $_POST['pname'];
         $productdesc = $_POST['desc'];
         $file = $_FILES['img'];
         
         $namatoko = $_SESSION['usernametoko'];
         $idtoko = "SELECT id_toko FROM toko WHERE nama_toko = ?";
         $result = $pdo->prepare($idtoko);
         $result->execute([$namatoko]);
         $x=$result->fetch();
        
         $filename = $namatoko.$productname.".png"; // filename pake namatoko+productname
         $destination = "../img/".$filename;
         move_uploaded_file($file['tmp_name'],$destination);
         $category = $_POST['categ'];
         $price = $_POST['price'];
         $stock = $_POST['stock'];



         $insertdata = "INSERT INTO item (nama_item,deskripsi,gambar_filepath,kategori,harga,stok,id_toko) VALUES(?,?,?,?,?,?,?)";
         $insertstmt = $pdo->prepare($insertdata);
         $insertstmt->execute([$productname,$productdesc,$filename,$category,$price,$stock,$x['id_toko']]);
         header("Location: ../toko/home-toko.php");
     }
?>