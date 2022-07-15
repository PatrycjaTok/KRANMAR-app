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
		$id_urlopu=$_POST['inputIdUrlopu'];
		$nr=$_POST['inputnr'];
		
		
			$sql="SELECT * FROM urlopy WHERE id_uzytkownika='$id_uzytkownika' AND id='$id_urlopu'";
			if($rezult=$polaczenie->query($sql))						
			{
				$ilu_userow=$rezult->num_rows;	
				$row=($rezult->fetch_assoc());
				$ktoid=$row['id_pracownika'];

					if($rezultKto=$polaczenie->query("SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id='$ktoid'"))						
					{
						$rowKto=$rezultKto->fetch_assoc();
						$ktoimiePlaceholder=$rowKto['imie'];
						$ktonazwiskoPlaceholder=$rowKto['nazwisko'];

					};
		
			}else { echo "BRAK DANYCH";};

			$sql4="SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika' ORDER BY pracownicy.nazwisko";
			if(!$rezult4=$polaczenie->query($sql4))						
			{
				echo "Nie można połączyć z bazą danych";
														
			};
		


		$polaczenie->close();
	}
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
	 <link rel='stylesheet' href='css/style_editdelete.css' type='text/css'>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - edytuj urlop</title>
	</head>
<body>
    <div class="container">
		
		<div class="box1">
			
		   <div class="boxpracownicyLittle">
			<br> 
				<table>
					<thead>
					<tr>
						<th>Od</th>
						<th>Do</th>
						<th>kto</th>
						<th>uwagi</th>
					</tr>
					</thead>
					<tbody id="tableData">
					
					<?php 
					
										
						
							echo "<form action ='editUrlop.php' method='post'><tr>
							<td> <input type='hidden' value='".$nr."' name='nr'> 
							<input type='date' value='".$row['data1']."' name='data1'></td>
							<td> <input type='date' value='".$row['data2']."' name='data2'></td>
								<td>		
								<select name='kto'>
								
								<option value=".$ktoid.">".@$ktonazwiskoPlaceholder." ".@$ktoimiePlaceholder."</option>
								<optgroup label='PRACOWNICY'>";
								
								while($row4=$rezult4->fetch_assoc())
								{
									$ktoImie=$row4['imie'];
									$ktoNazwisko=$row4['nazwisko'];
									$ktoId_pr=$row4['id'];				// !!!! pobierać na podstawie id? a co jeśli ktoś wpisze nazwę?																										
	
									echo "<option value='".$ktoId_pr."'>".$ktoNazwisko." ".$ktoImie."</option>";
															
								};

								echo "</optgroup>	
								</select>
								</td>
							<td><textarea name='uwagi' rows=1>".$row['uwagi']."</textarea></td>
							<input type='hidden' value='".$id_urlopu."' name='idUrlopu'>
							<br>
							
					</tbody>
				</table>
				<br>
				</div><br>
				<div class='divBtnEditDel'>
				<input type='submit' value='aktualizuj' name='aktualizuj' class='btnEdit'>
				<input type='submit' value='anuluj' name='anuluj' class='btnAnuluj'>
				</div>
				</form>";	?>
				
			</div>
			
	   </div>
   
   
 
   
    </body>


</html>