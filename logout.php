<?php

	session_start();

	session_unset();				//wylogowanie
	
	header('Location: index.php');	//wylogowanie
	
?>

