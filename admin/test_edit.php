<?php
	//including config file
	include('../configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//Include login check files
	include('include/check-login.php');
?>

<?php  
	if(isset($_REQUEST['testId'])){
		$tID = $_REQUEST['testId'];
	}

	if(isset($_REQUEST['update_test'])){
		$test_type = $_POST['test_type'];	
		$test_cost = $_POST['test_cost'];

		$sql = "UPDATE test set `type` = '$test_type', `cost` = '$test_cost' WHERE id = '$tID'";
		if($conn->query($sql)){
			header('location:test.php');
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
			<?php  
				$check = $conn->query("SELECT * FROM test WHERE id = '$tID'");
				foreach ($check as $test_val) {
			?>

			<form method="post">
			  <div class="form-group">
			    <label for="testID">Test ID</label>
			    <input type="text" name="test_id" readonly class="form-control" value="<?php echo $test_val['test_id'];?>" id="testID">
			  </div>
			  <div class="form-group">
			    <label for="testType">Test Type</label>
			    <input type="text" name="test_type" value="<?php echo $test_val['type'];?>" class="form-control" id="testType">
			  </div>
			  <div class="form-group">
			    <label for="testCost">Test Cost</label>
			    <input type="text" name="test_cost" required value="<?php echo $test_val['cost'];?>" class="form-control" id="testCost">
			  </div>
			  <button type="submit" name="update_test" class="btn btn-default">Update Test</button>
			</form>
			
			<?php  
				}
			?>
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