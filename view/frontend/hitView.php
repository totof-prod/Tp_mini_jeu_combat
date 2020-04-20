<?php $title = 'tp mini combat'; ?>

<?php ob_start(); ?>
    <h2>Nombre de personnages créés : <?= $manager->count() ?></h2>
    <div class="message">

        <?php
        if (isset($message)) // On a un message à afficher ?
            echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
        ?>
    </div>

    <p><a href="?deconnexion=1">Déconnexion</a></p>
    <fieldset>
        <legend>Mes informations</legend>
        <p>
            Nom : <?= htmlspecialchars($perso->getname()) ?><br />
            Dégâts : <?= $perso->getdamages() ?>
        </p>
    </fieldset>

    <fieldset>
        <legend>Qui frapper ?</legend>
        <p>
            <?php

            $persos = $manager->getList($perso->getName());


            if (empty($persos))
            {
                echo 'Personne à frapper !';
            }

            else
            {
                foreach ($persos as $unPerso)
                    echo '<a href="index.php?frapper=', $unPerso->getid(), '">', htmlspecialchars($unPerso->getName()), '</a> (dégâts : ', $unPerso->getDamages(), ')<br />';
            }
            ?>
        </p>
    </fieldset>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>