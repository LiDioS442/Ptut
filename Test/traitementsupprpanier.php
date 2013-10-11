<?php
    session_start();

    $ref_article = $_GET['article'];
    function supprim_article2($ref_article, $reindex = true) 
    { 
        $suppression = false; 
        $aCleSuppr = array_keys($_SESSION['panier']['refprod'], $ref_article); 

        /* sortie la clé a été trouvée */ 
        if (!empty ($aCleSuppr)) 
        { 
            /* on traverse le panier pour supprimer ce qui doit l'être */ 
            foreach ($_SESSION['panier'] as $k=>$v) 
            { 
                foreach($aCleSuppr as $v1) 
                { 
                    unset($_SESSION['panier'][$k][$v1]);    // remplace la ligne foireuse 
                } 
                /* si la réindexation est indispensable pour la suite de l'appli, faire ici: */ 
                if($reindex == true) 
                { 
                    $_SESSION['panier'][$k] = array_values($_SESSION['panier'][$k]); 
                } 
                $suppression = true; 
            } 
        } 
        else 
        { 
            $suppression = "absent"; 
        } 
        return $suppression; 
    }
    echo $ref_article;
?> 