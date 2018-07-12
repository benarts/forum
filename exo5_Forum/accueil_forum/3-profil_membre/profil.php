<?php
session_start();

require('../php/config.php');
if(isset($_SESSION['id'])){
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
    <head>
		<title>Mon profil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="../images/icon.png">
		<link rel="stylesheet" href="css/profil.css">
		<link rel="stylesheet" href="css/mon_profil.css"> 
		<link rel="stylesheet" href="css/modifier_mon_profil.css">
		<link rel="stylesheet" href="css/menu.css"> 
    </head>
	<body >
	
		<div class="col-12">
			<div class="menu">
			</div>
			<div class="position" align="center">
			<ul class="profil">
				<li class="profil"><A><p>MON PROFIL</p></A></li>
			</ul>
			</div>
			<div class="position_menu" align="center">
				<ul class="menuS">
					<li class="menuS1" ><A HREF="../accueil_connecte/accueil_forum.html"><p>ACCUEIL</p></A></li>
					<li class="menuS1"><A HREF="../2-forum_connecte/forum.php"><p>FORUM</p></A></li>
					<li class="menuS1" ><A HREF="../1-deconnexion_forum/deconnexion.php"><p>SE DECONNECTER</p></A></li>
				</ul>
			</div>
			<div class="position2" align="center">
				<div class="diap2S">
					<A HREF="https://twitter.com/"><img class="diap2" src="../images/twi.png"/></A>
					<A HREF="https://github.com/"><img class="diap2" src="../images/git.png"/></A>
					<A HREF="https://www.facebook.com/"><img class="diap2" src="../images/fb2.png"/></A>
				</div>
			</div>
		</div>
		<p class="titre" align="center">FlashClub-</p>
		<div class="position3" align="center">
			<div class="mon_profil">
				<div class="position4">
				<p class="detaill1">NOM DE L'UTILISATEUR </p><br /> <p class="det1"><?php echo $userinfo['pseudo']; ?></p>
				<br />
				<p class="detaill2">EMAIL </p><br /> <p class="det2"><?php echo $userinfo['mail']; ?></p>
				<br />
				</div>
				<?php
				if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
				?>
				<?php
				}
				?>
			</div>
			<img class="photo_de_profil" src="../images/icon.png"/>
			<?php
			if(!empty($userinfo['avatar']))
			{
			?>
			<img class="photo_de_profil" src="membres/avatars/<?php echo $userinfo['avatar']; ?>" width="150"/>
			<?php					
			}
			?>
			<br>
			<div class="changer_profil">
				<ul class="changer_profil2">
					<li class="changer_profil2"><a href="editionprofil.php"><input class="inscrist" type="submit" name="submit" value="Modifier" /></a></li>
				</ul>
			</div>
		</div>
	</body>
</html>
<?php   
}
?>
<?php   
}else {
	header('Location: ../1-connexion_forum/connexion.php');
 }
?>