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
        $nama = $_POST['updatenama'];
        $telp = $_POST['updatetelp'];
        $alamat = $_POST['updatealamat'];        
        $username = $_SESSION['username'];

        if($nama != '' && $telp != '' && $alamat != '')
        {
            $foto = $_FILES['updatefoto'];
            $randomstring = RandomString();
            $path = $_FILES['updatefoto']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if($ext != "png" && $ext != "jpg")
            {
                echo "<script>alert('Only Support .png adn .jpg files'); history.back();</script>";
                exit();
            }
            $filename = $username."_profile_".$randomstring.".".$ext; // filename pake namatoko+productname
            $destination = "../img/".$filename;
            move_uploaded_file($foto['tmp_name'],$destination);

            $insertdata = "UPDATE pembeli SET
                            nama = ?,
                            alamat = ?,
                            no_telp = ?,
                            foto_filepath = ?
                            WHERE username = ?";
            $insertstmt = $pdo->prepare($insertdata);
            $insertstmt->execute([$nama,$telp,$alamat,$filename,$username]);

            header("Location: ../profileuser.php");
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