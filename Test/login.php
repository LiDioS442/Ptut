
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

                <h3 style="text-align:center">Inscription</h3>

                <?php
                echo '<div id="cadreformulaire">';

                //Formulaire
                echo "<form name='ajout' method='POST' class='formulaire' action='login.php'>
		        		<label for='Login'>Login : </label><input type='text' name='login'/>
		        		<label for='pass'>Mot de Passe : </label><input type='password' name='pwd'/>
		        		<input type='submit' name='Connexion' class='bouton' value='Connexion' class='bouton'/>
		    	 </form>";
                echo '<p><a href="MDPoublie.php">Mot de passe oublié?</a></p>';

                //La connexion est permise si le mot de passe et le login correspondent sinon on affiche un message d'erreur, la page est ensuite redirigé sur la liste de film
                if (isset($_POST['Connexion'])) {
                    $login = $_POST['login'];
                    $pwd = $_POST['pwd'];

                    $bdd = connect_db();
                    $req = $bdd->prepare('SELECT idClient, login, nom FROM Client WHERE login ="' . $login . '" AND pwd = "' . $pwd . '";');
                    $req->execute() or die(print_r($req->errorInfo()));
                    $reslogin = $req->fetch(PDO::FETCH_ASSOC);

                    if (isset($_POST['login']) && isset($_POST['pwd']) && $reslogin != "") {

                        $_SESSION['login'] = $login;
                        $_SESSION['id'] = $reslogin['idClient'];
                        $_SESSION['nom'] = $reslogin['nom'];
                        $_SESSION['OnEstConnecte'] = 'TRUE';

                        setcookie("Login", $login, time() + 1200);
                        setcookie("Nom", $reslogin['login'], time() + 1200);

                        header('Location: http://127.0.0.1/test/store.php?');
                    } else {
                        echo "<h3>Nom de compte ou mot de passe incorrect !</h3>";
                    }
                }
                echo '</div>';
                ?>
            </div>


            <!-- Nav Sidebar -->
            <!-- This is source ordered to be pulled to the left on larger screens -->
            <div class="large-3 pull-9 columns">
                <br>
                <br>
                <p>Pour pouvoir acheter un produit veuillez vous connectez, si vous avez oublié votre mot de passe suivez les instructions.</p>

                <p><img src="img/login.jpg" /></p>

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