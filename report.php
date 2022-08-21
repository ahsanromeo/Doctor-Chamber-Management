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
        <li><a href="patient-profile.php">Profile</a></li>
        
        <?php if($login !=0) {?>
        <li><a href="appointment.php">Appointment</a></li>
        <li class="active"><a href="report.php">View Report</a></li>
        <li><a href="p-logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php
	if($login == 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>Admin Login</h2>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Password">Password</label>
            <div class="col-sm-10">
            	<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
            </div>
        </div>
        <?php if($success == 0){?>
		<p class="text-danger">Incorrent username or password</p>
        <?php }?>
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="submit" class="btn btn-default">Login</button>
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
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Report List</h2>
			<table class="table">
			<?php  
				$check = $conn->query("SELECT * FROM report");
				if($check->rowCount() != 0){
			?>
			<tr>
				<th>Report Number</th>
				<th>Report ID</th>
				<th>Patient Name</th>
				<th>Status</th>
			</tr>
			<?php
				}
				else
					echo "<h4>Empty List</h4>";

				$sl = 1;
				foreach ($check as $test_val) {
				?>
				<tr>
					<td><?php echo $sl; ?></td>
					<td><?php echo $test_val['patient_id'] ?></td>
					<td>
						<?php  
							$names = $conn->query("SELECT * FROM patient WHERE p_id = '".$test_val['patient_id']."'");
							foreach ($names as $name) {
							 	echo $name['name'];
							} 	
						?>
					</td>
					<td><a href="view_report.php?rid=<?php echo $test_val['id']; ?>">View Report</button></td>
				</tr>
				<?php
					$sl++;
				}
			?>				
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
<?php
	}
?>