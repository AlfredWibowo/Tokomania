<?php
    include "../services/database.php";
    if(!isset($_SESSION['usernametoko']))
    {
        header("Location: ./index.php");
        exit();
    } 
    $username = $_SESSION['usernametoko'];
    if(isset($_GET['id']))
    {
        $id_item = $_GET['id'];
        $sql = "SELECT * FROM item i JOIN toko t ON i.id_toko = t.id_toko WHERE i.id_item = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_item]);        
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
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloud
        flare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
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
                    <li class="active"><a href="home.php">Home</a></li>
                    <li>Cart</li>
                    <li><a href="search.php">Search</a></li>
                    <li>Contact</li>                    
                </ul>
                <div class="Logout">
                    <a href="#" class="signup-btn" onclick="LogOut()">Log Out</a>
                </div>
            </div>
            <?php
                if($stmt->rowCount() == 1)
                {
                    $item = $stmt->fetch();?>
                    <div id="item-list" class="item-list">
                        <div>
                            <label>Nama : </label>
                            <input disabled value="<?php echo $item['nama_item']; ?>">
                        </div>     
                        <div>
                            <img style="height: 300px;" src="<?php echo $item['gambar_filepath'] ?>">
                        </div>                   
                        <div>
                            <label>Deskripsi : </label>
                            <input disabled value="<?php echo $item['deskripsi']; ?>">
                        </div>
                        <div>
                            <label>Kategori : </label>
                            <input disabled value="<?php echo $item['kategori']; ?>">
                        </div>
                        <div>
                            <label>Harga : </label>
                            <input disabled value="<?php echo $item['harga']; ?>">
                        </div>
                        <div>
                            <label>Stok : </label>
                            <input disabled value="<?php echo $item['stok']; ?>">
                        </div>
                        <button class="btn btn-success">Edit Product</button>
                    </div>
            <?php }
                else
                {?>
                    <div id="item-list" class="item-list">
                        Item Unavailable
                    </div>
                <?php } ?>
                    
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