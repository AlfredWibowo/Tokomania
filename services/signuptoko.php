<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $usernametoko = $_POST['nama_toko'];
        $passwordtoko = $_POST['passwordtoko'];
        $telptoko = $_POST['no_telp'];
        $emailtoko = $_POST['emailtoko'];
        $confirmpassword = $_POST['confirmpassword'];

        if($usernametoko != '' && $passwordtoko != '' &&  $telptoko != ''  && $confirmpassword != ''){
            if($passwordtoko != $confirmpassword){
                header("Location: ../toko/signuptoko.php?stat=2");
                exit();
            }
            $check = "SELECT * FROM toko WHERE nama_toko = ?";
            $stmt = $pdo->prepare($check);
            $stmt->execute([$usernametoko]);

            if($stmt->rowCount() > 0) {
                echo "<script>history.back();</script>";
            }
            else{
                $insertdata = "INSERT INTO toko (nama_toko,no_telp,email,password) VALUES(?,?,?,?)";
                $insertstmt = $pdo->prepare($insertdata);
                $insertstmt->execute([$usernametoko,$telptoko,$emailtoko,$passwordtoko]);
                $_SESSION['usernametoko'] = $usernametoko;
                header("Location: ../toko/home-toko.php");
            }
        }
        else{
            header("Location: ../toko/signuptoko.php?stat=1x");
        }    
           
    }
    else{
        header("Location: ../toko/signuptoko.php?stat=1y");
    }
?>