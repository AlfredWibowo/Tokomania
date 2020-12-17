<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $iditem = $_POST['id'];

        $dlt = "DELETE FROM item WHERE id_item = ?";
        $result = $pdo->prepare($dlt);
        $result->execute([$iditem]);
        echo "success";
    }
    else{
        echo "failed";
    }
?>