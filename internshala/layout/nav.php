
<script>
  function logout() {
        console.log("i am call");
        document.location = 'logout.php';
    }
    
</script>
<nav class="navbar noshadow navbar-expand-lg navbar-light position-control scrolling-navbar  ">
  <a class="navbar-brand " href="#" style="margin-left: 7%">
    <img src="assests/logo.png" height="80" alt="logo" class="l1  d-sm-none d-lg-inline-block d-md-inline-block d-none  " >
    
    <img src="assests/logo.png" height="30" alt="logo" class=" d-inline-block d-lg-none d-md-none ">
</a>

  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse mr-3" id="navbarNav">
    <ul class="navbar-nav ml-auto mr-5  ">
      <li class="nav-item  ml-2 mr-3 ">
        <a class="nav-link red-text " href="home.php">Home </a>
      </li>
      <li class="nav-item ml-2 mr-3">
        <a class="nav-link red-text" href="home.php#about">About</a>
      </li>
      
      <li class="nav-item ml-2 mr-3">
        <a class="nav-link red-text " href="home.php#contact">Contact</a>
      </li>
      <li class="nav-item ml-2 mr-3">
        <a class="nav-link red-text " href="menu.php">Menu</a>
      </li>
     
      <li class="nav-item ml-2 mr-3">
        <?php 
        if(!isset($_SESSION['email']))
          {?>

        <a class="nav-link red-text "  href="login.php">Login/signup</a>
        <?php 
          }
          else{
          ?>
        <a class="nav-link red-text " id="LogoutButton" onclick="logout()">LogOut</a>
        <?php
        } 
        ?>  
      </li>
    </ul>
  </div>
</nav>


<!-- The login Modal -->

