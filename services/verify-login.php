<?php
    include "./database.php";

    header("Content-Type: application/json");

    $status = array(
        'stat' => 0
    );

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM pembeli WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,$password]);

        if($stmt->rowCount() == 1)
        {
            session_start();
            $_SESSION['username'] = $username;
            $status['stat'] = 1;
        }
        echo json_encode($status);
    }
    else
    {
        echo json_encode($status);
    }
?>