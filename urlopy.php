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

			$sql2="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult2=$polaczenie->query($sql2))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};

			$sql4="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult4=$polaczenie->query($sql4))						
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
	<link rel="stylesheet" href="css/style_urlopy.css" type="text/css">
	<link rel="stylesheet" href="css/styleOsCzasu.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - urlopy</title>
	</head>
<body>
    <div class="container">
	<div class="navbar1">
			<nav> 
			<a href="main.php">ZASTĘPSTWA</a>
			<a href="#" id='currentLink'>URLOPY</a>
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
					
					<li> <a href="main.php" >ZASTĘPSTWA</a> </li>
					<li> <a href="urlopy.php" id='currentLink'>URLOPY</a> </li>
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
			
				echo "<span id='p2' class='currentDate'> ".$dataDMY."</span></p>";

			   ?>
			   
		   </div>

		   <div class="logout">
	   
					<?php

					echo '<p> <a href="logout.php"> <button class="btnLogOut"> wyloguj </button> </a> </p>';		//logout
				
					?>
	   
	  		</div>
		   
		   <div class="boxzastepstw">
			   <div class="boxzastepstw2"> 
			   		<p> URLOPY </p>

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
						$sql_z2="SELECT * FROM urlopy WHERE id_uzytkownika='$id_uzytkownika'ORDER BY urlopy.data1";
						unset($_POST['btn1data']);
					}else if(isset($_POST['btn2data'])){
							$sql_z2="SELECT * FROM urlopy WHERE id_uzytkownika='$id_uzytkownika'ORDER BY urlopy.data2";
							unset($_POST['btn2data']);
					}else{
						$sql_z2="SELECT * FROM urlopy WHERE id_uzytkownika='$id_uzytkownika'ORDER BY urlopy.data1";
					};
					
					$rezult_z2=$polaczenie->query($sql_z2);
					$ile_zast=$rezult_z2->num_rows;				
					
					echo "<div class='comm'>";
					if(isset( $_SESSION['dodanoUrlopKomunikat']))
					{
						echo '<div class="positiv">'.$_SESSION['dodanoUrlopKomunikat'].'</div>';
						unset( $_SESSION['dodanoUrlopKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset( $_SESSION['edytowanoUrlop']))
					{
						echo '<div class="positiv">'.$_SESSION['edytowanoUrlop'].'</div>';
						unset( $_SESSION['edytowanoUrlop']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset( $_SESSION['usunietoUrlopKomunikat']))
					{
						echo '<div class="positiv">'.$_SESSION['usunietoUrlopKomunikat'].'</div>';
						unset($_SESSION['usunietoUrlopKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					}
					
					if(isset( $_SESSION['ErrorUrlopu']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorUrlopu'].'</div>';
						unset( $_SESSION['ErrorUrlopu']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};

					if(isset( $_SESSION['uzuppoleUrlop']))
					{
						echo '<div class="negativ">'.$_SESSION['uzuppoleUrlop'].'</div>';
						unset( $_SESSION['uzuppoleUrlop']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset( $_SESSION['PrzeniesDoHistroiiKom']))
					{
						echo '<div class="positiv">'.$_SESSION['PrzeniesDoHistroiiKom'].'</div>';
						unset( $_SESSION['PrzeniesDoHistroiiKom']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset( $_SESSION['ErrorBrakWynikow']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorBrakWynikow'].'</div>';
						unset( $_SESSION['ErrorBrakWynikow']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
					};
					if(isset($_SESSION['ErrorPoprawneDane']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorPoprawneDane'].'</div>';
						unset( $_SESSION['ErrorPoprawneDane']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
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
						<th> <form method='post'><input type='submit' name='btn1data' class='button1segr' value='Od [dz.mies.]'></form> </th>
						<th> <form method='post'><input type='submit' name='btn2data' class='button1segr' value='Do [dz.mies.]'></form> </th>
						<th class='hidden'> dataJS1 </th>
						<th class='hidden'> dataJS2 </th>
						<th class='hidden'> dataJSALL1 </th>
						<th class='hidden'> dataJSALL2 </th>
						<th><button class='button1segr' onclick='sortTableKto7()'>kto </button></th>
						<th>ilość dni [d]</th>
						<th>uwagi</th>
						<th></th>
					</tr>

					<tr> <form action='urlopyDodaj.php' method='post'>
						<td></td>
						<td><input type='date' name='data1_input' id='data1_input'></td>
						<td><input type='date' name='data2_input'  onclick='getDate1()'></td>
						<td>
						<select name='kto_input'>
							
							<option>  </option>
							<optgroup label="PRACOWNICY">   
							<?php 
							while($row4=$rezult4->fetch_assoc())
							{
							$ktoImie=$row4['imie'];
							$ktoNazwisko=$row4['nazwisko'];
							$ktoId_pr=$row4['id'];																											

							echo "<option value='".$ktoId_pr."'>".$ktoNazwisko." ".$ktoImie."</option>";
														
							};

							echo "</optgroup>";
							?>
						</select>

						</td>
						<td></td>
						<td><textarea name="uwagi_input" rows=1 placeholder='uwagi'></textarea></td>
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
						{ 	$nr=0;

							while($row_z2=$rezult_z2->fetch_assoc())
							{

								$id_urlopu=$row_z2['id'];
								$data1=$row_z2['data1'];
								$data2=$row_z2['data2'];
								$datasql1=strftime('%d.%m', strtotime($data1));
								$datasql2=strftime('%d.%m', strtotime($data2));
								$kto=$row_z2['id_pracownika'];
								$ilosDni=$row_z2['iloscDni'];
								$uwagi=$row_z2['uwagi'];
				
								
									$sql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$kto'";
									$rezult_z6=$polaczenie->query($sql_z6);
									$row_z6=$rezult_z6->fetch_assoc();

									@$ktosql3imie=$row_z6['imie'];
									@$ktosql3nazwisko=$row_z6['nazwisko'];
									@$ktosql=$ktosql3nazwisko." ".$ktosql3imie;

								$nr=$nr+1;
								$nrS=$nr-5;
								$czas1=(StrToTime($data1)/(60*60*24));	//w dobach
								$czas2=(StrToTime($data2)/(60*60*24));	//w dobach
		
 
									echo "<tr class='tableTr1'>
									<td>$nr</td> 
									<td>$datasql1</td> 
									<td>$datasql2</td> 
									<td class='hidden'>$czas1</td> 
									<td class='hidden'>$czas2</td>
									<td class='hidden'>$data1</td> 
									<td class='hidden'>$data2</td> 
									<td>$ktosql</td>  
									<td>$ilosDni</td> 
									<td>$uwagi</td> 
									<td> 
									<div class='editionbar'>
										<div id='s$nr' class='wrapper'> 
										<a href='#s$nrS'> opcje </a>
											<ul>
												<li><form action='edytujUrlop.php' method='post'> <input type='hidden' value='".$id_urlopu."' name='inputIdUrlopu'> <input type='hidden' value='".$nr."' name='inputnr'> <input type ='submit' name='edytujUrlop' value='edytuj' class='btnedit pointer'> </form></li>
												<li><button onclick='okienkoDeleteUrlop($id_urlopu)' class='btnedit pointer'> usuń </button></li>
											</ul>
										</div>
									</div>
									</td>
									</tr>";
									unset($ktosql);
								
							}$polaczenie->close();
						};
					?>

				</table>
				<div class='formargin'></div>
			</div>
		   </div> 
				</div>
   
</div>
			<!-- Time Line -->
		   	
			<div id="Timeline">		
					<div id='divAllMies'>
						<div id='divStyczen' class='divMiesiac'> <p> styczeń </p> <hr class='hrPoz310'> </div>
						<div id='divLuty' class='divMiesiac'> <p>luty </p>  <hr class='hrPoz280'> </div>
						<div id='divMarzec' class='divMiesiac'> <p>marzec </p>   <hr class='hrPoz310'></div>
						<div id='divKwiecien' class='divMiesiac'> <p>kwiecień</p>  <hr class='hrPoz300'> </div>
						<div id='divMaj' class='divMiesiac'><p> maj </p>  <hr class='hrPoz310'> </div>
						<div id='divCzerwiec' class='divMiesiac'> <p>czerwiec</p>  <hr class='hrPoz300'></div>
						<div id='divLipiec' class='divMiesiac'> <p>lipiec</p>  <hr class='hrPoz310'></div>
						<div id='divSierpien' class='divMiesiac'> <p>sierpień </p>  <hr class='hrPoz310'> </div>
						<div id='divWrzesien' class='divMiesiac'><p> wrzesień</p>  <hr class='hrPoz300'> </div>
						<div id='divPazdziernik' class='divMiesiac'> <p>pazdziernik</p>  <hr class='hrPoz310'> </div>
						<div id='divListopad' class='divMiesiac'> <p>listopad</p>  <hr class='hrPoz300'></div>
						<div id='divGrudzien' class='divMiesiac'> <p>grudzień</p>  <hr class='hrPoz310'></div>
					</div>

	
		   		<div class='boxUnderTable'><br>

				</div>
				<div class='boxToHistry'>
						<form action='dodajHistorieUrlopow.php' method='post'>
						Aby <b> przenieść </b> rok <b> do historii</b>, wpisz:
						<br> rok: 
						
						<?php  
						$datadoInputu=date("Y");
						echo "<input type='number' name='rokDoHistorii' value='2020' class='font15'>"; 
						?>

						<input type='submit' name='dodaj' value='dodaj do historii' class='btnOther'>
						</form>
					</div>
			   
			</div>
			
	
    
    <script src="js/script1.js"></script> 
	<script src="js/script_TimeLine.js"></script>
	<script>
	function okienkoDeleteUrlop(idPodm){
		let height=200;
		let width=400;
		let width1=(screen.width-width)/2;
		let height1=(screen.height-height)/2;
		window.open("deleteUrlop.php?zmiennaId="+idPodm, "Usuń", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
	};
	
	</script>
 
    </body>


</html>