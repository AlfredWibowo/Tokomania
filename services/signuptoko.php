<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $usernametoko = $_POST['nama_toko'];
        $passwordtoko = $_POST['password'];
        $telptoko = $_POST['no_telp'];
        $emailtoko = $_POST['email'];
        $confirmpassword = $_POST['confirmpassword'];

        if($username != '' && $password != '' &&  $telp != '' && $alamat != '' && $confirmpassword != '')
        {
            if($password != $confirmpassword)
            {
                header("Location: ../signup.php?stat=2");
            }
            $check = "SELECT * FROM pembeli WHERE username = ?";
            $stmt = $pdo->prepare($check);
            $stmt->execute([$username]);

            if($stmt->rowCount() > 0)
            {
                echo "<script>history.back();</script>";
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
            header("Location: ../signup.php?stat=1");
        }    
           
    }
    else
    {
        header("Location: ../signup.php?stat=1");
    }
?>