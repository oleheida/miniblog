<?php
require "includes/database.php";
include "includes/header.php";

if($_SESSION['logged-user'] != 'm'){
  header("Location: articles_home.php");
}
?>
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="">
            <div class="block">
              <h3>Latest updates</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                      <a href="articles_admin.php?action=add"><button class="btn">Add article</button></a>

                  <?php
                  $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC");
                  $categories = mysqli_query($connection, "SELECT * FROM articles_category");

                    while  ($art = mysqli_fetch_assoc($articles))
                    {
                      ?>
                      <article class="article ">
                        <div class="article-info">
                          <a class="col-lg-8" href="article.php?id=<?php echo $art['id'] ?>"><?php echo $art['title'] ?></a>

                          <a class="col-lg-1 col-lg-offset-2" href="articles_admin.php?action=edit&id=<?=$art['id']?>"><button class="btn">Edit</button> </a>
                          <a class="col-lg-1" href="articles_admin.php?action=delete&id=<?=$art['id']?>"><button class="btn">Delete</button></a>

                          <div class="article-info-cat">
                            <?php
                            foreach ($categories as $cat)
                            {
                              if($cat['id'] == $art['category_id'])
                              {
                                $art_cat = $cat;
                                break;
                              }
                            }
                            ?>
                            <small>Category: <span><?php echo $art_cat['category'] ?></span></small>
                          </div>
                          <div class="article-info-date">
                            <small>Published: <span><?php echo $art['pubdate'] ?></span></small>
                          </div>
                          <div class="article-info-preview">
                            <a href="article.php?id=<?php echo $art['id'] ?>"><?php echo mb_substr(strip_tags($art['text']), 0, 255, 'utf-8') ?><span>...</span></a>
                          </div>
                      </article>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </div>
    </div>
<?php include "includes/footer.php";?>