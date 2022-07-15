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
		$id_firmy=$_POST['inputIdFirmy'];
		$sql1="SELECT firmy.id, firmy.nazwa_firmy FROM firmy WHERE id_uzytkownika='$id_uzytkownika' AND id='$id_firmy'";
		if($rezult=$polaczenie->query($sql1))						
		{
			$ilu_userow=$rezult->num_rows;	//co jesli udalo sie wyslac zapytanie, ale jest bledny login/haslo
			
			// przyciski edycji i usuwania pracowników:
								
			
		}else { echo "BRAK DANYCH";}

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
    <title>Aplikacja do zarządzania ludźmi - edytuj firmę</title>
	</head>
<body>
    <div class="container">
		
		<div class="box1">
			
		   <div class="boxpracownicyTiny">
			<br> 
				<table>
					<thead>
					<tr>
						<th>nazwa firmy</th>
					</tr>
					</thead>
					<tbody id="tableData">
					
					<?php
					
						$row=($rezult->fetch_assoc());
						
							echo "<form action ='editFirmy.php' method='post'><tr>
							<td><input type='text' value='".$row['nazwa_firmy']."' name='nazwa_firmy'></td>
							<input type='hidden' value='".$id_firmy."' name='idFirm'>
							<br>
							
					</tbody>
				</table>
				<br>
				</div><br>
				<div class='divBtnEditDel'>
				<input type='submit' value='aktualizuj' name='aktualizuj' class='btnEdit'>
				<input type='submit' value='anuluj' name='anuluj'  class='btnAnuluj'>
				</div>
				</form>";	?>
				
			</div>
			
	   </div>
   
   
	<script type="text/javascript">	
	
		console.log("działam");
	
	</script>
    </body>


</html>