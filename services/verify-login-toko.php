<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $usernametoko = $_POST['username'];
        $passwordtoko = $_POST['password'];
        
        $sql = "SELECT * FROM toko WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username,$password]);

        if($stmt->rowCount() == 1)
        {
            $_SESSION['username'] = $usernametoko;
            header("Location: ../home-toko.php");
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