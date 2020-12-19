<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $idtoko = $_POST['idtoko'];

        $sql = "SELECT * FROM item WHERE id_toko = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idtoko]);

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