<?php
// ROUTEUR DES PROJETS
// URL: ?projets=...

use \App\Controllers\ProjetsController;

include_once '../app/controllers/projetsController.php';

switch ($_GET['projets']):

        // DÉTAIL D'UN PROJET
        // PATTERN: /projets/id/slug.html
        // URL: ?projets=show&id=x
        // CTRL: projetsController
        // ACTION: show
    case 'show':
        ProjetsController\showAction($connexion, $_GET['id']);
        break;

    // SUPPRESSION D'UN PROJET
    // PATTERN: /projets/delete/id/slug.html
    // URL: ?projets=delete&id=x
    // CTRL: projetsController
    // ACTION: delete
    case 'delete':
        ProjetsController\deleteAction($connexion, $_GET['id']);
        break;

    // FORMULAIRE D'AJOUT
    // PATTERN: /projects/add/form.html
    // URL: ?projets=addForm
    // CTRL: projetsController
    // ACTION: addForm
    case 'addForm':
        ProjetsController\addFormAction($connexion);
        break;

    // AJOUT D'UN PROJET (données du formulaire en POST)
    // PATTERN: /projects/add/insert.html
    // URL: ?projets=insert
    // CTRL: projetsController
    // ACTION: insert
    case 'insert':
        ProjetsController\insertAction($connexion, $_POST, $_FILES);
        break;

    // PAR DÉFAUT : liste des projets
    default:
        ProjetsController\indexAction($connexion);
        break;

endswitch;
