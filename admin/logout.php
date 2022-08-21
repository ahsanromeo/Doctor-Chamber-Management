<?php 
	 $past = time() - 100; 
	 setcookie('username', 'gone', $past); 
	 setcookie('pass', 'gone', $past); 
	 header("Location: index.php"); 
 ?> 