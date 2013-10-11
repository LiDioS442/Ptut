<?php

require_once("connection.php");

if (isset($_POST['login']) && !empty($_POST['login'])) { //Vérification que le champs ne soit pas vide
    $log = $_POST['login'];                              //On récupère les données du champs

    $bdd = connect_db();                               //On se connecte à la Base de données

    $req = $bdd->prepare('SELECT * FROM Client WHERE login = "' . $log . '";');
    $req->execute() or die(print_r($req->errorInfo()));
    $ligne = $req->fetch(PDO::FETCH_ASSOC);            //On récupère les éléments de notre base de données
    $row = $req->rowCount();                           //$row contient le nombre de ligne récupéré dans la base de données

    if ($row == 1) {                                        //Si il y en a une ligne alors c'est que le login existe déjà sinon le pseudo est disponible
        echo "Ce pseudo n'est pas disponible";
    } else {
        echo "Pseudo disponible";
    }
}
?>