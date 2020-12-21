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
        
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="./css/profile.css"> 
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
        <?php include "navbar.php"; 
          $user = $stmt->fetch();      
        ?>
        <div class="container">
            <div class="title mt-2">
                <h1>
                    USER PROFILE
                </h1>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-9 col-12" style="margin-left: auto; margin-right: auto;">
                <div class="card">
                    <img class="card-img-top" src="./img/profile_icon.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $user['nama']; ?>
                        </h5>
                        <p class="card-text">DESC USER</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            ID PEMBELI :  <?php echo $user['id_pembeli']; ?>
                        </li>
                        <li class="list-group-item">
                            NAMA : <?php echo $user['nama']; ?>
                        </li>
                        <li class="list-group-item">
                            ALAMAT : <?php echo $user['alamat']; ?>
                        </li>
                        <li class="list-group-item">
                            NO TELP : <?php echo $user['no_telp']; ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <button href="#" class="btn-primary">Edit Profile</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>