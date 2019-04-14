 <?php $current_page="Order Confirmation";?>
<?php require_once("include/header.php"); ?>
<?php require_once("include/dbconfig.php"); ?>
<?php require_once("include/helper_Function.php");?>
<?php session_start();
if(!isset($_SESSION['login'])){
  echo"<script>
  alert('You are log out,Please login again');
    </script>";
  header('refresh:0;url=login.php');

}
if($_SESSION['type']!='staff'){
  echo"<script>
  alert('You are not authorise to be here');
    </script>";
  header('refresh:0;url=home.php');
}?>
<?php 
function getData($arr){
        $data = [];
        while ($row = mysqli_fetch_array($arr)) {
            array_push($data,$row);}
        return $data;
    }
//fetching orderdata from orders table
$orderDataFetch = "SELECT * from orders";
$orderData_query = mysqli_query($connection,$orderDataFetch);
			if(!$orderData_query){
		        die("QueryFailed".mysqli_error($connection));

		    }
$orderData = getData($orderData_query);
?>
<body>
<?php require_once("layout/nav.php") ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mt-3">
				<h1 class="card orange white-text mt-4 p-3"> Restuarants orders</h1>
				<a href="staff.php" class="btn btn-orange white-text float-right">Go Back</a>
	<table class="table table-bordered">
		<tr>
			<th>orderId</th>
			<th>customer Name</th>
			<th>customer Email</th>
			<th>customer Address</th>
			<th>customer contact</th>
			
			<th>order</th> 

		</tr>
		<?php
		if(isset($orderData))
					{
						
						foreach($orderData as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["orderId"]; ?></td>
						<td><?php echo $values["customerName"]; ?></td>
						<td><?php echo $values["customerEmail"]; ?></td>
						<td><?php echo $values["customerAddress"]; ?></td>
						<td><?php echo $values["customerContact"]; ?></td>
						<td><a href="showOrders.php?action=view&id=<?php echo $values["orderId"]; ?>"><span class="text-danger btn btn-green">view</span></a></td></td>

					</tr>
					
					<?php
				}
					}
					?>
						
				</table>
</div>
<div class="col-lg-4 p-4 bg-light" style="position: fixed;right:0px;top:150px;" id="view">
	<table class="table table-bordered">
		<tr>
			<th>item Id</th>
			<th>item Name</th>
			<th>item Price</th>
			<th>item Quantity</th>
			
			
		</tr>
	<?php


	if(isset($_GET["action"]))
{ // rendering item from order onclicking view
	if($_GET["action"] == "view")
		$orderId = $_GET['id'];
		$orderTable = "orderTable"."$orderId";


	
		$order = "SELECT * from $orderTable";
		$order_query = mysqli_query($connection,$order);
			if(!$order_query){
		        die("QueryFailed".mysqli_error($connection));

		    }
		$orderDataId = getData($order_query);
		
		foreach($orderDataId as $keys => $values)
						{

	?>



		<tr>
			<td><?php echo $values["itemId"]; ?></td>
			<td><?php echo $values["itemName"]; ?></td>
			<td><?php echo $values["itemPrice"]; ?></td>
			<td><?php echo $values["itemQuantity"]; ?></td>			
		</tr>
					
<?php
}
}
?>



</div>


	