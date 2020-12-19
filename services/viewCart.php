<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $sql = "SELECT * FROM pembelian a JOIN pembeli b ON a.id_pembeli = b.id_pembeli 
        JOIN detail_pembelian dp ON a.id_pembelian = dp.id_pembelian 
        JOIN item i ON dp.id_item = i.id_item
        JOIn toko t ON i.id_toko = t.id_toko
        WHERE a.status = ? AND b.username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([0,$username]);

        $result = array();
        while($row = $stmt->fetch())
        {
            array_push($result,$row);
        }
        echo json_encode($result);
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
        $error = array(
            'error' => 'Method not Allowed'
        );

        echo json_encode($error);
    }
?>