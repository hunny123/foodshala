
<?php session_start()?>

<?php $current_page ="login";?>
<?php require_once("include\header.php"); ?>
<?php require_once("include\dbconfig.php"); ?>
<?php require_once("include\helper_Function.php");?>
<?php




if(isset($_POST['login'])){

        $email = escape($_POST["email"]);
        $password = escape($_POST["password"]);
        
        $pattern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
        if(!preg_match($pattern_email, $email)) {
              $errorEmail = "Invalid format of email";
             }
        $pattern_password= "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
        if(!preg_match($pattern_password, $password)){
                $errorPasswordinvalid="Invalid Password";
              } 
        if(!isset($_POST["type"])){
          //type may be staff or customer
          $typeError ="Please Select one from Are you section";
        }else{
        $type = escape($_POST["type"]);}
        if(!isset($errorEmail)&&!isset($errorPasswordinvalid)&&!isset($typeError)){
            
                  $tableName = $type."table";//preparing table name according to type
                  

                  $query = "SELECT * FROM $tableName WHERE email  ='$email' ";
                  $query_con = mysqli_query($connection,$query);
                  if(!$query_con){
                      die("QueryFailed".mysqli_error($connection));
                      } 
                  $result = mysqli_fetch_assoc($query_con);
                    
                  if(password_verify($password, $result["password"])) {
                                  
                                  
                      echo "<div class='notification'>Log In Successfull</div>";
                      $_SESSION['login'] = 'success';
                      $_SESSION['name']=$result["name"];
                                      $_SESSION['email']=$result["email"];
                                      $_SESSION['type']=$type;
                                      if($type=='staff'){
                                      header('location:staff.php');

                                    }       //sending to different login according to type
                                    else{
                                      header('location:menu.php');
                                    }
                    }                
                            
                    else {
                        echo "<div class='notification mx-3 bg-danger text-white p-3'>Invalid username or email or password</div>"
                        ;
                    }
}else {
                        echo "<div class='notification mx-3 bg-danger text-white p-3'>Invalid username or email or password</div>"
                        ;

                    }
}


?>


<?php require_once("layout/nav.php") ?>
<div class="container mt-5">
    <h4 class="p-2 text-center orange white-text">Sign in</h4>
<div class=" mx-auto card p-2 col-md-5 mt-3  ">

<form class="my-2" action="login.php" method="POST">
    
    

    <!-- Email -->
    <input type="email" name = "email" class="form-control mb-4" placeholder="E-mail" required>
    
    <!-- Password -->
    <input  type="password"  name ="password" class="form-control mb-4" placeholder="Password"  required>
    Are You:
     <input type="radio" id="femaleRadio" value="customer" name="type" required>user
     <input type="radio" id="maleRadio" value="staff" name="type" required>staff
    

    <!-- login button -->
    <button class="btn btn-orange btn-block my-4" type="submit" name="login">Sign in</button>

    <!-- Register -->
    <p>Not a member?
        <a href="signup.php">Register</a>
    </p>

    
    

</form>

</div>
      </div>