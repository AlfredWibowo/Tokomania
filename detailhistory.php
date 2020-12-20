<?php
    include "./services/database.php";
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM detail_pembelian dp JOIN item i ON dp.id_item = i.id_item WHERE id_pembelian = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
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
            <!-- <div class="menu">
                <ul>
                    <li class="logo"><img src="toped.png"></li>
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="search-toko.php">Search Toko</a></li>
                    <li><a href="history.php">History</a></li>                    
                </ul>
                <div class="Logout">
                    <a href="#" class="signup-btn" onclick="LogOut()">Log Out</a>
                </div>
            </div> -->
            <div class="transparenttable">
                 <div id="item-list" class="item-list">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Item</td>
                                <td>Jumlah</td>
                                <td>Total Harga</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                    <?php
                        while($row = $stmt->fetch()){?>
                            <tr>
                                <td><?php echo $row['nama_item']; ?></td>
                                <td><?php echo $row['jumlah'] ?></td>
                                <td><?php echo ($row['jumlah'] * $row['harga']) ?></td>
                                <td><?php 
                                    if($row['status'] == 0)
                                    {
                                        echo "<p style='color:yellow;'>Waiting</p>";
                                    }
                                    else if($row['status'] == 1)
                                    {
                                        echo "<p style='color:green;'>Confirmed</p>";
                                    }
                                    else if($row['status'] == 2)
                                    {
                                        echo "<p style='color:red;'>Canceled</p>";
                                    }
                                ?></td>
                            </tr>
                    <?php } ?>                
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
