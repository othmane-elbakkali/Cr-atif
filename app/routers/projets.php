<?php

use \app\Controllers\ProjetsController;

include_once "../app/controllers/projetsController.php";


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

    default:
        ProjetsController\indexAction($connexion);
        break;

endswitch;
