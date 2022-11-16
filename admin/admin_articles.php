<?php
session_start();
require_once('includes/dbh.inc.php');
if (!isset($_SESSION['id'])) {
    header('location: login.php');
  }else{
    include("header.php");

?>

                <!-- Begin Page Content -->
                <div class=" container container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 align-items-center">Articles</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                      <div class="container px-4 px-lg-5">
                          <div class="row gx-4 gx-lg-5 justify-content-center">
                              <div class="col-md-10 col-lg-8 col-xl-7">
                                  <!-- Post preview-->
                                  <?php

                                  $pdo = Database::connect();
                                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                  $sql = $pdo->prepare("SELECT * FROM articles
                                                        JOIN flex_authors
                                                        ON articles.author_id = flex_authors.author_id
                                                        ORDER BY article_id DESC");
                                  $sql->execute(array());

                                  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {

                                  Database::disconnect();

                                 ?>
                                 <div class="post-preview">
                                   <?php
                                     echo '<a href="../post.php?id='.$data['article_id'].'">
                                         <h1 class="post-title text-grey">'.$data['title'].'</h1>
                                         <h3 class="post-subtitle">'.$data['sub_title'].'</h3>
                                     </a>' . PHP_EOL;
                                     ?>
                                     <p class="post-meta">
                                         Posted by
                                         <a href="#!">
                                           <span class="text-success"><?php echo $data["first_name"]; ?></span>
                                           <span class="text-success"><?php echo $data["last_name"]; ?></span>
                                         </a>
                                         on <?php echo $data['date_posted']; ?>
                                     </p>
                                     <?php if ($data['status'] === "published"): ?>
                                       <a class="btn btn-success" href="#"><?php echo $data['status']; ?></a>
                                     <?php else: ?>
                                       <a class="btn btn-warning" href="#"><?php echo $data['status']; ?></a>
                                     <?php endif; ?>
                                     <?php
                                     echo '<a class="btn btn-primary" href="../post.php?id='.$data['article_id'].'"">Preview</a>' . PHP_EOL;

                                     echo '<a class="btn btn-success" href="includes/publish.php?id='. $data['article_id']. '">Publish</a>' .PHP_EOL;
                                     echo '<a class="btn btn-danger" href="delete_article.php?id='. $data['article_id']. '">Delete</a>' . PHP_EOL;

                                     ?>
                                 </div>
                                 <!-- Divider-->
                                 <hr class="my-4" />
                               <?php } ?>
                                  <!-- Pager-->
                                  <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                              </div>
                          </div>
                      </div>

                    </div>
                    <!-- Content Row -->

            <!-- Footer -->
            <?php include('footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
  <?php } ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
