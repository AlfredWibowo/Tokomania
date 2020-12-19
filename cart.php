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
            function Remove(id)
            {
                $.ajax({
                    url: "./services/deleteCart.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(res){
                        console.log(res);
                        if(res == "success")
                        {
                            alert("Item berhasil dihapus");
                            ViewCart();
                        }
                        else
                        {
                            alert("Try again");
                        }
                    }
                })
            }
            function buy(id)
            {
                var username = $("#pembeli").val();
                $.ajax({
                    url: "./services/buyCart.php",
                    method: "POST",
                    data: {
                        id: id,
                        username: username
                    },
                    success: function(res){
                        console.log(res);
                        if(res == "success")
                        {
                            alert("Pembelian Berhasil");
                            ViewCart();
                        }
                        else
                        {
                            alert("Try Again");
                        }
                    }
                });
            }
            function ViewCart()
            {
                var username = $("#pembeli").val();
                $.ajax({
                    url: "./services/viewCart.php",
                    method: "POST",
                    data: {
                        username: username
                    },
                    success: function(res){
                        console.log(res);
                        $("#item-list").html('');
                        var table = $("<table class='table'></table>");
                        var title = $(`
                            <thead>
                                <tr>
                                    <td>Nama Item</td>
                                    <td>Toko</td>
                                    <td>Jumlah</td>
                                    <td>Harga</td>
                                    <td>Harga Total</td>
                                    <td>Remove</td>
                                </tr>
                            </thead>
                            `);
                        var grand_total = 0;
                        table.append(title); 
                        var id_pembelian;             
                        res.forEach(function(item){
                            var html = $(`
                                <tr>
                                    <td>` + item['nama_item'] + `</td>
                                    <td>` + item['nama_toko'] + `</td>
                                    <td>` + item['jumlah'] + `</td>
                                    <td>` + item['harga'] + `</td>
                                    <td>` + (item['harga'] * item['jumlah']) + `</td>
                                    <td><button class="btn btn-danger" onclick="Remove(` + item['id_detail'] + `)">Remove</button></td>
                                </tr>
                            `);
                            table.append(html);
                            grand_total += (item['harga'] * item['jumlah']);
                            id_pembelian = item['id_pembelian'];
                        });
                        $("#item-list").append(table);
                        $("#item-list").append("Grand Total = " + grand_total);
                        var buy_button = $(`
                            <div>
                                <button class="btn btn-success" onclick="buy(` + id_pembelian + `)">Buy</button>
                            </div>`);
                        $("#item-list").append(buy_button);
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
    <body onload="ViewCart()">
        <div class="container">
            <div class="menu">
                <ul>
                    <li class="logo"><img src="toped.png"></li>
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="history.php">History</a></li>                    
                </ul>
                <div class="Logout">
                    <a href="#" class="signup-btn" onclick="LogOut()">Log Out</a>
                </div>
            </div>
            <input type="hidden" id="pembeli" value="<?php echo $username; ?>"></input>
            <div id="item-list" class="item-list">

            </div>
        </div>
    </body>
</html>