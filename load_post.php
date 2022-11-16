<?php
include ("includes/database.php");
date_default_timezone_set('Africa/Nairobi');
$newPostCount = $_POST['newPostCount'];
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $pdo->prepare("SELECT * FROM articles
                      JOIN flex_authors
                      ON flex_authors.author_id = articles.author_id
                      WHERE status = 'published'
                      ORDER BY article_id DESC LIMIT $newPostCount");
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
