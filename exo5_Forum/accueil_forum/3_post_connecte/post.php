<?php
	session_start();
   	require('../php/config.php');
   	require('../php/fonction.php');
	
	//on check si le varible qui contient le titre du post defini ds accueil.aff.php exist
		if(isset($_GET['titre'])) {

			$titre = htmlspecialchars($_GET['titre']);
			$id = htmlspecialchars($_GET['id']);
			//on selectionne tous les champs avec lid selectionner par luser
			$post = $bdd->prepare('SELECT * FROM f_topics WHERE id = ?');
			//on place les champs dans un tablaeu
		    $post->execute(array($id));
		    $post = $post->fetch();

			$reponses = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ? ORDER BY id');
		    $reponses->execute(array($id));

			if(isset($_POST['submit'],$_POST['reponse'])) {

				$reponse = htmlspecialchars($_POST['reponse']);

				if(isset($_SESSION['id'])) {
					if(!empty($reponse)) {

					$ins = $bdd->prepare('INSERT INTO f_messages(id_topic, id_posteur, contenu, date_heure_post) VALUES (?,?,?,NOW())');
					$ins->execute(array($id, $_SESSION['id'], $reponse));

					$erreur = "OK! Votre reponse a bien etait poste!";
					$titre = htmlspecialchars($_GET['titre']);
					$id = htmlspecialchars($_GET['id']);
					//on selectionne tous les champs avec lid selectionner par luser
					$post = $bdd->prepare('SELECT * FROM f_topics WHERE id = ?');
					//on place les champs dans un tablaeu
				    $post->execute(array($id));
				    $post = $post->fetch();

				    $reponses = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ? ORDER BY id');
				    $reponses->execute(array($id));
					}
				}else {
					header('Location: ../1-connexion_forum/connexion.php');
				}
			}
			require('post_aff.php');
		}
?>