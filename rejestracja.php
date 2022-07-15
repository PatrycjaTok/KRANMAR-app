<?php

	session_start();	// dzięki temu podstrona może korzystać ze zmiennych globalnych

	//Poniżej - przetważanie naszego formularza:
	if(isset($_POST['emailR'])) 	//Sprawdzam czy ktoś kliknął "zarejestruj"
	{								//teraz ustawiamy poprawność danych (jakie dane będą przyjmowane)
		//udana walidazja? Załóżmy, że tak (all testy ok)
		$all_OK=true;
		
		// imie
		$user_name=$_POST['user_name'];
		$user_name=htmlentities($user_name, ENT_QUOTES, "UTF-8");
		
		// długość imienia
		if((strlen($user_name)<2)||(strlen($user_name)>10)) 		//spr. długość imienia
		{
			$all_OK=false;
			$_SESSION['e_name']="imię musi posiadać od 2 do 10 znaków";
		}
		
		
		// spr. poprawności adresu email
		$email=$_POST['emailR'];
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);	 		//specjalnu filtr stosowany do adresów mailowych
		if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) //pierwsza walidacja mogła uciać litery, więc sprawdzam
		{
			$all_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail";
		}
		
		//Spr. poprawnośc hasła
		$password1=$_POST['passwordR'];
		$password2=$_POST['passwordR2'];
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
		
		//spr. czy checkbox jest zaznaczony (akceptacja regulaminu)
		if(!isset($_POST['regulamin']))
		{
			$all_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu";
		}
		
		//spr czy reCAPTCHA jest zaznaczony - Bot or not :D
		$secret_key="6LcbZeceAAAAAKXul9DYpJJTNO5to7yBFcPO_91S";			//druga część kodu z reCAPTCHA
		$spr=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);		//łączymy się z google by spr. zgodność reCAPTCHA
		$odp=json_decode($spr);					//dekodujemy, bo odp z googla przychodzi w formacie json
		
		if($odp->success==false)
		{
			$all_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem";
		}
		
		//COD
		$kod_spr=uniqid('kod'); // generowanie losowego kodu
		$cod=password_hash($kod_spr, PASSWORD_DEFAULT); // zaszyfrowanie kodu
		
		//zapamiętywanie wprowadzonych danych
		$_SESSION['form_name']=$user_name;
		$_SESSION['form_email']=$email;
		$_SESSION['form_password1']=$password1;
		$_SESSION['form_password2']=$password2;
		
		
		//sprawdzenie czy podany e-mail nie istnieje już w bazie
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
					//Czy email już istnieje?
					$rezult=$polaczenie->query("SELECT id FROM uzytkownicy WHERE mail='$email'");	//sprawdzam maila tylko jeśli udało się połączyć - dlatego w if'ie - w "else"
					if(!$rezult) throw new Exception($polaczenie->error);			//gdy nie udalo się w ogole wyslac zapytania
					$ile_takich_maili=$rezult->num_rows;
					if($ile_takich_maili>0)
					{
						$all_OK=false;
						$_SESSION['e_email']="istnieje już konto przypisane do tego adresu e-mail";
					}
										
					
					
					//GDY ALL JEST OK (all warunki spełnione) - DODANIE NOWEGO użytkownika 
					if($all_OK==true)
					{
						$task="task1";
						if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$user_name','$email', '$password_hash', '$cod', '$task')"))
						{
							$_SESSION['registry_ok']=true;			//udana rejestracja
							header('Location: witamy.php');
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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>  <!-- reCAPTCHA -->
    </head>
<body>
    <div class="container">
        <div class="box1b marginbottom30">
            <form method="post">	<!-- nie piszę action=...., bo chcę by ten sam plik przetworzył wysłany form. -->
			
			imię: <br><input type="text" class = "input1" name="user_name"
			value="<?php							//zapamiętywanie wpisanych danych
			if(isset($_SESSION['form_name'])) 		//w przypadku niepowodzenia rejestr. nie trzeba drugi raz all pisać
			{
				echo $_SESSION['form_name'];
				unset($_SESSION['form_name']);
			}
			?>">
			
			<?php
				if(isset($_SESSION['e_name']))
				{
					echo '<div class="negativ2">'.$_SESSION['e_name'].'</div>';
					unset($_SESSION['e_name']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> e-mail: <br><input type="text" class = "input1" name="emailR"
			value="<?php							//zapamiętywanie wpisanych danych
			if(isset($_SESSION['form_email'])) 		//w przypadku niepowodzenia rejestr. nie trzeba drugi raz all pisać
			{
				echo $_SESSION['form_email'];
				unset($_SESSION['form_email']);
			}
			?>">
			
			<?php
				if(isset($_SESSION['e_email']))
				{
					echo '<div class="negativ2">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> password: <br><input type="password" class = "input1" name="passwordR"
			value="<?php								//zapamiętywanie wpisanych danych
			if(isset($_SESSION['form_password1'])) 		//w przypadku niepowodzenia rejestr. nie trzeba drugi raz all pisać
			{
				echo $_SESSION['form_password1'];
				unset($_SESSION['form_password1']);
			}
			?>">
			
			<?php
				if(isset($_SESSION['e_password']))
				{
					echo '<div class="negativ2">'.$_SESSION['e_password'].'</div>';
					unset($_SESSION['e_password']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> repeat password: <br><input type="password" class = "input1" name="passwordR2"
			value="<?php								//zapamiętywanie wpisanych danych
			if(isset($_SESSION['form_password2'])) 		//w przypadku niepowodzenia rejestr. nie trzeba drugi raz all pisać
			{
				echo $_SESSION['form_password2'];
				unset($_SESSION['form_password2']);
			}
			?>">
			<br><label>				<!-- dzięki label nawet klikniecię na tekst spowoduje zaznaczenie checkboxa -->
				<input type="checkbox" name="regulamin">Akceptuję regulamin
				</label>
				
				<?php
				if(isset($_SESSION['e_regulamin']))
				{
					echo '<div class="negativ2">'.$_SESSION['e_regulamin'].'</div>';
					unset($_SESSION['e_regulamin']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
				<div class="g-recaptcha" data-sitekey="6LcbZeceAAAAAAee4UyfEIUCoYCjtpNrmX1Enf1u"></div>	<!-- wchodzę na str. reCAPTCHA i tam rejestruje str.-pierwsza część kodu) -->
			
			<?php
				if(isset($_SESSION['e_bot']))
				{
					echo '<div class="negativ2">'.$_SESSION['e_bot'].'</div>';
					unset($_SESSION['e_bot']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			
			<br> 
			<input type="submit" value="zarejestruj się" class='btnEdit2'>
			<button class='btnAnuluj2'><a href='index.php'>anuluj</a></button>
			
			</form>
		</div>
    </div>
    
    <!-- <script src=".js"></script> -->
    <!--w JS: console.log(document);-->
    </body>


</html>