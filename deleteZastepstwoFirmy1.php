<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
	
		//Poniżej - przetważanie naszego formularza:

					$id_zastepstwa=$_GET['zmiennaId'];
					$idPr1=$_GET['zmiennaId2'];
										
					//połączenie z bazą mySQL
					require_once "connect.php";

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
					}
					else
					{
						$id_uzytkownika=$_SESSION['id_uzytkownika'];
						$sql1="SELECT zastepstwa.zakogoPrzedr, zastepstwa.zakogo, zastepstwa.ktoPrzedr, zastepstwa.kto, zastepstwa.co FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika' AND id='$id_zastepstwa'";
						if($rezult=$polaczenie->query($sql1))						
						{
							$row=($rezult->fetch_assoc());

							$co1=$row['co'];
							if(is_numeric($co1))
							{
								$sql2="SELECT * FROM dozastepstw where id=$co1";
								if($rezult2=$polaczenie->query($sql2))
								{
									$row2=$rezult2->fetch_assoc();
									$coAnswer1=$row2['nazwa'];
									if($coAnswer1=="Z_nasze")
									{
										$coAnswer="zastępstwo (nasze)";
									}
									else if($coAnswer1=="Z_inne")
									{
										$coAnswer="zastępstwo (inne)";
									}
									else
									{
										$coAnswer=$coAnswer1;
									}
								};
							}else 
							{
								$coAnswer="pozycję";
							};

							$zakogoprzedrostek=$row['zakogoPrzedr'];
							if(is_string($zakogoprzedrostek))
							{
							
								$zakogoid=$row['zakogo'];
								if(($zakogoprzedrostek)=="pracownik")
									{
										$sql_z3="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$zakogoid'";
										if($rezult_z3=$polaczenie->query($sql_z3))
										{
											$row_z3=$rezult_z3->fetch_assoc();

											$zakogosql3imie=$row_z3['imie'];
											$zakogosql3nazwisko=$row_z3['nazwisko'];
											$zakogoAnswer=$zakogosql3nazwisko." ".$zakogosql3imie;
										};

									
									}else if(($zakogoprzedrostek)=="firma")
									{
										$sql_z4="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$zakogoid'";
										if($rezult_z4=$polaczenie->query($sql_z4))
										{
											$row_z4=$rezult_z4->fetch_assoc();

											$zakogoAnswer=$row_z4['nazwa_firmy'];
										};

									
									}else if(($zakogoprzedrostek)=="innypr")
									{
										$sql_z5="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$zakogoid'";
										if($rezult_z5=$polaczenie->query($sql_z5))
										{
											$row_z5=$rezult_z5->fetch_assoc();

											$zakogosql5imie=$row_z5['imie'];
											$zakogosql5nazwisko=$row_z5['nazwisko'];
											$zakogoAnswer=$zakogosql5nazwisko." ".$zakogosql5imie;
										};
										
									}
							}else
							{
								$zakogoAnswer=Null;
							};

							$ktoprzedrostek=$row['ktoPrzedr'];
							if(is_string($ktoprzedrostek))
							{
								
								
								$ktoid=$row['kto'];
								if(($ktoprzedrostek)=="pracownik")
									{
										$sql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$ktoid'";
										if($rezult_z6=$polaczenie->query($sql_z6))
										{
											$row_z6=$rezult_z6->fetch_assoc();

											$ktosql6imie=$row_z6['imie'];
											$ktosql6nazwisko=$row_z6['nazwisko'];
											$ktoAnswer=$ktosql6nazwisko." ".$ktosql6imie;
										};

									
									}else if(($ktoprzedrostek)=="firma")
									{
										$sql_z7="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$ktoid'";
										if($rezult_z7=$polaczenie->query($sql_z7))
										{
											$row_z7=$rezult_z7->fetch_assoc();

											$ktoAnswer=$row_z7['nazwa_firmy'];
										};

									
									}else if(($ktoprzedrostek)=="innypr")
									{
										$sql_z8="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$ktoid'";
										if($rezult_z8=$polaczenie->query($sql_z8))
										{
											$row_z8=$rezult_z8->fetch_assoc();

											$ktosql8imie=$row_z8['imie'];
											$ktosql8nazwisko=$row_z8['nazwisko'];
											$ktoAnswer=$ktosql8nazwisko." ".$ktosql8imie;
										};
										
									}
							}else
							{
								$ktoAnswer=Null;
							};			
							
						}else { echo "BRAK DANYCH";}

						//usuwanie zastępstwa
						if(isset($_POST['del'])){
							$idZastepstwa=$_POST['idZastepstwa'];
							$id_pr1=$_POST['idPr1'];
							$sqlDel="DELETE FROM zastepstwa WHERE id='$id_zastepstwa'";
							if($rezultDel=$polaczenie->query($sqlDel))						
							{
								$_SESSION['usunietoZastKomunikat']="usunięto pozycję/zastępstwo";
								$_SESSION['$idFirmy1']=$idPr1;
								echo "<script>
									window.close();
									if (window.opener && !window.opener.closed) {
										window.opener.location.href = 'firma1.php';
									};
									</script> ";
									exit();
								header('Location: firma1.php');
								
								
							}								
						
						unset($_POST['del']);
	
					}	

						$polaczenie->close();
					}
																		

	}
	
	?>

	
