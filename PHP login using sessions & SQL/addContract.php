
<?php

if (isset($_REQUEST['pName']) && isset($_REQUEST['pCode']))
{
    session_start();
    $pName=$_POST["pName"];
    $pCode=$_POST["pCode"];
    $cCode=$_POST["cCode"];
    $period=$_POST["period"];
    $value=$_POST["value"];
    $start=$_POST["date10"];
    $end=$_POST["date11"];

    $id  = $_SESSION['user']['id'];
 
    $link = mysql_connect("localhost", "root","") or die("Could not connect");
    mysql_select_db("aaa") or die("Could not select database");
    
           
    $sql = "INSERT INTO CONTRACT ( PAYMENT_NAME, PAYMENT_CODE, CUSTOMER_ID, FREQUENCY_IN_MONTHS, PAYMENT_AMOUNT, CONTRACT_START_DATE, CONTRACT_END_DATE) 
    VALUES ('$pName','$pCode','$cCode','$period','$value','$start','$end')";
  
    $result = mysql_query($sql) or die("Query failed");
 
    $query = mysql_query("SELECT max(id) FROM CONTRACT");
    $row = mysql_fetch_row($query);
    $contractid = $row[0];
    $contractId = $contractid +1;
    
    $sql= "INSERT INTO USER_CONTRACTS(USER_ID, CONTRACT_ID)
    VALUES ('$id', $contractid)";
    $result = mysql_query($sql) or die("Query failed1");
    mysql_close($link);
    
    Header("Location: index.php");
}
 ?>

<html>
<HEAD>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jquery.simple-dtpicker.css" rel="stylesheet" />
        <script type="text/javascript" src="inputCheck.js"></script>
</HEAD>
<body >
    
    <form action="addContract.php" method="POST">
        <h2>Nauja Sutartis</h2>
        <table class="contract" onkeypress="return testKey(event)">
            <tr>
                 <td> Mokejimo pavadinimas:</td> 
    <td><input type="text" name="pName" value="<?php echo @$_REQUEST['pName']; ?>"></td>
            </tr>
              <tr>
                 <td> Imokos kodas:</td> 
    <td><input type="text" name="pCode" onkeypress="return testKey(event)" value="<?php echo @$_REQUEST['pCode']; ?>"></td>
            </tr>
               <tr>
                 <td> Kliento kodas:</td> 
    <td><input type="text" name="cCode" onkeypress="return testKey(event)" value="<?php echo @$_REQUEST['cCode']; ?>"></td>
            </tr>
     <tr>
                 <td> Daznis(men):</td> 
    <td><input type="text" name="period"  onkeypress="return testKey(event)" value="<?php echo @$_REQUEST['period']; ?>"></td>
            </tr>
               <tr>
                     <td> Imokos dydis:</td> 
    <td><input type="text" name="value" onkeypress="return testKey(event)" value="<?php echo @$_REQUEST['value']; ?>"></td>
            </tr>
               <tr>
                   
                 <td> Mokejimo pradzia:</td> 
    <td><input type="text" name="date10" value="<?php echo @$_REQUEST['start']; ?>"></td>
            </tr>
               <tr>
                 <td> Mokejimo pabaiga:</td> 
    <td><input type="text" name="date11" value="<?php echo @$_REQUEST['end']; ?>"></td>
            </tr>
             
            <tr>
                <td>
                    <input type="submit" value="sukurti" />
                </td>
                 
            </tr>
     <tr >
        <script type="text/javascript">
				$(function(){
					$('*[name=date10]').appendDtpicker({
						"closeOnSelected": true
					});
				});
			</script>
    <script type="text/javascript">
				$(function(){
					$('*[name=date11]').appendDtpicker({
						"closeOnSelected": true
					});
				});
			</script>
             
        </table>
    
    </form>

</body>
</html>
<?php
     
?>

