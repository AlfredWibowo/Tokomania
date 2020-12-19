<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['usernametoko'];
        $sql = "SELECT * FROM detail_pembelian dp JOIN item i ON dp.id_item = i.id_item 
                JOIN toko t ON i.id_toko = t.id_toko  
                JOIN pembelian a ON dp.id_pembelian = a.id_pembelian
                JOIN pembeli b ON a.id_pembeli = b.id_pembeli
                WHERE t.nama_toko = ? AND dp.status = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,0]);

        $data = array();

        while($row = $stmt->fetch())
        {
            array_push($data,$row);
        }

        echo json_encode($data);
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