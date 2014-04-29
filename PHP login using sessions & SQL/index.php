<?php

	require_once("mysqlConnect.php");
	
	require_once("utils.php");
	
	require_once("generateHtml.php");
	
	date_default_timezone_set("Europe/Vilnius");
	
	session_start();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="dataTable.css">
	<script src="javascript.js"></script>
        <script type="text/javascript" src="inputCheck.js"></script>
</head>

<body>
    
      

<div id="wrapper">

	
	  <?php echo generateMenuHtml($con); ?>
	
	
	<div id="content" class="content" onkeypress="return testKey(event)">
	
		<br/>
	
	<?php
			
		if (isUserLoggedIn()) {

			if (isset($_REQUEST['pageName'])) {
				include($_REQUEST['pageName']);
			} else {
                                
				include("myContracts.php");
                                
			}
			
		} else {
                   
			include("login.php"); 
                        echo '<a href="newUser.php">Registracija</a>';
                  
                }
		
	?>
	
	</div>
  
  <div>
        
    
	
	
</div>
</body>
</html>

<?php mysqli_close($con); ?>