<?php
require "../includes/database.php";
include "../includes/header.php";
require "admin.php";
if($_SESSION['logged-user'] != 'm'){
    header("Location: articles_home.php");
}
?>

<div class="container">
    <h3>Article editing</h3>
    <div>
        <form method="post" action="admin.php?action=edit&id=<?=$_GET['id']?>">
            <label>Title</label><br>
                <input type="text" name="title" value="<?=$article['title']?>" class="form-item" autofocus required><br>
            <label>Text</label><br>
            <textarea class="form-item" name="text" cols="50" rows="10" required><?=$article['text']?></textarea><br>
            <input type="submit" value="Save article" class="btn">
        </form>
    </div>
</div>
<?php
include "../includes/footer-single.php";
?>
