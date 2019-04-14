<?php session_start()?>

<?php
// restricting  non login or user login's 
if(!isset($_SESSION['login'])){
	echo"<script>
	alert('You are log out,Please login again');
    </script>";
	header('refresh:0;url=login.php');

}
elseif($_SESSION['type']!='staff'){
	echo"<script>
	alert('You are not authorise to be here');
    </script>";
	header('refresh:0;url=home.php');
}
else{
$current_page=$_SESSION['name'];// fetching name of staff
}
?>




<?php require_once("include/header.php"); ?>
<body>
<?php require_once("layout/nav.php") ?>
<div class="container bg-light mt-2">
	<div class="row py-1">
		<div class="col-lg-5  mt-5">
			<div class="  mx-auto mt-3">
			<h1 class="card p-3 orange text-white">Welcome <?php echo $_SESSION['name']?>!</h1>
			<h2 class="my-3 p-3">You can perform this Action</h2>
			<a  class="btn btn-orange white-text"  href="addItem.php">Add Item</a>
				<a  class="btn btn-orange white-text" href="showOrders.php">Show Orders</a>
				<a class="btn btn-orange white-text"  href="menu.php"> Menu</a>	

			</div>	
		</div>

			<div class="col-lg-5 mt-5 text-center">
			<img src="assests/staff.png" height="500">
			</div>
		</div>
	</div>
			