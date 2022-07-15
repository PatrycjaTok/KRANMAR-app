<?php

	session_start();	// dzięki temu podstrona może korzystać ze zmiennych globalnych

	//Poniżej - przetważanie naszego formularza:
	if((isset($_POST['password1'])) && ($_SESSION['resetpass']=true))	
	{								//teraz ustawiamy poprawność danych (jakie dane będą przyjmowane)
		//udana walidazja? Załóżmy, że tak (all testy ok)
		$all_OK=true;
		
		
		//Spr. poprawnośc hasła
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		
		if((strlen($password1)<8)||(strlen($password1)>20)) 		//spr. długość hasła: od 8 do 20 znaków
		{
			$all_OK=false;
			$_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków";
		}
		
		if($password1!=$password2)
		{
			$all_OK=false;
			$_SESSION['e_password']="Hasła nie są identyczne";
		}
		
		$password_hash=password_hash($password1, PASSWORD_DEFAULT);	//haszujemy hasło - szyfrowanie hasła -BEZPPIECZENSTWO
		
		//spr poprawności kodyu
		$cod=$_POST['kod'];
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
					//Czy cod istnieje?
					$rezult1=$polaczenie->query("SELECT id FROM uzytkownicy WHERE COD='$cod'");	//sprawdzam maila tylko jeśli udało się połączyć - dlatego w if'ie - w "else"
					if(!$rezult1) throw new Exception($polaczenie->error);			//gdy nie udalo się w ogole wyslac zapytania
					$ile_takich_id=$rezult1->num_rows;
					if($ile_takich_id==0)
					{
						$all_OK=false;
						$_SESSION['e_cod']="Wpisz poprawny kod";
					}
					
					
					
					//GDY ALL JEST OK (all warunki spełnione) - DODANIE NOWEGO użytkownika 
					if($all_OK==true)
					{
				
							if($rezult2=$polaczenie->query("UPDATE uzytkownicy SET password='$password1' WHERE COD='$cod'")) // wysłanie zapytania
								{//jesli ok to wysylany zostaje email z linkiem do zmiany hasla 
								
									$pass_hash=password_hash($password1, PASSWORD_DEFAULT); // zaszyfrowanie hasła
									$cod_hash=password_hash($cod, PASSWORD_DEFAULT); // zaszyfrowanie kodu
									$rezult3=$polaczenie->query("UPDATE uzytkownicy SET COD='$cod_hash', password='$pass_hash' WHERE COD='$cod'");
									$_SESSION['resetpass']=false;
									
									echo "<p class='positiv positionCentre'>Hasło zostało zmienione</p>
									<button class='btnEditAnuluj positionCentre2'><a href='index.php'>Powrót</a></button>";
									
							
								
								}else
							 {
								 echo '<p>Wystąpił problem z zapytaniem do bazy danych. Zgłoś sie do administratora.</p>';
							 }
					
					
					
							$polaczenie->close();		//NIE ZAPONIJ ZAMKNĄĆ POŁĄCZENIA!
						
					}
					
				}	
				
				
		}
		catch(Exception $e)
		{
			echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie! </span>';
			//echo '<br>Informacja developerska: '.$e;
		}
	}

?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
    <link rel="stylesheet" href="css/style_editdelete.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - załóż nowe konto - rejestracja </title>
    </head>
<body>
    <div class="container">
        <div class="box1">
            <form action="http://kranmar.pl/rempasswindow.php?resetpaswd=yes&user>" method="post">	<!-- UPDATE -->
			
			
			<br> password: <br><input type="password" class = "input1" name="password1" placeholder="password">
			
			<?php
				if(isset($_SESSION['e_password']))
				{
					echo '<div class="negativ">'.$_SESSION['e_password'].'</div>';
					unset($_SESSION['e_password']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> repeat password: <br><input type="password" class = "input1" name="password2" placeholder="password">
			<br> wpisz kod: <br><input type="text" class = "input1" name="kod" placeholder="wpisz/wklej kod">
			
			<?php
				if(isset($_SESSION['e_cod']))
				{
					echo '<div class="negativ">'.$_SESSION['e_cod'].'</div>';
					unset($_SESSION['e_cod']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> <input type="submit" value="zmień hasło" class='btnEdit2'>
			<button class='btnAnuluj2'><a href='index.php'>Powrót</a></button>
			
			
			</form>
		</div>
    </div>
    
    <script src=".js"></script>
    <!--w JS: console.log(document);-->
    </body>


</html>