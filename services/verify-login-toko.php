<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $usernametoko = $_POST['nama_toko'];
        $passwordtoko = $_POST['password'];
        
        $sql = "SELECT * FROM toko WHERE nama_toko = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usernametoko,$passwordtoko]);

        if($stmt->rowCount() == 1)
        {
            $_SESSION['usernametoko'] = $usernametoko;
            header("Location: ../toko/home-toko.php");
        }
        else
        {
            header("Location: ../toko/index.php?stat=2");
        }
    }
    else
    {
        header("Location: ../toko/index.php?stat=1");
    }
?>