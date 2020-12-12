<?php
    include "./services/database.php"; 
    if(isset($_SESSION['username']))
    {
        header("Location: ./home.php");
    }   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     <script>        
        function CheckUsername()
        {
            var username = $("#username").val();
            console.log(username);
            $.ajax({
                url: "./services/checkusername.php",
                method: "POST",
                data:{
                    username: username
                },
                success: function(result)
                {
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
        function CheckPassword()
        {
            var password = $("#password").val();
            var confirm = $("#confirmpassword").val();
            if(password == '' || confirm == '')
            {
                document.getElementById("checkpass").innerHTML = "";
                document.getElementById("signup").disabled = true;
            }
            else if(password != confirm)
            {
                document.getElementById("checkpass").innerHTML = "Wrong";
                document.getElementById("checkpass").style.color = "red";
                document.getElementById("signup").disabled = true;
            }            
            else if(password == confirm)
            {
                document.getElementById("checkpass").innerHTML = "OK";
                document.getElementById("checkpass").style.color = "green";
                document.getElementById("signup").disabled = false;
            }
        }
    </script>
</head>
<body onload="CheckUsername()">
   <form method="POST" action="./services/signup.php">
        <div class="form-group">
            <label for="username">Username</label>
            <input onkeyup="CheckUsername()" type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            <p id="warning"></p>   
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input onkeyup="CheckPassword()" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="confrimpassword">Confirm Password</label>
            <input onkeyup="CheckPassword()" type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Password" required>
        </div>
        <p id="checkpass"></p>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
        </div>
        <div class="form-group">
            <label for="telp">No Telp</label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="No Telp" required>
        </div>
        <button type="submit" class="btn btn-primary" id="signup" disabled>Sign Up</button>
    </form>
    <?php
        if(isset($_GET['stat']))
        {
            $error = $_GET['stat'];
            if($error == 1)
            {
                echo "<script>alert('Try Again')</script>";
            }
            else if($error == 2)
            {
                echo "<script>alert('Password Incorrect')</script>";
            }
        }
    ?>   
</body>
</html>