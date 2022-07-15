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
						$id_urlopu=$_POST['idUrlopu'];
						$nr=$_POST['nr'];
						$data1=$_POST['data1'];
						$data2=$_POST['data2'];
						$kto=$_POST['kto'];
						
						$czas1=StrToTime($data1);
						$czas2=StrToTime($data2);
						$czasS=$czas2-$czas1;
						$iloscDni=($czasS/(60*60*24))+1;
						$uwagi=$_POST['uwagi'];
												
						$sql1="UPDATE urlopy SET data1='$data1',data2='$data2', id_pracownika='$kto', iloscDni='$iloscDni', uwagi='$uwagi' WHERE id='$id_urlopu'";
						if($rezult=$polaczenie->query($sql1))						
						{
							$_SESSION['edytowanoUrlop']="Zaktualizowano pozycję nr: ".$nr."";
							header('Location: urlopy.php');
							unset($_POST['aktualizuj']);
							exit();
							
						}else { echo "Wystąpił problem z aktualizacją pozycji";}

						$polaczenie->close();
					}
														
	
	}else if(isset($_POST['anuluj'])){
		header('Location: urlopy.php');
		unset($_POST['anuluj']);
		exit();
	}
}
	
	?>