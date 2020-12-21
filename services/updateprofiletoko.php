<?php
    include "./database.php";

    function RandomString()
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randchar = substr($characters, rand(0, strlen($characters)), 1);
            $randstring = $randstring . $randchar;
        }
        return $randstring;
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $telp = $_POST['updatetelp'];     
        $email = $_POST['updateemail']; 
        $username = $_SESSION['usernametoko'];

        if($email != '' && $telp != '')
        {
            $foto = $_FILES['updatefoto'];
            $randomstring = RandomString();
            $path = $_FILES['updatefoto']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if($ext != "png" && $ext != "jpg")
            {
                echo "<script>alert('Only Support .png and .jpg files'); history.back();</script>";
                exit();
            }
            $filename = $username."_profiletoko_".$randomstring.".".$ext; // filename pake namatoko+productname
            $destination = "../img/".$filename;
            move_uploaded_file($foto['tmp_name'],$destination);

            $insertdata = "UPDATE toko SET
                            no_telp = ?,
                            email = ?,
                            foto_filepath = ?
                            WHERE nama_toko = ?";
            $insertstmt = $pdo->prepare($insertdata);
            $insertstmt->execute([$telp,$email,$filename,$username]);

            header("Location: ../toko/profiletoko.php");
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