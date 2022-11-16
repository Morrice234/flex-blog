<?php
require_once('dbh.inc.php');
  $id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null === $id) {
    header('Location: ../admin_articles.php');
}

//if (!empty($_POST)) {

    //$ref_err = null;

    $publish = "published";

    //$valid = true;


    //if (empty($publish)) {
        //$publish_err = "This field can't be empty";
        //$valid = false;
    //}

    //if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = $pdo->prepare('UPDATE articles SET status = ? WHERE article_id = ?');

        if ($q->execute(array($publish, $id))) {
          header('Location: ../admin_articles.php');
          Database::disconnect();
        }

    //}
//} else {
    //$pdo = Database::connect();
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$q = $pdo->prepare('SELECT *
                    //    FROM articles
                    //    where article_id = ?');
    //$q->execute(array($id));
  //  if($data = $q->fetch(PDO::FETCH_ASSOC)) {

  //  $status = $data['status'];
  //  Database::disconnect();
  //}
//}


?>
