<?php
session_start();
include('includes/dbh.inc.php');
include('config.php');
if (!isset($_SESSION['id'])) {
    header('location: login.php');
  }else{
    include("header.php");

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Admins</h1>

                    </div>

                    <!-- Content Row -->

                    <div class="row">

                      <div class="card shadow mb-4">
                          <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary">Admins</h6>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Articles</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>

                                      <tbody>
                                        <?php
                                          date_default_timezone_set('Africa/Nairobi');
                                          $id = $_SESSION["id"];

                                          $pdo = Database::connect();
                                          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                          $sql = $pdo->prepare("SELECT flex_authors.author_id AS author_id, username, first_name, last_name, email, phone,
                                                                COUNT(articles.article_id) AS articles
                                                                FROM flex_authors
                                                                JOIN articles ON articles.author_id = flex_authors.author_id
                                                                WHERE type = 'admin'");
                                          $sql->execute(array());
                                          //$data = $sql->fetch(PDO::FETCH_ASSOC);
                                          while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {

                                            Database::disconnect();

                                           ?>
                                          <tr>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['email']; ?></td>
                                            <td><?php echo $data['phone']; ?></td>
                                            <td><?php echo $data['first_name']; ?></td>
                                            <td><?php echo $data['last_name']; ?></td>
                                            <td><?php echo $data['articles']; ?></td>
                                            <?php
                                            echo '<td>' . PHP_EOL;
                                            echo '<a class="btn btn-primary" href="view_user.php?id='.$data['author_id'].'">View</a>' . PHP_EOL;
                                            echo '<a class="btn btn-success" href="update_user.php?id='.$data['author_id'].'">Update</a>' . PHP_EOL;
                                            echo '<a class="btn btn-danger" href="delete_user.php?id='.$data['author_id'].'">Delete</a>' . PHP_EOL;
                                            echo '</td>' . PHP_EOL;
                                            ?>
                                          </tr>
                                        <?php } ?>

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>

                  </div>

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
                        <span aria-hidden="true">??</span>
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
