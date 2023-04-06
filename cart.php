
<?php
session_start();
require_once('php/CreateDB.php');
require_once('php/component.php');

$db=new CreateDB($dbname = "Newdb",$tablename = "products");

if(isset($_POST['remove']))
{
    if($_GET['action']=='remove')
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value["product_id"]== $_GET['id'])
            {
                unset($_SESSION['cart'][$key]);
                echo"<script>alert('Product has been Remove.....!')</script>";
                echo"<script>window.location='cart.php'</script>";
            }
        }
    }
}
if(isset($_POST['Saveforlater']))
{
    if($_GET['action']=='Saveforlater')
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value["product_id"]== $_GET['id'])
            {
                unset($_SESSION['cart'][$key]);
                echo"<script>alert('Product has been save.....!')</script>";
                echo"<script>window.location='cart.php'</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!--font awsome-->
    <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!--booststrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous ">
    <link rel="stylesheet" href="style.css">

</head>
<body class="bg-light">
    
<?php 
require_once('php/header.php');
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <br>
                <h6>My Cart</h6>
                
                <hr>
                
                    <?php
                    $total=0;
                   if(isset($_SESSION['cart']))
                   {
                    $product_id=array_column($_SESSION['cart'],'product_id');
                    $result=$db->getData();
                    while($row=mysqli_fetch_assoc($result))
                    {
                        foreach ($product_id as $id) 
                        {
                            if($row['id']==$id)
                            {
                                cartElement($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
                                $total=$total + (int)$row['product_price'];
                            }
                        }
                    }
                   }else
                   {
                    echo "<h5>Cart is Empty</h5>";
                   }
                    ?>
       
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                   <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php 
                                if(isset($_SESSION['cart']))
                                {
                                    $count=count($_SESSION['cart']);
                                    echo "<h6>Price($count items)</h6>";
                                }else
                                {
                                    echo "<h6>Price(0 items)</h6>";
                                }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payment</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo  $total;?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php 
                                echo $total;
                            ?></h6>
                        
                        
          
</div>
 
<hr>
<div class="pt-2">
                    <h6>Complete Information</h6>  
                       <form action="send.php" method ="post">
                       <div class="row price-details">
                       <div class="col-md-6">
   <input type="text" name="name" placeholder="Name">
   
   <input type="text" name="email" placeholder="Email">
   <input type="number" name="phone" placeholder="Phone">
   <textarea name="msg" placeholder="Input your Location "></textarea>
   <button type="submit" class="btn btn-warning">Submit To Buy</button>
                           </div>
                           </div>
   </form>             
                        
                      </div>
                 </div>
                 
             </div>
         </div>

                  
                           
    </div>
</div>

 
                   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>