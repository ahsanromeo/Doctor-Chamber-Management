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
			<h2>Report List</h2>
			<table class="table">
			<?php  
				$check = $conn->query("SELECT * FROM report");
				if($check->rowCount() != 0){
			?>
			<tr>
				<th>Report Number</th>
				<th>Report ID</th>
				<th>Patient Name</th>
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
					<td><?php echo $test_val['patient_id'] ?></td>
					<td>
						<?php  
							$names = $conn->query("SELECT * FROM patient WHERE p_id = '".$test_val['patient_id']."'");
							foreach ($names as $name) {
							 	echo $name['name'];
							} 	
						?>
					</td>
					<td><a href="view_report.php?rid=<?php echo $test_val['id']; ?>">View Report</button></td>
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