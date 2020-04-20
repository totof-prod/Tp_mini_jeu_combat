<?php $title = 'tp mini combat'; ?>

<?php ob_start(); ?>

<h2>Nombre de personnages créés : <?= $manager->count() ?></h2>
<div class="message">

    <?php
    if (isset($message)) // On a un message à afficher ?
        echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
    ?>
</div>

    <form action="index.php" method="post">
      <p>
        Nom : <input type="text" name="nom" maxlength="50" />
        <input type="submit" value="Créer ce personnage" name="creer" />
      </p>
        <a href="index.php?action=use">Utiliser un personnage déjà créer</a>
    </form>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
