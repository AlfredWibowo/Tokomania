<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updatedesc = $_POST['udesc'];
        $updateprice = $_POST['uprice'];
        $updatestock = $_POST['ustock'];
        $updatenama = $_POST['unama'];
        $id=$_POST['uid'];

        $update = "UPDATE item SET nama_item = ?, deskripsi = ?, harga = ?, stok = ? WHERE id_item = ? ";
        $update = $pdo->prepare($update);
        $update->execute([$updatenama,$updatedesc,$updateprice,$updatestock,$id]);
        header("Location: ../toko/home-toko.php");
    }
?>