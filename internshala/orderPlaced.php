


<?php $current_page="Order Confirmation";?>
<?php require_once("include/header.php"); ?>
<?php require_once("include/dbconfig.php"); ?>
<?php require_once("include/helper_Function.php");?>



<?php

session_start(); 
if(isset($_SESSION['shopping_cart'])&&!isset($_SESSION['orderId'])  ){
	 // fetching orderid from orderid table
		$orderIdfetch = "SELECT * from orderid";
		$quer_con1 = mysqli_query($connection,$orderIdfetch);
		    if(!$quer_con1){
		        die("QueryFailed".mysqli_error($connection));
		    }
		  
		$orderId= mysqli_fetch_array($quer_con1 );
		$_SESSION['orderId']=$orderId; 
		$orderIdupdate = "UPDATE orderid set orderId=$orderId[0]+1";
		$query_con2=mysqli_query($connection,$orderIdupdate);
		    if(!$query_con2){
		        die("QueryFailed".mysqli_error($connection));
		    }

}
if(!isset($_SESSION['shopping_cart'])){
	echo"<script>alert('This session is expire')";
	header('location:menu.php');
}
if(isset($_POST['orderPlaced'])){
	$customerName =$_SESSION['name'];
	$customerEmail = $_SESSION['email'];
	$customerAddress =$_POST['customerAddress'];

	$customerContact =$_POST['customerContact'];

	
	$orderId=$_SESSION['orderId'][0];



	$placeOrder="INSERT INTO orders(orderId,customerAddress,customerContact,customerName,customerEmail) VALUES ('$orderId','$customerAddress','$customerContact','$customerName','$customerEmail')";
	$placeOrder_query =  mysqli_query($connection,$placeOrder);
		    if(!$placeOrder_query){
		        die("QueryFailed".mysqli_error($connection));

		    } 
		     //[shopping_cart] => Array ( [0] => Array ( [itemId] => 7 [itemName] => russain dog [itemPrice] => 40 [itemQuantity] => 1 ) ) )
	$orderTable = "orderTable"."$orderId";
	$createorderTable = "CREATE TABLE $orderTable (

						itemId INT PRIMARY KEY,
						itemName VARCHAR(30) NOT NULL,
						itemPrice VARCHAR(30) NOT NULL,
						itemQuantity INT
						)";
	$createOrderTable_query=mysqli_query($connection,$createorderTable );
		    if(!$createOrderTable_query){
		        die("QueryFailed".mysqli_error($connection));

		    }
		    					

       foreach($_SESSION["shopping_cart"] as $keys => $values){
       	$itemId = $values["itemId"];  
		$itemName = $values["itemName"];  
		$itemPrice = $values["itemPrice"];  
		$itemQuantity = $values["itemQuantity"];  

       	$fillItem="INSERT INTO $orderTable(itemId,itemName,itemPrice,itemQuantity) VALUES ('$itemId','$itemName','$itemPrice','$itemQuantity')";
       	$fillItem_query = mysqli_query($connection,$fillItem);
		    if(!$fillItem_query){
		        die("QueryFailed".mysqli_error($connection));

		    } 

       }
       echo"<script>alert('Your order is Placed')</script>";
       unset ($_SESSION['shopping_cart']);
       unset ($_SESSION['orderId']);
       header("refresh:0;home.php");


}





?>

<?php require_once("layout/nav.php") ?>	
<h1 class="white-text my-2 p-2 text-center  orange"> Order Confirmation</h1>
<div class="container mt-4">
	
<div class="row">
<div class="col-lg-4 bg-light sticky" >
	<form method = "post" action="orderPlaced.php" class="mt-5">

		<div class="form-group">
	<label for="Address">Address of Delivery :</label>
	<input type = "text" class="form-control"name="customerAddress" ></div>
	<div class="form-group">
	<label for="Phone">Contact No:</label>
	<input type="number" class="form-control"name="customerContact"></div>
	


	
</div>

<div class="col-lg-8 bg-white " style="">
	<h1>Your Order</h1>
<div class="table-responsive mt-2">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["itemName"]; ?></td>

						<td> <?php echo $values["itemQuantity"]; ?></td>
						<td>$<?php echo $values["itemPrice"]; ?></td>
						<td>$ <?php echo number_format($values["itemQuantity"] * $values["itemPrice"], 2);?></td>
						
					</tr>
					<?php
							$total = $total + ($values["itemQuantity"] * $values["itemPrice"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total + 20%gst</td>
						<td align="right">$ <?php echo number_format($total+$total*0.2, 2); ?></td>
						
					</tr>
					<?php
					}
					?>
						
				</table>
</div></div>				
<div class="mx-auto ">
	<button type="submit" class="btn-danger btn mr-auto" name="orderPlaced">Confirm Order</button>
	<a href="menu.php" role="button"class="btn-danger btn ">Edit</a></div>
</form>		
