<?php


	session_start();	// dzięki temu podstrona może korzystać ze zmiennych globalnych

	//Poniżej - przetważanie naszego formularza:
	if(isset($_POST['email'])) 	//Sprawdzam czy ktoś kliknął "zarejestruj"
	{								//teraz ustawiamy poprawność danych (jakie dane będą przyjmowane)
		//udana walidazja? Załóżmy, że tak (all testy ok)
		$all_OK=true;
		$_SESSION['resetpass']=false;
		
		// spr. poprawności adresu email
		$email=$_POST['email'];
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);	 		//specjalny filtr stosowany do adresów mailowych
		if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) //pierwsza walidacja mogła uciać litery, więc sprawdzam
		{
			$all_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail";
		}
		
		//sprawdzenie czy podany e-mail istnieje w bazie
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
					if($ile_takich_maili==0)
					{
						$all_OK=false;
						$_SESSION['e_email']="konto o podanym adresie e-mail nie istnieje";
					}
						
					
					//GDY ALL JEST OK (all warunki spełnione) - wysyłam link
					if($all_OK==true)
					{
						$cod=uniqid('kod'); // generowanie losowego kodu
						//$cod=password_hash($kod_spr, PASSWORD_DEFAULT); // zaszyfrowanie kodu
						if($rezult1=$polaczenie->query("UPDATE uzytkownicy SET COD='$cod' WHERE mail='$email'")) // wysłanie zapytania
						 {  
							 //WYSYŁANIE MAILA C.D
							require 'phpmailer/PHPMailerAutoload.php';
				
							// Create instance of phpmailer
							$mail = new PHPMailer();
							// Set mailer to use smtp
							//$mail -> isSMTP();
							// define smtp host
							$mail -> Host = "smtp.gmail.com";
							// enable smtp authentication
							$mail -> SMTPAuth = true;
							// set type of encryption(ssl/thl)
							$mail -> SMTPSecure = 'tls';
							// set port to connect smtp
							$mail -> Port = 587;
							// set gmail username
							$mail -> Username = "patappsandprojects@gmail.com";
							// set gmail password
							$mail -> Password = "apps123*";
							//kodowanie znakow
							$mail->CharSet = "UTF-8";
							// set email subject
							$mail -> Subject = "Nowe hasło - kranmar.pl";
							// set sender email
							$mail -> setFrom("patappsandprojects@gmail.com");
							// Enable HTML
							$mail -> isHTML(true);
							// Attachment
							//$mail -> addAttachment('img/attachment.png');
							// email body
							$mail -> Body = " Witaj!\n Ktoś poprosił o wygenerowanie nowego hasła dla konta: ".$email." Na aplikacji do zarządzania ludźmi.\n Nawet jeśli to nie Ty wysłałeś prośbę o zmianę hasła, radzimy to zrobić.\n Twój kod to:\n ".$cod."\n Aby ustawić nowe hasło, przejdź pod adres:\n http://kranmar.pl/rempasswindow.php?resetpaswd=yes&user";
							// add recipient
							$mail -> addAddress($email);
							// finally send email
							if($mail->Send()){
								echo "<div class='positiv positionCentre'>Email został wysłany!</div>
								<br><button class='btnEdit positionCentre2'><a href='index.php'>wróć do strony logowania</a></button>";
							}else{
								echo "<div class='negativ positionCentre'>Error..! \n Zgłoś błąd do administratora </div>";
							}
							// closing smtp connection
							$mail->smtpClose();

							
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
			echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności i prosimy spróbować w innym terminie! </span>';
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
    <title>Aplikacja do zarządzania ludźmi - przypomnienie hasła </title>
    </head>
<body>
    <div class="container">
        <div class="box1">
            <form method="post" class='leftmarg'>	<!-- nie piszę action=...., bo chcę by ten sam plik przetworzył wysłany form. -->
			Link do zmiany hasła zostanie wysłany na podany adres e-mail.
			
			<br><b> e-mail: </b><br><input type="text" class = "input1" name="email" placeholder="e-mail"
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
					echo '<div class="negativ">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
			?>
			<br><br>
	 		<input type="submit" value="potwierdź" class='btnEdit2'>
			<button class='btnAnuluj2'><a href='index.php'>wróć do strony logowania</a></button>
			
			</form>
		</div>
    </div>

    </body>


</html>