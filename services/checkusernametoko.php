<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $usernametoko = $_POST['nama_toko'];
        if($usernametoko == '')
        {
            echo "empty";
            exit();
        }
        $check = "SELECT * FROM toko WHERE nama_toko = ?";
        $checkstmt = $pdo->prepare($check);
        $checkstmt->execute([$usernametoko]);

        $count = $checkstmt->rowCount();
        if($count > 0)
        {
            echo "no";
        }
        else
        {
            echo "yes";
        }
    }
?>