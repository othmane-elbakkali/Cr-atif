<!-- Contenu -->
<div class="container ct-content-wrap">
  <div class="row">
    <!-- Colonne principale : la vue chargée par le contrôleur -->
    <div class="col-lg-8">
      <?php echo $content; ?>
    </div>

    <!-- Colonne latérale -->
    <?php include_once '../app/views/templates/partials/_aside.php'; ?>
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->