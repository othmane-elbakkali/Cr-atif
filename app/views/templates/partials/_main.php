    <!-- Contenu -->
    <div class="container ct-content-wrap">
      <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">

          <?php echo $content; ?>

        </div>

        <!-- Pagination : 10 projets par page -->
        <nav aria-label="Navigation entre les pages de projets">
          <ul class="pagination ct-pagination" style="justify-content: center">
            <li class="page-item">
              <a class="page-link" href="#">Précédent</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">Suivant</a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Colonne latérale -->
      <div class="col-lg-4">
        <!-- Widget Créa'tifs -->
        <div class="ct-side-card">
          <h5 class="ct-side-card__head">Les créa'tifs</h5>
          <div class="ct-side-card__body">
            <ul class="ct-creatif-list">
              <li>
                <img class="ct-avatar" src="images/creatif_1.jpg" alt="" />
                <a href="#">Mister Univ'Hair</a>
                <span class="ct-count">4</span>
              </li>
              <li>
                <img class="ct-avatar" src="images/creatif_2.jpg" alt="" />
                <a href="#">Leerdam'Hair</a>
                <span class="ct-count">12</span>
              </li>
              <li>
                <img class="ct-avatar" src="images/creatif_3.jpeg" alt="" />
                <a href="#">Séda'Tifs</a>
                <span class="ct-count">9</span>
              </li>
              <li>
                <img class="ct-avatar" src="images/creatif_4.jpg" alt="" />
                <a href="#">Jupil'Hair</a>
                <span class="ct-count">5</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Widget Tags -->
        <div class="ct-side-card">
          <h5 class="ct-side-card__head">Tags</h5>
          <div class="ct-side-card__body">
            <ul class="ct-tags">
              <li><a class="ct-tag" href="#">Vintage</a></li>
              <li><a class="ct-tag" href="#">Alimentation</a></li>
              <li><a class="ct-tag" href="#">Géométrie</a></li>
              <li><a class="ct-tag" href="#">Couleur</a></li>
              <li><a class="ct-tag" href="#">Figuratif</a></li>
              <li><a class="ct-tag" href="#">Baptême</a></li>
              <li><a class="ct-tag" href="#">Abstract</a></li>
              <li><a class="ct-tag" href="#">Inclassable</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container -->