<?php

/** @var array $projets */ ?>


<div class="container ct-content-wrap">
    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">

            <!-- Projet 1 -->

            <?php foreach ($projets as $projet): ?>
                <article class="ct-card">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="projet.html">
                                <img class="img-fluid mb-3 mb-md-0"
                                    src="images/<?php echo $projet['projet_image']; ?>"
                                    alt="<?php echo $projet['titre']; ?>" />
                            </a>
                        </div>
                        <div class="col-md-8">

                            <h3><a href="projets/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>"><?php echo $projet['titre']; ?></a></h3>
                            <p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> ·
                                <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'd'); ?>
                                <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'M'); ?>
                                <?php echo \Core\Helpers\dateFormator($projet['dateCreation'], 'Y'); ?>
                            </p>


                            <p><?php echo \core\Helpers\truncate($projet['texte']); ?></p>
                            <a class="ct-btn ct-btn--primary ct-btn--sm" href="projet.html">Voir le projet</a>
                        </div>
                    </div>
                </article>

            <?php endforeach; ?>
        </div>
    </div>