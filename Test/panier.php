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

                <h3 style="text-align:center">Mon Profil</h3>

                <?php
                $bdd = connect_db();
                if (isset($_SESSION['panier'])) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<td> Référence Produit </td>';
                    echo '<td> Nom</td>';
                    echo '<td> Quantité </td>';
                    echo '<td> Prix Unitaire</td>';
                    echo '<td> Prix Total</td>';
                    echo '<td> Enlever du panier</td>';
                    echo '</tr>';
                    $i = 0;

                    do {
                        $req = $bdd->prepare('SELECT * FROM produit WHERE refProduit =' . $_SESSION['panier']['refprod'][$i]);
                        $req->execute() or die(print_r($req->errorInfo()));
                        $ligne = $req->fetch(PDO::FETCH_ASSOC);

                        echo '<tr>';
                        echo '<td>' . $_SESSION['panier']['refprod'][$i] . '</td>';
                        echo '<td>' . $ligne['nom'] . '</td>';
                        echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                        echo '<td>' . $ligne['prix'] . '</td>';
                        echo '<td>' . $ligne['prix'] * $_SESSION['panier']['quantite'][$i] . '</td>';
                        echo '<td Align=center><a href="traitementsupprpanier.php"><img src="img/close.gif"/></a></td>';
                        echo '</tr>';
                        $i = $i + 1;
                    } while ($i != $_SESSION['passage']);
                }
                else
                    echo "Vous n'avez rien dans votre panier";
                echo '</table>';

                echo "<form name='vider' method='POST' action='panier.php'>
              <input type='submit' name='vide' value='Vider le Panier' class='bouton'/>";
                echo '<div id="cadrebouton">';
                echo "<input type='submit' name='valider' value='Valider votre Commande' class='bouton'/>
              </form>";
                echo '</div>';

                if (isset($_POST['vide'])) {
                    $vide = false;
                    unset($_SESSION['prod']);
                    unset($_SESSION['panier']);
                    unset($_SESSION['panier']);
                    unset($_SESSION['passage']);
                    if (!isset($_SESSION['panier'])) {
                        $vide = true;
                    }
                }
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

                <p><img src="img/panier.jpg" /></p>

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