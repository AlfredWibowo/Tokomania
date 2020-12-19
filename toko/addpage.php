<?php
    include "../services/database.php";
    if(!isset($_SESSION['usernametoko']))
    {
        header("Location: index.php");
        exit();
    } 
    $username = $_SESSION['usernametoko'];
    if(isset($_GET['stat']))
    {
        if($_GET['stat'] == 1)
        {
            echo "<script>alert('Hanya support tipe file .jpg dan .png')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Products</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

        <script>
            function back(){
                window.location.href = "home-toko.php";
            }
        </script>
    </head>
    <body>
        <form method="POST" action="../services/additem.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pname"><b>Product Name</b></label>
                <input type="text" class="form-control" name="pname" id="pname" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                <label for="desc"><b>Products Description</b></label>
                <textarea class="form-control scrollabletextbox" name="desc" id="desc" placeholder="Product Description Here"></textarea>
            </div>
            <div class="form-group">
                <label for="img"><b>Image</b></label><br>
                <input type="file" name="img" accept=".jpg,.png" required>
            </div>
            <div class="form-group">
                <label for="categ"><b>Category</b></label>
                <input list="category" name="categ" id="categ" placeholder="Select Category" required>
                <datalist id="category">
                    <option value="Book"></option>
                    <option value="Fashion"></option>
                    <option value="Gadget"></option>
                    <option value="Gaming"></option>
                    <option value="Kitchen"></option>
                    <option value="Tools"></option>
                    <option value="Stationary"></option>
                </datalist>
            </div>
            <div class="form-group">
                <label for="price"><b>Price</b></label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
            </div>
            <div class="form-group">
                <label for=""><b>Stock</b></label>
                <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock Quantity" required>
            </div>
            <!-- css inline block dong -->
            <div> 
                <button type="submit" class="btn btn-primary">Add Now</button>
            </div>
            <!-- -->
        </form>
        <!-- css inline block dong -->
        <div>
            <button class="btn btn-primary" onclick="back()" >Back</button>
        </div>
        <!-- -->
    </body>

</html>