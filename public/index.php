<?php
require('../controller/frontend.php');
    try {
        if(empty($_SESSION['perso'])&& empty($_GET['action'] == 'use')){
           createCharacter();
        }
        if($_GET['action'] == 'use'){
            useCharacter();
        }
        if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
        {
            hitCharacter();
        }

    }
    catch(Exception $e) { // S'il y a eu une erreur, alors...
        echo 'Erreur : ' . $e->getMessage();
    }