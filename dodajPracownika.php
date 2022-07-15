<?php

	session_start(); // dzięki temu podstrona może korzystać ze zmiennych globalnych
	
	if(!isset($_SESSION['zalogowany']))	//by uniknąć że ktoś niezalogowany wpisze kod w adresie i przejdzie na tą stronę
	{
		header('Location: index.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}else
	{
	
	
		require_once "connect.php";
				
				mysqli_report(MYSQLI_REPORT_STRICT);		// tu inf. że chcemy rzucać wyjątkami w przypadku błędów
				try 										// try/catch, coś jak "@" (do pomijania błędów)
				{					 										
				 $polaczenie=new mysqli($host, $db_user, $db_password, $db_name);   
					if($polaczenie->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						$sql1= "SELECT * FROM umowa";
						$rezult=$polaczenie->query($sql1);			
						
						$polaczenie->close();	
					};
				}catch(Exception $e)
				{
					echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie! </span>';
					echo '<br>Informacja developerska: '.$e;
				};
					

		if(isset($_POST['dodaj'])){
					
			//Poniżej - przetważanie naszego formularza:
			if(isset($_POST['pr_name']))	//Sprawdzam czy ktoś wpisał chociaz imie lub nazwisko
			{								
				$id_uzytkownika=$_SESSION['id_uzytkownika'];
				
				//udana walidazja? Załóżmy, że tak (all testy ok)
				$all_OK=true;
				
				
				// inputy
				$pr_name=$_POST['pr_name'];
				$pr_name=htmlspecialchars($pr_name, ENT_QUOTES, "UTF-8");
				$pr_surname=$_POST['pr_surname'];
				$pr_surname=htmlspecialchars($pr_surname, ENT_QUOTES, "UTF-8");
				$umowa=$_POST['umowa'];
				$umowa_data=$_POST['umowa_data'];
				$lekarskie_data=$_POST['lekarskie_data'];
				$budowa=$_POST['budowa'];
				$stawka=$_POST['stawka'];
				$opisUwagi=$_POST['opisUwagi'];


				
				if((strlen($pr_name)<1)&&(strlen($pr_surname)<1)) 
				{
					$all_OK=false;
					$error_brakNameLubSurname="Wpisz imię lub nazwisko";
				}
				
					require_once "connect.php";
					
					mysqli_report(MYSQLI_REPORT_STRICT);		// tu inf. że chcemy rzucać wyjątkami w przypadku błędów
					try 										// try/catch, coś jak "@" (do pomijania błędów)
					{					 										
						$polaczenie=new mysqli($host, $db_user, $db_password, $db_name);  

						if($polaczenie->connect_errno!=0)
						{
							throw new Exception(mysqli_connect_errno());
						}
						else
						{
						//dodanie nwoego pracownika
							if($all_OK==true)
							{	
								
								if($polaczenie->query("INSERT INTO pracownicy VALUES(NULL, '$id_uzytkownika' ,'$pr_name','$pr_surname', '$umowa', '$umowa_data','$lekarskie_data','$budowa', '$stawka', '$opisUwagi')"))
								{
									$_SESSION['dodanoPrKomunikat']="Pomyślnie dodano pracownika";
									unset($_POST['dodaj']);
									echo "<script>
									window.close();
									if (window.opener && !window.opener.closed) {
										window.opener.location.href = 'pracownicy.php';
									  };
									  </script> ";
									exit();
								}
								else{
									throw new Exception($polaczenie->error);
								}
								
							}
							
							
							$polaczenie->close();		//NIE ZAPONIJ ZAMKNĄĆ POŁĄCZENIA!
						}
					}
					catch(Exception $e)
					{
						echo '<span class="error"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie! </span>';
						echo '<br>Informacja developerska: '.$e;
					}
			
			}
		};
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
	</head>
<body>
    <div class="container">
		
		<div class=box1>
			
		   <form method="post">
				<br>
		   
				<?php
				if(isset($error_brakNameLubSurname)) 
				{
					echo '<div class="negativ">'.$error_brakNameLubSurname.'</div>';
					unset($error_brakNameLubSurname);			//usuwam błąd, by po spełnieniu warunku nadal się nie pokazywał
				}
				?>
				
				<br> imię:
				<br><input type="text" name="pr_name">
				<br> nazwisko:
				<br><input type="text" name="pr_surname">
				<br> rodzaj umowy:
				<br>
				
				<select name="umowa" class='selectbox'>
				<option value=" "> </option>
						
					<?php

						while($row=$rezult->fetch_assoc())
						{
							$umowa_id=$row['id'];
							$umowa_nazwa=$row['nazwa'];																											

							echo "<option value='$umowa_nazwa'>".$umowa_nazwa."</option>";
														
						};

					?>

				</select>
						
				
				<br> okres umowy:
				<br><input type="date" name="umowa_data" class='selectbox'>
				<br> okres badań lekarskich: 
				<br><input type="date" name="lekarskie_data" class='selectbox'>
				<br> domyślna budowa:
				<br><input type="text" name="budowa">
				<br> stawka:
				<br><input type="number" name="stawka">
				<br> opis/uwagi:
				<br><input type="text" name="opisUwagi">
				
				<br><br> <input type="submit" value="dodaj" name='dodaj' class='button1'>
				<input type='submit' value='anuluj' name='anuluj' class='button2' onclick='window.close()'>
		   </form>
	   
	   </div>

   
    </div>

    </body>


</html>