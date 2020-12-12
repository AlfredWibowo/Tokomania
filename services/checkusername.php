<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        if($username == '')
        {
            echo "empty";
            exit();
        }
        $check = "SELECT * FROM pembeli WHERE username = ?";
        $checkstmt = $pdo->prepare($check);
        $checkstmt->execute([$username]);

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