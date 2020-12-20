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
                var search = $("#searchbar").val();
                $.ajax({
                    url: "./services/search-toko.php",
                    method: "POST",
                    data: {
                        search: search
                    },
                    success: function(res){
                         console.log(res);
                         $("#item-list").html('');
                         var table = $("<table class='table'></table>");
                         var title = $(`
                         <thead>
                            <tr>
                                <td>Id Toko</td>
                                <td>Nama Toko</td>
                                <td>View</td>
                            </tr>
                        </thead>`);
                         table.append(title);
                         res.forEach(function(item){
                            var html = $(`
                                <tr>
                                <td>`+ item['id_toko'] +`</td>
                                <td>` + item['nama_toko'] + `</td>
                                <td><a href="./viewtoko.php?id=`+ item['id_toko'] +`" class="btn btn-primary">View</a></td>
                                </tr>
                            `);                           
                            table.append(html);
                         });
                         $("#item-list").append(table);
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
    <body>
        <?php include "navbar.php"; ?>
        <div class="container">          
            <div class="search">
                <input type="text" id="searchbar">
                <button type="text" class="btn btn-success" onclick="getItem()">Search</button>
            </div>
            <div class="transparenttable">                
                 <div id="item-list" class="item-list">

                </div>
            </div>
        </div>
    </body>
</html>