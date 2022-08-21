<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);	
?>
  

<?php include('include/header.php'); ?>

<nav class="navbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="contact.php">Contact us</a></li>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row home-menu-block">
        <div class="col-md-3 col-md-offset-3">
            <a href="http://localhost/dcm/admin" class="big-menu"><i class="fa fa-cogs" aria-hidden="true"></i><br>Admin</a>
        </div>
        <div class="col-md-3">
            <a href="patient.php" class="big-menu"><i class="fa fa-users" aria-hidden="true"></i><br>Patient</a>
        </div>
    </div>
</div>

<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
