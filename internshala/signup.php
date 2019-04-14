<?php $current_page="Registration Page";?>
<?php require_once("include/header.php"); ?>
<?php require_once("include/dbconfig.php"); ?>
<?php require_once("include/helper_Function.php");?>
<?php
//<....................... userRegister................... >
if(isset($_POST["userRegister"])){
	$user_name =$_POST["user_name"];
	$type = "customer";
  $user_choice = escape($_POST["user_choice"]);
	$user_email = escape($_POST["user_email"]);
	$user_password = escape($_POST["user_password"]);
	$user_password_confirm = escape($_POST["user_password_confirm"]);
	
	$pattern_username = "/^[a-zA-Z ]{3,12}$/";
    if(!preg_match($pattern_username, $user_name)) {
	 $errorName = "Must be at lest 3 character long, letter and space allowed";
    }
    
    $pattern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
	 if(!preg_match($pattern_email, $user_email)) {
      $errorEmail = "Invalid format of email";
     }
     else {
                        $query = "SELECT * FROM customertable WHERE email = '$user_email'";
                        $query_con = mysqli_query($connection, $query);
                        if(!$query_con) {
                            die("Query Failed" . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($query_con);
                        if($count == 1) {
                            $errorEmail = "Email already exists";
                        }}
     $pattern_password= "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
     if(!preg_match($pattern_password, $user_password)){
     		$errorPasswordinvalid="Invalid Password";
     	}
     elseif($user_password !==$user_password_confirm){
     	$errorpPasswordconfirm = "Password does not match";
     }
     if(!isset($errorName) && !isset($errorEmail) && !isset($errorPasswordinvalid) && !isset($errorpPasswordconfirm)) 
     {
       					$hash = password_hash($user_password, PASSWORD_BCRYPT, ['cost'=>10]);
         				
                            $query = "INSERT INTO customertable (name, email, password, type,choice) VALUES ('$user_name', '$user_email', '$hash','$type','$user_choice')";
                            $query_conn = mysqli_query($connection, $query);
                            if(!$query_conn) {
                                die("Query failed" . mysqli_error($connection));
                            } 


                            else {
                                echo"<script>alert('Account create successfully')</script>";
                                header('refresh:0;url=login.php');
                                unset($user_name);
                                unset($user_email);
                            }
                        

 	
}
else{
   echo"<script>alert('something is wrong check open the form you just filled again')</script>";
}

}
//<....................... userRegisterEnd................... >
?>
<?php 


//<........................StaffRegister...................>
if(isset($_POST["staffRegister"])){
	$staff_name =$_POST["staff_name"];
	$type = "staff";
  
	$staff_email = escape($_POST["staff_email"]);
	$staff_password = escape($_POST["staff_password"]);
	$staff_password_confirm = escape($_POST["staff_password_confirm"]);
	
	$pattern_staffname = "/^[a-zA-Z ]{3,12}$/";
    if(!preg_match($pattern_staffname, $staff_name)) {
	 $errorstaffName = "Must be at lest 3 character long, letter and space allowed";

    }
    
    $pattern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
	 if(!preg_match($pattern_email, $staff_email)) {
      $errorstaffEmail = "Invalid format of email";
     }
     else {
                        $query = "SELECT * FROM stafftable WHERE email = '$staff_email'";
                        $query_con = mysqli_query($connection, $query);
                        if(!$query_con) {
                            die("Query Failed" . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($query_con);
                        if($count == 1) {
                            $errorStaffEmail = "Email already exists";
                        }}
     $pattern_password= "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
     if(!preg_match($pattern_password, $staff_password)){
     		$errorstaffPasswordinvalid="Invalid Password";
     	}
     elseif($staff_password !==$staff_password_confirm){
     	$errorpstaffPasswordconfirm = "Password does not match";
     }
     if(!isset($errorstaffName) && !isset($errorstaffEmail) && !isset($errorstaffPasswordinvalid) && !isset($errorpstaffPasswordconfirm)) 
     {
       					$hash = password_hash($staff_password, PASSWORD_BCRYPT, ['cost'=>10]);
         				
                            $query = "INSERT INTO stafftable (name, email, password, type) VALUES ('$staff_name', '$staff_email', '$hash','$type')";
                            $query_conn = mysqli_query($connection, $query);
                            if(!$query_conn) {
                                die("Query failed" . mysqli_error($connection));
                            } else {
                                echo"<script>alert('Account create successfully')</script>";
                                header('refresh:0;url=login.php');
                                unset($staff_name);
                                unset($staff_email);
                            }
                        

 	
}
else{
  echo"<script>alert('something is wrong check open the form you just filled again')</script>";
}



}

//<....................... StaffRegisterEnd................... >
?>

















<body>
<?php require_once("layout/nav.php") ?>	
<div class="container" style ="margin-top: 100px;">
<div class="row">
	<div class="col-sm-6 text-center">
    <img src="https://image.flaticon.com/icons/png/512/242/242452.png" height="300"alt="image">
		<h1>User Register</h1>
		
			<button type="button" class="btn btn-orange white-text" data-toggle="modal" data-target="#userModal">
 			 User Registration
			</button>

	</div>
	<div class="col-sm-6 text-center">
    <img src=" https://clearvisionmarketing.net/wp-content/uploads/2016/06/206898.png"alt="image"height="300">
		<h1> Staff Registration</h1>
		<button type="button" class="btn btn-orange white-text" data-toggle="modal" data-target="#staffModal">
 			 Staff Registration
			</button>

	</div>
</div>



</div>




<!--modal form for userRegistration-->


<!-- The Modal -->
<div class="modal orange" id="userModal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">User Registration</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form class="" action="signup.php" method="POST">

    

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" name="user_name" class="form-control" placeholder="User name" value=<?php echo isset($user_name)?$user_name:""; ?>>
             <?php echo isset($errorName)?"<span class='error'>{$errorName}</span>":""; ?>
        </div>
        
    </div>

    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" name=
    "user_email" class="form-control mb-2" placeholder="E-mail"value=<?php echo isset($user_email)?$user_email:""; ?>>
      <?php echo isset($errorEmail)?"<span class='error'>{$errorEmail}</span>":""; ?>
    <!--userFood Choice-->
    <b>Food choice: </b><select class="form-control" id="sel1" name="user_choice">
    <option>Veg</option>
    <option>Non-Veg</option>
    
  </select>  
    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control mt-2" name="user_password" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">

    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text  mb-4">
        Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist
    </small>
    <?php echo isset($errorPasswordinvalid)?"<span class='error'>{$errorPasswordinvalid}</span>":""; ?>
    <input type="password" id="defaultRegisterFormPasswordconfirm" class="form-control" name="user_password_confirm" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <?php echo isset($errorpPasswordconfirm)?"<span class='error'>{$errorpPasswordconfirm}</span>":""; ?>
    <!-- Phone number -->
    

    <!-- Newsletter -->
    

    <!-- Sign up button -->
    <button class="btn orange my-2 btn-block" type="submit" name="userRegister">Register</button>

    <!-- Social register -->
    

    
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--end user registration-->
<!--modal form for StaffRegistration-->
<div class="modal orange" id="staffModal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Staff Registration</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form class="text-center" action="signup.php" method="POST">

    

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" name="staff_name" class="form-control" placeholder="staff name" value=<?php echo isset($staff_name)?$staff_name:""; ?>>
             <?php echo isset($errorstaffName)?"<span class='error'>{$errorstaffName}</span>":""; ?>
        </div>
        
    </div>

    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" name=
    "staff_email" class="form-control mb-4" placeholder="E-mail"value=<?php echo isset($staff_email)?$staff_email:""; ?>>
      <?php echo isset($errorstaffEmail)?"<span class='error'>{$errorstaffEmail}</span>":""; ?>
    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" name="staff_password" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">

    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text  mb-4">
        Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist
    </small>
    <?php echo isset($errorstaffPasswordinvalid)?"<span class='error'>{$errorstaffPasswordinvalid}</span>":""; ?>
    <input type="password" id="defaultRegisterFormPasswordconfirm" class="form-control" name="staff_password_confirm" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <?php echo isset($errorpstaffPasswordconfirm)?"<span class='error'>{$errorpstaffPasswordconfirm}</span>":""; ?>
    <!-- Phone number -->
    

    <!-- Newsletter -->
    

    <!-- Sign up button -->
    <button class="btn orange my-2 btn-block" type="submit" name="staffRegister">Register</button>

    <!-- Social register -->
    

    
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!--end Staff registration-->