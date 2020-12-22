<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updatedesc = $_POST['udesc'];
        $updateprice = $_POST['uprice'];
        $updatestock = $_POST['ustock'];
        $updatenama = $_POST['unama'];
        $updatecategory = $_POST['ucateg'];
        $id=$_POST['uid'];

        if($updatenama == "" || $updatedesc == "" || $updatecategory == "" || $updateprice == "" || $updatestock == "")
         {
            header("Location: ../toko/edititemtoko.php?id=".$id."&stat=1");
            exit();
         }
         if($updatecategory != "Book" && $updatecategory != "Fashion" && $updatecategory != "Gadget" && $updatecategory != "Gaming" && $updatecategory != "Kitchen" && $updatecategory != "Tools" && $updatecategory != "Stationary")
         {
            header("Location: ../toko/edititemtoko.php?id=".$id."&stat=2");
            exit();
         }

        $update = "UPDATE item SET nama_item = ?, deskripsi = ?, harga = ?, stok = ?, kategori = ? WHERE id_item = ? ";
        $update = $pdo->prepare($update);
        $update->execute([$updatenama,$updatedesc,$updateprice,$updatestock,$updatecategory,$id]);
        header("Location: ../toko/home-toko.php");
    }
?>