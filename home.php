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
        <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                <img class="card-img-top" src="` + `img/`+ item['gambar_filepath'] +`" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">`+ item['nama_item'] +`</h5>
                                    <p class="card-text">`+ item['nama_toko'] +`</p>
                                    <p class="card-text">Rp `+ item['harga'] +`</p>
                                    <a href="./viewitem.php?id=`+ item['id_item'] +`" class="btn btn-primary">More</a>
                                </div>
                            </div>
                            `);
                            col.append(isi);
                            row.append(col);
                            if(num % 3 == 0)
                            {                                
                                $("#item-list").append(row);
                                row = $("<tr></tr>")
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
                        if(res == "logout"){
                            location.reload();
                        }
                    }
                })
            }
        </script>
    </head>
    <body onload="getItem()">
        <?php include "navbar.php"; ?>
        <div class="container">
            
           
            <div class="transparent">
                 <table id="item-list" class="item-list">

                </table>
            </div>
        </div>
    </body>
</html>