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
        ?>

        <!-- First Band (Slider) -->

        <div class="row">
            <div class="large-12 columns">
                <ul data-orbit>
                    <li><img src="img/Galerie1.png" style="margin: 0 auto;"/></li>
                    <li><img src="img/Galerie2.jpg" style="margin: 0 auto;"/></li>
                    <li><img src="img/Galerie3.jpg" style="margin: 0 auto;"/></li>
                    <li><img src="img/Galerie4.jpg" style="margin: 0 auto;"/></li>
                </ul>
                <!-- <div id="slider">
                  
                </div> -->

                <hr />
            </div>
        </div>

        <!-- Three-up Content Blocks -->

        <div class="row">
            <div class="large-4 columns">
                <img src="img/pres1.jpg" />
                <h4>Société Araydis</h4>
                <p>La société ARAYDIS, vous propose des solutions pour l'aménagement de vos espaces de travail (rayonnages, cloisons, plateformes...) et des équipements (bacs plastique, armoires, vestiaires, établis...). Nous intervenons essentiellement sur le marché de l'industrie, de la logistique et de </p>
            </div>

            <div class="large-4 columns">
                <img src="img/pres2.jpg" />
                <h4>Un savoir-faire</h4>
                <p>la grande distribution. Aujourd'hui plus de 600 clients nous font confiance, avec quelques références comme le groupe SEB, Bridgestone, Harley Davidson, les magasins Leclercs... Notre équipe est à votre disposition, pour tous renseignements complémentaires.</p>
            </div>

            <div class="large-4 columns">
                <img src="img/pres3.jpg" />
                <h4>Spécificités</h4>
                <p>La Sarl ARAYDIS, livre dans toute la France, et nos équipes de montages sont à votre disposition. Nous sommes situés en région Rhône-Alpes, à proximité de Saint-Etienne dans la Loire (42).</p>
            </div>

        </div>

        <!-- Call to Action Panel -->
        <div class="row">
            <div class="large-12 columns">

                <div class="panel">
                    <h4>Restons en contact !</h4>

                    <div class="row">
                        <div class="large-9 columns">
                            <p>Nous serions heureux de pouvoir répondre à vos questions.</p>
                        </div>
                        <div class="large-3 columns">
                            <a href="./contact.php" class="radius button right">Contactez-nous</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

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