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
			<?php  
				if(isset($_REQUEST['patientId'])){
					$p_id = $_REQUEST['patientId'];
				}
				$check = $conn->query("SELECT * FROM patient WHERE p_id = '$p_id'");
				foreach ($check as $val) {
			?>
			<h2><?php echo $val['name']; ?></h2>
			<div class="row p_details">
				
				<div class="col-md-12">
					<ul>
						<li><span>Address:</span> <?php echo $val['address']; ?></li>
						<li><span>Age:</span> <?php echo $val['age']; ?></li>
						<li><span>Sex:</span> <?php echo $val['sex']; ?></li>
						<li><span>Email:</span> <?php echo $val['email']; ?></li>
					</ul>
				</div>
				
			</div>
			<?php } ?>
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