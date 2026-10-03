<?php

/** @var array $creatifs  tous les créa'tifs (liste déroulante) */
/** @var array $tags      tous les tags (cases à cocher) */ ?>

<!-- Formulaire d'ajout d'un projet -->
<h1 class="mb-4">Ajouter un projet</h1>

<!-- enctype="multipart/form-data" est obligatoire pour envoyer un fichier (l'image) -->
<form action="projects/add/insert.html" method="post" enctype="multipart/form-data" class="ct-form-card">

    <!-- Titre -->
    <label for="titre">Titre du projet</label>
    <input type="text" name="titre" id="titre" class="form-control" placeholder="Ex : Frange Kamikaze" required />

    <!-- Résumé -->
    <label for="resume">Résumé</label>
    <input type="text" name="resume" id="resume" class="form-control" maxlength="255" placeholder="Une phrase d'accroche..." />

    <!-- Texte -->
    <label for="texte">Description</label>
    <textarea name="texte" id="texte" class="form-control" rows="5" placeholder="Racontez l'histoire (courageuse) de ce projet..."></textarea>

    <!-- Image -->
    <label for="image">Photo du résultat</label>
    <div class="ct-dropzone">
        ✂️ Choisissez une image (jpg, png, gif ou webp)
        <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required />
    </div>

    <!-- Créa'tif : la liste vient de la base -->
    <label for="creatif">Créa'tif</label>
    <select name="creatif" id="creatif" class="form-control" required>
        <option value="" disabled selected>Sélectionnez le créa'tif</option>
        <?php foreach ($creatifs as $creatif): ?>
            <option value="<?php echo $creatif['id']; ?>"><?php echo $creatif['pseudo']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Tags : la liste vient de la base, name="tags[]" pour pouvoir en cocher plusieurs -->
    <label>Tags <span style="font-weight:400;font-size:.8rem;color:#4a3a5a">(facultatif)</span></label>
    <div class="ct-tag-choice">
        <?php foreach ($tags as $tag): ?>
            <label><input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>" /> <?php echo $tag['nom']; ?></label>
        <?php endforeach; ?>
    </div>

    <!-- Boutons -->
    <div>
        <input class="ct-btn ct-btn--primary" type="submit" value="Enregistrer" />
        <input class="ct-btn ct-btn--ghost" type="reset" value="Réinitialiser" />
    </div>
</form>