<?php

	if ($stmt = mysqli_prepare($con, "SELECT USER.USERNAME, CONTRACT.ID,  CONTRACT.PAYMENT_NAME, CONTRACT.PAYMENT_CODE, CONTRACT.CUSTOMER_ID, CONTRACT.FREQUENCY_IN_MONTHS, CONTRACT.PAYMENT_AMOUNT, CONTRACT.CONTRACT_START_DATE, CONTRACT.CONTRACT_END_DATE, CONTRACT.IS_ACTIVE FROM USER_CONTRACTS LEFT JOIN CONTRACT ON USER_CONTRACTS.CONTRACT_ID = CONTRACT.ID LEFT JOIN USER ON USER_CONTRACTS.USER_ID = USER.ID ")) {

		mysqli_stmt_execute($stmt);
			
		mysqli_stmt_bind_result($stmt, $username, $contractId, $contractPaymentName, $contractPaymentCode, $contractCustomerId, $contractFrequencyInMonths, $contractPaymentAmount, $contractStartDate, $contractEndDate, $contractIsActive);
		
		$contracts = array();
		while (mysqli_stmt_fetch($stmt)) {
			array_push($contracts, array("id" => $contractId, "username" => $username, "paymentName" => $contractPaymentName, "paymentCode" => $contractPaymentCode, "customerId" => $contractCustomerId, "frequencyInMonths" => $contractFrequencyInMonths, "paymentAmount" => $contractPaymentAmount, "contractStartDate" => $contractStartDate, "contractEndDate" => $contractEndDate,  "isActive" => $contractIsActive === 1 ? true : false));
		}
		
		mysqli_stmt_close($stmt);
	}
?>

	<h2>Sutartys</h2>
	<table class = "data">
		<tr>
			<th>Nr.</th>
			<th>Vartotojo vardas</th>
			<th>Mokėjimo pav.</th>
			<th>Įmokos Kodas</th>
			<th>Kliento kodas</th>
			<th>Dažnis mėn.</th>
			<th>Įmokos dydis</th>
			<th>Pradžios data</th>
			<th>Pabaigos data</th>
			<th>Irašas aktyvus</th>
		</tr>
		<?php
                
               echo "<div> $username</div>";
			$counter = 1;
			$alt = "";
			foreach($contracts as $key => $contract) { 
				
				echo "<tr $alt>";
				echo "<td>$counter</td>";
				echo "<td>$contract[username]</td>";
				echo "<td>$contract[paymentName]</td>";
				echo "<td>$contract[paymentCode]</td>";
				echo "<td>$contract[customerId]</td>";
				echo "<td>$contract[frequencyInMonths]</td>";
				echo "<td>".number_format($contract['paymentAmount'], 2, '.', '')."</td>";
				echo "<td>$contract[contractStartDate]</td>";
				echo "<td>$contract[contractEndDate]</td>";

				$isActiveChecked = $contract['isActive'] ? "checked='checked'" : "";
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