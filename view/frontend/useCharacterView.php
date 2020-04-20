<?php $title = 'tp mini combat'; ?>

<?php ob_start(); ?>
<h2>Nombre de personnages créés : <?= $manager->count() ?></h2>
<div class="message">

    <?php
    if (isset($message)) // On a un message à afficher ?
        echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
    ?>
</div>

<fieldset>
    <legend>Qui choisir ?</legend>
    <form action="" method="post">
        <select name="useCharacter">
            <option value="nom">--Veuillez choisir un personnage--</option>


        <?php

        $persos = $manager->getList();


        if (empty($persos))
        {
            echo '<option value = ""> Personne à frapper !</option>';
        }

        else
        {
            foreach ($persos as $unPerso){

                echo '<option value="'.htmlspecialchars($unPerso->getName()).'">'.htmlspecialchars($unPerso->getName()).'</option>';
            }

        }
            ?>
        </select>
        <input type="submit" value="Utiliser ce personnage" name="use" />
    </form>
</fieldset>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
