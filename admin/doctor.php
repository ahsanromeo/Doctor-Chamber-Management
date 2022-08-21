<?php
	//including config file
	include('../configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//Include login check files
	include('include/check-login.php');
?>

<?php  
	if(isset($_REQUEST['add_doctor'])){
		$doc_id = $_POST['doc_id'];
		$doc_name = $_POST['doc_name'];	
		$doc_dept = $_POST['dept'];
		$doc_contact = $_POST['doc_contact'];

		$sql = "INSERT INTO doctor(`doctor_id`,`name`,`department`,`contact`) VALUES ('$doc_id','$doc_name','$doc_dept','$doc_contact')";
		$conn->exec($sql);
	}


	//Check and Initiate Doctor ID
	$check_ID = $conn->query("SELECT * FROM doctor");
	if($check_ID->rowCount() == 0){
		$doc_ID = 'D001';
	}
	else{
		$doc_ID_counter = $check_ID->rowCount();
		if($doc_ID_counter <= 8){
			$doc_ID = 'D00'.(string)($doc_ID_counter + 1);
		}
		else{
			$doc_ID = 'D0'.(string)($doc_ID_counter + 1);
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
			<h2>Add Doctor</h2>

			<form method="post">
			  <div class="form-group">
			    <label for="testID">Doctor ID</label>
			    <input type="text" name="doc_id" value="<?php echo $doc_ID; ?>" class="form-control" id="testID" readonly >
			  </div>
			  <div class="form-group">
			    <label for="testType">Doctor Name</label>
			    <input type="text" name="doc_name" required class="form-control" id="testType">
			  </div>
			  <div class="form-group">
			    <label for="testCost1">Department</label>
			    <input type="text" name="dept" required class="form-control" id="testCost1">
			  </div>
			  <div class="form-group">
			    <label for="testCost">Doctor Contact Details</label>
			    <input type="text" name="doc_contact" required class="form-control" id="testCost">
			  </div>
			  <button type="submit" name="add_doctor" class="btn btn-default">Add Doctor</button>
			</form>
		</div>

		<div class="col-md-6">
			<h2>Doctor List</h2>
			<table class="table">
				<?php  
					$check = $conn->query("SELECT * FROM doctor");
					if($check->rowCount() != 0){
				?>
				<tr>
					<th>Sl</th>
					<th>ID</th>
					<th>Name</th>
					<th>Departmnet</th>
					<th>Contact</th>
					<th>Action</th>
				</tr>
				<?php
					}
					else
						echo "<h4>Empty List</h4>";

					$sl = 1;
					foreach ($check as $doc_val) {
					?>
					<tr>
						<td><?php echo $sl; ?></td>
						<td><?php echo $doc_val['doctor_id'] ?></td>
						<td><?php echo $doc_val['name'] ?></td>
						<td><?php echo $doc_val['department'] ?></td>
						<td><?php echo $doc_val['contact'] ?></td>
						<td><a href="doctor_edit.php?docId=<?php echo $doc_val['id'];?>">Edit</a></td>
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
<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
<?php
	}
?>