<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $sql = "SELECT * FROM item i JOIN toko t ON i.id_toko = t.id_toko ORDER BY RAND() LIMIT 9";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

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