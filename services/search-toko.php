<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $search = $_POST['search'];

        $sql = "SELECT * FROM toko WHERE nama_toko LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['%'.$search.'%']);

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