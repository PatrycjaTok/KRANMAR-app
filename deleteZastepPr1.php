<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
		
		if(isset($_POST['idPr1'])){
			$idPr1=$_POST['idPr1'];
		}else if(isset($_POST['idRP1'])){
			$idRP1=$_POST['idRP1'];
		};

		//Poniżej - przetważanie naszego formularza:
		if(isset($_POST['del'])){
					$idZastepstwa=$_POST['idZastepstwa'];
										
					//połączenie z bazą mySQL
					require_once "connect.php";

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
					}
					else
					{
						$del=$_POST['del'];
												
							$sql1="DELETE FROM zastepstwa WHERE id='$idZastepstwa'";
							if($rezult=$polaczenie->query($sql1))						
							{
								if(isset($idPr1)){
									header('Location: pr1.php');
									$_SESSION['usunietoZastKomunikat']="usunięto pozycję/zastępstwo";
									$_SESSION['$idPr1']=$idPr1;
									unset($idPr1);
									unset($del);
								}else if(isset($idRP1)){
									header('Location: random1.php');
									$_SESSION['usunietoZastKomunikat']="usunięto pozycję/zastępstwo";
									$_SESSION['$idRP1']=$idRP1;
									unset($idRP1);
									unset($del);
								};

							}								
						

						$polaczenie->close();
					}
																		
										
				}else if(isset($_POST['anuluj'])){
					if(isset($idPr1)){
						$_SESSION['$idPr1']=$idPr1;
						header('Location: pr1.php');
						unset($anuluj);
						unset($idPr1);
						
					}else if(isset($idRP1)){
						$_SESSION['$idRP1']=$idRP1;
						header('Location: random1.php');
						unset($anuluj);
						unset($idRP1);
					};
				}
	};
	
	?>