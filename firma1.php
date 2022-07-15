<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else{


		$id_uzytkownika=$_SESSION['id_uzytkownika'];
		$dataDMY=date("d-m-Y");


		require_once "connect.php";

		$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
		if($polaczenie->connect_errno!=0)
		{
			echo "Error: ".$polaczenie->connect_errno;
		}
		else
		{
	
			if(isset($_SESSION['$idFirmy1'])){
				$idFirmy=$_SESSION['$idFirmy1'];
				unset($_SESSION['$idFirmy1']);
			}else{
				$idFirmy=$_POST['inputIdfirmy1'];
			};


			$sqlimienaziwsko="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE id_uzytkownika='$id_uzytkownika' AND id='$idFirmy'";
			$rezultimienazwisko=$polaczenie->query($sqlimienaziwsko);
			$rowimienazwisko=$rezultimienazwisko->fetch_assoc();
			$imienaziwsko=$rowimienazwisko['nazwa_firmy'];

	
			$polaczenie->close();


			function miesiacePLFunc($a)
			{
				$mies1=explode(".", $a);
				$b=$mies1[0];

				$miesiacPL=array(
				'01' => 'Styczeń',
				'02' => 'Luty',
				'03' => 'Marzec',
				'04' => 'Kwiecień',
				'05' => 'Maj',
				'06' => 'Czerwiec',
				'07' => 'Lipiec',
				'08' => 'Sierpień',
				'09' => 'Wrzesień',
				'10' => 'Październik',
				'11' => 'Listopad',
				'12' => 'Grudzień'
				);

				echo "$miesiacPL[$b] $mies1[1]r.";
			};	

		}



	}
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style_pracownicy.css" type="text/css">
	<link rel="stylesheet" href="css/style1.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - pracownik1</title>
	</head>
