<?php
session_start();
require('../php/config.php'); /* Contient la connexion à la $bdd */
if(isset($_POST['formconnexion'])){
	$mailconnect = ($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(isset($_POST['mailconnect'])AND !empty($_POST['mdpconnect']))
	{
		$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));//la fonction execute
		$userexist = $requser->rowCount();//rowCount sert a compter le mbr de colonne qui y a dans la bdd
		if($userexist == 1){

			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail'];
			header("Location: ../2-forum_connecte/forum.php");
		}
		else{
			$erreur ="Mot de passe ou mail incorrect!";
		}
	}
	else{
		$erreur ="Tous les champ doivent être complétés !";
	}
}
?>
<html>
    <head>
		<title>Connexion</title>
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
			height:15em;
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
			<li><A HREF=""><p>SE CONNECTER</p></A></li>
			<li><A HREF="../1-inscription_forum/inscription.php"><p>S'INSCRIRE</p></A></li>
		</ul>
	</div>
	<p class="text" align="center">Le forum des passionnés de photo</p>
	<p class="titre" align="center">FlashClub-</p>
	<div class="inscription" align="center">
	<img class="photo" src="../images/photo.png"/>
		<h2 class="titre2">Connexion</h2>
		<br/><br/>
		<div class="col-12">
			<form class="formu" method="POST" action="">
				<table>
					<tr>
						<td>
							<input class="texte" type="email" placeholder="Mail" id="mail" name="mailconnect" />
						</td>
					</tr>
					<tr>
						<td>
							<input class="texte" type="password" placeholder="Mot de passe" id="mail" name="mdpconnect"/>
						</td>
				</table>
				<hr/>
				<br/>
				<?php
					if(isset($erreur))
					{
						echo '<div class="error404">'.$erreur."</div>";
					}
				?>	
				<input class="inscrist" type="submit" name="formconnexion" value="Se connecter"/><br/>
			</form>
		</div>
	</div>
	</body>
	<footer class="col-12">
	<p class="copi">Copyright 2018 ©</p>
		<div class="diap2S">
			<A HREF="https://twitter.com/"><img class="diap2" src="../images/twi.png"/></A>
			<A HREF="https://github.com/"><img class="diap2" src="../images/git.png"/></A>
			<A HREF="https://www.facebook.com/"><img class="diap2" src="../images/fb2.png"/></A>
		</div>
	</footer>
</html>