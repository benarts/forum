<?php
session_start();
require('../php/config.php'); /* Contient la connexion à la base de donnée $bdd */

/* Traitement du formulaire de création de Topic */
if(isset($_SESSION['id'])) {
   if(isset($_POST['tsubmit'])) {
      if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
         $sujet = htmlspecialchars($_POST['tsujet']);
         $contenu = htmlspecialchars($_POST['tcontenu']);
         if(!empty($sujet) AND !empty($contenu)) {
            if(strlen($sujet) <= 70) {
               $ins = $bdd->prepare('INSERT INTO f_topics (id_createur, sujet, contenu, date_creation) VALUES(?,?,?,NOW())');
               $ins->execute(array($_SESSION['id'],$sujet,$contenu,));
			   header("Location: ../2-forum_connecte/forum.php");
            } else {
               $error404 = "Votre sujet ne peut pas dépasser 70 caractères";
            }
         } else {
            $error404 = "Veuillez compléter tous les champs";
         }
      }
   }
} else {
   header("Location: ../1-connexion_forum/connexion.php");
}

require('nouveau_post_aff.php'); /* Appel du fichier "vue" de notre page */
?>