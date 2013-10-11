 

<!-- Header and Nav -->

<div class="row">
    <div class="large-3 columns">
        <h1><img src="./img/logo.png"></h1>
    </div>
    <div class="large-9 columns">
        <ul class="button-group right">
            <li><a href="./index.php" class="button">Accueil</a></li>
            <li><a href="./store.php" class="button">Produits</a></li>
            <li><?php
                //On test si l'utilisateur est connecté, s'il est connecté sa lui affiche Deconnexion sinon Connexion
                session_start();

                if (isset($_SESSION['OnEstConnecte']))
                    echo '<a href="http://127.0.0.1/test/compte.php" class="button">Mon Compte</a>';
                else
                    echo '<a href="http://127.0.0.1/test/create_user.php" class="button">Inscription</a>';
                ?>
            </li>
            <li> 
                <?php
                if (isset($_SESSION['OnEstConnecte']))
                    echo '<a href="http://127.0.0.1/test/delogin.php" class="button">Deconnexion</a>';
                else
                    echo '<a href="http://127.0.0.1/test/login.php" class="button">Connexion</a>';
                ?>
            </li>
        </ul>
        </ul>
    </div>
</div>

<!-- End Header and Nav -->
