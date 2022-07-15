<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
		$idPr1=$_POST['idPr1'];
	
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
						$id_zastepstwa=$_POST['idZastepstwa'];
						$nr=$_POST['nr'];
						$data=$_POST['data'];
						
						
						$zakogo1=$_POST['zakogo'];
						$zakogoexpl=explode("_", $zakogo1);
						$zakogoPrzedr=$zakogoexpl[0];
						$zakogo=$zakogoexpl[1];
						
						$kto1=$_POST['kto'];
						$ktoexpl=explode("_", $kto1);
						$ktoPrzedr=$ktoexpl[0];
						$kto=$ktoexpl[1];
						

						$co=$_POST['co'];
						$gdzie=$_POST['gdzie'];
						$zuraw=$_POST['zuraw'];
						$ilosch=$_POST['ilosch'];
						$kwota=$_POST['kwota'];
						$uwagi=$_POST['uwagi'];
												
						$sql1="UPDATE zastepstwa SET zakogoPrzedr='$zakogoPrzedr', zakogo='$zakogo', dataMysql='$data', ktoPrzedr='$ktoPrzedr', kto='$kto', co='$co', gdzie='$gdzie', zuraw='$zuraw', ilosch='$ilosch', kwota='$kwota', uwagi='$uwagi' WHERE id='$id_zastepstwa'";
						if($rezult=$polaczenie->query($sql1))						
						{
							$_SESSION['edytowanoZastepstwo']="Zaktualizowano pozycję nr: ".$nr."";
							$_SESSION['$idFirmy1']=$idPr1;
							header('Location: firma1.php');
							unset($_POST['aktualizuj']);
												
							
						}else { echo "Wystąpił problem z aktualizacją pozycji";}

						$polaczenie->close();
					}
														
					
				}else if(isset($_POST['anuluj']))
				{
					$_SESSION['$idFirmy1']=$idPr1;
					header('Location: firma1.php');
					unset($_POST['anuluj']);
				};
	}
	
	?>