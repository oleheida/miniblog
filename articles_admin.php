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
              <h3>Admin panel</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                      <a href="models/add.php?action=add"><button class="btn">Add article</button></a>

                  <?php
                  $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC");
                  foreach($articles as $a):?>
                      <article class="article ">
                        <div class="article-info">
                          <a class="col-lg-8" href="article.php?id=<?php echo $a['id'] ?>"><?php echo $a['title'] ?></a>

                          <a class="col-lg-1 col-lg-offset-2" href="models/edit.php?action=edit&id=<?=$a['id']?>"><button class="btn">Edit</button> </a>
                          <a onclick = "return confirm('Are you sure?')" class="col-lg-1" href="models/admin.php?action=delete&id=<?=$a['id']?>">
                          <button class="btn">Delete</button>
                          </a>
                          </div>
                          <div class="article-info-date">
                            <small>Published: <span><?php echo $a['pubdate'] ?></span></small>
                          </div>
                          <div class="article-info-preview">
                            <a href="article.php?id=<?php echo $a['id'] ?>"><?php echo mb_substr(strip_tags($a['text']), 0, 255, 'utf-8') ?><span>...</span></a>
                          </div>
                      </article>
                      <?php endforeach ?>
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </div>
    </div>
<?php include "includes/footer.php";?>