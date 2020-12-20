<?php
    include "./services/database.php";
    if(isset($_SESSION['username']))
    {
        header("Location: ./home.php");
    } 
    if(isset($_GET['stat']))
    {
        $error = $_GET['stat'];
        if($error == 2)
        {
            echo "<script>alert('Wrong password and username')</script>";
        }
        else if($error == 2)
        {
            echo "<script>alert('Try again')</script>";
        }
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
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="container-inner">
            <div class="title">
                <h1>LOGIN USER</h1>
            </div>
            <div class="row pt-2 pb-2">
                <div class="col-sm-11 col-md-9 col-lg-8" id="form">
                    <form method="POST" action="./services/verify-login.php">
                        <div class="form-content">  
                            <div class="form-group">
                                <label for="username"><b>Username</b></label>
                                <div class="col-12 col-md-10 col-lg-9" style="margin-left: auto; margin-right: auto">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password"><b>Password</b></label>
                                <div class="col-12 col-md-10 col-lg-9" style="margin-left: auto; margin-right: auto">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-block">Log in</button>
                            <a href="signup.php">Sign up</a><br>
                            <a href="./toko/index.php">Login Toko</a>
                    </form>
                </div> 
            </div>
            
        </div>
    </div>       
</body>
</html>