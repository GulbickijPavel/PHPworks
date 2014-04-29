<?php

	if ($stmt = mysqli_prepare($con, "SELECT ID, USERNAME, PERSON_ID, FIRST_NAME, LAST_NAME, IS_ADMIN, IS_ACTIVE FROM USER")) {

		mysqli_stmt_execute($stmt);
			
		mysqli_stmt_bind_result($stmt, $userId, $userName, $userPersonId, $userFirstName, $userLastName, $userIsAdmin, $userIsActive);
		
		$users = array();
		while (mysqli_stmt_fetch($stmt)) {
			array_push($users, array("id" => $userId, "username" => $userName, "personId" => $userPersonId, "firstName" => $userFirstName, "lastName" => $userLastName, "isAdmin" => $userIsAdmin === 1 ? true : false, "isActive" => $userIsActive === 1 ? true : false));
		}
		
		mysqli_stmt_close($stmt);
		/*
		foreach($users as $key => $user) {
		
			if ($stmt = mysqli_prepare($con, "SELECT EMAIL FROM USER_EMAIL WHERE USER_ID = ?")) {

				mysqli_stmt_bind_param($stmt, "i", $user['id']);
				mysqli_stmt_execute($stmt);
					
				mysqli_stmt_bind_result($stmt, $userEmail);
				
				$users[$key]['email'] = array();
				while (mysqli_stmt_fetch($stmt)) {
					array_push($users[$key]['email'], $userEmail);
				}
				
				mysqli_stmt_close($stmt);
			
		}}*/
	}
?>
	<h2>Vartotojai</h2>
	<table class = "data">
		<tr>
			<th>Nr.</th>
			<th>Vardas</th>
			<th>Pavardė</th>
			<th>Asmens kodas</th>
			<th>Vartotojo vardas</th>
			<th>Administratorius</th>
			<th>Aktyvus</th>
		</tr>
		<?php
			$counter = 1;
			$alt = "";
			foreach($users as $key => $user) { 
			
				echo "<tr $alt>";
				echo "<td>$counter</td>";
				echo "<td>$user[firstName]</td>";
				echo "<td>$user[lastName]</td>";
				echo "<td>$user[personId]</td>";
				echo "<td>$user[username]</td>";
				
			
				echo "</td>";
				
				$isAdminChecked = $user['isAdmin'] ? "checked='checked'" : "";
				echo "<td><input type='checkbox' $isAdminChecked disabled='true'></td>";
				
				$isActiveChecked = $user['isActive'] ? "checked='checked'" : "";
				echo "<td><input type='checkbox' $isActiveChecked disabled='true'></td>";
				echo "</tr>";
				
				if (strlen($alt) == 0) {
					$alt = "class='alt'";
				} else {
					$alt = "";
				}
				
				$counter++;
			} 
		?>
	</table>