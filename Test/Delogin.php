<?php

//La page n'apparait pas elle deconnecte juste l'utilisateur
session_start();

require_once("connection.php");

setcookie('Login', "", time() + 1200);
$_SESSION = array();
session_destroy();

header('Location: index.php');
?>