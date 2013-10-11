
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title>Araydis</title>

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/foundation.css">
        <link rel="stylesheet" href="css/text.css">

        <script src="js/vendor/custom.modernizr.js"></script>

    </head>
    <body>


        <!-- Header and Nav -->

        <?php
        require_once("menu.php");
        require_once("connection.php");
        ?>

        <!-- End Header and Nav -->


        <div class="row">    

            <!-- Main Content Section -->
            <!-- This has been source ordered to come first in the markup (and on small devices) but to be to the right of the nav on larger screens -->
            <div class="large-9 push-3 columns">

                <h3 style="text-align:center">Produit</h3>
                <div id="content">
                    <?php
                    $bdd = connect_db();

                    $prod = $_GET['prod'];

                    if (isset($prod) && $prod != "") {
                        $reqprod = $bdd->prepare('SELECT * FROM Produit WHERE refProduit =' . $prod);
                        $reqprod->execute() or die(print_r($reqprod->errorInfo()));
                        $ligne = $reqprod->fetch(PDO::FETCH_ASSOC);

                        $reqprod = $bdd->prepare('SELECT * FROM Marque WHERE idMarque =' . $ligne['idMarque']);
                        $reqprod->execute() or die(print_r($reqprod->errorInfo()));
                        $marque = $reqprod->fetch(PDO::FETCH_ASSOC);

                        $reqnote = $bdd->prepare('SELECT * FROM Note WHERE idProd =' . $prod);
                        $reqnote->execute() or die(print_r($reqnote->errorInfo()));
                        $ligne2 = $reqnote->fetch(PDO::FETCH_ASSOC);

                        $_SESSION['prod'] = $prod;
                    
                        if ($ligne != "") {
                            echo '<h2>Descriptif du produit ' . $ligne['nom'] . '</h2><br>';

                            echo '<p>' . $ligne['description'] . '</p>';
                            if (isset($_SESSION['OnEstConnecte']))
                                {
                                    echo '<div id="cadreformulaire">';
                            echo "<form name='quantite' method='POST' action='traitementpanier.php'>
                        <label for='quantite'>Quantité : </label><input type='text' name='quantite'/>
                        <input type='submit' name='valider' value='Ajouter au Panier' class='bouton'/></br>
                        </form>";
                            echo '</div>';
                                }
                            else
                                echo '<p>Connectez vous pour pouvoir acheter.</p>';

                            if (isset($_SESSION['OnEstConnecte']))
                            {
                                $user = $_SESSION['id'];
                                //L'utilisateur a t'il déja voté?
                                $req = $bdd->prepare('SELECT user FROM Note WHERE user = "' . $user . '" AND idProd = "'.$prod.'";');
                                $req->execute() or die(print_r($req->errorInfo()));
                                $vote = $req->fetch(PDO::FETCH_ASSOC);

                                //L'utilisateur n'a pas voté, on montre le formulaire
                                if($vote == 0 && !isset($_POST['ok']))
                                {
                                    echo '<form name="vider" method="POST" action="produit.php?prod='.$prod.'">
                                        <select name="note" size="1">
                                            <option value="0">0
                                            <option value="1">1
                                            <option value="2">2
                                            <option value="3">3
                                            <option value="4">4
                                            <option value="5">5
                                            <option value="6">6
                                            <option value="7">7
                                            <option value="8">8
                                            <option value="9">9
                                            <option value="10">10
                                            <input type="submit" name="ok" value="Valider votre Note" class="bouton"/>
                                        </select>
                                    </form>     ';
                                }   
                             
                                //Si action de valider et que la note est différent de vide
                                if(isset($_POST['ok']) && $_POST['note'] != NULL){
                                    //Note de l'utilisateur
                                    $note = $_POST['note'];
                                    //Insertion en BDD
                                    $insert = $bdd->prepare('INSERT INTO Note VALUES("","'.$note.'","'.$prod.'","'.$user.'")');
                                    $insert->execute() or die (print_r($insert->errorInfo()));
                                    //Tout est ok, on informe et on redirige
                                }
                            }

                            //Combien d'utilisateurs ont votés?
                            $req2 = $bdd->prepare('SELECT * FROM Note WHERE idProd = "' . $prod . '";');
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
                                $moyenne = number_format($totalnote/$total_vote, 2, ',', '');
                                //Si les 2 chiffres après la virgule sont 2 zéros, on les suppriment pour obtenir un entier
                                echo 'Note : '.str_replace(',00','',$moyenne).'/10';
                            }
                            else{
                                echo '<p>Aucun vote pour le moment.</p>';
                            }

                            echo '<h2>Avis pour ' . $ligne['nom'] . '</h2><br>';


                            $reqcom = $bdd->prepare('SELECT * FROM commentaire WHERE idProd =' . $prod);
                            $reqcom->execute() or die(print_r($reqcom->errorInfo()));
                            $ligne3 = $reqcom->fetch(PDO::FETCH_ASSOC);
                            if ($ligne3 != "") {
                                echo '<table border>';
                                echo '<tr>';
                                echo '<td> Pseudo </td>';
                                echo '<td> Commentaire </td>';
                                echo '<td> Date </td>';
                                echo '</tr>';
                                do {
                                    $reqcli = $bdd->prepare('SELECT nom, prenom FROM Client WHERE idclient =' . $ligne3['idClient']);
                                    $reqcli->execute() or die(print_r($reqcli->errorInfo()));
                                    $ligne4 = $reqcli->fetch(PDO::FETCH_ASSOC);

                                    $newDate = date("d-m-Y", strtotime($ligne3["date"]));
                                    $pseudo = $ligne4['prenom'] . " " . $ligne4['nom'];
                                    echo '<tr>';
                                    echo '<td>' . $pseudo . '</td>';
                                    echo '<td>' . $ligne3['Com'] . '</td>';
                                    echo '<td>' . $newDate . '</td>';
                                    echo '</tr>';
                                } while ($ligne3 = $reqcom->fetch(PDO::FETCH_ASSOC));
                            }
                            else
                                echo "Il n'y a pas de commentaire.";
                            echo '</table>';
                        }
                    }
                    echo '<div id="cadreformulaire">';

                    if (isset($_SESSION['OnEstConnecte'])) {
                        $log = $_SESSION['login'];
                        $reqcompte = $bdd->prepare('SELECT * FROM Client WHERE login="' . $log . '"');
                        $reqcompte->execute() or die(print_r($reqcompte->errorInfo()));
                        $ligne5 = $reqcompte->fetch(PDO::FETCH_ASSOC);

                        date_default_timezone_set('Europe/Paris');
                        $today = date("Y/m/d");
                        echo 'Rajouter un commentaire';
                        echo "<form name='comment' method='POST' action='produit.php?prod=" . $prod . "'>
	               		<input type='text' name='comment'/>
	               		<input type='submit' name='ajout' value='Ajouter' class='bouton'/></br>
	                	</form>";

                        if (isset($_POST['ajout'])) {
                            $comment = $_POST['comment'];
                            $req = $bdd->prepare('INSERT INTO Commentaire VALUES("","' . $comment . '","' . $ligne5['idClient'] . '","' . $prod . '","' . $today . '")');
                            $req->execute() or die(print_r($req->errorInfo()));
                        }
                        $reqcompte->closeCursor();
                    }
                    else
                        echo 'Connectez vous pour pouvoir rajouter un commentaire.';
                    echo '</div>';
                    ?>
                </div>
            </div>


            <!-- Nav Sidebar -->
            <!-- This is source ordered to be pulled to the left on larger screens -->
            <div class="large-3 pull-9 columns">
                <br>
                <br>
                <p>Voici les détails du produit ainsi que les avis le concernant.</p>

<?php
echo '<p><img src="' . $ligne['photo'] . '"/></p>';
echo '<h3>' . $marque['libelleMarque'] . '</h3>';
echo '<h3>' . $ligne['prix'] . '€</h3>';
?>

            </div>

        </div>


        <!-- Footer -->

        <footer class="row">
            <div class="large-12 columns">
                <hr />
                <div class="row">
                    <div class="large-6 columns">
                        <p>&copy; Copyright no one at all. Go to town.</p>
                    </div>
                </div>
            </div> 
        </footer>
        <script>
            document.write('<script src=js/vendor/' +
                    ('__proto__' in {} ? 'zepto' : 'jquery') +
                    '.js><\/script>')
        </script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>