<?php

	session_start();	// dzięki temu podstrona może korzystać ze zmiennych globalnych

	if(!isset($_SESSION['registry_ok']))
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else{
		unset($_SESSION['registry_ok']);
	};

	//usuwamy zmienne służące do zapamiętywania wartości w przypadku złej rejestracji (DODATKOWE UDZIWNIENIE) - bo udało się zarejestrować
	if(isset($_SESSION['form_name'])) unset($_SESSION['form_name']);
	if(isset($_SESSION['form_email'])) unset($_SESSION['form_email']);
	if(isset($_SESSION['form_password1'])) unset($_SESSION['form_password1']);
	if(isset($_SESSION['form_password2'])) unset($_SESSION['form_password2']);
	
	//usuwamy errory rejestracji - bo udało się zarejestrować
	if(isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
	if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if(isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
    <link rel="stylesheet" href="css/style_editdelete.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - zastępstwa, zaliczki, budowy</title>
    </head>
<body>
    <div class="container">
		<div class='box1'>
			<div class="boxx">
				<div> 
					Dziękujemy za rejestrację! 
					<br> Możesz zalogować się do swojego konta.
				<br>
			
				<div class='divbtn'><br>
					<button class='btnEdit'><a href='index.php'>Przejdź na stronę logowania</a></button>
				</div>
			</div>
		

		</div>
    </div>
    
    <script src=".js"></script>
    <!--w JS: console.log(document);-->
    </body>


</html>