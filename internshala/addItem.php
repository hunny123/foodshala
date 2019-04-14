<?php $current_page="Add The Dish";?>
<?php require_once("include/header.php"); ?>
<?php require_once("include/dbconfig.php"); ?>
<?php require_once("include/helper_Function.php");?>
<?php session_start();?>
<?php
$upload_folder = "upload/";//mention folder for saving images
if(!isset($_SESSION['login'])){
  echo"<script>
  alert('You are log out,Please login again');
    </script>";
  header('refresh:0;url=login.php');

}                                   // checking for staff or non-login's
if($_SESSION['type']!='staff'){
  echo"<script>
  alert('You are not authorise to be here');
    </script>";
  header('refresh:0;url=home.php');
}
//add item 

if(isset($_POST['submit'])){
   $itemName = escape($_POST["itemName"]);
   $itemType = escape($_POST["itemType"]);
   $itemDescription = escape($_POST["itemDescription"]);
   $itemPrice = $_POST["itemPrice"];
   if(strlen($itemName)<4)
   {
   	$itemNameError = "Fill the Name";
   }
   if(strlen($itemType)<3)
   {
   	$itemTypeError = "Type should be Veg or Non-Veg";
   }
   if($itemName =="Veg" || $itemName=="Non-Veg"){
   	$itemTypeError = "Fill either Non-veg or Veg";
   }

   if(strlen($itemDescription)<10)
   {
   	$itemDescriptionError = "Description should be greater then 10 character";
   }
   if($itemPrice=="" || $itemPrice<10){
   	$itemPriceError = "Price should not be empty or less then 10";
   }
    $itemDate = date("h:i:sa");





    require_once("include/imageUpload.php");
    if(!isset($imageError)){
    	    
    		$itemImage = $upload_folder . $filename;
    		echo $itemImage;
    		echo"<script> alert('Image is Uploaded successfully')</script>";
    }
    


if(!isset($itemNameError) && !isset($itemTypeError) && !isset($itemDescriptionError) && !isset($itemPriceError) && !isset($imageError)  ){
  //inserting item to itemTable
	 $addItem = "INSERT INTO itemtable (itemName,itemType,itemDescription,itemPrice,itemImage,itemDate) VALUES ('$itemName','$itemType','$itemDescription','$itemPrice','$itemImage','$itemDate')";
	 	$query_conn = mysqli_query($connection, $addItem);
                            if(!$query_conn) {
                                die("Query failed" . mysqli_error($connection));
                            }
                            header('Location:staff.php');
                                             
     }

}

?>
<body>
  <?php require_once("layout/nav.php") ?> 
  <h1 class=" mx-3 py-2 white-text text-center card orange" > Add Dish</h1>
  <div class="container bg-light">
	
  <div class="row ">
	<div class="col-lg-5 card ">
	<form action="additem.php" method="post" enctype="multipart/form-data">
  
    Name:
    <input type="text" class="form-control" id="name" name="itemName">
    <?php if(isset($itemNameError)){echo "<span class='bg-danger py-1 white-text'>$itemNameError</scan>";} ?>
    Type:
   <select class="form-control" id="sel1" name="itemType">
    <option>Veg</option>
    <option>Non-Veg</option>
    
  </select>
  <?php if(isset($itemTypeError)){echo "<span class='bg-danger py-1 white-text'>$itemTypeError</scan>";} ?>
  
  
    <label for="description" class="form-check-label" >Description:
      <textarea class="form-control"row="5"name="itemDescription"></textarea>
      <?php if(isset($itemDescriptionError)){echo "<span class='bg-danger py-1 white-text'>$itemDescriptionError</scan>";} ?>
    </label>
  
  <div class="form-group">
	
    <label for="Image">Image:</label>
    <input type="file" name="photo" id="fileSelect" accept="image/*">
    <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
    <?php if(isset($imageError)){echo "<span class='bg-danger py-1 white-text'>$imageError</scan>";} ?>
	
  </div>
  <div class="form-group">
    <label for="Price">Price:</label>
    <input type="text" class="form-control" id="price" name="itemPrice">
    <?php if(isset($itemPriceError)){echo "<span class='bg-danger py-1 white-text'>$itemPriceError</scan>";} ?>
  </div>
  <button type="submit" name ="submit" class="btn btn-primary">Submit</button>
  <a href="staff.php" class="btn btn-orange white-text">Go Back</a>


</form>
</div>
<div class="col-lg-6">
  <img src="assests/order.png" alt="image" height="400">
  </div>
</body>