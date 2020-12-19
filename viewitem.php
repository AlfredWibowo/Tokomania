<?php
    include "./services/database.php";
    if(!isset($_SESSION['username']))
    {
        header("Location: index.php");
        exit();
    } 
    $username = $_SESSION['username'];
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
            function AddToCart()
            {
                console.log("masuk");
                var quantity = $("#quantity").val();
                var item = $("#item").val();
                console.log(quantity);
                console.log(item);
                $.ajax({
                    url: "./services/addtocart.php",
                    method: "POST",
                    data: {
                        quantity: quantity,
                        item: item
                    },
                    success: function(res){
                        console.log(res);
                            if(res == "success")
                            {
                                alert("Item Sudah ditambah");
                            }
                            else
                            {
                                alert("Try Again");
                            }
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="menu">
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
            </div>
            <?php
                if($stmt->rowCount() == 1)
                {
                    $item = $stmt->fetch();?>
                    <div id="item-list" class="item-list">
                        <div>
                            <label>Nama : </label>
                            <input disabled value="<?php echo $item['nama_item']; ?>">
                            <input type="hidden" id="item" value="<?php echo $item['id_item']; ?>">
                        </div>     
                        <div>
                            <img style="height: 300px;" src="img/<?php echo $item['gambar_filepath'] ?>">
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
                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add to Cart</button>
                    </div>
            <?php }
                else
                {?>
                    <div id="item-list" class="item-list">
                        Item Unavailable
                    </div>
                <?php } ?>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add To Cart</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <label>Nama : </label>
                            <input disabled value="<?php echo $item['nama_item']; ?>"><br>
                            <label>Quantity : </label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="AddToCart()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>