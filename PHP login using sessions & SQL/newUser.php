<?php
 $errMsg = "&nbsp;";

if (isset($_REQUEST['Password']) && isset($_REQUEST['Username']))
{
    
    $Username= filter_input(INPUT_POST, 'Username');
    $Password= filter_input(INPUT_POST, 'Password');
    $rPassword= filter_input(INPUT_POST, 'rPassword');
    $firstName=filter_input(INPUT_POST, 'firstName');
    $Last_name= filter_input(INPUT_POST, 'Last_name');
    $Person_id= filter_input(INPUT_POST, 'Person_id');
    $isAdmin = False;
    $isActive = True;
   

    
   $link = mysql_connect("localhost", "root","") or die("Could not connect");
   mysql_select_db("aaa") or die("Could not select database");
    
         $sql = "insert into user (username, password, person_id, first_name, last_name, is_admin)
	values ('$Username',md5('$Password'), '$Person_id', '$firstName', '$Last_name', false)";

    $result = mysql_query($sql) or die("Ivyko klaida registracijos metu");
    mysql_close($link);
    echo '';
    echo 'Jus sekmingai uzsiregistravote!';
    Header("refresh:2; url=index.php");
  
} 
    
?>
<html>
<HEAD>
<link rel="stylesheet" type="text/css" href="styles.css">
<script type="text/javascript" src="inputCheck.js"></script>
</HEAD>
<body>
    
    <form action="newUser.php" method="POST">
        <table class="login">
            <tr>
                
                <td>Registracija: </td>  
            </tr>
                       
                 <td> Slapyvardis:</td> 
                 <td><input type="text" name="Username" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['Username']; ?>"></td>
            </tr>
              <tr>
                 <td> Slaptazodis:</td> 
                 <td><input type="password" name="Password" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['Password']; ?>"></td>
            </tr>
         
            <tr>
                 <td> Pakartokite slaptazodi:</td> 
                 <td><input type="password" name="rPassword" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['rPassword']; ?>"></td>
            </tr>
           
     <tr>
                 <td> Vardas:</td> 
                 <td><input type="text" name="firstName" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['firstName']; ?>"></td>
            </tr>
               <tr>
                     <td> Pavarde:</td> 
                     <td><input type="text" name="Last_name" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['Last_name']; ?>"></td>
            </tr>
               <tr>
                 <td> Asmens kodas:</td> 
                 <td><input type="text" name="Person_id" onkeypress="return testKey(event)" value="<?php @$_REQUEST ['Person_id']; ?>"></td>
            </tr>
             
            <tr>
                <td></td>
                <td><input type="submit" value="Prideti" /></td>
               
                 
            </tr>
     <tr >
         
        </table>
    
    </form>

</body>
</html>

