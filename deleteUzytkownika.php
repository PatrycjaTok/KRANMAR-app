<?php

	session_start(); 
	
	if(!isset($_SESSION['zalogowany']))	
	{
		header('Location: index.php');
		exit();		
	}else
	{
	
	
		if(isset($_POST['delete'])){
					$id_uzytkownika=$_SESSION['id_uzytkownika'];
																							
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

		<style>
			@media screen and (max-width:640px){   
				body{
					font-size: 18px;
				}  
				
				.obrazek{
					width:75px;
					height: auto;
				}
					
			}
				
			@media screen and (min-width:640px) and (max-width:1024px){
				body{
					font-size: 20px;
				}

				.obrazek{
					width:100px;
					height: auto;
				}
					
			}
				
			@media screen and (min-width:1024px){
			body{
				font-size: 20px;
				}

				.obrazek{
					width:150px;
					height: auto;
				}
					
			}
				
				
			body{
				width: auto;
				background-color: rgb(196, 189, 189);
				font-family: georgia,tahoma, arial, sans-serif;
				margin:0;
				color: rgb(245, 236, 236);
			}
				
			.button1{
				background-color:  rgb(24, 121, 100);
				font-size: large;
				margin-top: 0.7em;
				cursor: pointer;
				box-shadow: 0 0.3em 0.3em rgba(0, 0, 0, 0.548);
				transition-property: box-shadow, background-color;
				transition-duration: 0.3s;
				border-radius: 5px;
				border: black solid 3px;
						
				}
						
			.button1:hover{
				background-color:  rgb(22, 102, 85);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.685)
			}
						
			.button1:active{
				background-color:  rgb(21, 87, 72);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.801)
			}

			.button2{
				background-color: rgb(219, 37, 37);
				font-size: large;
				margin-top: 0.7em;
				cursor: pointer;
				box-shadow: 0 0.3em 0.3em rgba(0, 0, 0, 0.548);
				transition-property: box-shadow, background-color;
				transition-duration: 0.3s;
				border-radius: 5px;
				border: black solid 3px;
						
			}
						
			.button2:hover{
				background-color: rgb(165, 32, 32);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.685)
			}
						
			.button2:active{
				background-color: rgb(131, 23, 23);
				box-shadow: 0 0.5em 0.5em rgba(0, 0, 0, 0.801)
			}

			.okienko{
				display:flex;
				justify-content: center;
				align-items: center;
			}

			.okienko2{
				padding: 10vh;
				text-align: center;
				margin-top: 30vh;
				border: solid black 5px;
				background-color: rgb(156, 52, 52);
				box-shadow: 0 1em 1em rgba(0, 0, 0, 0.685)
			}

			.marginleftbtn{
				margin-left: 20%;
			};
		</style>
	</head>

	<body>
	<div class='okienko'>
		<div class='okienko2'> 
			<form action='deleteUzytk.php' method='post'> CZY NAPEWNO CHCESZ USUNĄĆ KONTO? :( <br> 
			<img src='images/dog2.png' alt='obrazek1' title=':(' class='obrazek'> 
			<img src='images/kot2.png' alt='obrazek2' title=':(' class='obrazek'>
			<br>
			<input type='submit' name='del' value='usuń' class='button2'> <input type='submit' name='anuluj' value='anuluj' class='button1 marginleftbtn'></form></div></div>
	</body>
</html>