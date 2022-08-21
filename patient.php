<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//checking login id and password
	$login = 0;
	$success = 1;
	if (isset($_POST['submit'])) 
	{ 
		if($_POST['username'] != "" | $_POST['password'] != "") {
			$check = $conn->query("SELECT * FROM admin WHERE username = '".$_POST['username']."'");
			$check2 = $check->rowCount();
			
			if ($check2 != 0) {
				foreach($check as $info) 	
				{
				 	$_POST['password'] = stripslashes($_POST['password']);
					$info['password'] = stripslashes($info['password']);
				 
					if ($_POST['password'] != $info['password']) {
						$login = 0;
						$success = 0;
					}
					else
					{
						$_POST['username'] = stripslashes($_POST['username']);
						$hour = time() + 3600;
						setcookie('username', $_POST['username'], $hour);
						setcookie('password', $_POST['password'], $hour);
						$login = 1;
					}
				}
			}
		}
	}
	
	//Checking login id with cookie
	if(isset($_COOKIE['username']))
	{ 	
		$username = $_COOKIE['username']; 	
		$pass = $_COOKIE['password']; 	 	
		$check = $conn->query("SELECT * FROM admin WHERE username = '$username'"); 	
		foreach($check as $info) 	 		
		{ 		
			if ($pass != $info['password']) 			
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
        <li class="active"><a href="patient.php">Register</a></li>
        <li><a href="patient-login.php">Login</a></li>
        
        <?php if($login !=0) {?>
        <li><a href="test.php">Add Test</a></li>
        <li><a href="#">Add Doctor</a></li>
        <li><a href="#">View Patient Details</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container error">
<?php  

	//Check and Initiate Test ID
    $check_ID = $conn->query("SELECT * FROM patient");
    if($check_ID->rowCount() == 0){
        $patient_ID = 'P001';
    }
    else{
        $patient_ID_counter = $check_ID->rowCount();
        if($patient_ID_counter <= 8){
            $patient_ID = 'P00'.(string)($patient_ID_counter + 1);
        }
        else{
            $patient_ID = 'P0'.(string)($patient_ID_counter + 1);
        }
    }
	
	if(isset($_REQUEST['reg'])){
		$pUname = $_POST['pUsername'];	
		$pPass = $_POST['pPass'];
		$pFname = $_POST['pname'];
		$pAdd = $_POST['address'];
		$pAge = $_POST['age'];
		$pSex = $_POST['sex'];
		$pEmail = $_POST['email'];

		$sql = "INSERT INTO patient(`p_id`,`name`,`address`,`age`,`sex`,`email`,`username`,`pass`) VALUES ('$patient_ID','$pFname','$pAdd','$pAge','$pSex','$pEmail','$pUname','$pPass')";
		if($pUname != ""){
			$check = $conn->query("SELECT * FROM patient WHERE username = '$pUname'");
			if($check->rowCount() == 0){
				if($pPass != "" && $pEmail != ""){
					if($pPass != "" && $pEmail != ""){
					$conn->exec($sql);
					$hour = time() + 3600;
					setcookie('P_username', $pUname, $hour);
					setcookie('P_password', $pPass, $hour);
					header('Location:patient-profile.php');
				}
				}
				else{
					echo "<p>Please fillup the required field.</p>";
				}
			}
			else{
				echo "<p>Username already exists</p>";
			}
		}else{
			echo "<p>Username empty</p>";
		}
	}
?>
</div>

<?php
	if($login == 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>Patient Register</h2>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username *</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" id="username" name="pUsername">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="pass">Password *</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="username" name="pPass">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Full Name</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" id="name" name="pname">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="address">Address</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" id="address" name="address">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Age</label>
            <div class="col-sm-10">
                <input type="text" required class="form-control" id="age" name="age">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sex">Sex</label>
            <div class="col-sm-10">
                <div class="radio">
				  <label>
				    <input type="radio" name="sex" id="sex1" value="male" checked>
				    Male
				  </label>
				  <label>
				    <input type="radio" name="sex" id="sex2" value="female">
				    Female
				  </label>
				</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Email *</label>
            <div class="col-sm-10">
                <input type="email" required class="form-control" id="mail" name="email">
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="reg" class="btn btn-default">Register</button>
            </div>
        </div>
    </form>
</div>
<!-- Login form end -->
<?php 
	} 
	else
	{
?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
<?php
	}
?>