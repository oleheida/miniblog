<?php

require "includes/database.php";
require "includes/config.php";
include "includes/header.php";
?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="col-lg-12 col-md-10">
            <div class="block">
              <h3>Latest updates</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php
                  $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC");
                  $categories = mysqli_query($connection, "SELECT * FROM articles_category");

                    while  ($art = mysqli_fetch_assoc($articles))
                    {
                      ?>
                      <article class="article">
                        <div class="article-info">
                          <a href="article.php?id=<?php echo $art['id'] ?>"><?php echo $art['title'] ?></a>
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