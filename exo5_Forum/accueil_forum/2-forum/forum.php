<?php
require('../php/config.php'); /* Contient la connexion à la $bdd */
$topics = $bdd->query('SELECT * FROM f_topics ORDER BY id');
require('forum_aff.php');
?>
