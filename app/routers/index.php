<?php
// ROUTER PRINCIPAL


if (isset($_GET['projets'])):
    include_once '../app/routers/projets.php';

// ROUTE PAR DEFAUT
// PATTERN:
// CTRL: ProjetsController
// ACTION: homeAction
else:
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\homeAction($connexion);

endif;
