<?php
function get_pseudo($id) {
   global $bdd;
   $pseudo = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
   $pseudo->execute(array($id));
   $pseudo = $pseudo->fetch()['pseudo'];
   return $pseudo;
}
function get_avatar($id) {
   global $bdd;
   $pseudo = $bdd->prepare('SELECT avatar FROM membres WHERE id = ?');
   $pseudo->execute(array($id));
   $pseudo = $pseudo->fetch()['avatar'];
   return $pseudo;
}
?>