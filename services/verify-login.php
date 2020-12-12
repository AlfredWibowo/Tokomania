<?php
    include "./database.php";

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
            header("Location: ../home.php");
        }
        else
        {
            header("Location: ../index.php?stat=2");
        }
    }
    else
    {
        header("Location: ../index.php?stat=1");
    }
?>