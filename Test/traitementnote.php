<?php
    require_once("connection.php");
    $bdd = connect_db();
    session_start();
    $user = $_SESSION['id'];
    $prod = $_SESSION['prodnote'];

    //L'utilisateur a t'il déja voté?
    $req = $bdd->prepare('SELECT user FROM Notes WHERE user = "' . $user . '";');
    $req->execute() or die(print_r($req->errorInfo()));
    $vote = $req->fetch(PDO::FETCH_ASSOC);

 
    //L'utilisateur n'a pas voté, on montre le formulaire
    if($user == 0)
    {
        echo '     <form name="monform" id="monform" method="post">     <label>Noter cet article</label>     <select name="note" onchange="javascript:submit(this)">     <option value="">Note</option>     <option value="0">0</option>        <option value="1">1</option>     <option value="2">2</option>     <option value="3">3</option>     <option value="4">4</option>     <option value="5">5</option>     <option value="6">6</option>     <option value="7">7</option>     <option value="8">8</option>     <option value="9">9</option>     <option value="10">10</option>     </select>     </form>     ';
    }   
 
    //Si action de valider et que la note est différent de vide
    if(isset($_POST['note']) && $_POST['note'] != NULL){
        //On vérifie si le cookie existe et si tel est le cas, c'est que l'utilisateur tente de voter plusieurs fois
        if(isset($_COOKIE["deja_voter"]) && $_COOKIE["deja_voter"] == $id_vote){
            die ("Un seul vote autorisé ... merci!");
        }
        //Note de l'utilisateur
        $note = $_POST['note'];
        //Insertion en BDD
        $insert = $bdd->prepare('INSERT INTO Notes VALUES("","'.$note.'","'.$prod.'","'.$user.'")');
        $insert->execute() or die (print_r($insert->errorInfo()));
        //Tout est ok, on informe et on redirige
    }
 
    //Combien d'utilisateurs ont votés?
    $req2 = $bdd->prepare('SELECT * FROM Notes WHERE idProd = "' . $prod . '";');
    $req2->execute() or die(print_r($req3->errorInfo()));
    $nbvote = $req2->fetch(PDO::FETCH_ASSOC);
    $total_vote = $req2->rowCount();

    //Total des votes des utilisateurs
    $req3 = $bdd->prepare('SELECT SUM(note) AS totalmoyenne FROM note WHERE idProd = "' . $prod . '";');
    $req3->execute() or die(print_r($req3->errorInfo()));
    $data = $req3->fetch(PDO::FETCH_ASSOC);

    $totalnote= $data['totalmoyenne'];
 
    //Moyenne des votes des utilisateurs
    if($total_vote != NULL && $totalnote != NULL){
        $moyenne = number_format($total_calcul_vote/$total_vote, 2, ',', '');
        //Si les 2 chiffres après la virgule sont 2 zéros, on les suppriment pour obtenir un entier
        echo 'Note : '.str_replace(',00','',$moyenne).'/10';
        //On affiche les étoiles
    }
    else{
        echo 'Aucun vote pour le moment.';
    }
?>