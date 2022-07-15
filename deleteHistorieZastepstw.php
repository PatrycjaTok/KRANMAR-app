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
							$data2=$_POST['data2'];
							$month=$_POST['month'];
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
								if($rezultquestion=$polaczenie->query("SELECT id FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data2'"))
								{
									$ilerows=$rezultquestion->num_rows;	
									if($ilerows>0)
									{
										
										$sql1="DELETE FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data2'";
										if($rezult=$polaczenie->query($sql1))						
										{
											header('Location: historiaZastepst.php');
											$_SESSION['deleteHistZast']="usunięto z historii: ".$month.".".$year."r.";
											unset($_POST['del']);		
										};	
		
		
										
									}else
									{
										header('Location: historiaZastepst.php');
										$_SESSION['ErrorZastepstw']="brak wyników";
										unset($_POST['del']);
									};
			
															
								};
		
								
									
								
		
								$polaczenie->close();
							};
																				
							
												
						};
						
						if(isset($_POST['anuluj']))
						{
							header('Location: historiaZastepst.php');
							unset($anuluj);
						};
					};
		
			
		






	};
	
	?>