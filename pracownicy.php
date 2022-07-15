<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}
	
	require_once "connect.php";

    $polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$id_uzytkownika=$_SESSION['id_uzytkownika'];
		
		if(isset($_POST['btn6'])){
			$sql1="SELECT * FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.stawka";
			unset($_POST['btn6']);
		}else if(isset($_POST['btn1'])){
			$sql1="SELECT * FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.imie";
			unset($_POST['btn1']);
		}else if(isset($_POST['btn2'])){
				$sql1="SELECT * FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
				unset($_POST['btn2']);
		}else{
			$sql1="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko, pracownicy.umowa, pracownicy.okrUmowy, pracownicy.lekarskie, pracownicy.budowa, pracownicy.stawka, pracownicy.opisPr FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
		};
		
		if($rezult=@$polaczenie->query($sql1))						
		{
			$ilu_userow=$rezult->num_rows;	
															
			
		}else { echo "BRAK DANYCH";}


		$polaczenie->close();

		
	}
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
    <link rel="stylesheet" href="css/style_pracownicy.css" type="text/css">
	<link rel="stylesheet" href="css/style2_pr.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - pracownicy</title>
	</head>
<body>
    <div class="container">
	<div class="navbar1">
			<nav> 
			<a href="main.php">ZASTĘPSTWA</a>
			<a href="urlopy.php">URLOPY</a>
			<div class='editionbarNAV'>
				<div class='wrapperNAV'> 
					<a href='#'  id='currentLink'> PRACOWNICY/FIRMY </a>
					<ul>
						<li><a href="#" id='currentLink'>pracownicy</a></li>
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
					
					<li> <a href="main.php">ZASTĘPSTWA</a> </li>
					<li> <a href="urlopy.php">URLOPY</a> </li>
					<li> <div class='editionbarNAV'>
						<div class='wrapperNAV'> 
							<a href='#' id='currentLink' onclick='showNavigSmall1()'> PRACOWNICY/FIRMY </a>
							<ul id='ulSmallHide1' class='secondSt'>
								<li><a href="pracownicy.php" id='currentLink'>pracownicy</a></li>
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
			<div class="logout">
		
				<?php

				echo '<p> <a href="logout.php"> <button class="btnLogOut"> wyloguj </button> </a> </p>';		//logout
			
				?>

			</div>

			<div class="boxTitle"> 
			   		<p>PRACOWNICY <br>
					<input type="text" id="szukaj_pr_input" placeholder='szukaj pracownika' class='input_szukaj' onKeyUp='updateSqlAsk()'>	</p>	   
			</div>
			
		   <div class="boxpracownicy">
		   		<div class='positionAndComunicat'>
				   <button class='button1 radious5px pointer' onclick="okienko1()"> dodaj pracownika </button>
				   
				<div class='comm'>
				   <?php
						if(isset($_SESSION['dodanoPrKomunikat']))
						{
							echo '<div class="positiv">'.$_SESSION['dodanoPrKomunikat'].'</div>';
							unset($_SESSION['dodanoPrKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
						}
						
						if(isset($_SESSION['usunietoPrKomunikat']))
						{
							echo '<div class="positiv">'.$_SESSION['usunietoPrKomunikat'].'</div>';
							unset($_SESSION['usunietoPrKomunikat']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
						}
						
						if(isset($_SESSION['edytowanoPracownika']))
						{
							echo '<div class="positiv">'.$_SESSION['edytowanoPracownika'].'</div>';
							unset($_SESSION['edytowanoPracownika']);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
						}
						
					
					?>
				</div>

				   <?php
					echo "Ilość pracowników: $ilu_userow <br>";
						
					?>

				</div>
				
				<br> 
				<div class='divTable'>
				<table id='sortable'>
					<thead>
					<tr>
						<th>nr</th>
						<th><form method='post'><input type='submit' name='btn1' class='button1segr minwidth' value='imię'></form></th>
						<th> <form method='post'><input type='submit' name='btn2' class='button1segr minwidth' value='nazwisko'></form></th>
						<th> <button class='button1segr minwidth' onclick='sortTableRodzUmowy()'>rodzaj umowy</button></th>
						<th> <button class='button1segr minwidth' onclick='sortTableOkrUmowy()'>okres umowy</button></th>
						<th><button class='button1segr minwidth' onclick='sortTableBadania()'>okres badań lek. </button></th>
						<th><button class='button1segr minwidth' onclick='sortTableBudowa()'>domyślna budowa </button></th>
						<th> <form method='post'><input type='submit' name='btn6' class='button1segr' value='stawka'></form></th>
						<th class='minwidth maxwidth'> <b>opis/uwagi</b></th>
						<th></th>
					</tr>
					</thead>
					<tbody id="tableData">
					
					<?php
						$nr= 0;
						while($row=$rezult->fetch_assoc())
						{
							$nr++;	
							$nrS=$nr-5;
							$id_pracownika=$row['id'];
																							
							echo "<tr>
							<td>".$nr."</td>
							<td class='imie'><form action='pr1.php' method='post'><input type='hidden' value=".$id_pracownika." name='inputIdPr1'><input type ='submit' name='zobaczPracownika' value='".$row['imie']."' class='btnzobacz pointer btnzobaczImie'></form></td>
							<td class='nazwisko'><form action='pr1.php' method='post'><input type='hidden' value=".$id_pracownika." name='inputIdPr1'><input type ='submit' name='zobaczPracownika' value='".$row['nazwisko']."' class='btnzobacz pointer btnzobaczNazwisko'></form></td>
							<td class='umowa'>".$row['umowa']."</td>
							<td class='umowaOkr'>".$row['okrUmowy']."</td>
							<td class='badaniaOkr'>".$row['lekarskie']."</td>
							<td>".$row['budowa']."</td>
							<td>".$row['stawka']."</td>
							<td class='minwidth maxwidth'><div class='maxwidth'>".$row['opisPr']."</div></td>
							<td> 
							<div class='editionbar'>
								<div id='s$nr' class='wrapper'> 
								<a href='#s$nrS'> opcje </a>
									<ul>
										<li><form action='edytujPracownika.php' method='post'><input type='hidden' value=".$id_pracownika." name='inputIdPracownika'><input type ='submit' name='edytujPracownika' value='edytuj' class='btnedit pointer'></form></li>
										<button onclick='okienkoDelete($id_pracownika)' class='btnedit pointer'> usuń </button>
									</ul>
								</div>
							</div>
							</td>
							</tr>"; 
																	
						};		
									
					?>
						
					</tbody>
				</table>
				<div class='formargin'></div>
			</div>
								
		   </div>
		 
		  	   
	   </div>  
   
    </div>
   
	<script src="js/script2_pr.js"></script> 
	<script src="js/script_littleBox_pr.js"></script> 

    </body>


</html>