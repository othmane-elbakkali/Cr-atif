<?php

namespace Core\Helpers;

function dateFormator(string $date, string $format = "d/m/Y"): string
{
    return date($format, strtotime($date));
}

function slugify(string $text): string
{
    // 1. Remplacer les caractères accentués par leur équivalent non accentué
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);

    // 2. Mettre en minuscules
    $text = strtolower($text);

    // 3. Remplacer tout ce qui n'est pas une lettre, un chiffre ou un tiret par un tiret
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);

    // 4. Supprimer les tirets en début et fin de chaîne
    $text = trim($text, '-');

    return $text;
}

function truncate(string $string, int $lg_max = 100): string
{
    if (strlen($string) > $lg_max):

        $string = substr($string, 0, $lg_max);
        $last_space = strrpos($string, " ");
        return substr($string, 0, $last_space) . "...";;
    endif;
    return $string;
}


// Enregistre l'image envoyée par un formulaire dans public/images
// Renvoie le nom du fichier enregistré, ou null si aucune image valide n'a été envoyée
function uploadImage(array $file): ?string
{
    // aucun fichier choisi, ou erreur pendant l'envoi
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK):
        return null;
    endif;

    // on n'accepte que les images (pas de .php dans le dossier public !)
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])):
        return null;
    endif;

    // nom unique pour ne jamais écraser une image existante
    $nom = uniqid() . '.' . $extension;

    // on est dans le dossier public/ (là où se trouve index.php)
    move_uploaded_file($file['tmp_name'], 'images/' . $nom);

    return $nom;
}
