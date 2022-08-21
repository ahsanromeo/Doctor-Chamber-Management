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

	//Check and Initiate Test ID
	$check_ID = $conn->query("SELECT * FROM test");
	if($check_ID->rowCount() == 0){
		$test_ID = 'T001';
	}
	else{
		$test_ID_counter = $check_ID->rowCount();
		if($test_ID_counter <= 8){
			$test_ID = 'T00'.(string)($test_ID_counter + 1);
		}
		else{
			$test_ID = 'T0'.(string)($test_ID_counter + 1);
		}
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
		<div class="col-md-6">
			<h2>Add Test</h2>

			<form method="post">
			  <div class="form-group">
			    <label for="testID">Test ID</label>
			    <input type="text" name="test_id" value="<?php echo $test_ID; ?>" readonly class="form-control" id="testID">
			  </div>
			  <div class="form-group">
			    <label for="testType">Test Type</label>
			    <input type="text" name="test_type" class="form-control" required required id="testType">
			  </div>
			  <div class="form-group">
			    <label for="testCost">Test Cost</label>
			    <input type="number" name="test_cost" class="form-control" required id="testCost">
			  </div>
			  <button type="submit" name="add_test" class="btn btn-default">Add Test</button>
			</form>
		</div>

		<div class="col-md-6">
			<h2>Test List</h2>
			<table class="table">
				<?php  
					$check = $conn->query("SELECT * FROM test");
					if($check->rowCount() != 0){
				?>
				<tr>
					<th>Sl</th>
					<th>Test ID</th>
					<th>Test Name</th>
					<th>Cost</th>
					<th>Action</th>
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
						<td><?php echo $test_val['test_id'] ?></td>
						<td><?php echo $test_val['type'] ?></td>
						<td><?php echo $test_val['cost'] ?></td>
						<td><a href="test_edit.php?testId=<?php echo $test_val['id'];?>">Edit</a></td>
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