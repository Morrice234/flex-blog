<?php include 'includes/database.php'; ?>
<?php include 'header.php'; ?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Flex Media</h1>
                            <span class="subheading">Your entertaining partner</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div id="Post" class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php
                    date_default_timezone_set('Africa/Nairobi');

                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = $pdo->prepare("SELECT * FROM articles
                                          JOIN flex_authors
                                          ON flex_authors.author_id = articles.author_id
                                          WHERE status = 'published'
                                          ORDER BY article_id DESC LIMIT 40");
                    $sql->execute(array());
                    //$data = $sql->fetch(PDO::FETCH_ASSOC);
                    while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {

                      $date = $data['date_posted'];
                      $first_name = $data['first_name'];
                      $last_name = $data['last_name'];
                      $title = $data['title'];
                      $image = $data['cover_image'];
                      Database::disconnect();

                     ?>
                    <div class="post-preview">
                      <img style="width: 120px" src="assets/img/<?php echo $image; ?>" alt="">

                      <?php echo '<a href="post.php?id='.$data['article_id'].'">' ?>
                            <h1 class="post-title"><?php echo $data['title']; ?></h1>
                            <h3 class="post-subtitle"><?php echo $data['sub_title']; ?></h3>
                        <?php echo "</a>" ?>

                        <p class="">
                            Posted by <strong><?php echo $first_name; ?> <?php echo $last_name; ?></strong>

                            on <strong><?php echo $date; ?></strong>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                  <?php } ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><button id="readMore" class="btn btn-primary text-uppercase">Older Posts →</button></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php include 'footer.php'; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            var postCount = 1;
            $("#readMore").click(function(){
              postCount = postCount + 1;
              $("#Post").load("load_post.php", {
                newPostCount = postCount
              });
            });
          });
        </script>
    </body>
</html>
