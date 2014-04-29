<?php

	$errMsg = "&nbsp;";

	if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
	
		if ($_REQUEST['username'] != null && $_REQUEST['password'] != null) {

			// getting user
			if ($stmt = mysqli_prepare($con, "SELECT ID, USERNAME, PERSON_ID, FIRST_NAME, LAST_NAME, IS_ADMIN FROM USER WHERE USERNAME = ? AND PASSWORD = MD5(?) AND IS_ACTIVE = ?")) {

				$isActive = 1;
			
				mysqli_stmt_bind_param($stmt, "ssi", $_REQUEST['username'], $_REQUEST['password'], $isActive);
				mysqli_stmt_execute($stmt);
				
				mysqli_stmt_bind_result($stmt, $_SESSION['user']['id'], $_SESSION['user']['username'], $_SESSION['user']['personId'], $_SESSION['user']['firstName'], $_SESSION['user']['lastName'], $_SESSION['user']['isAdmin']);
				
				$isUserFound = mysqli_stmt_fetch($stmt);
				
				mysqli_stmt_close($stmt);
				
				// getting emails
				if ($isUserFound) {
					mysqli_close($con);
					Header("Location: index.php");
				} else {
					$errMsg = "Neteisingi prisijungimo duomenis!";
				}
			}
		} else {
			$errMsg = "Neįvedėte prisijungimo duomenų!";
		}
	}
	
?>
	<div class="error"><?php echo $errMsg; ?></div>
	<br/>
	<form action="index.php?pageName=login.php" method="post">
		<table class="login">
                    <tr>
                         <td>Prisijungimas:</td>
                    </tr>
                   
			<tr>
				<td>Vartotojo vardas:</td>
				<td><input type="text" name="username" value="<?php filter_input(INPUT_GET, 'username'); ?>"></td>
			</tr>
			<tr>
				<td>Slaptažodis:</td>
				<td><input type="password" name="password" value="<?php filter_input(INPUT_GET, 'password'); ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="Prisijungti"></td>
			</tr>
		</table>
	</form>
