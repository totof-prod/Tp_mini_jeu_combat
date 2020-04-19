<?php $title = 'tp mini combat'; ?>

<?php ob_start(); ?>

<h1>Les Personnage</h1>



<div class="character_info">
    <div class="character">
        <h3>Le personnage 1</h3>
            <ul>
                <li>Nom : <?= $persosName1 ?></li>
                <li>Sa force : <?= $persoStrong1 ?></li>
                <li>Les dégats : <?= $persoDamage1 ?></li>
                <li>Son Niveau : <?= $persolevel1 ?></li>
            </ul>
    </div>
    <div class="character">
        <h3>Le personnage 2</h3>
            <ul>
                <li>Nom : <?= $persosName2 ?></li>
                <li>Sa force : <?= $persoStrong2 ?></li>
                <li>Les dégats : <?= $persoDamage2 ?></li>
                <li>Son Niveau : <?= $persolevel2 ?></li>
            </ul>
    </div>
    <div class="character">
        <h3>Le personnage 3</h3>
            <ul>
                <li>Nom : <?= $persosName3 ?></li>
                <li>Sa force : <?= $persoStrong3 ?></li>
                <li>Les dégats : <?= $persoDamage3 ?></li>
                <li>Son Niveau : <?= $persolevel3 ?></li>
            </ul>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
