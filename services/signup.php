<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $confirmpassword = $_POST['confirmpassword'];

        if($username != '' && $password != '' && $nama != '' && $telp != '' && $alamat != '' && $confirmpassword != '')
        {
            if($password != $confirmpassword)
            {
                echo "<script>alert('Password Incorrect'); history.back();</script>";
                exit();
            }
            $check = "SELECT * FROM pembeli WHERE username = ?";
            $stmt = $pdo->prepare($check);
            $stmt->execute([$username]);

            if($stmt->rowCount() > 0)
            {
                echo "<script>alert('Username Unavailabale'); history.back();</script>";
                exit();
            }
            else
            {
                $insertdata = "INSERT INTO pembeli (nama,no_telp,alamat,username,password) VALUES(?,?,?,?,?)";
                $insertstmt = $pdo->prepare($insertdata);
                $insertstmt->execute([$nama,$telp,$alamat,$username,$password]);
                $_SESSION['username'] = $username;
                header("Location: ../home.php");
            }
        }
        else
        {
            echo "<script>alert('Empty Fields'); history.back();</script>";
            exit();
        }    
           
    }
    else
    {
        echo "<script>alert('Try Again'); history.back();</script>";
        exit();
    }
?>