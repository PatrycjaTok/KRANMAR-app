<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
				

		if(isset($_POST['dodaj']))
		{
			$month=$_POST['miesiacDoHistorii'];
			$year=$_POST['rokDoHistorii'];
			if( ($month<13) && ($month>0) && ($year<5000) && ($year>1900))					
			{
				//Poniżej - przetważanie naszego formularza:
												
				$id_uzytkownika=$_SESSION['id_uzytkownika'];				
				
				$data="$month$year";
		
				
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
								
							//dodanie do historii zastępstw
							if($rezultquestion=$polaczenie->query("SELECT id FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data'"))
							{
								$ilerows=$rezultquestion->num_rows;	
								if($ilerows>0)
								{
									if($polaczenie->query("INSERT INTO zastepstwa_historia SELECT * FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data'"))
									{
										$polaczenie->query("DELETE FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data'");
										header('Location: main.php');
										$_SESSION['PrzeniesDoHistroiiKomunikat']="Przeniesiono do historii: ".$month.".".$year."r.";
										unset($_POST['dodaj']);


									}
									else{
										throw new Exception($polaczenie->error);
									} 
								}else
								{
									header('Location: main.php');
									$_SESSION['ErrorZastepstw']="brak wyników";
									unset($_POST['dodaj']);
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
			}else
			{
				header('Location: main.php');
				$_SESSION['ErrorZastepstw']="uzupełnij poprawnie miesiąc i rok";
				unset($_POST['dodaj']);
			}
			
			
			
		}
}	
	
