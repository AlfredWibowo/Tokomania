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