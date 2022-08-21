<?php  
	
	//checking login id and password
	$login = 0;
	$success = 1;
	if (isset($_POST['submit'])) 
	{ 
		if($_POST['username'] != "" | $_POST['password'] != "") {
			$check = $conn->query("SELECT * FROM admin WHERE username = '".$_POST['username']."'");
			$check2 = $check->rowCount();
			
			if ($check2 != 0) {
				foreach($check as $info) 	
				{
				 	$_POST['password'] = stripslashes($_POST['password']);
					$info['password'] = stripslashes($info['password']);
				 
					if ($_POST['password'] != $info['password']) {
						$login = 0;
						$success = 0;
					}
					else
					{
						$_POST['username'] = stripslashes($_POST['username']);
						$hour = time() + 3600;
						setcookie('username', $_POST['username'], $hour);
						setcookie('password', $_POST['password'], $hour);
						$login = 1;
					}
				}
			}
		}
	}
	
	//Checking login id with cookie
	if(isset($_COOKIE['username']))
	{ 	
		$username = $_COOKIE['username']; 	
		$pass = $_COOKIE['password']; 	 	
		$check = $conn->query("SELECT * FROM admin WHERE username = '$username'"); 	
		foreach($check as $info) 	 		
		{ 		
			if ($pass != $info['password']) 			
			{
				$login = 0;
			} 		
			else 			
			{ 			
				$login = 1; 
			} 		
		} 
	}

?>