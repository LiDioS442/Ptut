
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

  <script src="js/jquery1.2.1.js"></script>
  <script src="js/jqueryv1.10.1.js"></script>
  <script src="js/func.js"></script>

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

            //L'utilisateur peut ce créer son compte si il utilise le même mot de passe, que son mail est correcte et que le pseudo n'est pas déjà utilisé
            if (isset($_POST['valider']))
            {
                $login=$_POST["login"];
                $pwd=$_POST["pwd"];
                $pwd2=$_POST["pwd2"];
                $mail=$_POST["mail"];
                $civ=$_POST["civilite"];
                $nom=$_POST["nom"];
                $prenom=$_POST["prenom"];
                $datenaiss=$_POST["datenaiss"];
                $adresse=$_POST["adresse"];
                $CP=$_POST["CP"];
                $ville=$_POST["ville"];
                $tel=$_POST["tel"];

                if ($_POST['pwd'] == $_POST['pwd2'])
                {
                    if (!empty($login) && !empty($pwd) && !empty($pwd2) && !empty($mail) && !empty($civ) && !empty($nom) && !empty($prenom) && !empty($adresse) && !empty($CP) && !empty($tel) && !empty($datenaiss))    
                        {
                        if (chercherarobase($mail) == 'True')
                        {
                            $bdd = connect_db();
                            $req3 = $bdd->prepare('SELECT login FROM Client WHERE login = "'.$login.'";');
                            $req3->execute() or die (print_r($req->errorInfo()));
                            $loginex = $req3->fetch(PDO::FETCH_ASSOC);

                            if( $loginex !=  "")
                                echo "<h3>Le login est déjà utilisé</h3>";
                            else {
                                $req = $bdd->prepare('SELECT mail FROM Client WHERE mail = "'.$mail.'";');
                                $req->execute() or die (print_r($req->errorInfo()));
                                $mailex = $req->fetch(PDO::FETCH_ASSOC);

                                if( $mailex !=  "")
                                    echo "<h3>L'adresse Mail est déjà utilisé</h3>";
                                else {
                                    $req2 = $bdd->prepare('INSERT INTO Client VALUES("","'.$nom.'","'.$prenom.'","'.$adresse.'","'.$CP.'","'.$tel.'","'.$mail.'","'.$login.'","'.$pwd.'","'.$ville.'","'.$civ.'","'.$datenaiss.'")');
                                    $req2->execute() or die (print_r($req2->errorInfo()));
                      
                                    echo "<h3>Le compte a bien été créé</h3>";
                                }
                            }
                        }
                        else
                            echo "<h3>Votre adresse mail n'est pas valide</h3>";
                        }
                    else
                        echo "<h3>Le formulaire est incomplet</h3>";
                    }
                else
                    echo "<h3>Mot de passe Incorrect</h3>";
            }

            echo "<form name='create' method='POST' action='create_user.php'>
            <label for='login'>Login : </label><input type='text' id='login' name='login'/>
            <span class='feedback'></span>
            <div id='loader'><img src='img/loader.gif'/></div>
            <label for='pwd'>Mot de passe : </label><input type='password' name='pwd'/>
            <label for='pwd2'>Répéter mot de passe : </label><input type='password' name='pwd2'/>
            <label for='mail'>Mail : </label><input type='text' name='mail'/><br>
            <label for='civ'>Votre civilité : </label><input type='radio' name='civilite' value='Mr' checked='checked'> M. 
            <input type='radio' name='civilite' value='Mlle'> Mlle
            <input type='radio' name='civilite' value='Mme'> Mme<br>
            <label for='nom'>Nom :</label><input type='text' name='nom'/>
            <label for='prenom'>Prénom : </label><input type='text' name='prenom'/><br>
            <label for='datenaiss'>Date de Naissance : </label><input type='date' name='datenaiss'/>";
            echo '</select><br/>';
            echo '<label for="adresse">Votre Adresse :</label><input type="text" name="adresse"/>
            <label for="CP">Code Postal : </label><input type="text" name="CP"/>
            <label for="ville">Ville :</label><input type="text" name="ville"/>
            <label for="tel">Mobile (+33 6) :</label><input type="text" name="tel"/>
            <input type="submit" name="valider" value="Valider" class="bouton"/></br>
            </form>';



            echo '</div>';

            //Fonction qui permet de chercher l'arobase dans le input
            function chercherarobase($mail){            
                $trouve_moi = '.';
                if ($position = strpos($mail, $trouve_moi))
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        ?>
    </div>
    
    
    <!-- Nav Sidebar -->
    <!-- This is source ordered to be pulled to the left on larger screens -->
    <div class="large-3 pull-9 columns">
    <br>
    <br>
    <p>Pour pouvoir acheter un produit veuillez vous enregistrez, remplissez tous les champs pour bien que votre inscription soit validée</p>
      
      <p><img src="img/inscription.jpg" /></p>
        
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
