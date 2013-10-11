
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
        <link rel="stylesheet" href="css/global.css">

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
            <?php
                $bdd = connect_db();

                $log = $_SESSION['login'];


                $reqcompte = $bdd->prepare('SELECT * FROM Client WHERE login="' . $log . '"');
                $reqcompte->execute() or die(print_r($reqcompte->errorInfo()));
                $ligne = $reqcompte->fetch(PDO::FETCH_ASSOC);

                $newDate = date("d-m-Y", strtotime($ligne["datenaiss"]));
            
            echo"<!-- Main Content Section -->
            <!-- This has been source ordered to come first in the markup (and on small devices) but to be to the right of the nav on larger screens -->";
            echo'<div class="large-9 push-3 columns">';
                    echo'<section id="left"> 
            <div id="userStats" class="clearfix">
                <div class="pic">
                    <span id="aa"><img src="img/user_avatar.jpg" width="150" height="150" /></span>
                </div>
                
                <div class="data">';
                    echo'<h10>' . $ligne['nom'] . ' ' . $ligne['prenom'] . '</h10><br>';
                    echo'<h15>' . $ligne['ville'] . ', FR</h15><br>';
                    echo'<h20><a href="mailto:' . $ligne['mail'] . '">' . $ligne['mail'] . '</a></h20>';
            echo'</div>';
                
                echo'<div class="data2">';
                    echo'<h10>A propos de moi:</h10>
                                <p>';
                                     echo'<h8> <b>Login :</b> ' . $ligne['login'] . '</h8><br>  ';           
                                     echo'<h8> <b>Adresse :</b> ' . $ligne['adresse'] . '</h8><br> ';
                                     echo'<h8> <b>Code Postal</b> : ' . $ligne['CP'].' </h8><br>';
                                     echo'<h8> <b>Téléphone :</b>' . $ligne['tel'] . ' </h8><br>';

                               echo' </p>';
            ?>
            </section>
                

               
                <!--
                if ($ligne != "") {
                    echo 'Nom :               ' . $ligne['nom'] . '<br>';
                    echo 'Prénom :            ' . $ligne['prenom'] . '<br>';
                    echo 'Date de Naissance : ' . $newDate . '<br>';
                    echo 'Adresse :           ' . $ligne['adresse'] . '<br>';
                    echo 'Code Postal :       ' . $ligne['CP'] . '<br>';
                    echo 'Ville :             ' . $ligne['ville'] . '<br>';
                    echo 'Téléphone :         ' . $ligne['tel'] . '<br>';
                    echo 'Login :             ' . $ligne['login'] . '<br>';
                    echo 'E-Mail :            ' . $ligne['mail'] . '';
                }
                ?>-->
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

                <p><img src="img/compte.png" /></p>

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
