<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else{


		$id_uzytkownika=$_SESSION['id_uzytkownika'];


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

			

			
		}



	}
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
	 <link rel="stylesheet" href="css/style_pracownicy.css" type="text/css">
    <link rel="stylesheet" href="css/style5.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - zastępstwa - historia</title>
	</head>
<body>
    <div class="container">
	<div class="navbar1">
			<nav> 
			<a href="main.php">ZASTĘPSTWA</a>
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
					<a href='#' id='currentLink'> HISTORIA </a>
					<ul id='ulBigger'>
						<li><a href="historiaZastepst.php" id='currentLink'>histora zastępstw</a></li>
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
					
					<li> <a href="main.php">ZASTĘPSTWA</a> </li>
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
							<a href='#' id='currentLink' onclick='showNavigSmall2()'> HISTORIA </a>
							<ul id='ulSmallHide2' class='secondSt ulBigger'>
								<li><a href="#" id='currentLink'>histora zastępstw</a></li>
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
		
			<div class="logout">
	
				<?php

				echo '<p> <a href="logout.php"> <button class="btnLogOut"> wyloguj </button> </a> </p>';		//logout
				
				?>
	
			</div>
			
		   
		   <div class="boxzastepstw">
			   <div class="boxzastepstw2"> 
			   	<p>ZASTĘPSTWA - HISTORIA </p>

				   <br>

				 <?php

				$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
				if($polaczenie->connect_errno!=0)
				{
					echo "Error: ".$polaczenie->connect_errno;
				}
				else
				{

					if(isset($_POST['szukajwhistorii']))
					{
						$month=$_POST['miesiacDoHist'];
						$year=intval($_POST['rokDoHist']);
						$data="$month$year";
						
						if($rezultquestion=$polaczenie->query("SELECT id FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data'"))
							{
								$ilerows=$rezultquestion->num_rows;	
								if($ilerows>0)
								{
									
									
									$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' AND data2='$data' ORDER BY zastepstwa_historia.dataMysql";
										
										

										$rezult_z2=$polaczenie->query($sql_z2);
										$ile_zast=$rezult_z2->num_rows;				
										$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
										unset($_POST['szukajwhistorii']);
										$komunikatdata = "data";


									
								}else
								{
									
									$_SESSION['ErrorZastepstw']="brak wyników dla podanego zakresu. <br>
									<br> <form method='post'><input type='submit' value='Wszystkie wyniki' name='allanswers' class='btnOther'></form><br><br>";
									$rezult_z2=Null;
									unset($_POST['szukajwhistorii']);
								}
		
														
							}else
							{
					
								$_SESSION['ErrorZastepstw']="brak wyników";
								unset($_POST['szukajwhistorii']);
							}
							unset($_POST['szukajwhistorii']);
					
							
					}else if(isset($_POST['allanswers']))
					{
							$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' ORDER BY zastepstwa_historia.dataMysql";
			
							$rezult_z2=$polaczenie->query($sql_z2);
							$ile_zast=$rezult_z2->num_rows;				
							$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
							unset($_POST['allanswers']);
					}else
					{	
						
							$sql_z2="SELECT * FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika' ORDER BY zastepstwa_historia.dataMysql";
									
							
						$rezult_z2=$polaczenie->query($sql_z2);
						$ile_zast=$rezult_z2->num_rows;				
						$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
						unset($_POST['allanswers']);
							

					};
		
					
						
						$polaczenie->close();

					}

			
				?>

			   </div>

				<div class='search'>

				   <form method='post'>
					   WYSZUKIWANIE:
					   <br> miesiąc: <input type='number' name='miesiacDoHist'>
					   <br> rok: 
					   
					   <?php  
					   $datadoInputu=date("Y");
					   echo "<input type='number' name='rokDoHist' value='$datadoInputu'>"; 
					   ?>

					   <input type='submit' name='szukajwhistorii' value='Szukaj' class='btnOther'>
					</form>
				</div> 
				<div class='positionAndComunicat'>
			  
				<?php
				if(isset( $_SESSION['ErrorZastepstw']))
						{
							echo '<br><br><div class="negativ">'.$_SESSION['ErrorZastepstw'].'</div>';
							unset( $_SESSION['ErrorZastepstw']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
						};

						if(isset( $_SESSION['deleteHistZast']))
						{
							echo '<br><br><div class="positiv">'.$_SESSION['deleteHistZast'].'</div>';
							unset( $_SESSION['deleteHistZast']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
						};
					?>
				</div> 
								
				<br>
				<div class='positionAndComunicat'>
					<?php
					if(isset($komunikatilosc))
						{
							echo '<br><br><div>'.$komunikatilosc.'</div>';
							unset($komunikatilosc);			
						}; 
						?>
				</div>

				<div class='searchDate'>
					<?php 
						if(isset($komunikatdata))
							{ 
								miesiacePLFunc($month, $year);	
								unset($komunikatdata);		
							}; 
					?>
				</div>
				<div class='divTable'>
				<table id='sortable'>
					<thead>
					<tr>
						<th class='minwidth'> <button class='button1segr' onclick='sortTableData()'>data</button>
						</th>
						<th class='minwidth'> <button class='button1segr' onclick='sortTableZakogo()'>za kogo</button>
						</th>
						<th class='minwidth' sort><button class='button1segr' onclick='sortTableKto()'>kto</button>
						</th>
						<th class='minwidth20'><button class='button1segr' onclick='sortTableCo()'>co</button>
						</th>
						<th class='minwidth30'> <button class='button1segr' onclick='sortTableGdzie()'>gdzie</button>
					</th>
						<th class='minwidth20'> <button class='button1segr' onclick='sortTableZuraw()'>żuraw</button>
						</th>
						<th class='minwidth10'>ilość godzin [h]
					</th>
						<th class='minwidth'>kwota [zł]
					</th> 
						<th class='minwidth30'>uwagi
						</th>
						
					</tr>
						</thead>
						<tbody> 

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

								while($row_z2=$rezult_z2->fetch_assoc())
								{

									$id_zastepstwasql2=$row_z2['id'];
									$datasql2=$row_z2['dataMysql'];
									$cosql2=$row_z2['co'];
									$gdziesql2=$row_z2['gdzie'];
									$zurawsql2=$row_z2['zuraw'];
									$iloschsql2=$row_z2['ilosch'];
									$kwotasql2=$row_z2['kwota'];
									$uwagisql2=$row_z2['uwagi'];
									$zakogosqlid=$row_z2['zakogo'];
									$zakogosqlprzedr=$row_z2['zakogoPrzedr'];
									@$zakogosql2=$zakogosqlid;
									$ktosqlid=$row_z2['kto'];
									$ktosqlprzedr=$row_z2['ktoPrzedr'];
									@$ktosql2=$ktosqlid;

									if(($zakogosqlprzedr)=="pracownik")
									{
										$sql_z3="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$zakogosql2'";
										$rezult_z3=$polaczenie->query($sql_z3);
										$row_z3=$rezult_z3->fetch_assoc();

										@$zakogosql3imie=$row_z3['imie'];
										@$zakogosql3nazwisko=$row_z3['nazwisko'];
										@$zakogosql=$zakogosql3nazwisko." ".$zakogosql3imie;

									
									}else if(($zakogosqlprzedr)=="firma")
									{
										$sql_z4="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$zakogosql2'";
										$rezult_z4=$polaczenie->query($sql_z4);
										$row_z4=$rezult_z4->fetch_assoc();

										@$zakogosql=$row_z4['nazwa_firmy'];

									
									}else if(($zakogosqlprzedr)=="innypr")
									{
										$sql_z5="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$zakogosql2'";
										$rezult_z5=$polaczenie->query($sql_z5);
										$row_z5=$rezult_z5->fetch_assoc();

										@$zakogosql5imie=$row_z5['imie'];
										@$zakogosql5nazwisko=$row_z5['nazwisko'];
										@$zakogosql=$zakogosql5nazwisko." ".$zakogosql5imie;

										
									}



									if(($ktosqlprzedr)=="pracownik")
									{
										$sql_z6="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE pracownicy.id='$ktosql2'";
										$rezult_z6=$polaczenie->query($sql_z6);
										$row_z6=$rezult_z6->fetch_assoc();

										@$ktosql3imie=$row_z6['imie'];
										@$ktosql3nazwisko=$row_z6['nazwisko'];
										@$ktosql=$ktosql3nazwisko." ".$ktosql3imie;

									
									}else if(($ktosqlprzedr)=="firma")
									{
										$sql_z7="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE firmy.id='$ktosql2'";
										$rezult_z7=$polaczenie->query($sql_z7);
										$row_z7=$rezult_z7->fetch_assoc();

										@$ktosql=$row_z7['nazwa_firmy'];

																			
									}else if(($ktosqlprzedr)=="innypr")
									{
										$sql_z8="SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE randompeople.id='$ktosql2'";
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
		
	
										echo "<tr> 
										<td>".$datasql2."</td> 
										<td class='zakogoClass'>".@$zakogosql."</td> 
										<td class='ktoClass'>".@$ktosql."</td> 
										<td class='co'>$cosql2wynik</td> 
										<td>$gdziesql2 </td> 
										<td>$zurawsql2 </td> 
										<td>$iloschsql2 </td> 
										<td>$kwotasql2 </td> 
										<td>$uwagisql2</td> 
										</tr>";

										unset($zakogosql);
										unset($ktosql);
									
								}


								$polaczenie->close();
							};
						}
					?>

					
				</tbody>
				</table>
			</div>
		   </div>   
		   	<div class='deletehistbox'>
			   
					

				   <form action='deleteHistZast.php' method='post'>
					  USUŃ dany miesiąc z historii:<Br>
					   <br> miesiąc: <input type='number' name='miesiacDeleteHistorii'>
					   <br> rok: 
					   
					   <?php  
					   $datadoInputu=date("Y");
					   echo "<input type='number' name='rokDeleteHistorii' value='$datadoInputu'>"; 
					   ?>
					  <input type='submit' name='delete' value='Usuń na zawsze' class='btnOther'>
					</form>
			</div>
	   </div>
	    
   
   
    </div>
    
    <script src="js/script3.js"></script>
    </body>


</html>