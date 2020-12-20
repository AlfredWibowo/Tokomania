<?php
    include "../services/database.php";    
    if(isset($_SESSION['usernametoko']))
    {
        header("Location: ./home-toko.php");
    } 

    if(isset($_GET['stat'])){
        $error = $_GET['stat'];
        if($error == 1){
            echo "<script>alert('Try Again')</script>";
        }
         else if($error == 2){
            echo "<script>alert('Password Incorrect')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Toko</title>
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     <script>        
        function CheckUsername() {
            var username = $("#nama_toko").val();
            console.log(username);
            $.ajax({
                url: "../services/checkusernametoko.php",
                method: "POST",
                data:{
                    nama_toko: username
                },
                success: function(result)
                {
                    console.log(result);
                    if(result == "no")
                    {
                        document.getElementById("warning").innerHTML = "Username unavailable";
                        document.getElementById("warning").style.color = "red";
                        document.getElementById("signup").disabled = true;
                    }
                    else if(result == "yes")
                    {
                        document.getElementById("warning").innerHTML = "Username available";
                        document.getElementById("warning").style.color = "green";
                        document.getElementById("signup").disabled = false;
                    }
                    else if(result == "empty")
                    {
                        document.getElementById("warning").innerHTML = "";
                        document.getElementById("signup").disabled = true;
                    }
                }
            });
        }
        function CheckPassword() {
            var password = $("#passwordtoko").val();
            var confirm = $("#confirmpassword").val();
            if(password == '' || confirm == '') {
                document.getElementById("checkpass").innerHTML = "";
                document.getElementById("signup").disabled = true;
            }
            else if(password != confirm) {
                document.getElementById("checkpass").innerHTML = "Wrong";
                document.getElementById("checkpass").style.color = "red";
                document.getElementById("signup").disabled = true;
            }            
            else if(password == confirm){
                document.getElementById("checkpass").innerHTML = "OK";
                document.getElementById("checkpass").style.color = "green";
                document.getElementById("signup").disabled = false;
            }
        }
    </script>
</head>
<body onload="CheckUsername()">
    <div class="container">
        <div class="title">
            <h2>SIGN UP TOKO</h2>
        </div>
        <form method="POST" action="../services/signuptoko.php">
            <div class="row pt-2 mt-5">
                <div class="col-md-12 col-sm-11 col-12">
                    <div class="form-group">
                        <label for="nama-toko">Nama Toko</label>
                        <input onkeyup="CheckUsername()" type="text" class="form-control" name="nama_toko" id="nama_toko" placeholder="Username" required>
                        <p id="warning"></p>   
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-11 col-12">
                    <div class="form-group">
                        <label for="passwordtoko">Password</label>
                        <input onkeyup="CheckPassword()" type="password" class="form-control" name="passwordtoko" id="passwordtoko" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-11 col-12">
                    <div class="form-group">
                            <label for="confrimpassword">Confirm Password</label>
                            <input onkeyup="CheckPassword()" type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Password" required>
                    </div>
                        <p id="checkpass"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-11 col-12">
                    <div class="form-group">
                        <label for="emailtoko">Email</label>
                        <input type="text" class="form-control" name="emailtoko" id="emailtoko" placeholder="Email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-11 col-12">
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pb-2 mb-5">
                <button type="submit" class="btn btn-primary" id="signup" disabled>Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>