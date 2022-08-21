<?php
	//including config file
	include('../configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//Include login check files
	include('include/check-login.php');
?>
  

<?php include('include/header.php'); ?>
<?php include('include/admin-nav.php'); ?>


<?php
	if($login == 0)
	{
		header('location:index.php');
	} 
	else
	{
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Appointment List</h2>
			<table class="table">
				<?php  
					if(isset($_REQUEST['aid'])){
						$aid = $_REQUEST['aid'];
						$conn->exec("UPDATE appointment SET state = 1 WHERE app_id = '$aid'");
					}
					$check = $conn->query("SELECT * FROM appointment WHERE state = 0");
					if($check->rowCount() != 0){
				?>
				<tr>
					<th>Appointment Number</th>
					<th>Appointment ID</th>
					<th>Test Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Patient Name</th>
					<th>Total Cost</th>
					<th>Biling Status</th>
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
						<td><?php echo $test_val['app_id'] ?></td>
						<td>
							<?php
								$test_list = explode(',',$test_val['test']);
								for($i = 0; $i < sizeof($test_list); $i++){
									$test_names = $conn->query("SELECT * FROM test WHERE test_id = '".$test_list[$i]."'");
									foreach ($test_names as $test_name) {
									 	echo '[ <b>'.$test_name['type'].'</b> ] ';
									} 
								}
							?>
						</td>
						<td><?php echo $test_val['date'] ?></td>
						<td><?php echo $test_val['time'] ?></td>
						<td>
							<?php  
								$names = $conn->query("SELECT * FROM patient WHERE p_id = '".$test_val['patient_id']."'");
								foreach ($names as $name) {
								 	echo $name['name'];
								} 	
							?>
						</td>
						<td><?php echo $test_val['amount'] ?></td>
						<td>
							<?php 
								if($test_val['status'] == 'Deu') 
									echo "<p style='color:red'>You have to pay now</p>"; 
								else 
									echo $test_val['status'];
							?>
						</td>
						<td><a href="appointment.php?aid=<?php echo $test_val['app_id']; ?>" class="btn btn-primary">Done</button></td>
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