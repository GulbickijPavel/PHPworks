<?php

	// save data if '$' icon pressed
	if (isset($_REQUEST['payUserContractId'])) {
	
		if ($stmt = mysqli_prepare($con, "SELECT CONTRACT.ID, CONTRACT.CONTRACT_END_DATE, CONTRACT.FREQUENCY_IN_MONTHS FROM USER_CONTRACTS LEFT JOIN CONTRACT ON USER_CONTRACTS.CONTRACT_ID = CONTRACT.ID WHERE USER_CONTRACTS.ID = ?")) {

			mysqli_stmt_bind_param($stmt, "i", $_REQUEST['payUserContractId']);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_bind_result($stmt, $contractId, $contractEndDate , $contractFrequencyInMonths);
			
			mysqli_stmt_fetch($stmt);

			mysqli_stmt_close($stmt);
           	Header("Location: index.php?pageName=myContracts.php");
				exit();
			
		}
	}
	
	// load data
	if ($stmt = mysqli_prepare($con, "SELECT USER_CONTRACTS.ID, CONTRACT.PAYMENT_NAME, CONTRACT.PAYMENT_CODE, CONTRACT.CUSTOMER_ID, CONTRACT.FREQUENCY_IN_MONTHS, CONTRACT.PAYMENT_AMOUNT, CONTRACT.CONTRACT_START_DATE, CONTRACT.CONTRACT_END_DATE FROM USER_CONTRACTS LEFT JOIN CONTRACT ON USER_CONTRACTS.CONTRACT_ID = CONTRACT.ID  WHERE USER_CONTRACTS.USER_ID = ?")) {

		mysqli_stmt_bind_param($stmt, "i", $_SESSION['user']['id']);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_bind_result($stmt, $userContractsId, $contractPaymentName, $contractPaymentCode, $contractCustomerId, $contractFrequencyInMonths, $contractPaymentAmount, $contractStartDate, $contractEndDate);
		
		$userContracts = array();
		while (mysqli_stmt_fetch($stmt)) {
			array_push($userContracts, array("id" => $userContractsId, "paymentName" => $contractPaymentName, "paymentCode" => $contractPaymentCode, "customerId" => $contractCustomerId, "frequencyInMonths" => $contractFrequencyInMonths, "paymentAmount" => $contractPaymentAmount, "contractStartDate" => $contractStartDate, "contractEndDate" => $contractEndDate));
		}
		
		mysqli_stmt_close($stmt);
	}

?>
	<h2>Mano Sutartys</h2>
	<table class = "data">
		<tr>
			<th>Nr.</th>
			<th>Mokėjimo pavadinimas</th>
			<th>Įmokos kodas</th>
			<th>Kliento kodas</th>
			<th>Dažnis mėn.</th>
			<th>Įmokos dydis</th>
			<th>Pradžios data</th>
			<th>Pabaigos data</th>
			<th>Veiksmai</th>
		</tr>
		<?php
			$counter = 1;
			$alt = "";
			foreach($userContracts as $key => $userContract) 
                            {
				
				echo "<tr $alt>";
				echo "<td>$counter</td>";
				echo "<td>$userContract[paymentName]</td>";
				echo "<td>$userContract[paymentCode]</td>";
				echo "<td>$userContract[customerId]</td>";
				echo "<td>$userContract[frequencyInMonths]</td>";
				echo "<td>".number_format($userContract['paymentAmount'], 2, '.', '')."</td>";
				echo "<td>$userContract[contractStartDate]</td>";
				echo "<td>$userContract[contractEndDate]</td>";

				echo "<td><a href='index.php?pageName=myContracts.php&payUserContractId=$userContract[id]' onclick='javascript:if (confirm(\"Mokejimas jau ivykdytas? \\\"$userContract[paymentName]\\\"?\")) {return true;} else {return false;}'><img src='images/pay.jpg' width='30px'></a></td>";
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
            