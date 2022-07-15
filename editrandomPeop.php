<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
	
		//Poniżej - przetważanie naszego formularza:
		if(isset($_POST['aktualizuj']))
				{
										
					require_once "connect.php";

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
					}
					else
					{
						$id_people=$_POST['idPeo'];
						$imieRP=$_POST['imieRP'];
						$nazwiskoRP=$_POST['nazwiskoRP'];
												
						$sql1="UPDATE randompeople SET imie='$imieRP', nazwisko='$nazwiskoRP' WHERE id='$id_people'";
						if($rezult=$polaczenie->query($sql1))						
						{
							$_SESSION['edytowanoPracownika']="zaktualizowano: ".$imieRP." ".$nazwiskoRP;
							header('Location: randomPeop.php');
							unset($_POST['aktualizuj']);
												
							
						}else { echo "Wystąpił problem  zaktualizacją pracownika";}

						$polaczenie->close();
					}
														
					
				}else if(isset($_POST['anuluj']))
				{
					header('Location: randomPeop.php');
					unset($_POST['anuluj']);
				};
	}
	
	?>