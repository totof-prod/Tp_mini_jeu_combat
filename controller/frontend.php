<?php

require_once ('../model/Character.php');
require_once ('../model/CharacterManager.php');


session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.

if (isset($_GET['deconnexion']))
{
    session_destroy();
    header('Location: index.php');
    exit();
}


function createCharacter()
{


    if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
    {
        $perso = $_SESSION['perso'];
    }
    $db = new PDO('mysql:host=localhost:8889;dbname=TP_fight;charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
    $manager = new CharacterManager($db);

    if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un personnage.
    {
        $perso = new Character(['name' => $_POST['nom']]); // On crée un nouveau personnage.

        if (!$perso->nameTrue()) {
            $message = 'Le nom choisi est invalide.';
            unset($perso);
        } elseif ($manager->exists($perso->getName())) {
            $message = 'Le nom du personnage est déjà pris.';
            unset($perso);
        } else {
            $manager->add($perso);
            header('Location: index.php');
        }
        if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
        {
            $_SESSION['perso'] = $perso;

        }

    }
    require '../view/frontend/persoCreateView.php';
}
function useCharacter(){
        $db = new Manager();
        $db = $db->dbConnect();
        $manager = new CharacterManager($db);
    if (isset($_POST['use']) && isset($_POST['useCharacter'])) // Si on a voulu utiliser un personnage.
    {
        if ($manager->exists($_POST['useCharacter'])) // Si celui-ci existe.
        {
            $perso = $manager->get($_POST['useCharacter']);

            if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
            {
                $_SESSION['perso'] = $perso;
            }
            header('Location: index.php');
        }
        else
        {
            $message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
        }
    }
    require '../view/frontend/useCharacterView.php';
}

function hitCharacter(){

    $db = new Manager();
    $db = $db->dbConnect();
    $manager = new CharacterManager($db);
    $perso = $_SESSION['perso'];

        if (!$manager->exists((int)$_GET['frapper'])) {
            $message = 'Le personnage que vous voulez frapper n\'existe pas !';
        } else {
            $persoAFrapper = $manager->get((int)$_GET['frapper']);

            $perso = $_SESSION['perso'];

            $retour = $perso->hit($persoAFrapper); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.

            switch ($retour) {
                case Character::ITS_ME :
                    $message = 'Mais... pourquoi voulez-vous vous frapper ???';
                    break;

                case Character::CHARACTER_HIT :
                    $message = 'Le personnage a bien été frappé !';

                    $manager->update($perso);
                    $manager->update($persoAFrapper);

                    break;

                case Character::CHARACTER_DIE :
                    $message = 'Vous avez tué ce personnage !';

                    $manager->update($perso);
                    $manager->delete($persoAFrapper);

                    break;
            }
        }
        require '../view/frontend/hitView.php';
    }







