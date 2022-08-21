<?php 
	 $past = time() - 100; 
	 setcookie('P_username', 'gone', $past); 
	 setcookie('P_password', 'gone', $past); 
	 header("Location: patient-login.php"); 
 ?> 