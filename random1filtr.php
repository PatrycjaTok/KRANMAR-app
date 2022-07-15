<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{


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
	
			if(isset($_SESSION['$idRp1'])){
				$idRandom=$_SESSION['$idRp1'];
				unset($_SESSION['$idRp1']);
			}else{
				$idRandom=$_POST['idRpSzuk'];
			};

			if(isset($_POST['btn1'])){
				$data=$_POST['datahidden'];
				$month=$_POST['monthhidden'];
				$year=$_POST['yearhidden'];
				$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data' AND((zakogo='$idRandom' AND zakogoPrzedr='innypr') OR (kto='$idRandom' AND ktoPrzedr='innypr')) ORDER BY zastepstwa_historia.dataMysql";
				$rezult_z2=$polaczenie->query($sql_z2);
				$ile_zast=$rezult_z2->num_rows;				
				$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
				unset($_POST['btn1']);
				$komunikatdata = "data";
			}
			
			if(isset($_POST['szukajwhistorii']))
				{
						$month=$_POST['miesiacSearch'];
						$year=$_POST['rokSearch'];
						$data="$month$year";

						$sqlsearch = "SELECT id FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data' AND((zakogo='$idRandom' AND zakogoPrzedr='innypr') OR (kto='$idRandom' AND ktoPrzedr='innypr'))";
						
						if($rezultquestion=$polaczenie->query($sqlsearch))
							{
								$ilerows=$rezultquestion->num_rows;	
								if($ilerows>0)
								{
									
									if(isset($_POST['btn1'])){
										$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data' AND((zakogo='$$idRandom' AND zakogoPrzedr='innypr') OR (kto='$idRandom' AND ktoPrzedr='innypr')) ORDER BY zastepstwa_historia.dataMysql";
									}else{
										$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data' AND((zakogo='$$idRandom' AND zakogoPrzedr='innypr') OR (kto='$idRandom' AND ktoPrzedr='innypr')) ORDER BY zastepstwa_historia.dataMysql";
									};
									
										
										

										$rezult_z2=$polaczenie->query($sql_z2);
										$ile_zast=$rezult_z2->num_rows;				
										$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
										unset($_POST['szukajwhistorii']);
										$komunikatdata = "data";


									
								}else
								{
									
									$_SESSION['ErrorZastepstwprfiltr']="brak wyników dla podanego zakresu. <br>
									<br> 
									<form action='random1.php' method='post'>
									<input type='hidden' name='inputIdPr1' value='".$idRandom."'>
									<input type='submit' value='WSZYSTKIE WYNIKI' name='prfiltrpowrot' class='button2 radious5px pointer'>
									</form>
									</div>";

									$rezult_z2=Null;
									unset($_POST['szukajwhistorii']);
								}
		
														
							}else
							{
					
								$_SESSION['ErrorZastepstwprfiltr']="brak wyników";
								unset($_POST['szukajwhistorii']);
							}
					
					
							
					}else if(isset($_POST['allanswers']))
					{
						header('Location: random1.php');
						exit();	
					};
				

					}


			$sqlimienaziwsko="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE id_uzytkownika='$id_uzytkownika' AND id='$idRandom'";
			$rezultimienazwisko=$polaczenie->query($sqlimienaziwsko);
			$rowimienazwisko=$rezultimienazwisko->fetch_assoc();
			$imienaziwsko=$rowimienazwisko['nazwisko']." ".$rowimienazwisko['imie'];

	

				$dataDoMysqlA=date("m-Y");
				$dataDoMysqlB=explode("-", $dataDoMysqlA);
				$a=$dataDoMysqlB[0];
				$b=$dataDoMysqlB[1];
				$dataDoMysql=$a.$b;
				$c=intval($a)+1;
				$dataDoMysql=$c.$b;
				$randomString="innypr";


					if(isset($_POST['btn1'])){
						$sql_z2="SELECT * FROM zastepstwa WHERE ((id_uzytkownika='$id_uzytkownika' AND zakogo='$idRandom' AND zakogoPrzedr='innypr') OR (id_uzytkownika='$id_uzytkownika' AND kto='$idRandom' AND ktoPrzedr='innypr')) ORDER BY zastepstwa.dataMysql";
						$rezult_z2=$polaczenie->query($sql_z2);
						$ile_zast=$rezult_z2->num_rows;
					};

		
					
			
				
				
	
			$polaczenie->close();


			function miesiacePLFunc($a, $b)
			{

				$miesiacPL=array(
				'1' => 'Styczeń',
				'2' => 'Luty',
				'3' => 'Marzec',
				'4' => 'Kwiecień',
				'5' => 'Maj',
				'6' => 'Czerwiec',
				'7' => 'Lipiec',
				'8' => 'Sierpień',
				'9' => 'Wrzesień',
				'10' => 'Październik',
				'11' => 'Listopad',
				'12' => 'Grudzień'
				);

				echo "$miesiacPL[$a] $b";
			};
			

		};
	



	
	
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
				<b> historia - 
				 <?php 
						if(isset($komunikatdata))
							{ 
								miesiacePLFunc($month, $year);	
								unset($komunikatdata);		
							}; 
					?>
					</b>	</div>
				   
				   <br>
				
				<div class='positionAndComunicat'>

				

					<?php
		
					echo "<span>Ilość pozycji: ".@$ile_zast."</span>";

					if(isset( $_SESSION['ErrorZastepstwprfiltr']))
				  {
					  echo '<div class="negativ">'.$_SESSION['ErrorZastepstwprfiltr'].'</div>';
					  unset( $_SESSION['ErrorZastepstwprfiltr']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				  };
		
				?>

			   </div><br>
			   <div class='divTable'>
			   <table class='table' id='sortable'>
					<tr>
						<th>nr</th>
						<th>
							<?php
							 echo "<form method='post'><input type='hidden' name='idRpSzuk' value='".$idRandom."'><input type='hidden' name='datahidden' value='".$data."'><input type='hidden' name='monthhidden' value='".$month."'><input type='hidden' name='yearhidden' value='".$year."'><input type='submit' name='btn1' class='button1segr' value='data [dz.mies.]'></form>"; 
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
					</tr>


					<?php
					
						$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
						if($polaczenie->connect_errno!=0)
						{
							echo "Error: ".$polaczenie->connect_errno;
						}
						else
						{ 	
							if($rezult_z2!=null)
							{
								$nr=0;
								

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
										$sql_z3="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$zakogo'";
										$rezult_z3=$polaczenie->query($sql_z3);
										$row_z3=$rezult_z3->fetch_assoc();

										$zakogosql3imie=$row_z3['imie'];
										$zakogosql3nazwisko=$row_z3['nazwisko'];
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
	
										echo "<tr class='tableTr1'>
										<td>$nr</td> 
										<td>$datasql</td> 
										<td>".@$zakogosql."</td> 
										<td>".@$ktosql."</td> 
										<td class='co'>$cosql2wynik</td> 
										<td>$gdziesql2</td> 
										<td>$zurawsql2</td> 
										<td>$iloschsql2</td> 
										<td>$kwotasql2</td> 
										<td>$uwagisql2</td> 
										</tr>";

										unset($zakogosql);
										unset($ktosql);
									
								}
								$polaczenie->close();
							}
						};
					?>
					</table>
				</div>
				
		   </div> 
		 
			<div>
			<?php
				echo "<form action='random1.php' method='post'>
				<input type='hidden' name='inputIdPr1' value='".$idRandom."'>
				<input type='submit' value='Powrót' name='prfiltrpowrot' class='button2 radious5px pointer'>
				</form>";
			?>
			</div>
	   </div>
   
    </div>
    
    <script src="js/script2b.js"></script> 
    <!--w JS: console.log(document);-->
    </body>


</html>