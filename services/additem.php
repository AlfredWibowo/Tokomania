<?php
    include "./database.php";
    function RandomString()
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randchar = substr($characters, rand(0, strlen($characters)), 1);
            $randstring = $randstring . $randchar;
        }
        return $randstring;
    }
     if($_SERVER['REQUEST_METHOD'] == 'POST')
     {
         $productname = $_POST['pname'];
         $productdesc = $_POST['desc'];
         $category = $_POST['categ'];
         $price = $_POST['price'];
         $stock = $_POST['stock'];
         $file = $_FILES['img'];
         
         if($productname == "" || $productdesc == "" || $category == "" || $price == "" || $stock == "")
         {
             header("Location: ../toko/addpage.php?stat=2");
             exit();
         }
         if($category != "Book" && $category != "Fashion" && $category != "Gadget" && $category != "Gaming" && $category != "Kitchen" && $category != "Tools" && $category != "Stationary")
         {
             header("Location: ../toko/addpage.php?stat=3");
             exit();
         }
         $namatoko = $_SESSION['usernametoko'];
         $idtoko = "SELECT id_toko FROM toko WHERE nama_toko = ?";
         $result = $pdo->prepare($idtoko);
         $result->execute([$namatoko]);
         $x=$result->fetch();
        
         $randomstring = RandomString();
         $path = $_FILES['img']['name'];
         $ext = pathinfo($path, PATHINFO_EXTENSION);
         if($ext != "png" && $ext != "jpg")
         {
             header("Location: ../toko/addpage.php?stat=1");
             exit();
         }
         $filename = $namatoko.$productname."_".$randomstring.".".$ext; // filename pake namatoko+productname
         $destination = "../img/".$filename;
         move_uploaded_file($file['tmp_name'],$destination);

         $insertdata = "INSERT INTO item (nama_item,deskripsi,gambar_filepath,kategori,harga,stok,id_toko) VALUES(?,?,?,?,?,?,?)";
         $insertstmt = $pdo->prepare($insertdata);
         $insertstmt->execute([$productname,$productdesc,$filename,$category,$price,$stock,$x['id_toko']]);
         header("Location: ../toko/home-toko.php");
     }
?>