<?php 


    

//start session
session_start();

require_once('php/CreateDB.php');
require_once('./php/component.php');

//create instance of CreateDB class
$database = new CreateDB($dbname = "Newdb",
$tablename = "products",
);

if(isset($_POST['Add']))
{
    //print_r($_POST['product_id']);
    if(isset($_SESSION['cart']))
    {
        $item_array_id=array_column($_SESSION['cart'],'product_id');
        
        
        if(in_array($_POST['product_id'],$item_array_id))
        {
            echo"<script>alert('Product is already added in the cart..!')</script>";
            echo"<script>window.location='index.php'</script>";
        }else
        {
            $count=count($_SESSION['cart']);
            $item_array=array(
                'product_id'=>$_POST['product_id']
            );
            $_SESSION['cart'][$count]=$item_array;
            echo"<script>alert('Product is already added in the cart..!')</script>";
            //echo"<script>window.location='index.php'</script>";
        }
    }else{
        $item_array=array(
            'product_id'=>$_POST['product_id']
        );
        //Create new session variable
        $_SESSION['cart'][0] = $item_array;
        echo"<script>alert('Product is already added in the cart..!')</script>";
            //echo"<script>window.location='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <!--font awsome-->
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="images/style.css">
    <!--booststrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous ">
    <link rel="stylesheet" href="style.css">

    
</head>
<body>
    <?php require_once("php/header.php");?> 
    <div class="container">
    <div class="row text-center py-5">
    <?php

$result=$database->getData();
while($row=mysqli_fetch_assoc($result))
{
    component($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
}
?>


</div>
</div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>