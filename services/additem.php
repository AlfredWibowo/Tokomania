<?php
     $name = "";
     if($_SERVER['REQUEST_METHOD'] == 'POST')
     {
         $productname = $_FILES['pname'];
         $productdesc = $_FILES['desc'];
         $file = $_FILES['img'];
         $idtoko = 
         $namaitem = 
         $iditem = 
         $filename = $idtoko.$namaitem.$iditem; // filename pake idtoko + namaitem + iditem
         $destination = "img/".$filename;
         move_uploaded_file($file['tmp_name'],$destination);
         $category = $_FILES['categ'];
         $price = $_FILES['price'];
         $stock = $_FILES['stock'];
     }
?>