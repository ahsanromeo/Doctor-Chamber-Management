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
<link rel="stylesheet" href="css/datepicker.css">

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
        <li class="active"><a href="appointment.php">Appointment</a></li>
        <li><a href="report.php">View Report</a></li>
        <li><a href="p-logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container error">
<?php  
    $check_PID = $conn->query("SELECT * FROM patient WHERE username = '$username'");
    foreach ($check_PID as $val) {
        $p_id = $val['p_id'];
    }

    //Check and Initiate Test ID
    $check_AID = $conn->query("SELECT * FROM appointment");
    if($check_AID->rowCount() == 0){
        $appointment_ID = 'A001';
    }
    else{
        $appointment_ID_counter = $check_AID->rowCount();
        if($appointment_ID_counter <= 8){
            $appointment_ID = 'A00'.(string)($appointment_ID_counter + 1);
        }
        else{
            $appointment_ID = 'A0'.(string)($appointment_ID_counter + 1);
        }
    }

	if(isset($_REQUEST['update'])){
		$test = implode(',',$_POST['testType']);
		$time = $_POST['time'];
        $date = $_POST['date'];
        $amount = $_POST['amount'];
		$status = $_POST['status'];


		$sql = "INSERT INTO appointment(`app_id`,`patient_id`,`test`,`date`,`time`,`amount`,`status`,`state`) VALUES ('$appointment_ID','$p_id','$test','$date','$time','$amount','$status',0)";
        if($conn->exec($sql)){
            echo "<center><p>Successfully booked</p></center>";
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
	<h2>Appointment</h2>
	
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Select Test</label>
            <div class="col-sm-10">
                <?php  
                    $check = $conn->query("SELECT * FROM test");
                    foreach ($check as $val) {
                ?>
                <div class="checkbox testList">
                  <label>
                    <input type="checkbox" name="testType[]" data-cost="<?php echo $val['cost']; ?>" value="<?php echo $val['test_id']; ?>"><?php echo $val['type']; ?> <br><strong>Cost: <?php echo $val['cost']; ?> .Tk</strong>
                  </label>
                </div>
                <?php  
                    }
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Date</label>
            <div class="col-sm-10">
                <input type="text" class="span2 form-control" name="date" value="16-10-2016" id="dp1" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="time">Time</label>
            <div class="col-sm-10 time-frame">
                <button class="btn btn-info">8:00am - 10:00am</button>
                <button class="btn btn-info">10:00am - 12:00pm</button>
                <button class="btn btn-info">4:00pm - 08:00pm</button>
                <input type="hidden" name="time">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2 ">
                <input type="text" class="form-control" name="amount" readonly >
            </div>
            <div class="col-sm-6 cost-btn">
                <button type="submit" data-pay="Paid" class="btn btn-success">Pay Now</button>
                <button type="submit" data-pay="Due" class="btn btn-danger">Later</button>
                <p class="note hide1"></p>
                <input type="hidden" name="status">
            </div>
        </div>                
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="update" class="btn btn-default hide1">Book Appointment</button>
            </div>
        </div>
    </form>
</div>
<!-- Login form end -->
<?php 
	} 
	else{
		header('location:patient-login.php');
	}
?>
<footer></footer>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
</body>
</html>