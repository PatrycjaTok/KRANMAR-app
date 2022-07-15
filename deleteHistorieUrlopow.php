<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
	
		//Poniżej - przetważanie naszego formularza:
		
					$id_uzytkownika=$_SESSION['id_uzytkownika'];
										
					//połączenie z bazą mySQL
					require_once "connect.php";

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
					}
					else
					{
						if(isset($_POST['del']))
						{
							$year=$_POST['year'];
																			
							//połączenie z bazą mySQL
							require_once "connect.php";
		
							$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
		
							if($polaczenie->connect_errno!=0)
							{
								echo "Error: ".$polaczenie->connect_errno;
							}
							else
							{	
								if($rezultquestion=$polaczenie->query("SELECT id FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika' AND year1='$year'"))
								{
									$ilerows=$rezultquestion->num_rows;	
									if($ilerows>0)
									{
										
										$sql1="DELETE FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika' AND year1='$year'";
										if($rezult=$polaczenie->query($sql1))						
										{
											header('Location: historiaUrlopow.php');
											$_SESSION['deleteHistUrlopow']="usunięto z historii: ".$year."r.";
											unset($_POST['del']);		
										};	
		
		
										
									}else
									{
										header('Location: historiaUrlopow.php');
										$_SESSION['ErrorUrlopow']="brak wyników";
										unset($_POST['del']);
									};
			
															
								};
		
								
									
								
		
								$polaczenie->close();
							};
																				
							
												
						};
						
						if(isset($_POST['anuluj']))
						{
							header('Location: historiaUrlopow.php');
							unset($anuluj);
						};
					};
		
			
		






	};
	
	?>