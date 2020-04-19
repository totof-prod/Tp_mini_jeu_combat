<?php

function loadClass($class){
    require '../model/' . $class;
}
spl_autoload_register('loadClass');



function listCharacter(){

    $db = new Manager();
    $db = $db->dbConnect();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $manager = new CharacterManager($db);
    $persos = $manager->getList();

    $persosName1 = $persos[0]->getName();
    $persosName2 = $persos[1]->getName();
    $persosName3 = $persos[2]->getName();

    $persoStrong1 = $persos[0]->getStrongCharacter();
    $persoStrong2 = $persos[1]->getStrongCharacter();
    $persoStrong3 = $persos[2]->getStrongCharacter();

    $persoDamage1 = $persos[0]->getDamages();
    $persoDamage2 = $persos[1]->getDamages();
    $persoDamage3 = $persos[2]->getDamages();

    $persolevel1 = $persos[0]->getlevel();
    $persolevel2 = $persos[1]->getlevel();
    $persolevel3 = $persos[2]->getlevel();

    require '../view/frontend/persoListView.php';
}
