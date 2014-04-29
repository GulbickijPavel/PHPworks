<?php

function generateHeaderHtml($text) {
	
}

function generateMenuHtml() {

	$menuHtml = "<div id='menu' >\r";

			
	if (isUserLoggedIn()) {
	
		if ($_SESSION['user']['isAdmin']) {
			$menuHtml .= "<a href='index.php?pageName=users.php' target='_self'> Vartotojai </a>";
		
			$menuHtml .= "<a href='index.php?pageName=Contracts.php' target='_self'> Sutartys </a>";
                        
		}
		$menuHtml .= "<a href='index.php?pageName=addContract.php' target='_self'> Nauja Sutartis </a>";
		$menuHtml .= "<a href='index.php?pageName=myContracts.php' target='_self'> Mano sutartys </a>";
	
		
	
		$menuHtml .= "</h5>";
		$menuHtml .= "<a href='index.php?pageName=logout.php' target='_self'> Atsijungti </a> <br/>";
        
           $menuHtml .= $_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']."<br/>";
		   $menuHtml .= $_SESSION['user']['id']."<br/>";
                   
		
	}
	
	$menuHtml .= "</div>";
	
	return $menuHtml;
}

?> 