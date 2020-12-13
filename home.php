<?php
    include "./services/database.php";
    if(!isset($_SESSION['username']))
    {
        header("Location: index.php");
        exit();
    } 
    $username = $_SESSION['username'];
?>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloud
        flare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
            function getItem()
            {
                $.ajax({
                    url: "./services/getitem.php",
                    method: "POST",
                    success: function(res){
                        $("#item-list").html('');
                        var num = 0;                        
                        var row = $("<tr></tr>");
                        res.forEach(function(item){
                            num++;
                            var col = $("<td></td>");

                            var isi = $(`
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="`+ item['gambar_filepath'] +`" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">`+ item['nama_item'] +`</h5>
                                    <p class="card-text">`+ item['nama_toko'] +`</p>
                                    <a href="./viewitem.php?id=`+ item['id_item'] +`" class="btn btn-primary">More</a>
                                </div>
                            </div>
                            `);
                            col.append(isi);
                            row.append(col);
                            if(num % 3 == 0)
                            {                                
                                $("#item-list").append(row);
                                row = $("<td></td>")
                            }
                        });
                        if(num % 3 != 0)
                        {
                            $("#item-list").append(row);
                        }
                    }
                });
            }
            function LogOut()
            {
                $.ajax({
                    url: "./services/logout.php",
                    method: "GET",
                    success: function(res){
                        console.log(res);
                        if(res == "logout"){
                            location.reload();
                        }
                    }
                })
            }
        </script>
    </head>
    <body onload="getItem()">
        <div class="container">
            <div class="menu">
                <ul>
                    <li class="logo"><img src="toped.png"></li>
                    <li class="active">Home</li>
                    <li>Cart</li>
                    <li>Notification</li>
                    <li>Contact</li>                    
                </ul>
                <div class="Logout">
                    <a href="#" class="signup-btn" onclick="LogOut()">Log Out</a>
                </div>
            </div>
            <div id="item-list" class="item-list">
                <!-- <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="toped.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">nama toko</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div> -->
            </div>
            <!-- <div class="quick-menu">
                <ul>
                    <li><i class="fa fa-share-square-o" aria-hidden="true"></i><p>Share</p></li>
                    <li><i class="fa fa-history" aria-hidden="true"></i><p>History</p></li>
                    <li><i class="fa fa-heart-o" aria-hidden="true"></i><p>Favorite</p></li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <p>Message</p></li>
                </ul>
                </div>
                <div class="quick-social">
                    <ul>
                        <li><i class="fa fa-facebook-official" aria-hidden="true"></i></li>
                        <li><i class="fa fa-twitter-square" aria-hidden="true"></i></li>
                        <li><i class="fa fa-instagram" aria-hidden="true"></i></li>

                    </ul>
                    </div>
            </div> -->
        </div>
    </body>
</html>