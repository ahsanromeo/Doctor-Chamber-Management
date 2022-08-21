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
        <li><a href="report.php">View Report</a></li>
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
			<h2><center>Laboratory Report</center></h2>

			<?php 
				if(isset($_REQUEST['rid'])){
					$r_id = $_REQUEST['rid'];
				} 
				$check = $conn->query("SELECT * FROM report WHERE id = '$r_id'");
				foreach ($check as $val) {
			?>

			<div class="row p_details">
				<?php  
					$check1 = $conn->query("SELECT * FROM patient WHERE p_id = '".$val['patient_id']."'");
					foreach ($check1 as $val1) {
				?>
				<div class="col-md-6">
					<ul>
						<li><span>Patient Name:</span> <?php echo $val1['name']; ?></li>
						<li><span>Age:</span> <?php echo $val1['age']; ?></li>
						<li><span>Sex:</span> <?php echo $val1['sex']; ?></li>
						<li><span>Ref Doctor:</span> <?php echo $val['doctor']; ?></li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul>
						<li><span>Location:</span> <?php echo $val1['address']; ?></li>
						<li><span>ID:</span> <?php echo $val['patient_id']; ?></li>
						<li>
							<span>Appointment Date:</span> 
							<?php 
								$check2 = $conn->query("SELECT * FROM appointment WHERE app_id = '".$val['app_id']."'");
								foreach ($check2 as $val2) {
									echo $val2['date'];
								}
							?>
						</li>
						<li><span>Report Date:</span> <?php echo $val['report_date']; ?></li>
					</ul>
				</div>
				<?php } ?>
			</div>
			<table class="table">
				<tr>
					<th>Test Name</th>
					<th>Test Result</th>
					<th>Patient Status</th>
					<th>Reference Range</th>
				</tr>
				<?php
					$check3 = $conn->query("SELECT * FROM appointment WHERE app_id = '".$val['app_id']."'");
					foreach ($check3 as $val3) {
						$test_list = explode(',',$val3['test']);
					}
					$result_list = explode(',',$val['result']);

					for($i = 0; $i < sizeof($test_list); $i++){
				?>	
				<tr>
					<?php  
						$check4 = $conn->query("SELECT * FROM test_details WHERE test_id = '".$test_list[$i]."'");
						foreach ($check4 as $val4) {
					?>
						<td><?php echo $val4['test_type']; ?></td>
						<td><?php echo $result_list[$i]; ?></td>
						<td>
							<?php 
								$min = explode(',',$val4['min']);
								$max = explode(',',$val4['max']);
								$avg = explode(',',$val4['avg']);

								if($result_list[$i] > 0 && $result_list[$i] <= $min[0]){
									echo $min[1];
									$range = '0 - '.$min[0].'%';
								}
									
								else if($result_list[$i] > $min[0] && $result_list[$i] <= $avg[0]){
									echo $avg[1];
									$range = ($min[0]+1).'% - '.$avg[0].'%';
								}
									
								else if($result_list[$i] > $avg[0] && $result_list[$i] <= $max[0]){
									echo $max[1];
									$range = ($avg[0]+1).'% - '.$max[0].'%';
								}
									
								else{
									echo "Patient condition too bad";
									$range = "Below 0 or over ".$max[0];
								}
									
							?>
						</td>
						<td><?php echo $range; ?></td>
					<?php  
						}
					?>
				</tr>
				<?php 
					}
				?>			
			</table>
			<?php
				}
			?>
			<a href="" class="btn btn-default">Print</a>
			<a href="" class="btn btn-default">Email</a>
		</div>
	</div>
</div>
<footer></footer>
<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
<?php
	}
?>