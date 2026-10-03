<?php
// ROUTEUR PRINCIPAL

// ROUTES DES PROJETS
// URL: ?projets=...
// ROUTEUR: projets
if (isset($_GET['projets'])):
    include_once '../app/routers/projets.php';

// ROUTE PAR DÉFAUT : liste des projets
// PATTERN: / ou /projects
// URL: ?
// CTRL: projetsController
// ACTION: index
else:
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\indexAction($connexion);
endif;
