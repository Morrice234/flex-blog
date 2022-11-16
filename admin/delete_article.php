<?php
  session_start();
    require 'includes/dbh.inc.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null === $id) {
      if ($_SESSION["type"] === "admin") {
        header('Location: admin_articles.php');
      }else {
        header('Location: articles.php');
      }

    }

    if (!empty($_POST)) {
        $id = $_POST['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        $q->execute(array($id));
        Database::disconnect();
        if ($_SESSION["type"] === "admin") {
          header('Location: admin_articles.php');
        }else {
          header('Location: articles.php');
        }
        
    }

    include 'header.php';
?>


<div class="container">
    <div class="row">
        <h3>Delete Article</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="delete_article.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p class="bg-danger alert">Are you sure to delete ?</p>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <a class="btn btn-default" href="index.php">No</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
