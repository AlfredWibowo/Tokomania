<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];

        $sql = "UPDATE detail_pembelian
                SET status = ? 
                WHERE id_detail = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([2,$id]);
        echo "success";
    }
    else{
        echo "failed";
    }
?>