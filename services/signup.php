<?php
    require "./database.php";

    header("Content-Type: application/json");

    $status = array(
        'stat' => 0
    );
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];

        if($username != '' && $password != '' && $nama != '' && $telp != '' && $alamat != '')
        {
            $check = "SELECT * FROM pembeli WHERE username = ?";
            $stmt = $pdo->prepare($check);
            $stmt->execute([$username]);

            if($stmt->rowCount() > 0)
            {
                $status['stat'] = 2;
            }
            else
            {
                $status['stat'] = 1;
                $insertdata = "INSERT INTO pembeli (nama,no_telp,alamat,username,password) VALUES(?,?,?,?,?)";
                $insertstmt = $pdo->prepare($insertdata);
                $insertstmt->execute([$nama,$telp,$alamat,$username,$password]);
            }
        }    
        
        echo json_encode($status);    
    }
    else
    {
       echo json_encode($status); 
    }
?>