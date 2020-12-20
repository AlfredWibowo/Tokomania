<?php
    include "./services/database.php";
    if(!isset($_SESSION['username']))
    {
        header("Location: index.php");
        exit();
    } 
    $username = $_SESSION['username'];
    
    $sql = "SELECT * FROM pembeli WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Toko</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/profile.css">
        <link rel="stylesheet" href="./css/home.css">

        <script>
            function LogOut()
            {
                $.ajax({
                    url: "./services/logout.php",
                    method: "GET",
                    success: function(res){
                        if(res == "logout"){
                            location.reload();
                        }
                    }
                })
            }
        </script>
    
    </head>
    <body>
        <?php include "navbar.php"; ?>
        <div class="container">
            <div class="containerprofile center" style="margin-top:10%;">
                <?php
                    $toko=$stmt->fetch();
                ?>
                
                <div>
                    <h1 style="text-align:center">User Profile</h1>
                </div>

                <div class="data">
                    <div class="idtoko">
                        <label> <?php echo $toko['id_pembeli']; ?> </label>
                    </div>
                    <div class="label">
                        <label >ID Pembeli</label>
                    </div>
                    <div class="email">
                        <label> <?php echo $toko['username']; ?> </label>
                    </div>
                    <div class="label">
                        <label >Username</label>
                    </div>
                    <div class="namatoko">
                        <label> <?php echo $toko['nama']; ?> </label>
                    </div>
                    <div class="label">
                        <label >Nama</label>
                    </div>
                    <div class="notelp">
                        <label> <?php echo $toko['alamat']; ?> </label>
                    </div>
                    <div class="label">
                        <label >Alamat</label>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>