<?php
require('../controller/frontend.php');
    try {

        loadClass('Character.php');
        loadClass('CharacterManager.php');
        listCharacter();


    }
    catch(Exception $e) { // S'il y a eu une erreur, alors...
        echo 'Erreur : ' . $e->getMessage();
    }