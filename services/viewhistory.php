<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $sql = "SELECT * FROM pembelian a JOIN pembeli b ON a.id_pembeli = b.id_pembeli WHERE b.username = ? AND a.status = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,1]);

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