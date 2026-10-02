<?php

/** @var array $projet */
/** @var array $tags */ ?>

<!-- Détail d'un projet -->
<h1><?php echo $projet['titre']; ?></h1>
<p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> ·
    <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'd M Y'); ?>
</p>

<!-- Actions : éditer / supprimer -->
<div class="mb-4">
    <a href="form.html" class="ct-btn ct-btn--primary">Éditer le projet</a>
    <a href="projets/delete/<?php echo $projet['projet_id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html" class="ct-btn ct-btn--danger" onclick="return confirm('Supprimer définitivement ce projet ?');">Supprimer le projet</a>
</div>

<article class="ct-card">
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid mb-3 mb-md-0"
                src="images/<?php echo $projet['projet_image']; ?>"
                alt="<?php echo $projet['titre']; ?>" />
        </div>
        <div class="col-md-6">
            <!-- Résumé -->
            <p class="lead" style="font-weight: 600"><?php echo $projet['resume']; ?></p>
            <hr />
            <!-- Texte complet -->
            <p><?php echo $projet['texte']; ?></p>
            <hr />
            <!-- Tags du projet -->
            <ul class="ct-tags">
                <?php foreach ($tags as $tag): ?>
                    <li><a class="ct-tag" href="#"><?php echo $tag['nom']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</article>