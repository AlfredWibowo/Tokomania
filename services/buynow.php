<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_SESSION['username'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];

        $idsql = "SELECT * FROM pembeli WHERE username = ?";
        $id = $pdo->prepare($idsql);
        $id->execute([$username]);
        $data = $id->fetch();

        $addpembelian = "INSERT INTO pembelian (tanggal,id_pembeli,status) VALUES(CURRENT_TIMESTAMP,?,?)";
        $addstmt = $pdo->prepare($addpembelian);
        $addstmt->execute([$data['id_pembeli'],2]);

        $pembelian = "SELECT * FROM pembelian WHERE id_pembeli = ? AND status = ?";
        $pembelianstmt = $pdo->prepare($pembelian);
        $pembelianstmt->execute([$data['id_pembeli'],2]);
        $idpembelian = $pembelianstmt->fetch();

        $detailsql = "INSERT INTO detail_pembelian (id_pembelian,id_item,jumlah) VALUES(?,?,?)";
        $detailstmt = $pdo->prepare($detailsql);
        $detailstmt->execute([$idpembelian['id_pembelian'],$item,$quantity]);

        $editstatus = "UPDATE pembelian SET status = ? WHERE id_pembelian = ?";
        $editstmt = $pdo->prepare($editstatus);
        $editstmt->execute([1,$idpembelian['id_pembelian']]);
        
        echo "success";
    }
    else
    {
        echo "failed";
    }
?>