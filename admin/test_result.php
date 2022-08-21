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
			<h2>Test Result</h2>
			<table class="table">
			<?php  
				if(isset($_REQUEST['report'])){
					$aid = $_POST['app_id'];
					$p_id = $_POST['p_id'];
					$doctor = $_POST['doctor'];
					$t_result = implode(',',$_POST['test_result']);
					$date = date('d-m-Y');

					$conn->exec("UPDATE appointment SET state = 2 WHERE app_id = '$aid'");
					$sql = "INSERT INTO report(`app_id`,`patient_id`,`result`,`doctor`,`report_date`) VALUES ('$aid','$p_id','$t_result','$doctor','$date')";
			        if($conn->exec($sql)){
			            echo "<center><p style='color:red'>Report successfully made.</p></center>";
			        }
				}
				$check = $conn->query("SELECT * FROM appointment WHERE state = 1");
				if($check->rowCount() != 0){
			?>
			<tr>
				<th>Appointment ID</th>
				<th>Test Result</th>
				<th>Doctor Name</th>
				<th>Patient Name</th>
				<th>Action</th>
			</tr>
			<?php
				}
				else
					echo "<h4>Empty List</h4>";

				foreach ($check as $test_val) {
				?>
				<form class="form-horizontal" role="form" method="post">
					<tr>
						<td><?php echo $test_val['app_id'] ?><input type="hidden" name="app_id" value="<?php echo $test_val['app_id'] ?>"></td>
						<td>
							<?php
								$test_list = explode(',',$test_val['test']);
								for($i = 0; $i < sizeof($test_list); $i++){
									$test_names = $conn->query("SELECT * FROM test WHERE test_id = '".$test_list[$i]."'");
									foreach ($test_names as $test_name) {
									 	echo '<b>'.$test_name['type'].' Result</b> : <input type="text" required class="form-control" name="test_result[]"> <span>Please insert the value between 0-100</span><br>';
									} 
								}
							?>
						</td>
						<td>
							<select class="form-control" name="doctor" id="selectTest">
						    	<option>Please select Doctor</option>
						    	<?php  
						    		$check_test = $conn->query("SELECT * FROM doctor");
						    		foreach ($check_test as $testVal) {
						    			echo '<option value="'.$testVal["name"].'">'.$testVal['name'].'</option>';
						    		}
						    	?>
						    </select>
						</td>
						<td>
							<?php  
								$names = $conn->query("SELECT * FROM patient WHERE p_id = '".$test_val['patient_id']."'");
								foreach ($names as $name) {
								 	echo $name['name'];
								} 	
							?>
							<input type="hidden" name="p_id" value="<?php echo $test_val['patient_id'];?>">
						</td>
						<td><input type="submit" class="btn btn-primary" name="report" value="Make Report"></td>
					</tr>
				</form>
				<?php
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