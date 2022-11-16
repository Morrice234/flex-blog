<?php
session_start();
include('includes/dbh.inc.php');
if (!isset($_SESSION['id'])) {
    header('location: login.php');
  }else{
    include("header.php");

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Article</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                      <form class="user" method="post" action="includes/post.php" enctype="multipart/form-data">

                        <div class="form-group">
                          <label class="text text-success" for="cover_pic">Cover Image</label>
                            <input type="file" name="cover_pic" class=""
                                id="exampleInputEmail" aria-describedby="emailHelp">
                        </div>

                          <div class="form-group">
                              <input type="text" name="title" class="form-control form-control-user"
                                  id="exampleInputEmail" aria-describedby="emailHelp"
                                  placeholder="Title">
                          </div>

                          <div class="form-group">
                              <input type="text" name="sub_title" class="form-control form-control-user"
                                  id="exampleInputEmail" aria-describedby="emailHelp"
                                  placeholder="Sub Title">
                          </div>

                          <div class="form-group">
                              <input type="text" name="category" class="form-control form-control-user"
                                  id="exampleInputPassword" placeholder="Category">
                          </div>

                          <div class="form-group">
                            <textarea id="Article_content" name="article_content" rows="50" cols="150"></textarea>
                          </div>

                          <input type="submit" value="Post" class="btn btn-info btn-user btn-block">

                          <hr>

                      </form>
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
    <script src="ckeditor/ckeditor.js" charset="utf-8"></script>
    <script>
      CKEDITOR.replace('Article_content');
    </script>

</body>

</html>
