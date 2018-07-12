<?php
session_start();
header("Location: profil.php?id=".$_SESSION['id']);
?>