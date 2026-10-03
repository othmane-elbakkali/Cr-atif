<?php

/** @var array  $projet      le projet : vide pour un ajout, rempli pour une modification */
/** @var array  $projetTags  les id des tags à cocher */
/** @var array  $creatifs    tous les créa'tifs (liste déroulante) */
/** @var array  $tags        tous les tags (cases à cocher) */
/** @var string $titreForm   "Ajouter un projet" ou "Modifier le projet" */
/** @var string $action      l'adresse où le formulaire envoie ses données */

// Ce formulaire sert pour l'ajout ET pour la modification d'un projet.
// htmlspecialchars() protège les valeurs qui contiennent des guillemets
?>

<h1 class="mb-4"><?php echo $titreForm; ?></h1>

<!-- enctype="multipart/form-data" est obligatoire pour envoyer un fichier (l'image) -->
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="ct-form-card">

    <!-- Titre -->
    <label for="titre">Titre du projet</label>
    <input type="text" name="titre" id="titre" class="form-control" placeholder="Ex : Frange Kamikaze"
        value="<?php echo htmlspecialchars($projet['titre']); ?>" required />

    <!-- Résumé -->
    <label for="resume">Résumé</label>
    <input type="text" name="resume" id="resume" class="form-control" maxlength="255" placeholder="Une phrase d'accroche..."
        value="<?php echo htmlspecialchars($projet['resume'] ?? ''); ?>" />

    <!-- Texte -->
    <label for="texte">Description</label>
    <textarea name="texte" id="texte" class="form-control" rows="5" placeholder="Racontez l'histoire (courageuse) de ce projet..."><?php echo htmlspecialchars($projet['texte'] ?? ''); ?></textarea>

    <!-- Image -->
    <label for="image">Photo du résultat</label>
    <div class="ct-dropzone">
        <?php if ($projet['projet_image']): ?>
            <!-- Modification : on montre l'image actuelle, le champ devient facultatif -->
            <img src="images/<?php echo $projet['projet_image']; ?>" alt="" style="max-width: 120px; display: block; margin: 0 auto .5rem;" />
            Laissez vide pour garder l'image actuelle
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" />
        <?php else: ?>
            <!-- Ajout : l'image est obligatoire -->
            ✂️ Choisissez une image (jpg, png, gif ou webp)
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required />
        <?php endif; ?>
    </div>

    <!-- Créa'tif : la liste vient de la base, le créa'tif du projet est pré-sélectionné -->
    <label for="creatif">Créa'tif</label>
    <select name="creatif" id="creatif" class="form-control" required>
        <option value="" disabled <?php echo $projet['creatif'] ? '' : 'selected'; ?>>Sélectionnez le créa'tif</option>
        <?php foreach ($creatifs as $creatif): ?>
            <option value="<?php echo $creatif['id']; ?>" <?php echo ($creatif['id'] == $projet['creatif']) ? 'selected' : ''; ?>>
                <?php echo $creatif['pseudo']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Tags : la liste vient de la base, les tags du projet sont cochés -->
    <label>Tags <span style="font-weight:400;font-size:.8rem;color:#4a3a5a">(facultatif)</span></label>
    <div class="ct-tag-choice">
        <?php foreach ($tags as $tag): ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>"
                    <?php echo in_array($tag['id'], $projetTags) ? 'checked' : ''; ?> />
                <?php echo $tag['nom']; ?>
            </label>
        <?php endforeach; ?>
    </div>

    <!-- Boutons -->
    <div>
        <input class="ct-btn ct-btn--primary" type="submit" value="Enregistrer" />
        <input class="ct-btn ct-btn--ghost" type="reset" value="Réinitialiser" />
    </div>
</form>