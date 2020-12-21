<?php
    include "../services/database.php";
    if(!isset($_SESSION['usernametoko']))
    {
        header("Location: index.php");
        exit();
    } 
    $username = $_SESSION['usernametoko'];
    
    $sql = "SELECT * FROM toko WHERE nama_toko = ?";
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
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="../css/profile.css">

        <script>
            
            function LogOut()
            {
                $.ajax({
                    url: "../services/logout.php",
                    method: "GET",
                    success: function(res){
                        if(res == "logout"){
                            location.reload();
                        }
                    }
                })
            }
            function Update()
            {
                $("#updateform").submit();
            }
        </script>
    
    </head>
    <body>
    <?php include "navbar.php"; 
          $toko = $stmt->fetch();      
        ?>
        <div class="container">
            <div class="title mt-2" style="text-align:center; color: white;">
                <h1>
                    TOKO PROFILE
                </h1>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-9 col-12" style="margin-left: auto; margin-right: auto;">
                <div class="card">
                   <img class="card-img-top" src="<?php if($toko['foto_filepath'] == NULL){ echo './img/profile_icon.jpg';} else{echo '../img/'.$toko['foto_filepath'];}  ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $toko['nama_toko']; ?>
                        </h5>
                        <p class="card-text">DESC USER</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            ID TOKO :  <?php echo $toko['id_toko']; ?>
                        </li>
                        <li class="list-group-item">
                            NAMA TOKO : <?php echo $toko['nama_toko']; ?>
                        </li>
                        <li class="list-group-item">
                            EMAIL : <?php echo $toko['email']; ?>
                        </li>
                        <li class="list-group-item">
                            NO TELP : <?php echo $toko['no_telp']; ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-primary btn-block"  data-toggle="modal" data-target="#update">Edit Profile</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div id="update" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Profile</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="../services/updateprofiletoko.php" id="updateform">
                        <div class="form-group">
                            <label for="updateemaul" style="float: left;">Email</label>
                            <input type="text" name="updateemail" class="form-control" id="updatenama" required>
                        </div>
                        <div>
                            <label for="updatetelp" style="float: left;">No Telepon</label>
                            <input type="text" name="updatetelp" class="form-control" id="updatetelp" required>
                        </div>
                        <div class="form-group">
                            <label for="updatefoto" style="float: left;">Foto</label>
                            <input type="file" name="updatefoto" id="updatefoto" class="form-control-file" accept=".jpg,.png" required>
                        </div>                        
                    </form>  

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="Update()">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
            </div>
        </div> 
    </body>
</html>