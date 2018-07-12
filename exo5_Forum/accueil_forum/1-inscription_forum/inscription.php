<?php
require('../php/config.php'); /* Contient la connexion à la $bdd */

if(isset($_POST['forminscription']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	
	if(!empty($_POST['pseudo'])AND isset($_POST['mail'])AND !empty($_POST['mail2'])AND !empty($_POST['mdp'])AND !empty($_POST['mdp2']))
	{		
		$pseudolength = strlen($pseudo);//"strlen" est la pour verifier si la taille du pseudo et bon donc
		if($pseudolength <= 255) // si le pseudo est < ou = a 255 et 
		{
			if($mail == $mail2)// si le mail de Confirmation et égal au mail de base alors il
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL))// verifi si le mail est vraiment un mail et  
				{
					$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
					$reqmail->execute(array($mail));//la fonction execute
					$mailexist = $reqmail->rowCount();//rowCount sert a compter le mbr de colonne qui y a dans la bdd
					if($mailexist == 0)
					{
						//$mdp = password_hash($mdp, PASSWORD_DEFAULT);
						if($mdp == $mdp2)// si le mdp de Confirmation et égal au mdp de base alors
						{
							$insertmbr = $bdd->prepare('INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)');//requete pour preparer a executer la base de donné(bdd)avec...
							$insertmbr->execute(array($pseudo, $mail, $mdp));//la fonction execute
							header("Location: ../1-connexion_forum/connexion.php");
						}
						else // sinon une erreur s'affiche
						{
							$erreur = "Vos mot de passe ne corresponent pas !";
						}
					}
					else // sinon une erreur s'affiche
					{
						$erreur = "Adresses mail déjé utiliséé !";
					}
				}
				else // sinon une erreur s'affiche
				{
					$erreur = "vos adresses mail n'est pas valide !";
				}
			}
			else // sinon une erreur s'affiche
			{
				$erreur = "vos adresses mail ne corresponent pas !";
			}
		}
		else // sinon une erreur s'affiche
		{
			$erreur = "votre pseudo ne doit pas dépasser 255 caractères.";
		}
	}
	else
	{
		$erreur ="Tous les champ doivent être complétés !";
	}
	
}
?>
<html>
    <head>
		<title>Inscription</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="../images/icon.png">
		<link rel="stylesheet" href="css/forum.css"> 
		<style>
		@font-face {
			font-family: "The Heart of Everything Demo";
			src: url('../police/TheHeartof.ttf');
		}
		body{
			background-image: url(../images/fond2.jpg);
			background-repeat:no-repeat;
			background-position:absolute;
			background-size: cover;
			margin:0;
		}
		
		ul{
			display: table;
			width: 500px;
			margin: auto;
			padding: 0;
			background: #555;
			background: linear-gradient(to right, #555,  #444);
			border-radius: 3px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, .3),
						0 3px 5px rgba(0, 0, 0, .2),
						0 5px 10px rgba(0, 0, 0, .2),
						0 20px 20px rgba(0, 0, 0, .15);
		}
		ul li{
			display: table-cell;
		}
		ul li a{
			display: block;
			position: relative;
			text-align: center;
			color: rgba(255, 255, 255, .7); 
			text-decoration: none;
			transition: padding .3s;
			transition: all .3s .1s;
			transition: padding .3s, background .3s;
			padding: 8px 8px 17px 8px;
			text-shadow: 0 1px 0 rgba(255, 255, 255, .4);
		}
		ul li a::before{
			content: '';
			position: absolute;
			left: 50%;
			bottom: 9px;
			margin-left: -2px;
			width: 4px;
			height: 4px;
			border-radius: 50%;
			background: rgba(0, 0, 0, .5);
		}
		ul li a:hover::before,
		ul li a:focus::before{
			background: white;
			box-shadow: 0 0 2px white, 
						0 -1px 0 rgba(0, 0, 0, .4);
		}
		ul li:first-child a{
			border-radius: 3px 0 0 3px;
		}
		ul li:last-child a{
			border-radius: 0 3px 3px 0;
		}
		ul li a:hover, 
		ul li a:focus{
			transition: all .3s 0s;
			background: rgba(255,255,255,.2);
			padding: 8px 25px 17px 25px;
		}
		ul li a:active{
			background: linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.1)); 
			box-shadow: 0 0 2px rgba(0,0,0,.3) inset;
		}	
		
		#barreClub{
			height:4em;
			width:auto;
			bottom:0em;
			margin-right:auto;
			margin-left:auto;
			background: #000;
			opacity:0.8;
		}
		p.text{
			margin-top:0.2em;
			margin-right:auto;
			margin-left:auto;
			width:auto;
			height:auto;
			background: linear-gradient(to top, #fff, #fff);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-family: The Heart of Everything Demo;
			font-size:2em;
		}
		p.titre{
			margin-top:-0.56em;
			margin-right:auto;
			margin-left:auto;
			width:auto;
			height:auto;
			background: linear-gradient(to top, #fff, #fff);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			font-family: The Heart of Everything Demo;
			font-size:10em;
		}
		img.photo{
			margin-top:-5em;
			width:auto;
			height:5em;
			margin-left:28em;
			transform: rotate(20deg);
		}
		h2.titre2{
			margin-top:0em;
			margin-right:auto;
			margin-left:auto;
			width:auto;
			height:auto;
			color: white;
			background-color: black;
			font-family: The Heart of Everything Demo;
			font-size:5em;

		}
		div.inscription{
			background: linear-gradient(to right, #555,  #444);
			border-radius:10px;
			border:0px inset #0F2027;
			margin-top:-11em;
			margin-right:auto;
			margin-left:auto;
			width:24em;
			height:21em;
			opacity:0.96;
		}
		form.formu{
			margin-top:-6em;
			margin-right:auto;
			margin-left:auto;
			
		}
		input.texte{
			margin-top:0em;
			margin-right:auto;
			margin-left:auto;
			width:15em;
			height:2.2em;
			border-radius:5px 5px 5px 5px;
			border:1px inset rgb(156,156,156);
			color: white;
			background-color: rgb(40,40,40);
			font-family: Arial, sans-serif;
		}
		hr{
			color:black;
		}
		div.error404{
			margin-top:-1.6em;
			margin-right:auto;
			margin-left:auto;
			width:auto;
			height:1.9em;
			border-radius:0px 0px 10px 10px;
			color: red;
			background-color: rgb(0,0,0);
			font-family: Arial, sans-serif;
		}
		div.valide{
			margin-top:-1.6em;
			margin-right:auto;
			margin-left:auto;
			width:auto;
			height:1.9em;
			border-radius:0px 0px 10px 10px;
			color: green;
			background-color: rgb(0,0,0);
			font-family: Arial, sans-serif;
		}
		.inscrist{
			height:2em;
			width:5em;
			font-size:1.5em;
			margin-left:0em;
			margin-top:1em;
			border:0.5px inset #ffffff;
			border-radius:150px;
			color: #fff;
			font-family: The Heart of Everything Demo, sans-serif;
			text-shadow: 0px 0px 0px rgba( 255, 255, 255, 0.2);
			background: #000;
		}
		p.copi{
			font-family: Arial, sans-serif;
			color: #fff;
		}
		img.diap2{
			width:auto;
			height:80%;
			margin-left:2%;
		}
		div.diap2S{
			text-align:center;
			margin-top:-2.8em;
			margin-left:-2%;
		}
		footer{
			position:fixed;
			height:8%;
			width:auto;
			bottom:0em;
			margin-right:auto;
			margin-left:auto;
			background: #000;
			opacity:0.8;
		}
		.col-1 {width: 8.33%;}
		.col-2 {width: 16.66%;}
		.col-3 {width: 25%;}
		.col-4 {width: 33.33%;}
		.col-5 {width: 45%;}
		.col-6 {width: 50%;}
		.col-7 {width: 58.33%;}
		.col-8 {width: 66.66%;}
		.col-9 {width: 75%;}
		.col-10 {width: 83.33%;}
		.col-11 {width: 91.66%;}
		.col-12 {width: 100%;}
		*{
		  box-sizing: border-box;
		}
		[class*="col-"] {
			float: left;
		}
		</style>
    </head>
	<body >
	<div id="barreClub">
		<ul>
			<li><A HREF="../accueil_forum.html"><p>ACCUEIL</p></A></li>
			<li><A HREF="../2-forum/forum.php"><p>FORUM</p></A></li>
			<li><A HREF="../1-connexion_forum/connexion.php"><p>SE CONNECTER</p></A></li>
			<li><A HREF=""><p>S'INSCRIRE</p></A></li>
		</ul>
	</div>
	<p class="text" align="center">Le forum des passionnés de photo</p>
	<p class="titre" align="center">FlashClub-</p>
	<div class="inscription" align="center">
	<img class="photo" src="../images/photo.png"/>
		<h2 class="titre2">Inscription</h2>
		<br/><br/>
		<div class="col-12">
			<form class="formu" method="POST" action="">
				<table>
					<tr>
						<td align="right">
							<label for="pseudo"></label>
						</td>
						<td>
							<input class="texte" type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; }?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail"></label>
						</td>
						<td>
							<input class="texte" type="email" placeholder="Mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; }?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail2"></label>
						</td>
						<td>
							<input class="texte" type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; }?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp"></label>
						</td>
						<td>
							<input class="texte" type="password" placeholder="Mot de passe" id="mdp" name="mdp"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp2"></label>
						</td>
						<td>
							<input class="texte" type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2"/>
						</td>
					</tr>
				</table>
				<hr/>
				<br/>
				<?php
					if(isset($erreur))
					{
						echo '<div class="error404">'.$erreur."</div>";
					}
					if (isset($valide))
					{
						echo '<div class="valide">'.$valide."</div>";
					}
				?>	
				<input class="inscrist" type="submit" name="forminscription" value="Je m'inscris"/><br/>
			</form>
		</div>
	</div>
	</body>
	<footer class="col-12">
	<p class="copi">Copyright 2018 ©</p>
		<div class="diap2S">
			<A HREF="https://twitter.com/Rikami7"><img class="diap2" src="../images/twi.png"/></A>
			<A HREF="https://github.com/"><img class="diap2" src="../images/git.png"/></A>
			<A HREF="https://www.facebook.com/"><img class="diap2" src="../images/fb2.png"/></A>
		</div>
	</footer>
</html>