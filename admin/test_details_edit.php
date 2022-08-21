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
		$min = $_POST['test_val1'].','.$_POST['test_res1'];	
		$avg = $_POST['test_val2'].','.$_POST['test_res2'];	
		$max = $_POST['test_val3'].','.$_POST['test_res3'];

		$sql = "UPDATE test_details set `min` = '$min', `avg` = '$avg', `max` = '$max' WHERE test_id = '$tID'";
		if($conn->query($sql)){
			header('location:test_details.php');
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
			<?php  
				$check = $conn->query("SELECT * FROM test_details WHERE test_id = '$tID'");
				foreach ($check as $test_val) {
					$min = explode(',',$test_val['min']);
					$avg = explode(',',$test_val['avg']);
					$max = explode(',',$test_val['max']);
			?>
			<h2><?php echo $test_val['test_type']; ?></h2>
			

			<form method="post">
			  
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval1">Min Value</label>
					    <input type="number" required name="test_val1" value="<?php echo $min[0]; ?>" class="form-control" id="testval1">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres1">Test Result</label>
					    <input type="text" required name="test_res1" value="<?php echo $min[1]; ?>" class="form-control" id="testres1">
					</div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval2">Avg Value</label>
					    <input type="number" required name="test_val2" value="<?php echo $avg[0]; ?>" class="form-control" id="testval2">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres2">Test Result</label>
					    <input type="text" required name="test_res2" value="<?php echo $avg[1]; ?>" class="form-control" id="testres2">
					</div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testval3">Max Value</label>
					    <input type="number" required name="test_val3" value="<?php echo $max[0]; ?>" class="form-control" id="testval3">
					</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="testres3">Test Result</label>
					    <input type="text" required name="test_res3" value="<?php echo $max[1]; ?>" class="form-control" id="testres3">
					</div>
			  	</div>
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