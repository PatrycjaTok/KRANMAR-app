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
		$id_zastepstwa=$_POST['inputIdZastepstwa'];
		$nr=$_POST['inputnr'];
		$idPracownika=$_POST['idPracownika'];
		if(isset($_POST['is1'])){
			$is1=true;
			unset($_POST['is1']);
		}else{
			$is1=false;
		}
		
			$sql="SELECT * FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika' AND id='$id_zastepstwa'";
			if($rezult=$polaczenie->query($sql))						
			{
				$ilu_userow=$rezult->num_rows;	
				$row=($rezult->fetch_assoc());
				
				$zakogoprzedrostek=$row['zakogoPrzedr'];
				$zakogoid=$row['zakogo'];
				$zakogo1=$row['zakogoPrzedr']."_".$row['zakogo'];

				if($zakogoprzedrostek=="pracownik")
				{
						if($rezultZakogo=$polaczenie->query("SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id='$zakogoid'"))						
					{
						$rowZakogo=$rezultZakogo->fetch_assoc();
						$zakogoimiePlaceholder=$rowZakogo['imie'];
						$zakogonazwiskoPlaceholder=$rowZakogo['nazwisko'];

					};
				};
			

				if($zakogoprzedrostek=="innypr")
				{
						if($rezultZakogo=$polaczenie->query("SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE id='$zakogoid'"))						
					{
						$rowZakogo=$rezultZakogo->fetch_assoc();
						$zakogoimiePlaceholder=$rowZakogo['imie'];
						$zakogonazwiskoPlaceholder=$rowZakogo['nazwisko'];

					};
				};
				

				if($zakogoprzedrostek=="firma")
				{
						if($rezultZakogo=$polaczenie->query("SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE id='$zakogoid'"))						
					{
						$rowZakogo=$rezultZakogo->fetch_assoc();
						$zakogoimiePlaceholder=$rowZakogo['nazwa_firmy'];
						$zakogonazwiskoPlaceholder="";

					};
				};
				

				$ktoprzedrostek=$row['ktoPrzedr'];
				$ktoid=$row['kto'];
				$kto1=$row['ktoPrzedr']."_".$row['kto'];

				if($ktoprzedrostek=="pracownik")
				{
						if($rezultKto=$polaczenie->query("SELECT pracownicy.id, pracownicy.imie, pracownicy.nazwisko FROM pracownicy WHERE id='$ktoid'"))						
					{
						$rowKto=$rezultKto->fetch_assoc();
						$ktoimiePlaceholder=$rowKto['imie'];
						$ktonazwiskoPlaceholder=$rowKto['nazwisko'];

					};
				};
					

				if($ktoprzedrostek=="innypr")
				{
						if($rezultKto=$polaczenie->query("SELECT randompeople.id, randompeople.imie, randompeople.nazwisko FROM randompeople WHERE id='$ktoid'"))						
					{
						$rowKto=$rezultKto->fetch_assoc();
						$ktoimiePlaceholder=$rowKto['imie'];
						$ktonazwiskoPlaceholder=$rowKto['nazwisko'];

					};
				};
					

				if($ktoprzedrostek=="firma")
				{
						if($rezultKto=$polaczenie->query("SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE id='$ktoid'"))						
					{
						$rowKto=$rezultKto->fetch_assoc();
						$ktoimiePlaceholder=$rowKto['nazwa_firmy'];
						$ktonazwiskoPlaceholder="";

					};
				};

				$co1=$row['co'];
				if($rezultCo=$polaczenie->query("SELECT dozastepstw.id, dozastepstw.nazwa FROM dozastepstw WHERE id='$co1'"))						
					{
						$rowCo=$rezultCo->fetch_assoc();
						$coPlaceholder=$rowCo['nazwa'];

					};
				
				

								
				
			}else { echo "BRAK DANYCH";};

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
	}
	
	?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
	 <link rel='stylesheet' href='css/style_editdelete.css' type='text/css'>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - edytuj zastępstwo</title>
	</head>
<body>
    <div class="container">
		
		<div class="box1">
			
		   <div class="boxpracownicy">
			<br> 
				<table>
					<thead>
					<tr>
						<th>data</th>
						<th>za kogo</th>
						<th>kto</th>
						<th>co</th>
						<th>gdzie</th>
						<th>żuraw</th>
						<th>ilość [h]</th>
						<th>kwota</th>
						<th>uwagi</th>
					</tr>
					</thead>
					<tbody id="tableData">
					
					<?php 
					
										
						
							echo "<form action ='editZastepstwo.php' method='post'><tr>
							<td> <input type='hidden' value='".$nr."' name='nr'> 
							<input type='date' value='".$row['dataMysql']."' name='data'></td>
							<td>

							
							<select name='zakogo'>
							<option value=".$zakogo1.">".@$zakogonazwiskoPlaceholder." ".@$zakogoimiePlaceholder."</option>
							<optgroup label='PRACOWNICY'>";
															
								while($row2=$rezult2->fetch_assoc())
								{
									$zakogoImie=$row2['imie'];
									$zakogoNazwisko=$row2['nazwisko'];
									$zakogoId_pr=$row2['id'];

									echo"<option value='pracownik_".$zakogoId_pr."'>".$zakogoNazwisko." ".$zakogoImie." </option>";
			
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

								echo "</optgroup>
											
								</select>

								</td>
								<td>

						
								<select name='kto'>
								
								<option value=".$kto1.">".@$ktonazwiskoPlaceholder." ".@$ktoimiePlaceholder."</option>
								<optgroup label='PRACOWNICY'>";
								
								while($row4=$rezult4->fetch_assoc())
								{
									$ktoImie=$row4['imie'];
									$ktoNazwisko=$row4['nazwisko'];
									$ktoId_pr=$row4['id'];				// !!!! pobierać na podstawie id? a co jeśli ktoś wpisze nazwę?																										
	
									echo "<option value='pracownik_".$ktoId_pr."'>".$ktoNazwisko." ".$ktoImie."</option>";
															
								};

								echo "<option>  </option> </optgroup>
								<optgroup label='INNI PRACOWNICY'>";

								while($row7=$rezult7->fetch_assoc())
								{
									$ktoImieRP=$row7['imie'];
									$ktoNazwiskoRP=$row7['nazwisko'];
									$ktoId_RP=$row7['id'];				// !!!! pobierać na podstawie id? a co jeśli ktoś wpisze nazwę?																										

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
								echo "</optgroup>
									
								</select>

								</td>

								<td>
								<select name='co'>
								<option value=".$co1.">".@$coPlaceholder."</option>";
								
								
								while($row1=$rezult1->fetch_assoc())
								{
								$dozastepstw_id=$row1['id'];
								$dozastepstw_name=$row1['nazwa'];																											

								echo "<option value='".$dozastepstw_id."'>".$dozastepstw_name."</option>";
															
								};
									
							

							echo "</td>

							<td><input type='text' value='".$row['gdzie']."' name='gdzie'></td>
							<td><input type='text' value='".$row['zuraw']."' name='zuraw'></td>
							<td><input type='number' value='".$row['ilosch']."' name='ilosch'></td>
							<td><input type='number' value='".$row['kwota']."' name='kwota'></td>
							<td><textarea name='uwagi' rows=1>".$row['uwagi']."</textarea></td>
							<input type='hidden' value='".$id_zastepstwa."' name='idZastepstwa'>
							<input type='hidden' value='".$is1."' name='is1'>
							<input type='hidden' value='".$idPracownika."' name='idPracownika'>
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
   
   
    
   
   
   
   
   
	<script type="text/javascript">	
	
		console.log("działam");
	
	</script>
    </body>


</html>