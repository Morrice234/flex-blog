<?php
  session_start();
  include 'includes/database.php';


?>
<?php include 'header.php'; ?>
        <!-- Page Header-->
        <?php
          $id = null;
          if (!empty($_GET['id'])) {
              $id = $_REQUEST['id'];
          }

          if (null === $id) {
              header('Location: index.php');
          } else {
            if (isset($_SESSION['view'])) {
              $_SESSION['view'] = $_SESSION['view'] + 1;
            } else {
              $_SESSION['view'] = 1;
            }

              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $q = $pdo->prepare('SELECT * FROM articles
                                  JOIN flex_authors
                                  ON flex_authors.author_id = articles.author_id
                                  WHERE article_id = ?');
              $q->execute(array($id));
              //$data = $q->fetch(PDO::FETCH_ASSOC);
              if ($data = $q->fetch(PDO::FETCH_ASSOC)) {


              Database::disconnect();
          }

         ?>
        <header class="masthead" style="background-image: url('assets/img/<?php echo $data['cover_image']; ?>');">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $data['title']; ?></h1>
                            <h2 class="subheading"></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!">
                                  <span><?php echo $data['first_name']; ?></span>
                                  <span><?php echo $data['last_name']; ?></span>
                                </a>
                                on <?php echo $data['date_posted']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                      <p>
                        <?php echo $data['content']; ?>
                      </p>
                      <?php if (isset($_SESSION["id"])): ?>
                        <?php if ($_SESSION["type"] === "admin"): ?>
                          <a class="btn btn-dark px-5 float-right" href="admin/admin_articles.php">Back</a>
                        <?php else: ?>
                          <a class="btn btn-dark px-5 float-right" href="admin/articles.php">Back</a>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                </div>
            </div>

        </article>

        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                      <h1 class="text-success my-4">Latest Articles</h1>
                      <?php
                      date_default_timezone_set('Africa/Nairobi');

                      $pdo = Database::connect();
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = $pdo->prepare("SELECT * FROM articles
                                            JOIN flex_authors
                                            ON flex_authors.author_id = articles.author_id
                                            WHERE status = 'published'
                                            ORDER BY article_id DESC LIMIT 10");
                      $sql->execute(array());
                      //$data = $sql->fetch(PDO::FETCH_ASSOC);
                      while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {

                        $image = $data['cover_image'];
                        Database::disconnect();

                       ?>
                      <div class="post-preview display-absolute">
                        <img class="display-relative" style="width: 120px" src="assets/img/<?php echo $image; ?>" alt="">

                        <?php echo '<a href="post.php?id='.$data['article_id'].'">' ?>
                              <h1 class="post-title"><?php echo $data['title']; ?></h1>
                              <h3 class="post-subtitle"><?php echo $data['sub_title']; ?></h3>
                          <?php echo "</a>" ?>

                          <p class="">
                              Posted by <strong><?php echo $data['first_name']; ?> <?php echo $data['last_name']; ?></strong>

                              on <strong><?php echo $data['date_posted']; ?></strong>
                          </p>
                      </div>
                      <!-- Divider-->
                      <hr class="my-4" />
                    <?php } ?>
                    </div>
                </div>
            </div>

        </article>

      <?php } ?>
        <!-- Footer-->
        <?php include 'footer.php'; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
