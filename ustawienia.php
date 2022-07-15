<?php

	session_start(); 
	
	if(!isset($_SESSION['zalogowany']))	
	{
		header('Location: index.php');
		exit();		
	}
	
	$emailuzytk=$_SESSION['email'];
	
	require_once "connect.php";

    $polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$id_uzytkownika=$_SESSION['id_uzytkownika'];

		$sqlfirst="SELECT uzytkownicy.mail FROM uzytkownicy WHERE id='$id_uzytkownika'"; 
			if($rezultfirst=@$polaczenie->query($sqlfirst))						
			{
			$rowfirst=$rezultfirst->fetch_assoc();
			$mailUzytkownika=$rowfirst['mail'];							
				
			}else {
				$_SESSION['komunikatnegativSave']="Problem z połączeniem z bazą danych";
			};
	
		
		if(isset($_POST['save'])){
			$task=$_POST['PokazUkryj'];
			$sql2="UPDATE uzytkownicy SET ustawieniaTask='$task' WHERE id='$id_uzytkownika'"; 
			if($rezult2=@$polaczenie->query($sql2))						
			{
				
			$_SESSION['komunikatpositivSave']="Zmiany zostały zapisane";
			header('Location: ustawienia.php');
			exit;												
				
			}else {
				$_SESSION['komunikatnegativSave']="Problem z połączeniem z bazą danych";
			};

		};

		if(isset($_POST['editEmail'])){
			$email=$_POST['mailValue'];

			$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);	 		//specjalnu filtr stosowany do adresów mailowych
			if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) //pierwsza walidacja mogła uciać litery, więc sprawdzam
			{
				$_SESSION['e_email']="Podaj poprawny adres e-mail";
			}else{
				$sql3="UPDATE uzytkownicy SET mail='$email' WHERE id='$id_uzytkownika'"; 
				if($rezult3=@$polaczenie->query($sql3))						
				{
					
				$_SESSION['komunikatpositivSave']="Zmiany zostały zapisane";
				$_SESSION['email']=$email;
				header('Location: ustawienia.php');
				exit;												
					
				}else {
					$_SESSION['komunikatnegativSave']="Problem z połączeniem z bazą danych";
				};
			}

		};

		$sql1="SELECT uzytkownicy.ustawieniaTask FROM uzytkownicy WHERE id='$id_uzytkownika'"; 
		if($rezult1=@$polaczenie->query($sql1))						
		{
			$row1=$rezult1->fetch_assoc();
			$taskValue=$row1['ustawieniaTask'];
		}else {
			$_SESSION['komunikatnegativSave']="Problem z połączeniem z bazą danych";
		};
			
		
		$polaczenie->close();
	};
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
	 <link rel="stylesheet" href="css/style_pracownicy.css" type="text/css">
	<link rel="stylesheet" href="css/style_ustawienia.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - settings</title>
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
					<a href='#'> HISTORIA </a>
					<ul id='ulBigger'>
						<li><a href="historiaZastepst.php">histora zastępstw</a></li>
						<li><a href="historiaUrlopow.php">historia urlopów</a></li>
					</ul>
				</div>
			</div>
			<a href="ustawienia.php" id='currentLink'>USTAWIENIA</a>				
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
							<a href='#'  onclick='showNavigSmall2()'> HISTORIA </a>
							<ul id='ulSmallHide2' class='secondSt ulBigger'>
								<li><a href="historiaZastepst.php">histora zastępstw</a></li>
								<li><a href="historiaUrlopow.php" >historia urlopów</a></li>
							</ul>
						</div>
					</div> </li>
					<li> <a href="#" id='currentLink'>USTAWIENIA</a> </li>			

				</ul>
				</div>
			</div>
		</div>
		
		
		<div class=box1>
			<div class='comunicats'> 
			<?php 
			if(isset($_SESSION['komunikatpositivSave'])){
				echo "<div class='positiv'>".$_SESSION['komunikatpositivSave']."</div>";
				unset($_SESSION['komunikatpositivSave']);
			};
			if(isset($_SESSION['komunikatnegativSave'])){
				echo "<div class='negativ'>".$_SESSION['komunikatnegativSave']."</div>";
				unset($_SESSION['komunikatnegativSave']);
			};
			if(isset($_SESSION['e_email'])){
				echo "<div class='negativ'>".$_SESSION['e_email']."</div>";
				unset($_SESSION['e_email']);
			};
				?>
			</div>

			<div class="boxTitle"> 
			   		<p>USTAWIENIA</p>		   
			</div>
			<div class='boxForm'>
			
				<ul>
					<li>
						<p>Pokaż lub ukryj znacznik komunikatów o zbliżających/minionych terminach dat: </p>
						<div>
						<form method='post'>
							<?php
							if($taskValue=="task1"){
								echo "<label> Pokaż<input type='radio' value='task1' name='PokazUkryj' checked> </label>
								<label> Ukryj <input type='radio' value='task2' name='PokazUkryj'></label>";
							}else if($taskValue=="task2"){
								echo "<label> Pokaż<input type='radio' value='task1' name='PokazUkryj'> </label>
								<label> Ukryj <input type='radio' value='task2' name='PokazUkryj' checked></label>";
							}
							?>
							<input type='submit' name='save' value='Zapisz' class='btnSettings'></input>
						</form>
						</div>
					</li>
					<li>
						<form method='post'>
						<p>Edytuj adres e-mail</p>
						<input type="text" class = "inputemail" name="mailValue" value="<?php echo $mailUzytkownika; ?>">
						<input type='submit' name='editEmail' value='edytuj' class='btnSettings'></input>
						</form>
					</li>
					<li>
						<form action='changepass.php' method='post'>
						<p>Zmień hasło </p>
						<?php echo "<input type='hidden' name='emailuzytk' value='".$emailuzytk."' class='btnSettings'></input>"; ?>
						<input type='submit' name='changePassword' value='Zmień' class='btnSettings'></input>
						</form>
					</li>
					<li>
						<form action='deleteUzytkownika.php' method='post'>
						<p class='textRed'>Usuń konto </p>
						<input type='submit' name='delete' value='Usuń' class='btndelete'></input>
						</form>
					</li>
				</ul>
  			
				</form>
			</div>
			
		   
		  	   
	   </div>  
   
    </div>

    </body>
	<script>
		var ulToHide = document.getElementById("ulToHide");
		var ulSmallHide1 = document.getElementById("ulSmallHide1");
		var ulSmallHide2 = document.getElementById("ulSmallHide2");

		ulToHide.style.display = "none";
		ulSmallHide1.style.display = "none";
		ulSmallHide2.style.display = "none";

		function showNavig2(){
			if (ulToHide.style.display === "none") {
				ulToHide.style.display = "block";
			} else {
				ulToHide.style.display = "none";
			}
		};

		function showNavigSmall1(){
			if (ulSmallHide1.style.display === "none") {
				ulSmallHide1.style.display = "block";
			} else {
				ulSmallHide1.style.display = "none";
			}
		};

		function showNavigSmall2(){
			if (ulSmallHide2.style.display === "none") {
				ulSmallHide2.style.display = "block";
			} else {
				ulSmallHide2.style.display = "none";
			}
		};
	</script> 

</html>