<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "form1";

$con = new mysqli($host,$user,$pass,$db);
if (!$con) {
   echo "There are some problem while connection the database";
}
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$msg = $_POST['msg'];

$query = "INSERT INTO `table_1`(`name`, `email`, `phone`, `msg`) 
VALUES ('$name','$email','$phone','$msg')";
$insert = mysqli_query($con,$query);
if (!$insert) {
    echo "Please Input Information";
}else {
    
    echo"<script>alert('Submit Success')</script>";
    echo"Please wait for our company, we will deliver the goods.Goods arrive at home to be paid.";
}



?>
<form action="index.php" method ="post">
 <input type="submit"  name="btn">Back</input>

 