<!DOCTYPE HTML>
<html lang="pl-PL">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-=1">
		<link rel="stylesheet" href="css/style_pracownicydodaj.css" type="text/css">
		<link rel="stylesheet" href="css/style_littleBox_pr.css" type="text/css">
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		<title>Aplikacja do zarządzania ludźmi - dodaj pracownika</title>

		<style>
			@media screen and (max-width:640px){   
				body{
					font-size: 18px;
				}  					
			}
							
			@media screen and (min-width:640px) and (max-width:1024px){
				body{
					font-size: 20px;
				}				
			}
							
			@media screen and (min-width:1024px){
				body{
					font-size: 20px;
				}					
			}
							
			body{
				width: auto;
				background-color: rgb(146, 180, 129);
				font-family: georgia,tahoma, arial, sans-serif;
				margin:0;
			}
			
			.button1{
				background-color:  rgb(24, 121, 100);
				font-size: large;
				margin-top: 0.7em;
				cursor: pointer;
				box-shadow: 0 0.3em 0.3em rgba(0, 0, 0, 0.548);
				transition-property: box-shadow, background-color;
				transition-duration: 0.3s;
				border-radius: 5px;
			}
									
			.button1:hover{
				background-color:  rgb(22, 102, 85);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.685)
			}
									
			.button1:active{
				background-color:  rgb(21, 87, 72);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.801)
			}

			.button2{
				background-color: rgb(187, 37, 37);
				font-size: large;
				margin-top: 0.7em;
				cursor: pointer;
				box-shadow: 0 0.3em 0.3em rgba(0, 0, 0, 0.548);
				transition-property: box-shadow, background-color;
				transition-duration: 0.3s;
				border-radius: 5px;
			}
									
			.button2:hover{
				background-color: rgb(165, 32, 32);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.685)
			}
									
			.button2:active{
				background-color: rgb(131, 23, 23);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.801)
			}

			.okienko{
				padding:10px;
				text-align: center;
				margin-top: 22vh;
			}

			.marginleftbtn{
				margin-left: 20vw;
			};
		</style>
	</head>

	<body>

		<div class='okienko'> <form method='post'> Czy na pewno chcesz usunąć: <b>

		<?php

			if(@$zakogoAnswer==Null && @$ktoAnswer==Null)
			{
				echo " ".$coAnswer;
			}else if(@$zakogoAnswer!==Null && @$ktoAnswer==Null){	
				echo " ".$coAnswer."</b>, dot.: <b>".$zakogoAnswer;
			}else if(@$zakogoAnswer==Null && @$ktoAnswer!==Null){
				echo " ".$coAnswer."</b>, dot.: <b>".$ktoAnswer;				
			}else if(@$zakogoAnswer!==Null && @$ktoAnswer!==Null){
				echo " ".$coAnswer."</b>, dot.: <b>".$zakogoAnswer."</b> oraz <b>".$ktoAnswer;		
			};
			echo "</b>?
			<br> <input type='hidden' name='idZastepstwa' value='".$id_zastepstwa."'><input type='hidden' name='idPr1' value='".$idPr1."'>";
					
		?>
		<input type='submit' name='del' value='usuń' class='button2'> <input type='submit' value='anuluj' class='button1' onclick='window.close()'></form></div>
	</body>
</html>