<?php
session_start();
// function to return  the data from query
function getData($arr){
        $data = [];
        while ($row = mysqli_fetch_array($arr)) {
            array_push($data,$row);}
        return $data;
    }?>

<?php $current_page="Menu";?>
<!--importing require fills-->
<?php require_once("include/header.php"); ?>
<?php require_once("include/dbconfig.php"); ?>
<?php require_once("include/helper_Function.php");?>
<?php 
// fetching and query dishes from itemtable
$fetchItem = "SELECT * from itemTable";
$quer_con1 = mysqli_query($connection,$fetchItem);
    if(!$quer_con1){
        die("QueryFailed".mysqli_error($connection));
    }
    $result = getData($quer_con1);
?>
<?php


	if(isset($_POST["add_to_cart"]))
{	// checking somebody is login or not
    if(!isset($_SESSION['login'])){
    		echo "<script>
				alert('Please login .Redirecting to login Page');
				window.location.href='login.php';
				</script>";		
    }
    // checking somebody is staff or not
    elseif($_SESSION['type']=='staff'){

    			echo "<div class='notification mx-3 bg-danger text-white p-3'>You are not allowed as you are staff</div>"	;	
    	}

    // shopping cart section 
  elseif(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "itemId");
		$count = count($_SESSION["shopping_cart"]);
		if(!in_array($_GET["id"], $item_array_id))
		{
			//prepare item object
			$item_array = array(
				'itemId'			=>	$_GET["id"],
				'itemName'			=>	$_POST["itemName"],
				'itemPrice'			=>	$_POST["itemPrice"],
				'itemQuantity'		=>	$_POST["itemQuantity"]
			);
			//putting in session
			$_SESSION["shopping_cart"][$count] = $item_array;
			
		}
		else
		{ // if item is already in cart
			echo"<script>
			      alert('item is already in cart');
			      </script>";

		}
	}
	else
	{   // when cart is empty
		$item_array = array(
			'itemId'			=>$_GET["id"]	,
			'itemName'			=>$_POST["itemName"]	,
			'itemPrice'		=>$_POST["itemPrice"]	,
			'itemQuantity'		=>$_POST["itemQuantity"]	
		);
		$_SESSION["shopping_cart"][0] = $item_array;
		
	}

}


// remove from item
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["itemId"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				
				echo '<script>window.location="menu.php"</script>';
			}
		}
	}
}

?>




<body>
<?php require_once("layout/nav.php") ?>
<div class="container-fluid mt-1">
	<h1 class="text-center text-white orange p-2 "> Menu </h1>
<div class="row  py-2">
	<div class="col-lg-8 ">
		<div class="row">


<?php

if(isset($result)){
	
	for ($i=0; $i <count($result); $i++) {
// rendering item from table
?>
<div class="col-lg-4 mt-1">
<form method="post" action="menu.php?action=add&id=<?php echo $result[$i]['itemS.no']; ?>">
	<div class="card" >
						<img src="<?php echo $result[$i]['itemImage']; ?>" class="img-fluid" style="height:150px"/><br />
						<div class="card-body">
						<input type="hidden" name="itemName" value="<?php echo $result[$i]['itemName']; ?>" />
  						<h1 class="orange-text"><?php echo $result[$i]['itemName']; ?></h1>
						<p>Decription:<?php echo $result[$i]['itemDescription']; ?></p>
						Price: <span class="px-2 py-2 my-2 text-white orange"><?php echo $result[$i]['itemPrice']; ?>$</span>
						<input type="hidden" name="itemPrice" value="<?php echo $result[$i]['itemPrice']; ?>" /><br>
						Quantity: <input type="number" name="itemQuantity" value="1" min="1" max="20" class="form-control mt-2" />

						</div>
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success float-right" value="Add to Cart" />
	</div>
</form>

</div>

	<?php	
	}
	
	
}

?>
</div>
</div>
<!--shopping cart section -->
<div class="col-lg-4 bg-white " style="position:fixed;right:0px;z-index:1">
<div class="table-responsive mt-2">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							//rendering from item cart from shopping cart
					?>
					<tr>
						<td><?php echo $values["itemName"]; ?></td>

						<td> <?php echo $values["itemQuantity"]; ?></td>
						<td>$<?php echo $values["itemPrice"]; ?></td>
						<td>$ <?php echo number_format($values["itemQuantity"] * $values["itemPrice"], 2);?></td>
						<td><a href="menu.php?action=delete&id=<?php echo $values["itemId"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["itemQuantity"] * $values["itemPrice"]);
						}
					?>
					<tr>
						<td colspan="2" align="right"> Total + 20%gst</td>
						<td align="right"colspan="3">$ <?php echo number_format($total+$total*0.2, 2); ?>
							
						</td>
						
					</tr>
					<?php
					}
					?>
						
				</table>
				

<!--link to final order confirmation-->
<a class="btn-danger btn" role="button" href="orderPlaced.php">Place Order</a>









</div>

</div>



</div>
</div>

	
</body>
