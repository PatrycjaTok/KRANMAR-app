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
			if((strlen($_POST['kto_input'])>0) && (strlen($_POST['data1_input'])>0) && (strlen($_POST['data2_input'])>0))					
			{									
				$id_uzytkownika=$_SESSION['id_uzytkownika'];

				$data1=$_POST['data1_input'];
				$data2=$_POST['data2_input'];
				$kto=$_POST['kto_input'];

				$czas1=StrToTime($data1);
				$czas2=StrToTime($data2);
				$czasS=$czas2-$czas1;
				$iloscDni=($czasS/(60*60*24))+1;

				$uwagi=$_POST['uwagi_input'];
				$formatted_date = strtotime( $data1 );
				$year1=date( 'Y', $formatted_date );
		
				
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
							
							if($polaczenie->query("INSERT INTO urlopy VALUES(NULL, '$id_uzytkownika' ,'$data1', '$data2','$kto', '$iloscDni', '$uwagi', '$year1')"))
							{
								header('Location: urlopy.php');
								$_SESSION['dodanoUrlopKomunikat']="Dodano urlop";
								unset($_POST['dodaj']);
								unset($_POST['kto_input']);
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
				header('Location: urlopy.php');
				$_SESSION['uzuppoleUrlop']='uzupełnij pole "kto" i daty';
				unset($_POST['dodaj']);
			}
			
			
			
		}
}	
	
