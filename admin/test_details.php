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
		$test_val = explode('--',$_POST['test_type']);
		$min = $_POST['test_val1'].','.$_POST['test_res1'];	
		$avg = $_POST['test_val2'].','.$_POST['test_res2'];	
		$max = $_POST['test_val3'].','.$_POST['test_res3'];	

		if($test_val != ""){
			$sql = "INSERT INTO test_details(`test_id`,`test_type`,`min`,`avg`,`max`) VALUES ('$test_val[0]','$test_val[1]','$min','$avg','$max')";
			$sql1 = "UPDATE test SET `status` = 1 WHERE `test_id` = '$test_val[0]'";
			$conn->exec($sql);
			$conn->exec($sql1);
		}
		else
			echo "<p>Please Select a Test and fill all info.</p>";
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
			<h2>Test Details</h2>

			<form method="post">
			  <div class="form-group">
			    <label for="testID1">Select Test</label>
			    <select class="form-control" name="selectTest" id="selectTest">
			    	<option>Please select Test</option>
			    	<?php  
			    		$check_test = $conn->query("SELECT * FROM test where status = 0");
			    		$status = $check_test->rowCount();

			    		foreach ($check_test as $testVal) {
			    			echo '<option value="'.$testVal["test_id"].'--'.$testVal["type"].'">'.$testVal['type'].'</option>';
			    		}
			    	?>
			    </select>
			  </div>
			  <?php  
			  	if($status == 0){
			  		echo "<p>No new test. Please add test first.</p>";
			  	}
			  	else{
			  ?>
			  <div class="form-group">
			    <label for="testType">Test Type</label>
			    <input type="text" required name="test_type" class="form-control" id="testType" readonly>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval1">Min Value</label>
					    <input type="number" required name="test_val1" class="form-control" id="testval1">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres1">Test Result</label>
					    <input type="text" required name="test_res1" class="form-control" id="testres1">
					</div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval2">Avg Value</label>
					    <input type="number" required name="test_val2" class="form-control" id="testval2">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres2">Test Result</label>
					    <input type="text" required name="test_res2" class="form-control" id="testres2">
					</div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval3">Max Value</label>
					    <input type="number" required name="test_val3" class="form-control" id="testval3">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres3">Test Result</label>
					    <input type="text" required name="test_res3" class="form-control" id="testres3">
					</div>
			  	</div>
			  </div>
			  
			  
			  <button type="submit" name="add_test" class="btn btn-default">Add Details</button>
			  <?php } ?>
			</form>
		</div>

		<div class="col-md-6">
			<h2>Test Details</h2>
			<table class="table">
				<?php  
					$check = $conn->query("SELECT * FROM test_details");
					if($check->rowCount() != 0){
				?>
				<tr>
					<th>Sl</th>
					<th>Test Name</th>
					<th>MIN</th>
					<th>AVG</th>
					<th>MAX</th>
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
						<td><?php echo $test_val['test_type'] ?></td>
						<td><?php echo $test_val['min'] ?></td>
						<td><?php echo $test_val['avg'] ?></td>
						<td><?php echo $test_val['max'] ?></td>
						<td><a href="test_details_edit.php?testId=<?php echo $test_val['test_id'];?>">Edit</a></td>
					</tr>
					<?php
						$sl++;
					}
				?>
			</table>
		</div>
	</div>
</div>
<footer></footer>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/custom.js"></script>

</body>
</html>
<?php
	}
?>