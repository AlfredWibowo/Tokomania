<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];

        $sql = "DELETE FROM detail_pembelian WHERE id_detail = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        echo "success";
    }
    else{
        echo "failed";
    }
?>