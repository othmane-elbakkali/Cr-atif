<?php

/** @var array $projets */ ?>

<!-- Liste des projets -->
<?php foreach ($projets as $projet): ?>

    <?php // lien vers le détail du projet : projets/id/slug
    $lien = 'projets/' . $projet['projet_id'] . '/' . \Core\Helpers\slugify($projet['titre']) . '.html'; ?>

    <article class="ct-card">
        <div class="row">
            <div class="col-md-4">
                <a href="<?php echo $lien; ?>">
                    <img class="img-fluid mb-3 mb-md-0"
                        src="images/<?php echo $projet['projet_image']; ?>"
                        alt="<?php echo $projet['titre']; ?>" />
                </a>
            </div>
            <div class="col-md-8">
                <h3><a href="<?php echo $lien; ?>"><?php echo $projet['titre']; ?></a></h3>
                <p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> ·
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'd'); ?>
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'M'); ?>
                    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'Y'); ?>
                </p>

                <p><?php echo \Core\Helpers\truncate($projet['texte']); ?></p>
                <a class="ct-btn ct-btn--primary ct-btn--sm" href="<?php echo $lien; ?>">Voir le projet</a>
            </div>
        </div>
    </article>

<?php endforeach; ?>

<!-- Pagination : 10 projets par page -->
<nav aria-label="Navigation entre les pages de projets">
    <ul class="pagination ct-pagination" style="justify-content: center">
        <li class="page-item"><a class="page-link" href="#">Précédent</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
    </ul>
</nav>