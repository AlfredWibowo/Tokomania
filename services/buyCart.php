<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id_pembelian = $_POST['id'];
        $username = $_POST['username'];
        $sql = "UPDATE pembelian SET status = ?, tanggal = CURRENT_TIMESTAMP WHERE id_pembelian = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([1,$id_pembelian]);

        $id_pembeli_sql = "SELECT * FROM pembeli WHERE username = ?";
        $id_pembeli_stmt = $pdo->prepare($id_pembeli_sql);
        $id_pembeli_stmt->execute([$username]);

        $id_pembeli = $id_pembeli_stmt->fetch();

        $addpembelian = "INSERT INTO pembelian (tanggal,id_pembeli,status) VALUES(CURRENT_TIMESTAMP,?,?)";
        $addstmt = $pdo->prepare($addpembelian);
        $addstmt->execute([$id_pembeli['id_pembeli'],0]);

        echo "success";
    }
    else
    {
        echo "failed";
    }
?>