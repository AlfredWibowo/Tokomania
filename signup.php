<?php
    include "./services/database.php";
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
</head>
<body>
   <form method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
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
        <button type="text" class="btn btn-primary" onclick="signup()">Sign Up</button>
    </form>
    <script>
        function signup()
        {
            var nama = $("#nama").val();
            var alamat = $("#alamat").val();
            var no_telp = $("#telp").val();
            var username = $("#username").val();
            var password = $("#password").val();
            console.log("hello");
             
            $.ajax({
                url: "./services/signup.php",
                method: "POST",
                data: {
                    username : username,
                    password : password,
                    nama: nama,
                    no_telp: no_telp,
                    alamat: alamat
                },
                success: function(result){
                    console.log(result);
                    if(result.stat == 1)
                    {
                        window.location.href = "home.php";
                    }
                    else
                    {
                        console.log("login gagal");
                    }
                }
            })
           
        }
    </script>
</body>
</html>