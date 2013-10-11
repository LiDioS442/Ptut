<?php
require_once("connection.php");

$bdd = connect_db();
$req = $bdd->prepare('SELECT mail, pwd FROM Client WHERE mail ="' . $emailmember . '";');
$req->execute() or die(print_r($req->errorInfo()));
$result = $req->fetch(PDO::FETCH_ASSOC);


$emailmember = $_POST['mail'];
$emailadmin = "aurelien.souvignet@gmail.com";

if (empty($emailmember)) {
    header("Location:MDPoublie.php?succes=false");
} elseif ($result == NULL) {
    header("Location:MDPoublie.php?succes=false");
} else {
    $bdd = connect_db();
    $req = $bdd->prepare('SELECT mail, pwd FROM Client WHERE mail ="' . $emailmember . '";');
    $req->execute() or die(print_r($req->errorInfo()));
    $result = $req->fetch(PDO::FETCH_ASSOC);


    $passmember = $result['pwd'];
    $subjectmember = "Informations Personnelles";
    $textmember = "Bonjour, 
			Comme demandé, ci-dessous les informations quant à : 
			votre adresse courriel : " . $emailmember . "
			votre mot de passe : " . $passmember . "
			Cordialement, 
			L'équipe de site.ca";

    @mail("$emailmember", $subjectmember, $textmember, "FROM: $emailadmin");
    header("Location:login.php?succes=true");
}
?> 