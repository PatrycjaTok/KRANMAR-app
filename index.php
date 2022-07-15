<?php

	session_start();	// dzięki temu podstrona może korzystać ze zmiennych globalnych

	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))	//by uniknąć że ktoś zalogowany usunie kod w adresie i przejdzie na str logowania
	{
		header('Location: main.php');
		exit();			// w takim przypadku przenieś na str main (zalogowaną) i pomiń poniższy kod (z tej str index)
	}
	$_SESSION['resetpass']=false;

?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale-=1">
    <link rel="stylesheet" href="css/styleindex.css" type="text/css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Aplikacja do zarządzania ludźmi - zastępstwa, zaliczki, budowy</title>
    </head>
<body>
    <div class="container">
         <div class='box'>   
            <div id="powitanie"> <p>Wiatmy!</p>
                By korzystać ze strony <b>zaloguj się</b>. 
                <br>Jeżeli nie posiadasz konta <b>dokonaj rejestracji</b>.
            </div>
            
                <div class='boxlogin'>
                    <form action="zaloguj.php" method="post"><p id='zaloguj'>zaloguj się</p>
                    e-mail:<input type="text" class="input1" name="loginl" placeholder="e-mail">
                    <br>password:<input type="password" class="input1" name="passwordl" placeholder="password">
                    <br><input type="submit" value="zaloguj" class='btndodaj'>
                    </form>
                </div>
                <div class='positionAndComunicat'>
                    <?php
                        if(isset($_SESSION['blad'])){	 
                        echo $_SESSION['blad'];
                        unset($_SESSION['blad']);
                        }
                            //jeżeli istnieje taka zmienna - to ją wyświetl(by uniknąć wyświetlania za 1-wszym logowaniem)
                    ?>
                </div>
                <div class='boxremindpass'>
                    Nie pamiętasz hasła?
                    <br> <a href="reminderpass.php">odzyskaj hasło</a>
                </div>
                <div class='boxremindpass marginbottom'>
                    Nie masz konta? załóż je teraz!
                    <br> <a href="rejestracja.php">Zarejestruj się</a>
                 </div>
            
        </div>
    </div>
    
  
    </body>


</html>