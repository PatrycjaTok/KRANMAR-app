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

			$sql1="SELECT * FROM dozastepstw";
			if(!$rezult1=$polaczenie->query($sql1))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql2="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult2=$polaczenie->query($sql2))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql3="SELECT * FROM firmy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY firmy.nazwa_firmy";
			if(!$rezult3=$polaczenie->query($sql3))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql4="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult4=$polaczenie->query($sql4))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql5="SELECT * FROM firmy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY firmy.nazwa_firmy";
			if(!$rezult5=$polaczenie->query($sql5))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql6="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE id_uzytkownika='$id_uzytkownika' ORDER BY randompeople.nazwisko";
			if(!$rezult6=$polaczenie->query($sql6))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql7="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE id_uzytkownika='$id_uzytkownika' ORDER BY randompeople.nazwisko";
			if(!$rezult7=$polaczenie->query($sql7))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql8="SELECT * FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult8=$polaczenie->query($sql8))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

	
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
    <title>Aplikacja do zarządzania ludźmi - zastępstwa</title>
	</head>
<body>
    <div class="container">
		<div class="navbar1">
			<nav> 
			<a href="#" id='currentLink'>ZASTĘPSTWA</a>
			<a href="urlopy.php">URLOPY</a>
			<div class='editionbarNAV'>
				<div class='wrapperNAV'> 
					<a href='#'> PRACOWNICY/FIRMY </a>
					<ul>
						<li><a href="pracownicy.php">pracownicy</a></li>
						<li><a href="firmy.php">firmy</a></li>
						<li><a href="randomPeop.php">pozostali</a></li>
					</ul>
				</div>
			</div>
			<div class='editionbarNAV'>
				<div class='wrapperNAV'> 
					<a href='#'> HISTORIA </a>
					<ul id='ulBigger'>
						<li><a href="historiaZastepst.php">histora zastępstw</a></li>
						<li><a href="historiaUrlopow.php">historia urlopów</a></li>
					</ul>
				</div>
			</div>
			<a href="ustawienia.php">USTAWIENIA</a>				
			</nav>
		</div>

		<div class="navbar2">
			<div class='editionbarNAVsmall' class='btnNav'>
				<div class='wrapperNAVsmall'> 
				<a href='#' onclick='showNavig2()'> MENU </a>
				<ul id='ulToHide'>
					
					<li> <a href="#" id='currentLink'>ZASTĘPSTWA</a> </li>
					<li> <a href="urlopy.php">URLOPY</a> </li>
					<li> <div class='editionbarNAV'>
						<div class='wrapperNAV'> 
							<a href='#' onclick='showNavigSmall1()'> PRACOWNICY/FIRMY </a>
							<ul id='ulSmallHide1' class='secondSt'>
								<li><a href="pracownicy.php">pracownicy</a></li>
								<li><a href="firmy.php">firmy</a></li>
								<li><a href="randomPeop.php">pozostali</a></li>
							</ul>
						</div>
					</div> </li>
					<li> <div class='editionbarNAV''>
						<div class='wrapperNAV'> 
							<a href='#'  onclick='showNavigSmall2()'> HISTORIA </a>
							<ul id='ulSmallHide2' class='secondSt ulBigger'>
								<li><a href="historiaZastepst.php">histora zastępstw</a></li>
								<li><a href="historiaUrlopow.php">historia urlopów</a></li>
							</ul>
						</div>
					</div> </li>
					<li> <a href="ustawienia.php">USTAWIENIA</a> </li>			

				</ul>
				</div>
			</div>
		</div>
		
		
		<div class=box1>
			<div class="powitanie">
		   
			   <?php
			
				echo "<p><span id='p1'> Witaj ".$_SESSION['name'].", <span id='spanDate'></span></span><br><span id='p2'> ".$dataDMY."</span></p>";

			   ?>
			   
		   </div>

		   <div class="logout">
	   
					<?php

					echo '<p> <a href="logout.php"> <button class="btnLogOut"> wyloguj </button> </a> </p>';		//logout
				
					?>
	   
	  		</div>
		   
		   <div class="boxzastepstw">
			   <div class="boxzastepstw2"> 
			   		<p>ZASTĘPSTWA </p>

				  <?php $dataPodZast=strftime('%m.%Y', strtotime($dataDMY));
				   echo "Obecny miesiąc: ";
				   echo miesiacePLFunc($dataPodZast);
				   ?> 


				   
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

					if(isset($_POST['btn1data'])){
						$sql_z2="SELECT * FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika'ORDER BY zastepstwa.dataMysql DESC";
						unset($_POST['btn1data']);
					}else{
						$sql_z2="SELECT * FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika'ORDER BY zastepstwa.dataMysql DESC";
					};
					
					$rezult_z2=$polaczenie->query($sql_z2);
					$ile_zast=$rezult_z2->num_rows;				
		
					echo "<div class='comm'>";
					if(isset( $_SESSION['dodanoZastepstwoKomunikat']))
					{
						echo '<div class="positiv">'.$_SESSION['dodanoZastepstwoKomunikat'].'</div>';
						unset( $_SESSION['dodanoZastepstwoKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
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
					echo "</div>";
					
					echo "Ilość pozycji: ".$ile_zast."";

					$polaczenie->close();

				}
				?>

			   </div><br>
			   <div class='divTable'>
				<table class='table' id='sortable'>
					<tr>
						<th>nr</th>
						<th> <form method='post'><input type='submit' name='btn1data' class='button1segr' value='data [dz.mies.]'></form> </th>
						<th><button class='button1segr' onclick='sortTableZakogo()'>za kogo</button></th>
						<th><button class='button1segr' onclick='sortTableKto()'>kto </button></th>
						<th><button class='button1segr' onclick='sortTableCo()'>co </button></th>
						<th><button class='button1segr' onclick='sortTableGdzie()'>gdzie</button></th>
						<th><button class='button1segr' onclick='sortTableZuraw()'>żuraw</button></th>
						<th>ilość godzin [h]</th>
						<th>kwota [zł]</th>
						<th>uwagi</th>
						<th></th>
					</tr>

					<tr> <form action='zastepstwa.php' method='post'>
						<td></td>
						<td><input type='date' name='data'></td>
						<td>

						<select name='zakogo'>  
						<option> </option>
						<optgroup label="PRACOWNICY" >
															
							<?php 
							while($row2=$rezult2->fetch_assoc())
							{
							$zakogoImie=$row2['imie'];
							$zakogoNazwisko=$row2['nazwisko'];
							$zakogoId_pr=$row2['id'];																												

							echo "<option value='pracownik_".$zakogoId_pr."'>".$zakogoNazwisko." ".$zakogoImie." </option>";
							};
							
							echo "<option>  </option> </optgroup>
							<optgroup label='INNI PRACOWNICY'>";

							while($row6=$rezult6->fetch_assoc())
							{
							$zakogoImieRP=$row6['imie'];
							$zakogoNazwiskoRP=$row6['nazwisko'];
							$zakogoId_RP=$row6['id'];																												

							echo "<option value='innypr_".$zakogoId_RP."'>".$zakogoNazwiskoRP." ".$zakogoImieRP." </option>";
							};
							
							echo "<option>  </option> </optgroup>
							<optgroup label='FIRMY'>";

							while($row3=$rezult3->fetch_assoc())
							{
							$zakogonazwaFirmy=$row3['nazwa_firmy'];			
							$zakogoidFirmy=$row3['id'];																									

							echo "<option value='firma_".$zakogoidFirmy."'>".$zakogonazwaFirmy."</option>";
														
							};

							echo "</optgroup>";
								
							?>

						</select>

						</td>
						<td>

					
							<select name='kto'>
							
							<option>  </option>
							<optgroup label="PRACOWNICY">
							<?php 
							while($row4=$rezult4->fetch_assoc())
							{
							$ktoImie=$row4['imie'];
							$ktoNazwisko=$row4['nazwisko'];
							$ktoId_pr=$row4['id'];																											

							echo "<option value='pracownik_".$ktoId_pr."'>".$ktoNazwisko." ".$ktoImie."</option>";
														
							};

							echo "<option>  </option> </optgroup>
							<optgroup label='INNI PRACOWNICY'>";

							while($row7=$rezult7->fetch_assoc())
							{
							$ktoImieRP=$row7['imie'];
							$ktoNazwiskoRP=$row7['nazwisko'];
							$ktoId_RP=$row7['id'];																												

							echo "<option value='innypr_".$ktoId_RP."'>".$ktoNazwiskoRP." ".$ktoImieRP." </option>";
							};

							echo "<option>  </option> </optgroup>
							<optgroup label='FIRMY'>";

							while($row5=$rezult5->fetch_assoc())
							{
							$ktonazwaFirmy=$row5['nazwa_firmy'];			
							$ktoidFirmy=$row5['id'];																									

							echo "<option value='firma_".$ktoidFirmy."'>".$ktonazwaFirmy."</option>";
														
							};
							echo "</optgroup>";
								
							?>

						</select>

						</td>

						<td>
							<select name='co'>
							<option value='  '>  </option>
							
							<?php 
							while($row1=$rezult1->fetch_assoc())
							{
							$dozastepstw_id=$row1['id'];
							$dozastepstw_name=$row1['nazwa'];																											

							echo "<option value='".$dozastepstw_id."'>".$dozastepstw_name."</option>";
														
							};
								
							?>

						</td>
						
						<td><input type='text' name='gdzie'></td>
						<td><input type='text' name='zuraw'></td>
						<td><input type='number' name='ilosch'></td>
						<td><input type='number' name='kwota'></td>
						<td><textarea name="uwagi" rows=1 placeholder='uwagi'></textarea></td>
						<td><input type='submit' name='dodaj' value='dodaj' class='btndodaj'></td>
						</form>
						
					</tr>


					<?php
					
						$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
						if($polaczenie->connect_errno!=0)
						{
							echo "Error: ".$polaczenie->connect_errno;
						}
						else
						{ 	$nr=$ile_zast+1;

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

									@$zakogosql3imie=$row_z3['imie'];
									@$zakogosql3nazwisko=$row_z3['nazwisko'];
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

									@$zakogosql5imie=$row_z5['imie'];
									@$zakogosql5nazwisko=$row_z5['nazwisko'];
									@$zakogosql=$zakogosql5nazwisko." ".$zakogosql5imie;

									
								}



								if(($ktoPrzedr)=="pracownik")
								{
									$sql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$kto'";
									$rezult_z6=$polaczenie->query($sql_z6);
									$row_z6=$rezult_z6->fetch_assoc();

									@$ktosql3imie=$row_z6['imie'];
									@$ktosql3nazwisko=$row_z6['nazwisko'];
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

									@$ktosql8imie=$row_z8['imie'];
									@$ktosql8nazwisko=$row_z8['nazwisko'];
									@$ktosql=$ktosql8nazwisko." ".$ktosql8imie;

								
								}

								$sql_z9="SELECT dozastepstw.id, dozastepstw.nazwa FROM dozastepstw WHERE dozastepstw.id='$cosql2'";
								$rezult_z9=$polaczenie->query($sql_z9);
								$row_z9=$rezult_z9->fetch_assoc();

								@$cosql2wynik=$row_z9['nazwa'];
								$nr=$nr-1;
								$nrS=$nr+5;
 
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
												<li><form action='edytujZastepstwo.php' method='post'> <input type='hidden' value='".$id_zastepstwasql2."' name='inputIdZastepstwa'> <input type='hidden' value='".$nr."' name='inputnr'> <input type ='submit' name='edytujZastepstwo' value='edytuj' class='btnedit pointer'> </form></li>
												<li><button onclick='okienkoDeleteMain($id_zastepstwasql2)' class='btnedit pointer'> usuń </button></li>
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
				<div class='formargin'></div>
				</div>
		   </div> 
		   <div>  
		   		<div class='boxUnderTable'><br>

				</div>
			   
					<Br>
					<div class='boxToHistry'>
						<form action='dodajHistorieZastepstw.php' method='post'>
						Aby <b> przenieść </b> miesiąc <b> do historii</b>, wpisz miesiąc i rok:
						<br> miesiąc: <input type='number' name='miesiacDoHistorii'>
						<br> rok: 
						
						<?php  
						$datadoInputu=date("Y");
						echo "<input type='number' name='rokDoHistorii' value='$datadoInputu'>"; 
						?>

						<input type='submit' name='dodaj' value='dodaj do historii' class='btnOther'>
						</form>
					</div>
			</div>
	   </div>
   
   
    </div>


	<!-- UKRYTY DIV -->
	<div style="display: none">
	<table>
		<tr>
			<th>imię</th>
			<th>nazwisko</th>
			<th>okres umowy</th>
			<th>okres badań</th>
		</tr>
	<?php

		$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

		if($polaczenie->connect_errno!=0)
		{
			echo "Error: ".$polaczenie->connect_errno;
		}
		else
		{
		
			while($row8=$rezult8->fetch_assoc())
			{
				$idPr8=$row8['id'];
				$imie8=$row8['imie'];
				$nazwisko8=$row8['nazwisko'];
				$umowaOkr8=$row8['okrUmowy'];
				$badaniaOkr8=$row8['lekarskie'];

				echo "
				<tr>
					<td class='imie'>$imie8</td>
					<td class='nazwisko'>$nazwisko8</td>
					<td class='umowaOkr'>$umowaOkr8</td>
					<td class='badaniaOkr'>$badaniaOkr8</td>
				</tr>
				";

			}

			$sqlTaskSetting="SELECT uzytkownicy.ustawieniaTask FROM uzytkownicy WHERE id='$id_uzytkownika'";
			if($rezultTaskSettings=@$polaczenie->query($sqlTaskSetting))						
			{
				$rowTaskSettings=$rezultTaskSettings->fetch_assoc();
				$taskValue=$rowTaskSettings['ustawieniaTask'];
				echo "<div id='taskValue'>".$taskValue."</div> ";
			};


			$polaczenie->close();
		}

		?>
		</table>
	</div>
    
    <script src="js/script1.js"></script> 
	<script src="js/scriptDaty.js"></script>
 
    </body>


</html>