
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title>Araydis</title>

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/foundation.css">

        <script src="js/vendor/custom.modernizr.js"></script>
        <script src="./js/jquery1.2.1.js"></script>
        <script src="./js/jqueryv1.10.1.js"></script>


    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">

                <?php
                require_once("menu.php");
                require_once("connection.php");

                $bdd = connect_db();

                $req = $bdd->prepare('SELECT refProduit, nom, description, Prix, idMarque, photo FROM produit');
                $req->execute() or die(print_r($req->errorInfo()));
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
                $taille = $req->rowCount();
                ?>

                <div class="row">

                    <!-- Side Bar -->

                    <div class="large-4 columns">

                        <img src="img/boutique.jpg">

                        <div class="hide-for-small panel">
                            <h3>Boutique</h3>
                            <h5 class="subheader">La boutique permet de visualiser les produits mise en vente par la société, elle permet également d'en acheter.
                            </h5>
                        </div>

                        <a href="#">
                            <div class="panel callout radius">
                                <h6><?php echo $taille . ' produits dans la liste' ?></h6>
                            </div>
                        </a>

                    </div>

                    <!-- End Side Bar -->


                    <!-- Thumbnails -->

                    <div class="large-8 columns">
                        <div class="row">
                            <?php
                            do {
                                echo'  <div class="large-4 small-6 columns">
                <a href="produit.php?prod=' . $ligne['refProduit'] . '"><img src="' . $ligne['photo'] . '"></a>
                <div class="panel">
                  <h5>' . $ligne['nom'] . '</h5>
                  <h6 class="subheader">' . $ligne['Prix'] . '€</h6>
                  <a href="produit.php?prod=' . $ligne['refProduit'] . '"">Détails</a>
                </div>
              </div>';
                            } while (($ligne = $req->fetch(PDO::FETCH_ASSOC)))
                            ?>

                        </div>
                    </div>
                </div>


                <!-- Footer -->

                <footer class="row">
                    <div class="large-12 columns"><hr />
                        <div class="row">

                            <div class="large-6 columns">
                                <p>&copy; Copyright no one at all. Go to town.</p>
                            </div>
                        </div>
                    </div>
                </footer>

                <!-- End Footer -->

                <!-- Map Modal -->

                <div class="reveal-modal" id="mapModal">
                    <h4>Vitre en verre</h4>
                    <p>Vitre 100% française fabriqué avec un verre de qualité</p>
                    <img src="img/vitreverre.png" width="300" height="300">

                    <!-- Any anchor with this class will close the modal. This also inherits certain styles, which can be overriden. -->
                    <a href="#" class="close-reveal-modal">&times;</a>
                </div>

                <!-- End Map Modal -->

            </div>
        </div>

        <script>
            document.write('<script src=js/vendor/' +
                    ('__proto__' in {} ? 'zepto' : 'jquery') +
                    '.js><\/script>')
        </script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
        <!-- End Footer -->

    </body>
</html>
