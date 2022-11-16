<?php
session_start();
include('dbh.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

      date_default_timezone_set('Africa/Nairobi');

      $date_posted = date('Y/m/d H:i:s');
      $id = $_SESSION['id'];
      $title = trim($_POST['title']);
      $sub_title = trim($_POST['sub_title']);
      $category = trim($_POST['category']);
      $content = trim($_POST['article_content']);
      $image = $_FILES['cover_pic'];
      $image_name = $image["name"];
      $image_temp = $image["tmp_name"];

      $upload_image = '../../assets/img/' . $image_name;
      move_uploaded_file($image_temp, $upload_image);

      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO articles (title, sub_title, category, content, cover_image, date_posted, author_id)
                          VALUES(?, ?, ?, ?, ?, ?, ?)
                          ";
      $q = $pdo->prepare($sql);
      $q->execute(array($title, $sub_title, $category, $content, $upload_image, $date_posted, $id));

      if ($q) {
        echo "
          <script>alert('Article added successfully. Please wait as admin publishes it.')</script>
    	     <script>window.location = '../tasks.php?'</script>";
      } else {
        echo "
          <script>alert('Please try again.')</script>
    	     <script>window.location = '../tasks.php?'</script>";
      }

  }

?>
