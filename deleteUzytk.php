<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany']))	
	{
		header('Location: index.php');
		exit();		
	}else
	{
		$id_uzytkownika=$_SESSION['id_uzytkownika'];
		
		if(isset($_POST['del'])){
	
										
					
					require_once "connect.php";

					$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

					if($polaczenie->connect_errno!=0)
					{
						echo "Error: ".$polaczenie->connect_errno;
						unset($_POST['del']);
					}
					else
					{
									
							$sql1="DELETE FROM pracownicy WHERE id_uzytkownika='$id_uzytkownika'";
							$sql2="DELETE FROM firmy WHERE id_uzytkownika='$id_uzytkownika'";
							$sql3="DELETE FROM randompeople WHERE id_uzytkownika='$id_uzytkownika'";
							$sql4="DELETE FROM zastepstwa WHERE id_uzytkownika='$id_uzytkownika'";
							$sql5="DELETE FROM zastepstwa_historia WHERE id_uzytkownika='$id_uzytkownika'";
							$sql6="DELETE FROM uzytkownicy WHERE id='$id_uzytkownika'";
							if($rezult1=$polaczenie->query($sql1))					
							{
								if($rezult2=$polaczenie->query($sql2)){
									if($rezult3=$polaczenie->query($sql3)){
										if($rezult4=$polaczenie->query($sql4)){
											if($rezult5=$polaczenie->query($sql5))
											{
												if($rezult6=$polaczenie->query($sql6))
												{
													unset($_SESSION['zalogowany']);
													header('Location:index.php');
													unset($_POST['del']);
												};
											};
										};
									};
								};	
							};
							
								
														
						

						$polaczenie->close();
						unset($_POST['del']);
					};
					
																		
			
										
		}else if(isset($_POST['anuluj'])){
			header('Location: ustawienia.php');
			unset($_POST['anuluj']);
		}
	};
	
	?>