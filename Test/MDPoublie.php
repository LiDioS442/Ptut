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
        <link rel="stylesheet" href="css/text.css">

        <script src="js/vendor/custom.modernizr.js"></script>

    </head>
    <body>

        <?php
        require_once("menu.php");
        require_once("connection.php");
        ?>

        <?php
        echo '<div id="cadreformulaire">';

        //L'utilisateur peut ce créer son compte si il utilise le même mot de passe, que son mail est correcte et que le pseudo n'est pas déjà utilisé

        if (isset($_GET['succes'])) {
            $succes = $_GET['succes'];
            if ($succes == 'true')
                echo "<h3>Mot de Passe envoyé</h3>";
            else
                echo "<h3>Entrez une adresse mail valide. Merci de réesssayer</h3>";
        }
        echo "<p><strong><u>Mot de passe oublié</u></strong></p>
            <p>Pour récupérer votre mot de passe : veuillez saisir ci-dessous l'adresse courriel que vous utilisez pour vous connecter et validez ! </p> 
            <p> </p> 
            <form name='form1' method='post' action='traitementmdp.php'> 
                <label for='mail'>Adresse Email</label><input type='text' name='mail' > 
                <input type='submit' name='button' value='VALIDER'> 
            </form> 
            <p> </p>";
        if (isset($_POST['valider'])) {
            if (chercherarobase($mail) == 'True') {
                header('Location: traitementmdp.php');
            }
        }

        echo '</div>';

        //Fonction qui permet de chercher l'arobase dans le input
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
</body>
</html>