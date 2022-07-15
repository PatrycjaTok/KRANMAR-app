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
		
			if( ((strlen($_POST['kto'])>2) || (strlen($_POST['zakogo'])>2)) && (strlen($_POST['data'])>2) )					
			{
				//Poniżej - przetważanie naszego formularza:
												
				$id_uzytkownika=$_SESSION['id_uzytkownika'];
							
				// inputy
				$data=$_POST['data'];

				$dataA=explode("-", $data);
				$a=$dataA[0];
				$b=$dataA[1];
				$c=$dataA[2];
				$data2=strval($b.$a);

				$zakogoToExplode=$_POST['zakogo'];
				$zakogoExplode=explode("_", $zakogoToExplode);
				$zakogo=$zakogoExplode[1];
				$zakogoPrzedr=$zakogoExplode[0];

				$ktoToExplode=$_POST['kto'];
				$ktoExplode=explode("_", $ktoToExplode);
				$kto=$ktoExplode[1];
				$ktoPrzedr=$ktoExplode[0];
				
				$co=$_POST['co'];
				$gdzie=$_POST['gdzie'];
				$zuraw=$_POST['zuraw'];
				$ilosch=$_POST['ilosch'];
				$kwota=$_POST['kwota'];
				$uwagi=$_POST['uwagi'];
		
				
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
								
						//dodanie zastępstwa
							
							if($polaczenie->query("INSERT INTO zastepstwa VALUES(NULL, '$id_uzytkownika' ,'$data', '$data2', '$zakogoPrzedr', '$zakogo','$ktoPrzedr', '$kto', '$co','$gdzie','$zuraw', '$ilosch', '$kwota', '$uwagi')"))
							{
								header('Location: main.php');
								$_SESSION['dodanoZastepstwoKomunikat']="Dodano pozycję";
								unset($_POST['dodaj']);
								unset($_POST['kto']);
								unset($_POST['zakogo']);


							}
							else{
								throw new Exception($polaczenie->error);
							} 
		
														
								
							$polaczenie->close();		//NIE ZAPONIJ ZAMKNĄĆ POŁĄCZENIA!
						}
					}
					catch(Exception $e)
					{
						echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności  </span>';
						echo '<br>Informacja developerska: '.$e;
					}
			}else
			{
				header('Location: main.php');
				$_SESSION['uzuppole']='uzupełnij pole "kto" lub "za kogo" oraz datę';
				unset($_POST['dodaj']);
			}
			
			
			
		}
}	
	
