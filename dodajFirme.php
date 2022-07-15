<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
		$id_uzytkownika=$_SESSION['id_uzytkownika'];

		//Poniżej - przetważanie naszego formularza:
		if(isset($_POST['dodaj']))	//Sprawdzam czy ktoś wpisał chociaz imie lub nazwisko
		{								
						
			//udana walidazja? Załóżmy, że tak (all testy ok)
			$all_OK=true;
			
			
			// inputy
			$pr_name=$_POST['pr_name'];
			$pr_name=htmlspecialchars($pr_name, ENT_QUOTES, "UTF-8");
						
			if(strlen($pr_name)<1)
			{
				$all_OK=false;
				$error_brakNameLubSurname="Wpisz nazwę firmy";
			}
			
				require_once "connect.php";
				
				mysqli_report(MYSQLI_REPORT_STRICT);		// tu inf. że chcemy rzucać wyjątkami w przypadku błędów
				try 										// try/catch, coś jak "@" (do pomijania błędów)
				{					 										
				 $polaczenie=new mysqli($host, $db_user, $db_password, $db_name);   
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
					 //dodanie nowej firmy
						if($all_OK==true)
						{	
							if($polaczenie->query("INSERT INTO firmy VALUES(NULL, '$id_uzytkownika' ,'$pr_name')"))
							{
								$_SESSION['dodanoPrKomunikat']="Pomyślnie dodano firmę";
								unset($_POST['dodaj']);
								echo "<script>
									window.close();
									if (window.opener && !window.opener.closed) {
										window.opener.location.href = 'firmy.php';
									};
								</script> ";
								exit();
							}
							else{
								throw new Exception($polaczenie->error);
							}
							
						}
						
						
						$polaczenie->close();		//NIE ZAPONIJ ZAMKNĄĆ POŁĄCZENIA!
					}
				}
				catch(Exception $e)
				{
					echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie! </span>';
					echo '<br>Informacja developerska: '.$e;
				}
			
			
		
		}else if(isset($_POST['anuluj'])){
			header('Location: firmy.php');
			unset($_POST['anuluj']);
			};
	}

	
?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/style_littleBox_pr.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - dodaj firmę</title>
	</head>
<body>
    <div class="container">
			
		<div class=box1>
			
		   <form method="post">
						   
				<?php
				if(isset($error_brakNameLubSurname))
				{
					echo '<div class="negativ">'.$error_brakNameLubSurname.'</div>';
					unset($error_brakNameLubSurname);
				}
				?>
				
				<br> nazwa firmy:
				<br><input type="text" name="pr_name">
								
				<br><br> <input type="submit" value="dodaj" name='dodaj' class='button1'>
				<input type='submit' value='anuluj' name='anuluj' class='button2' onclick='window.close()'>
		   </form>
	   
	   </div>

   
    </div>
    
   <!-- <script src="js/script1.js"></script> -->
    </body>


</html>