
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

        <script src="./js/vendor/custom.modernizr.js"></script>
        <script src="./js/jquery1.2.1.js"></script>
        <script src="./js/jqueryv1.10.1.js"></script>

    </head>
    <body>

        <?php
        require_once("menu.php");
        require_once("connection.php");
        ?>


        <!-- Main Page Content and Sidebar -->

        <div class="row">

            <!-- Contact Details -->
            <div class="large-9 columns">

                <h3>Restons en contact !</h3>
                <p>Cette page est consacré à toutes les questions qui sont susceptibles de vous traverser l'esprit, 
                    qu'elles soient techniques ou non, nous serions très heureux de pouvoir y répondre, nous restons à votre disposition toute <em>la journée</em>.</p>

                <div class="section-container auto" data-section>
                    <section class="section">
                        <h5 class="title"><a href="#panel1">Contactez notre société</a></h5>
                        <div class="content" data-slug="panel1">
                            <?php
                            echo '<form name="create" method="POST" action="contact.php">
              <div class="row collapse">
                <div class="large-2 columns">
                  <label class="inline">Votre nom</label>
                </div>
                <div class="large-10 columns">
                  <input type="text" name="name" placeholder="Jordan Thé">
                </div>
              </div>
              <div class="row collapse">
                <div class="large-2 columns">
                  <label class="inline"> Votre mail</label>
                </div>
                <div class="large-10 columns">
                  <input type="text" name="email" placeholder="jordan.the@gmail.com">
                </div>
              </div>
              <label>Message</label>
              <textarea rows="4" name="sujet"></textarea>
              <button type="submit" name="valider" class="radius button">Valider</button>
            </form>';

                            if (isset($_POST['valider'])) {
                                $nom = $_POST["name"];
                                $mail = $_POST["email"];
                                $sujet = $_POST["sujet"];
                                if (!empty($nom) && !empty($mail) && !empty($sujet)) {
                                    if (chercherarobase($mail) == 'True') {
                                        $bdd = connect_db();
                                        $req2 = $bdd->prepare('INSERT INTO Contact VALUES("","' . $nom . '","' . $mail . '","' . $sujet . '")');
                                        $req2->execute() or die(print_r($req2->errorInfo()));

                                        echo "Le message a bien été envoyé.";
                                    }
                                    else
                                        echo "Adresse mail non valide.";
                                }
                                else
                                    echo "Veuillez réessayez!";
                            }

                            function chercherarobase($mail) {
                                $trouve_moi = '.';
                                if ($position = strpos($mail, $trouve_moi)) {
                                    return TRUE;
                                } else {
                                    return FALSE;
                                }
                            }
                            ?>



                        </div>
                    </section>

                </div>
            </div>

            <!-- End Contact Details -->


            <!-- Sidebar -->


            <div class="large-3 columns">
                <h5>Carte</h5>
                <!-- Clicking this placeholder fires the mapModal Reveal modal -->
                <p>
                    <a href="" data-reveal-id="mapModal"><img src="img/map1.jpg"></a><br />
                    <a href="" data-reveal-id="mapModal">Regardez sur la carte</a>
                </p>
                <p>
                    <strong><u>Adresse de l'entreprise:</u></strong></br>
                    9 La Platière</br>
                    42320 Grand Croix</br>
                    <strong><u>Adresse du siège sociale:</u></strong></br>
                    2125 Route de Couttange</br>
                    42320 Grand Croix
                </p>
            </div>
            <!-- End Sidebar -->
        </div>

        <!-- End Main Content and Sidebar -->


        <!-- Footer -->

        <footer class="row">
            <div class="large-12 columns">
                <hr />
                <div class="row">
                    <div class="large-6 columns">
                        <p>&copy; Copyright 2013. Developped by A&J.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- End Footer -->



        <!-- Map Modal -->

        <div class="reveal-modal" id="mapModal">
            <h4>Where We Are</h4>
            <p>L'adresse de notre dépot</p>
            <img src="img/map2.png" >

            <!-- Any anchor with this class will close the modal. This also inherits certain styles, which can be overriden. -->
            <a href="#" class="close-reveal-modal">&times;</a>
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

    </body>
</html>
