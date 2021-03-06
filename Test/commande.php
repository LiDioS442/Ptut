
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
        if (($_SESSION['OnEstConnecte'])==false)
            {
                header('Location:create_user.php');
            }
        ?>

        <!-- End Header and Nav -->


        <div class="row">    

            <!-- Main Content Section -->
            <!-- This has been source ordered to come first in the markup (and on small devices) but to be to the right of the nav on larger screens -->
            <div class="large-9 push-3 columns">

                <h3 style="text-align:center">Mes Commandes en cours</h3>

                <?php
                $bdd = connect_db();

                $log = $_SESSION['login'];


                $reqcompte = $bdd->prepare('SELECT * FROM Client WHERE login="' . $log . '"');
                $reqcompte->execute() or die(print_r($reqcompte->errorInfo()));
                $ligne1 = $reqcompte->fetch(PDO::FETCH_ASSOC);

                $reqcom = $bdd->prepare('SELECT Commande.idCommande, nom, prix, dateCommande, Statut FROM commande, composer, produit WHERE commande.idCommande = composer.idCommande AND composer.refProduit = produit.refProduit AND Statut="1" AND idClient ="' . $ligne1['idClient'].'"');
                $reqcom->execute() or die(print_r($reqcom->errorInfo()));
                $ligne2 = $reqcom->fetch(PDO::FETCH_ASSOC);


                if ($ligne2 != "") {
                    echo '<table border>';
                    echo '<tr>';
                    echo '<td> Numéro Commande </td>';
                    echo '<td> Produit(s) </td>';
                    echo '<td> Date</td>';
                    echo '<td> Prix Total</td>';
                    echo '</tr>';
                    do {
                        $newDate = date("d-m-Y", strtotime($ligne2["dateCommande"]));
                        $v = 0;
                        echo '<tr>';
                        if($ligne2['idCommande'] != $v)
                            echo '<td>' . $ligne2['idCommande'] . '</td>';
                        else
                            echo '<td>' . $ligne2['idCommande'] . '</td>';
                        echo '<td>'. $ligne2['nom'].'</td>';
                        echo '<td>' . $newDate . '</td>';
                        echo '<td>Trouve aussi une solution xD</td>';
                        echo '</tr>';

                        $v = $ligne2['idCommande'];
                    } while ($ligne2 = $reqcom->fetch(PDO::FETCH_ASSOC));
                }
                else
                    echo "Vous n'avez pas de fait de commande.";
                echo '</table>';
                ?>


            </div>


            <!-- Nav Sidebar -->
            <!-- This is source ordered to be pulled to the left on larger screens -->
            <div class="large-3 pull-9 columns">

                <ul class="side-nav">
                    <li><a href="compte.php">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="commande.php">Commande en Cours</a></li>
                    <li><a href="historique.php">Historique</a></li>
                    <li><a href="commentaire.php">Mes commentaires</a></li>
                </ul>

                <p><img src="img/commande.jpg" /></p>

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