<body>
    <div class="container">		
		
		<div class=box1>
			
		   <div class="boxzastepstw">
			   <div class="boxzastepstw2"> 
			   		<?php 
					   echo "<p>".$imienaziwsko." - <i>pozycje</i> </p>";
					   ?>

 						 <div class='boxBtnSwitch'>
							<button class='switchBtn switchBtnActive btn1radious' onclick='show1()'>obecne</button>
							<button class='switchBtn switchBtnHidden btn2radious' onclick='show2()'> historia</button>
						</div>

						<br>
						<div class='search hidden2 hidden'>

							<form action='firma1filtr.php' method='post'>
								WYSZUKIWANIE:
								<br> miesiąc: <input type='number' name='miesiacSearch'>
								<br> rok: 
								<?php
								echo "<input type='hidden' name='idFrSzuk' value='".$idFirmy."'>";
								
								$datadoInputu=date("Y");
								echo "<input type='number' name='rokSearch' value='$datadoInputu'>"; 
								?>
								<input type='submit' name='szukajwhistorii' value='Szukaj' class='radious5px pointer'>
							</form>

						</div> <br>
				   
				</div>
				   
				
				<div class='positionAndComunicat'>

					<?php

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
		
					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
					}
					else
					{
						$dataDoMysqlA=date("m-Y");
						$dataDoMysqlB=explode("-", $dataDoMysqlA);
						$a=$dataDoMysqlB[0];
						$b=$dataDoMysqlB[1];
						$dataDoMysql=$a.$b;
						$c=intval($a)+1;
						$dataDoMysql=$c.$b;
						$pracownikString="pracownik";

					
					if(isset($_POST['btn1'])){
						$sql_z2="SELECT * FROM zastepstwa WHERE ((id_uzytkownika='$id_uzytkownika' AND zakogo='$idFirmy' AND zakogoPrzedr='firma') OR (id_uzytkownika='$id_uzytkownika' AND kto='$idFirmy' AND ktoPrzedr='firma')) ORDER BY zastepstwa.dataMysql";
						$_SESSION['$idFirmy1']=$idFirmy;
						unset($_POST['btn1']);
					}else{
						$sql_z2="SELECT * FROM zastepstwa WHERE ((id_uzytkownika='$id_uzytkownika' AND zakogo='$idFirmy' AND zakogoPrzedr='firma') OR (id_uzytkownika='$id_uzytkownika' AND kto='$idFirmy' AND ktoPrzedr='firma')) ORDER BY zastepstwa.dataMysql";
					};

					//dla historii zastępstw:
					if(isset($_POST['btn1'])){
						$sql_z3="SELECT * FROM zastepstwa_historia WHERE ((id_uzytkownika='$id_uzytkownika' AND zakogo='$idFirmy' AND zakogoPrzedr='firma') OR (id_uzytkownika='$id_uzytkownika' AND kto='$idFirmy' AND ktoPrzedr='firma')) ORDER BY zastepstwa_historia.dataMysql";
						$_SESSION['$idFirmy1']=$idFirmy;
						unset($_POST['btn1']);
					}else{
						$sql_z3="SELECT * FROM zastepstwa_historia WHERE ((id_uzytkownika='$id_uzytkownika' AND zakogo='$idFirmy' AND zakogoPrzedr='firma') OR (id_uzytkownika='$id_uzytkownika' AND kto='$idFirmy' AND ktoPrzedr='firma')) ORDER BY zastepstwa_historia.dataMysql";
					};
					
					$rezult_z2=$polaczenie->query($sql_z2);
					$ile_zast=$rezult_z2->num_rows;		
					
					//dla historii zastępstw:
					$brezult_z3=$polaczenie->query($sql_z3);
					$ile_zast3=$brezult_z3->num_rows;	

					echo "<span class='hidden1'> Ilość pozycji: ".$ile_zast."</span>
					<span class='hidden2 hidden'>Ilość pozycji: ".$ile_zast3."</span>";

					if(isset( $_SESSION['edytowanoZastepstwo']))
					{
						echo '<div class="positiv">'.$_SESSION['edytowanoZastepstwo'].'</div>';
						unset( $_SESSION['edytowanoZastepstwo']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset( $_SESSION['usunietoZastKomunikat']))
					{
						echo '<div class="positiv">'.$_SESSION['usunietoZastKomunikat'].'</div>';
						unset($_SESSION['usunietoZastKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					}
					if(isset( $_SESSION['ErrorZastepstw']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorZastepstw'].'</div>';
						unset( $_SESSION['ErrorZastepstw']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};

					if(isset( $_SESSION['PrzeniesDoHistroiiKomunikat']))
					{
						echo '<div class="positiv">'.$_SESSION['PrzeniesDoHistroiiKomunikat'].'</div>';
						unset( $_SESSION['PrzeniesDoHistroiiKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					}; 
					if(isset( $_SESSION['uzuppole']))
					{
						echo '<div class="negativ">'.$_SESSION['uzuppole'].'</div>';
						unset( $_SESSION['uzuppole']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					$polaczenie->close();

				}
				?>

			   </div><br>
			   <div class='hidden1 divTable'>
					<table class='table' id='sortable'>
					<tr>
						<th>nr</th>
						<th>
							<?php
							 echo "<form method='post'><input type='hidden' name='inputIdfirmy1' value='".$idFirmy."'><input type='submit' name='btn1' class='button1segr' value='data [dz.mies.]'></form>";
							 ?>
						</th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableZakogo()'>za kogo</button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableKto()'>kto </button></th>
						<th><button class='button1segr' onclick='sortTableCo()'>co </button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableGdzie()'>gdzie</button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableZuraw()'>żuraw</button></th>
						<th>ilość godzin [h]</th>
						<th>kwota [zł]</th>
						<th class='minMaxWidth'>uwagi</th>
						<th></th>
					</tr>


					<?php
					
						$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
						if($polaczenie->connect_errno!=0)
						{
							echo "Error: ".$polaczenie->connect_errno;
						}
						else
						{ 	$nr=0;

							while($row_z2=$rezult_z2->fetch_assoc())
							{

								$id_zastepstwasql2=$row_z2['id'];
								$datasql=$row_z2['dataMysql'];
								$datasql2=strftime('%d.%m', strtotime($datasql));
								$cosql2=$row_z2['co'];
								$gdziesql2=$row_z2['gdzie'];
								$zurawsql2=$row_z2['zuraw'];
								$iloschsql2=$row_z2['ilosch'];
								$kwotasql2=$row_z2['kwota'];
								$uwagisql2=$row_z2['uwagi'];

								$zakogoPrzedr=$row_z2['zakogoPrzedr'];
								$zakogo=$row_z2['zakogo'];
								
								$ktoPrzedr=$row_z2['ktoPrzedr'];
								$kto=$row_z2['kto'];
							
								if(($zakogoPrzedr)=="pracownik")
								{
									$sql_z3a="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$zakogo'";
									$rezult_z3a=$polaczenie->query($sql_z3a);
									$row_z3a=$rezult_z3a->fetch_assoc();

									$zakogosql3imie=$row_z3a['imie'];
									$zakogosql3nazwisko=$row_z3a['nazwisko'];
									@$zakogosql=$zakogosql3nazwisko." ".$zakogosql3imie;

								
								}else if(($zakogoPrzedr)=="firma")
								{
									$sql_z4="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$zakogo'";
									$rezult_z4=$polaczenie->query($sql_z4);
									$row_z4=$rezult_z4->fetch_assoc();

									@$zakogosql=$row_z4['nazwa_firmy'];

								
								}else if(($zakogoPrzedr)=="innypr")
								{
									$sql_z5="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$zakogo'";
									$rezult_z5=$polaczenie->query($sql_z5);
									$row_z5=$rezult_z5->fetch_assoc();

									$zakogosql5imie=$row_z5['imie'];
									$zakogosql5nazwisko=$row_z5['nazwisko'];
									@$zakogosql=$zakogosql5nazwisko." ".$zakogosql5imie;

									
								}



								if(($ktoPrzedr)=="pracownik")
								{
									$sql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$kto'";
									$rezult_z6=$polaczenie->query($sql_z6);
									$row_z6=$rezult_z6->fetch_assoc();

									$ktosql3imie=$row_z6['imie'];
									$ktosql3nazwisko=$row_z6['nazwisko'];
									@$ktosql=$ktosql3nazwisko." ".$ktosql3imie;

								
								}else if(($ktoPrzedr)=="firma")
								{
									$sql_z7="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$kto'";
									$rezult_z7=$polaczenie->query($sql_z7);
									$row_z7=$rezult_z7->fetch_assoc();

									@$ktosql=$row_z7['nazwa_firmy'];

																		
								}else if(($ktoPrzedr)=="innypr")
								{
									$sql_z8="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$kto'";
									$rezult_z8=$polaczenie->query($sql_z8);
									$row_z8=$rezult_z8->fetch_assoc();

									$ktosql8imie=$row_z8['imie'];
									$ktosql8nazwisko=$row_z8['nazwisko'];
									@$ktosql=$ktosql8nazwisko." ".$ktosql8imie;

								
								}

								$sql_z9="SELECT dozastepstw.id, dozastepstw.nazwa FROM dozastepstw WHERE dozastepstw.id='$cosql2'";
								$rezult_z9=$polaczenie->query($sql_z9);
								$row_z9=$rezult_z9->fetch_assoc();

								@$cosql2wynik=$row_z9['nazwa'];
								$nr=$nr+1;
								$nrS=$nr-5;
 
									echo "<tr class='tableTr1'>
									<td>$nr</td> 
									<td>$datasql2</td> 
									<td>".@$zakogosql."</td> 
									<td>".@$ktosql."</td> 
									<td class='co'>$cosql2wynik</td> 
									<td>$gdziesql2</td> 
									<td>$zurawsql2</td> 
									<td>$iloschsql2</td> 
									<td>$kwotasql2</td> 
									<td>$uwagisql2</td> 
									<td> 
									<div class='editionbar'>
										<div id='s$nr' class='wrapper'> 
										<a href='#s$nrS'> opcje </a>
											<ul>
												<li><form action='edytujZastepstwoFirmy1.php' method='post'> <input type='hidden' value='".$id_zastepstwasql2."' name='inputIdZastepstwa'> <input type='hidden' value='".$nr."' name='inputnr'><input type='hidden' value='".$idFirmy."' name='inputIdPr1'> <input type ='submit' name='edytujZastepstwo' value='edytuj' class='btnedit pointer'> </form></li>
												<li><button onclick='okienkoDeleteFirm($id_zastepstwasql2, $idFirmy)' class='btnedit pointer'> usuń </button></li>
											</ul>
										</div>
									</div>
									</td>
									</tr>";

									unset($zakogosql);
									unset($ktosql);
								
							}$polaczenie->close();
						};
					?>

					</table>
					<div class='formargin'> </div>
				</div>
				<!-- dla historii zastępstw: -->
				<div class='hidden2 hidden divTable'>
							<table class='table' id='sortable2'>
					<tr>
						<th>nr</th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableData22()'>data [dz.mies.]</button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableZakogo2()'>za kogo</button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableKto2()'>kto </button></th>
						<th><button class='button1segr' onclick='sortTableCo2()'>co </button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableGdzie2()'>gdzie</button></th>
						<th class='minMaxWidth'><button class='button1segr' onclick='sortTableZuraw2()'>żuraw</button></th>
						<th>ilość godzin [h]</th>
						<th>kwota [zł]</th>
						<th class='minMaxWidth'>uwagi</th>
						
					</tr>


					<?php
					
						$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
						if($polaczenie->connect_errno!=0)
						{
							echo "Error: ".$polaczenie->connect_errno;
						}
						else
						{ 	$bnr=0;

							while($brow_z2b=$brezult_z3->fetch_assoc())
							{

								$bid_zastepstwasql2=$brow_z2b['id'];
								$bdatasql=$brow_z2b['dataMysql'];
								$bdatasql2=strftime('%d.%m', strtotime($bdatasql));
								$bcosql2=$brow_z2b['co'];
								$bgdziesql2=$brow_z2b['gdzie'];
								$bzurawsql2=$brow_z2b['zuraw'];
								$biloschsql2=$brow_z2b['ilosch'];
								$bkwotasql2=$brow_z2b['kwota'];
								$buwagisql2=$brow_z2b['uwagi'];

								$bzakogoPrzedr=$brow_z2b['zakogoPrzedr'];
								$bzakogo=$brow_z2b['zakogo'];
								
								$bktoPrzedr=$brow_z2b['ktoPrzedr'];
								$bkto=$brow_z2b['kto'];
							
								if(($bzakogoPrzedr)=="pracownik")
								{
									$bsql_z3b="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$bzakogo'";
									$brezult_z3b=$polaczenie->query($bsql_z3b);
									$brow_z3b=$brezult_z3b->fetch_assoc();

									$bzakogosql3imie=$brow_z3b['imie'];
									$bzakogosql3nazwisko=$brow_z3b['nazwisko'];
									@$bzakogosql=$bzakogosql3nazwisko." ".$bzakogosql3imie;

								
								}else if(($bzakogoPrzedr)=="firma")
								{
									$bsql_z4="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$bzakogo'";
									$brezult_z4=$polaczenie->query($bsql_z4);
									$brow_z4=$brezult_z4->fetch_assoc();

									@$bzakogosql=$brow_z4['nazwa_firmy'];

								
								}else if(($bzakogoPrzedr)=="innypr")
								{
									$bsql_z5="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$bzakogo'";
									$brezult_z5=$polaczenie->query($bsql_z5);
									$brow_z5=$brezult_z5->fetch_assoc();

									$bzakogosql5imie=$brow_z5['imie'];
									$bzakogosql5nazwisko=$brow_z5['nazwisko'];
									@$bzakogosql=$bzakogosql5nazwisko." ".$bzakogosql5imie;

									
								}



								if(($bktoPrzedr)=="pracownik")
								{
									$bsql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$bkto'";
									$brezult_z6=$polaczenie->query($bsql_z6);
									$brow_z6=$brezult_z6->fetch_assoc();

									$bktosql3imie=$brow_z6['imie'];
									$bktosql3nazwisko=$brow_z6['nazwisko'];
									@$bktosql=$bktosql3nazwisko." ".$bktosql3imie;

								
								}else if(($bktoPrzedr)=="firma")
								{
									$bsql_z7="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$bkto'";
									$brezult_z7=$polaczenie->query($bsql_z7);
									$brow_z7=$brezult_z7->fetch_assoc();

									@$bktosql=$brow_z7['nazwa_firmy'];

																		
								}else if(($bktoPrzedr)=="innypr")
								{
									$bsql_z8="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$bkto'";
									$brezult_z8=$polaczenie->query($bsql_z8);
									$brow_z8=$brezult_z8->fetch_assoc();

									$bktosql8imie=$brow_z8['imie'];
									$bktosql8nazwisko=$brow_z8['nazwisko'];
									@$bktosql=$bktosql8nazwisko." ".$kbtosql8imie;

								
								}

								$bsql_z9="SELECT dozastepstw.id, dozastepstw.nazwa FROM dozastepstw WHERE dozastepstw.id='$bcosql2'";
								$brezult_z9=$polaczenie->query($bsql_z9);
								$brow_z9=$brezult_z9->fetch_assoc();

								@$bcosql2wynik=$brow_z9['nazwa'];
								$bnr=$bnr+1;
 
									echo "<tr class='tableTr1'>
									<td>$bnr</td> 
									<td>$bdatasql</td> 
									<td>".@$bzakogosql."</td> 
									<td>".@$bktosql."</td> 
									<td class='co'>$bcosql2wynik</td> 
									<td>$bgdziesql2</td> 
									<td>$bzurawsql2</td> 
									<td>$biloschsql2</td> 
									<td>$bkwotasql2</td> 
									<td>$buwagisql2</td> 
									</tr>";

									unset($bzakogosql);
									unset($bktosql);
								
							}$polaczenie->close();
						};
					?>

					</table>

				</div>
		   </div> 
		   <div>  
				
			</div>
			<div>
			<a href="firmy.php"><button class='button2 radious5px pointer'> powrót </button></a>
			</div>
	   </div>
   
   
    </div>
    
    <script src="js/script1b.js"></script> 
    <!--w JS: console.log(document);-->
    </body>


</html>