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
            function deleteItem(){
                var id = $("#uid").val();
                $.ajax({
                    url: "../services/deleteitemtoko.php",
                    method:"POST",
                    data:{
                        id: id
                    },
                    success: function(res){
                        console.log(res);
                        if(res == "success"){
                            alert("Product Deleted");
                        }
                        else if(res== "failed"){
                            alert("Something's Wrong");
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
        <?php include "navbar.php"; ?>
        <div class="container">
            <div class="transparenttable">
                <?php
                    if($stmt->rowCount() == 1)
                    {
                        $item = $stmt->fetch();?>
                        <form action = "../services/updateitem.php" method="POST">
                            <div id="item-list" class="item-list" style="text-align:center; width: 100%;">
                                <div class="form-group">
                                    <label>Nama : </label>
                                    <input class="form-control" name="unama" value="<?php echo $item['nama_item']; ?>">
                                </div>     
                                <div class="form-group"> 
                                    <img style="height: 350px;" src="../img/<?php echo $item['gambar_filepath'] ?>">
                                </div>
                                <div class="form-group"> 
                                    <input class="form-control" type="hidden" id="uid" name="uid" value="<?php echo $item['id_item']; ?>">
                                </div>               
                                <div class="form-group">
                                    <label>Deskripsi : </label>
                                    <textarea class="form-control" type="text" style="height: 100px;" name="udesc"><?php echo $item['deskripsi']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kategori : </label>
                                    <input class="form-control" disabled value="<?php echo $item['kategori']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Harga : </label>
                                    <input class="form-control" name="uprice" value="<?php echo $item['harga']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Stok : </label>
                                    <input class="form-control" name="ustock" value="<?php echo $item['stok']; ?>">
                                </div>
                                <button class="btn btn-warning">Edit Product</button>
                                <button class="btn btn-danger" onclick=deleteItem()>Delete Product</button>
                            </div>
                        </form>
                <?php }
                    else
                    {?>
                        <div id="item-list" class="item-list">
                            Item Unavailable
                        </div>
                    <?php } ?>
            </div>            
        </div>
    </body>
</html>