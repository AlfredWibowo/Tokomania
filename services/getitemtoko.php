<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $namatoko = $_SESSION['usernametoko'];
        $sql = "SELECT * FROM item i JOIN toko t ON i.id_toko = t.id_toko WHERE nama_toko = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$namatoko]);

        $result = array();
         while($row = $stmt->fetch()) {
            array_push($result, $row);
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