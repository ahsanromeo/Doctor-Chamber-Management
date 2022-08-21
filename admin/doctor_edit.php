<?php
	//including config file
	include('../configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//Include login check files
	include('include/check-login.php');
?>

<?php  
	if(isset($_REQUEST['docId'])){
		$dID = $_REQUEST['docId'];
	}

	if(isset($_REQUEST['update_doctor'])){
		$doc_name = $_POST['doc_name'];	
		$doc_dept = $_POST['dept'];
		$doc_contact = $_POST['doc_contact'];

		$sql = "UPDATE doctor set `name` = '$doc_name', `department` = '$doc_dept', `contact` = '$doc_contact' WHERE id = '$dID'";
		if($conn->query($sql)){
			header('location:doctor.php');
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
			<h2>Edit Doctor</h2>

			<?php  
				
				$check = $conn->query("SELECT * FROM doctor WHERE id = '$dID'");
				foreach ($check as $doc_val) {
			?>

			<form method="post">
			  <div class="form-group">
			    <label for="testID">Doctor ID</label>
			    <input type="text" name="doc_id" readonly class="form-control" value="<?php echo $doc_val['doctor_id'];?>" id="testID">
			  </div>
			  <div class="form-group">
			    <label for="testType">Doctor Name</label>
			    <input type="text" name="doc_name" required value="<?php echo $doc_val['name'];?>" class="form-control" id="testType">
			  </div>
			  <div class="form-group">
			    <label for="testType">Department</label>
			    <input type="text" name="dept" required value="<?php echo $doc_val['department'];?>" class="form-control" id="testType">
			  </div>
			  <div class="form-group">
			    <label for="testCost">Contact Details</label>
			    <input type="text" required name="doc_contact" value="<?php echo $doc_val['contact'];?>" class="form-control" id="testCost">
			  </div>
			  <button type="submit" name="update_doctor" class="btn btn-default">Update Doctor</button>
			</form>
			<?php  
				}
			?>
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