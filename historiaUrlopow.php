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

			//Szukaj sw Historii START
			if(isset($_POST['szukajwhistorii']))
			{
				$yearToHist=$_POST['rokDoHist'];
				
				if($rezultquestion=$polaczenie->query("SELECT id FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika' AND year1='$yearToHist'"))
					{
						$ilerows=$rezultquestion->num_rows;	
						if($ilerows>0)
						{
							
							$sql_z2="SELECT * FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika' AND year1='$yearToHist' ORDER BY urlopy_historia.data1";
	
								$rezult_z2=$polaczenie->query($sql_z2);
								$ile_zast=$rezult_z2->num_rows;				
								$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
								unset($_POST['szukajwhistorii']);
								$komunikatdata = "data";


							
						}else
						{
							
							$_SESSION['ErrorUrlopow']="brak wyników dla podanego zakresu. <br>
							<br> <form method='post'><input type='submit' value='Wszystkie wyniki' name='allanswers' class='btnOther'></form><br><br>";
							$rezult_z2=Null;
							unset($_POST['szukajwhistorii']);
						}

												
					}else
					{
			
						$_SESSION['ErrorUrlopow']="brak wyników";
						unset($_POST['szukajwhistorii']);
					}
			
			
					
			}else if(isset($_POST['allanswers']))
			{
				
					$sql_z2="SELECT * FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika' ORDER BY urlopy_historia.data1";
		
					$rezult_z2=$polaczenie->query($sql_z2);
					$ile_zast=$rezult_z2->num_rows;				
					$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
			}else
			{	
				
					$sql_z2="SELECT * FROM urlopy_historia WHERE id_uzytkownika='$id_uzytkownika'ORDER BY urlopy_historia.data1";	
					
				$rezult_z2=$polaczenie->query($sql_z2);
				$ile_zast=$rezult_z2->num_rows;				
				$komunikatilosc = "Ilość pozycji: ".$ile_zast."";
					

			};

			//Szukaj w historii END
	
			$polaczenie->close();

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
    <title>Aplikacja do zarządzania ludźmi - urlopy - historia</title>
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
						<li><a href="historiaZastepst.php">histora zastępstw</a></li>
						<li><a href="historiaUrlopow.php" id='currentLink'>historia urlopów</a></li>
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
								<li><a href="historiaZastepst.php">histora zastępstw</a></li>
								<li><a href="#" id='currentLink'>historia urlopów</a></li>
							</ul>
						</div>
					</div> </li>
					<li> <a href="ustawienia.php">USTAWIENIA</a> </li>			

				</ul>
				</div>
			</div>
		</div>
		
		
		<div class=box1>

		   <div class="logout2">
	   
					<?php

					echo '<p> <a href="logout.php"> <button class="btnLogOut"> wyloguj </button> </a> </p>';		//logout
				
					?>
	   
	  		</div>
		   
		   <div class="boxzastepstw">
			   <div class="boxzastepstw2"> 
			   		<p> URLOPY - HISTORIA </p>
			   
				</div><br>
				<div class='search'>

				   <form method='post'>
					   WYSZUKIWANIE:
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

					if(isset($komunikatilosc))
					{
						echo "$komunikatilosc";
					};

					if(isset( $_SESSION['ErrorBrakWynikow']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorBrakWynikow'].'</div>';
						unset( $_SESSION['ErrorBrakWynikow']);			
					};
					if(isset($_SESSION['ErrorPoprawneDane']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorPoprawneDane'].'</div>';
						unset( $_SESSION['ErrorPoprawneDane']);			
					};
					if(isset( $_SESSION['deleteHistUrlopow']))
					{
						echo '<div class="negativ">'.$_SESSION['deleteHistUrlopow'].'</div>';
						unset( $_SESSION['deleteHistUrlopow']);			
					};
					if(isset( $_SESSION['ErrorUrlopow']))
					{
						echo '<div class="negativ">'.$_SESSION['ErrorUrlopow'].'</div>';
						unset( $_SESSION['ErrorUrlopow']);		
					};

					
					$polaczenie->close();

				}
				?>

			   </div><br>
			   <div class='searchDate'>
					<?php 
						if(isset($komunikatdata))
							{ 
								echo "Urlopy w roku: $yearToHist";	
								unset($komunikatdata);		
							}; 
					?>
				</div>
				<div class='divTable'>
				<table class='table' id='sortable'>
					<tr>
						<th class='minwidth20'> <button class='button1segr' onclick='sortTableData()'>nr</button>
						</th>
						<th class='minwidth'> <button class='button1segr' onclick='sortTableZakogo()'>Od</button>
						</th>
						<th class='minwidth' sort><button class='button1segr' onclick='sortTableKto()'>Do</button>
						</th>
						<th class='hidden'> dataJS1 </th>
						<th class='hidden'> dataJS2 </th>
						<th class='hidden'> dataJSALL1 </th>
						<th class='hidden'> dataJSALL2 </th>
						<th class='minwidth'><button class='button1segr' onclick='sortTableKto7()'>kto</button></th>
						<th class='minwidth30'> ilość dni [d]</th>
						<th class='minwidth30'> uwagi</th>
					</tr>


					<?php
					
						$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);
	
						if($polaczenie->connect_errno!=0)
						{
							echo "Error: ".$polaczenie->connect_errno;
						}
						else
						{ 	$nr=0;
							if($rezult_z2!=null)
							{
								while($row_z2=$rezult_z2->fetch_assoc())
								{

									$id_urlopu=$row_z2['id'];
									$data1=$row_z2['data1'];
									$data2=$row_z2['data2'];
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
									$czas1=(StrToTime($data1)/(60*60*24));	//w dobach
									$czas2=(StrToTime($data2)/(60*60*24));	//w dobach
			
	
										echo "<tr class='tableTr1'>
										<td>$nr</td> 
										<td>$data1</td> 
										<td>$data2</td> 
										<td class='hidden'>$czas1</td> 
										<td class='hidden'>$czas2</td>
										<td class='hidden'>$data1</td> 
										<td class='hidden'>$data2</td> 
										<td>$ktosql</td>  
										<td>$ilosDni</td> 
										<td>$uwagi</td> 
										</tr>";
										unset($ktosql);
								}
								
							}
							$polaczenie->close();
						};
					?>

				</table>
				</div>
		   </div> 
		   <div class='deletehistbox'>
			   
					 

			   <form action='deleteHistUrlopu.php' method='post'>
				  USUŃ dany rok z historii:<Br>
					rok: 
				   
				   <?php  
				   $datadoInputu=date("Y");
				   echo "<input type='number' name='rokDeleteHist' value='2020'>"; 
				   ?>
				  <input type='submit' name='delete' value='Usuń na zawsze' class='btnOther'>
				</form>
		</div>
	
	   </div>
   
   
    </div>	
	
    
    <script src="js/script3.js"></script> 
 
    </body>


</html>