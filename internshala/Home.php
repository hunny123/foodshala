<?php $current_page="Home";

session_start();
?>
<?php require_once("include\header.php"); ?>
<style >
	
	.img-height{
		height:150px;
	}
</style>
<body>
<div class=" big ">
		
<?php require_once("layout/nav.php") ?>

   <div class='container '>
   	<div class="row mt-5  pb-0">
   		<div class="col-md-7 d-lg-none d-sm-block d-md-none " >
   			<img class="img-fluid mt-4" src="assests/graphics.svg">
   		</div>
   		<div class="col-md-5 mt-2  ">
   			<object data="assests/message1.svg" type="image/svg+xml"  class="embed-responsive-item ">
   				
   			</object>
			<a href="#about" class="btn btn-lg btn-orange white-text">About</a>
   		
   		</div>
   		<div class="col-md-7  d-none d-lg-block d-md-block" >
   			<img class="img-fluid mt-2" src="assests/graphics.svg">
   		</div>

	</div></div></div>
	
	<div class="container-fluid py-4 grey lighten-5 " id="about">
		<div class="row   mt-4">
			<div class="col-lg-1 d-none d-lg-block pl-2">
			</div>
			
			<div class="col-lg-3 mx-2 mt-5 ">

				<p class="bigFront py-4  orange-text">Who<br> We Are</p>
				<p class="smallFront ml-1  text-justify ">Is a warm and welcoming restaurant, we also specialize in every kind of South Indian food and North Indian tandoori dishes. All the branches provide specially cooked vegetarian dishes, specially made for our vegetarian clientele. South Indian cuisine is one of the spiciest and most aromatic in Indian culture.</p>
                <a class="btn px-5 btn-rounded white-text  btn-orange mt-5 d-none d-lg-inline-block  "  role="button"href="menu.php">Menu</a>
			</div>
			<div class="col-lg-1 d-none d-lg-block pl-2">
			</div>
			<div class="col-lg-6 ml-2 mt-5">
				<div class="row pl-1 mt-3">
					<div class="col-md-6">
							<img src="http://www.foodofy.com/wp-content/uploads/2015/07/11014_14_site_clear.jpeg" class="my-4 img-fluid img-height" alt="image">
							<h3>South indian cuisine</h3>
							
						</div>
						<div class="col-md-6">
							<img src="https://www.franchiseindia.com/uploads/content/ri/art/what-makes-north-indian-cuisine--197cc9db88.jpg" class="my-4 img-fluid img-height" alt="image" >
							<h3>North India Cuisine</h3>
							
						</div>
						<div class="col-md-6">
							<img src="https://media.timeout.com/images/100392423/630/472/image.jpg"  class="my-4 img-fluid img-height" alt="image">
							<h3>West India Cuisine</h3>
							
						</div>
						<div class="col-md-6">
							<img src="https://img.grouponcdn.com/deal/a1cb94e3b12c4ce995360a233234bc67/67/v1/c700x420.jpg"  class="my-4 img-fluid img-height" alt="image">
							<h3>East India Cuisine</h3>
							
						</div>	

				
			</div>

		</div>
           <a class="btn px-5 btn-rounded white-text btn-orange mt-5 ml-5 d-lg-none "  role="button"href="menu.php">Menu</a>
	</div>
</div>









<?php require_once('layout/footer.php');?>	
</body>




