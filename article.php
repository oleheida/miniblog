<?php
include "includes/config.php";
include "includes/header.php";
require "includes/database.php"
?>

<?php
$article = mysqli_query($connection, "SELECT * FROM articles WHERE id =".(int)$_GET['id']);
$categories = mysqli_query($connection, "SELECT * FROM articles_category");



if(mysqli_num_rows($article) == 0){
  ?> <div class="text-center article-error col-lg-4 col-lg-offset-4">Sorry. Article doesn't exist.</div>
  <?php
  }
    else
  {
$art = mysqli_fetch_assoc($article);
foreach ($categories as $cat)
{
  if($cat['id'] == $art['category_id'])
  {
    $art_cat = $cat;
    break;
  }
};
?>
<div id="content">
  <div class="container">
    <div class="row">
      <section class="content__left col-lg-9 col-md-8">
        <div class="block">
         <a href="/miniblog/articles_home.php"> <button class="btn btn-all">All articles</button></a>
          <h3><?php echo $art['title']?></h3>
          <div class="block__content">
            <div class="articles articles__horizontal">
                <article class="article">
                  <div class="article-info">
                    <div class="article-info-cat">
                      <small>Category: <span><?php echo $art_cat['category'] ?></span></small>
                    </div>
                    <div class="article-info-date">
                      <small>Published: <span><?php echo $art['pubdate'] ?></span></small>
                    </div>
                    <div class="article-info-full">
                      <p><?php echo $art['text']?></p>
                    </div>
                </article>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
</div>
<?php
}
?>


<?php
include "includes/footer.php";
?>
