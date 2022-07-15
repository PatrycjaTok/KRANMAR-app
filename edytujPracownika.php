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
		$id_pracownika=$_POST['inputIdPracownika'];
		$sql1="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko, pracownicy.umowa, pracownicy.okrUmowy, pracownicy.lekarskie, pracownicy.budowa, pracownicy.stawka, pracownicy.opisPr FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' AND id='$id_pracownika'";
		if($rezult=$polaczenie->query($sql1))						
		{
			$ilu_userow=$rezult->num_rows;							
			
		}else { echo "BRAK DANYCH";};

		$sql2= "SELECT * FROM umowa";
		$rezult2=$polaczenie->query($sql2);	

		$polaczenie->close();
	};
	?>

<!DOCTYPE HTML>
<html lang='pl-PL'>
<head>
    <meta charset='utf-8'>
     <meta name='viewport' content='width=device-width, initial-scale-=1'>
    <link rel='stylesheet' href='css/style_editdelete.css' type='text/css'>
    <link rel='icon' href='images/favicon.png' type='image/x-icon'>
    <title>Aplikacja do zarządzania ludźmi - pracownicy - edycja</title>
	</head>
<body>
    <div class='container'>
		
		<div class='box1'>
			
		   <div class='boxpracownicyMedium'>
		
				<table>
					<thead>
					<tr>
						<th>imie</th>
						<th>nazwisko</th>
						<th>rodzaj umowy</th>
						<th>okres umowy</th>
						<th>okres badań lekarskich</th>
						<th>domyślna budowa</th>
						<th>stawka</th>
						<th>opis/uwagi</th>
					</tr>
					</thead>
					<tbody id='tableData'>
					
				<?php
					
						$row=($rezult->fetch_assoc());
							$umowa2=$row['umowa'];
						
							echo "<form action ='editPracownika.php' method='post'><tr>
							<td><input type='text' value='".$row['imie']."' name='imie'></td>
							<td><input type='text' value='".$row['nazwisko']."' name='nazwisko'></td>
							<td>	
							<select name='umowa' >
							<option value='$umowa2'>$umowa2</option>";
									
							
								while($row2=$rezult2->fetch_assoc())
								{
									$umowa_nazwa=$row2['nazwa'];																											
			
									echo "<option value='$umowa_nazwa'>$umowa_nazwa</option>";
																	
								}; 
			
								
							echo"
							</select>
							</td>
							<td><input type='date' value='".$row['okrUmowy']."' name='okrUmowy'></td>
							<td><input type='date' value='".$row['lekarskie']."' name='badania'></td>
							<td><input type='text' value='".$row['budowa']."' name='budowa'></td>
							<td><input type='number' value='".$row['stawka']."' name='stawka'></td>
							<td><input type='text' value='".$row['opisPr']."' name='opisUwagi'></td>
							<input type='hidden' value='".$id_pracownika."' name='idPrac'>
							<br>";
						?>
								
						</tbody>
					</table>
					<br>
					</div><br>
					<div class='divBtnEditDel'>
					<input type='submit' value='aktualizuj' name='aktualizuj' class='btnEdit'>
					<input type='submit' value='anuluj' name='anuluj' class='btnAnuluj'>
					</form>
					</div>
				
			</div>
			
	   </div>
   
   
    </body>


</html> 