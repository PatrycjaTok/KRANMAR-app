<?php

	session_start(); 	//potrzebne, by móc korzystać z sesji - tworzyc zmienne dostępne na innych podstronach php

    if((!isset($_POST['loginl'])) || (!isset($_POST['passwordl'])))	 	//co jeżeli ktoś z palca wpisze w adrese odniesienie do zaloguj.php
	{
		header('Location: index.php');		//jeżeli login lub hasło nie istnieją to idź na str główną
		exit();
	}
	
	require_once "connect.php";

    $polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login=$_POST['loginl'];
		$password=$_POST['passwordl'];
		
		$login=htmlentities($login, ENT_QUOTES, "UTF-8"); 			//BEZPIECZENSTWO, niepozwala wpisywać specjalnych znaków

		/* 
		$sql="SELECT * FROM uzytkownicy WHERE mail='$login' AND password='$password'";
		if($rezult=@$polaczenie->query($sql))						
		{ $ilu_userow=$rezult...  
		*/  
		//-----DLA BEZPIECZEŃSTWA ZAPISUJE TO INACZEJ:
	
		if($rezult=@$polaczenie->query(	//co jesli zupelnie nie da sie wyslac zapytania
		sprintf("SELECT * FROM uzytkownicy WHERE mail='%s'",
		mysqli_real_escape_string($polaczenie,$login))))		// BEZPIECZENSTWO - okreslam,że wprowadzone dane muszą byc string (%s)
		{
			$ilu_userow=$rezult->num_rows;	//co jesli udalo sie wyslac zapytanie, ale jest bledny login/haslo
			if($ilu_userow>0)
			{
				$row=$rezult->fetch_assoc();	//tworzę tablicę assoc. o nazwie row
				if(password_verify($password,$row['password']))
				{
					$_SESSION['zalogowany']=true;	// DODATKOWA - zmienna, by spr czy ktos zalogowany jest i jak co przeniesc na inna strone
						
					$_SESSION['id_uzytkownika']=$row['id'];		// DODATKOWO - id przyda sie do zapytan np. zmieniajacych dane
					$_SESSION['email']=$row['mail'];  	/*wyciągam z bazy danych login uzytkownika (czyli mail)
												robię to za pomocą sesji - tablicy globalnej (by można korzystać ze zmiennych też w innych plikach php)
												np na podstronach. Na początku strony potrzebuję session_start(); */
					$_SESSION['name']=$row['imie'];
						
					unset($_SESSION['blad']);
					$rezult->close();	//czyszczę z pamięci ram servera wyniki zapytania. Mam je już w zmiennych php
					header('Location:main.php');	// logowanie się powiodlo, więc przekierowujemy do kolejnej podstrony
				}
				
				else
				{
					$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło</span>';	//gdy zły hasło/login
					header('Location:index.php');	//przenosimy spowrotem na str główną
				}
			}else{
				$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło</span>';	//gdy zły hasło/login
				header('Location:index.php');	//przenosimy spowrotem na str główną
				}
		}

		$polaczenie->close();
	}
	
	
?>

	
