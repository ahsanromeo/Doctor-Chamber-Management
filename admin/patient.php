<?php
	//including config file
	include('../configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//Include login check files
	include('include/check-login.php');
?>

<?php  
	if(isset($_REQUEST['add_test'])){
		$test_id = $_POST['test_id'];
		$test_type = $_POST['test_type'];	
		$test_cost = $_POST['test_cost'];

		$sql = "INSERT INTO test(`test_id`,`type`,`cost`) VALUES ('$test_id','$test_type','$test_cost')";
		$conn->exec($sql);
	}
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
			<h2>Patient List</h2>

			<table class="table">
				<?php  
					$check = $conn->query("SELECT * FROM patient");
					if($check->rowCount() != 0){
				?>
				<tr>
					<th>Sl</th>
					<th>Patient ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Sex</th>
					<th>Action</th>
				</tr>
				<?php
					}
					else
						echo "<h4>Empty List</h4>";
					
					$sl = 1;
					foreach ($check as $patient_val) {
					?>
					<tr>
						<td><?php echo $sl; ?></td>
						<td><?php echo $patient_val['p_id'] ?></td>
						<td><?php echo $patient_val['name'] ?></td>
						<td><?php echo $patient_val['address'] ?></td>
						<td><?php echo $patient_val['sex'] ?></td>
						<td><a href="patient_details.php?patientId=<?php echo $patient_val['p_id'];?>">View</a></td>
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