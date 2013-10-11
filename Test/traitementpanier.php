<?php
session_start();

if (!isset($_SESSION['passage'])) {
    $_SESSION['passage'] = 0;
}
if (isset($_POST['valider'])) {
    if ($_SESSION['passage'] == 0) {
        /* Initialisation du panier */
        $_SESSION['panier'] = array();
        /* Subdivision du panier */
        $_SESSION['panier']['refprod'] = array();
        $_SESSION['panier']['quantite'] = array();
    }
    //Insertion panier
    $_SESSION['panier']['refprod'][$_SESSION['passage']] = $_SESSION['prod'];
    $_SESSION['panier']['quantite'][$_SESSION['passage']] = $_POST['quantite'];
    $_SESSION['passage'] = $_SESSION['passage'] + 1;
}
header("Location:panier.php");
?> 