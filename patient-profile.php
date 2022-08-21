<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//checking login id and password
	$login = 0;
	$success = 1;
	
	
	//Checking login id with cookie
	if(isset($_COOKIE['P_username']))
	{ 	
		$username = $_COOKIE['P_username']; 	
		$pass = $_COOKIE['P_password']; 	 	
		$check = $conn->query("SELECT * FROM patient WHERE username = '$username'"); 	
		foreach($check as $info) 	 		
		{ 		
			if ($pass != $info['pass']) 			
			{
				$login = 0;
			} 		
			else 			
			{ 			
				$login = 1; 
			} 		
		} 
	}
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
        <li><a href="http://localhost/dcm/">Home</a></li>
        <li class="active"><a href="patient-profile.php">Profile</a></li>
        
        <?php if($login !=0) {?>
        <li><a href="appointment.php">Appointment</a></li>
        <li><a href="report.php">View Report</a></li>
        <li><a href="p-logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container error">
<?php  
	
	if(isset($_REQUEST['update'])){
		$pPass = $_POST['pPass'];
		$pFname = $_POST['pname'];
		$pAdd = $_POST['address'];
		$pAge = $_POST['age'];
		$pSex = $_POST['sex'];
		$pEmail = $_POST['email'];

		$sql = "UPDATE patient SET name = '$pFname', address = '$pAdd',age = '$pAge',sex = '$pSex',email = '$pEmail',pass = '$pPass' WHERE username = '$username'";
		if($pPass != "" && $pEmail != ""){
			$conn->exec($sql);
		}
		else{
			echo "<p>Please fillup the required field.</p>";
		}
	}

    
?>
</div>

<?php
	if($login != 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>My Details</h2>
	<?php  
		$check = $conn->query("SELECT * FROM patient WHERE username = '$username'");
		foreach ($check as $val) {
	?>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" readonly value="<?php echo $val['username'] ?>" name="pUsername">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="pass">Password *</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="username" value="<?php echo $val['pass']; ?>" name="pPass">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Full Name</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" value="<?php echo $val['name']; ?>" id="name" name="pname">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="address">Address</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" value="<?php echo $val['address']; ?>" id="address" name="address">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Age</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" value="<?php echo $val['age']; ?>" id="age" name="age">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sex">Sex</label>
            <div class="col-sm-10">
                <div class="radio">
				  <label>
				    <input type="radio" name="sex" id="sex1" value="male" <?php if($val['sex'] == 'male'){echo "checked";} ?>>
				    Male
				  </label>
				  <label>
				    <input type="radio" name="sex" id="sex2" <?php if($val['sex'] == 'female'){echo "checked";} ?> value="female">
				    Female
				  </label>
				</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Email *</label>
            <div class="col-sm-10">
                <input type="email" required value="<?php echo $val['email']; ?>" class="form-control" id="mail" name="email">
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="update" class="btn btn-default">Update</button>
            </div>
        </div>
    </form>
    <?php  
    	}
    ?>
</div>
<!-- Login form end -->
<?php 
	} 
	else{
		header('location:patient-login.php');
	}
?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>