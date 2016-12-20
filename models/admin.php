<?php
require ("../includes/database.php");

if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

if ($action == "add") {
    if(!empty($_POST)){
        articles_new($connection, $_POST['title'],  $_POST['text']);
        header("Location: /miniblog/articles_admin.php");
    }
    include("/miniblog/articles_admin.php");
}else if($action == 'edit'){
    if(!isset($_GET['id']))
        header('Location: /miniblog/articles_admin.php');
    $id = (int)$_GET['id'];

    if(!empty($_POST) && $id > 0) {
        articles_edit($connection, $id, $_POST['title'], $_POST['text']);
        header("Location: /miniblog/articles_admin.php");
    }

    $article = articles_get($connection, $id);

}else if($action == "delete"){
    $id = $_GET['id'];
    $art = articles_delete($connection, $id);
    header("Location: /miniblog/articles_admin.php");
}

/////////////////////////////////////////////////////
function articles_all($connection){
    $query = "SELECT * FROM articles ORDER BY id DESC";
    $result = mysqli_query($connection, $query);

    if (!$result)
        die(mysqli_error($connection));

    //EXTRACT FROM DB
    $n = mysqli_num_rows($result);
    $articles = array();

    for ($i=0; $i < $n; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $articles[] = $row;
    }
    return $articles;
}
function articles_get($connection, $id_article){
    $query = sprintf ("SELECT * FROM articles WHERE id=%d", (int)$id_article);
    $result = mysqli_query($connection, $query);

    if (!$result)
        die(mysqli_fetch_assoc($connection));
    $article = mysqli_fetch_assoc($result);
    return $article;

}
    function articles_new($connection, $title, $text)
    {
        // Подготовка
        $title = trim($title);
        $text = trim($text);

        // Проверка
        if ($title == '')
            return false;

        // Запрос
        $t = "INSERT INTO articles (title, text) VALUES ('%s', '%s')";

        $query = sprintf($t,
            mysqli_real_escape_string($connection, $title),
            mysqli_real_escape_string($connection, $text));


        $result = mysqli_query($connection, $query);

        if (!$result)
            die(mysqli_error($connection));

        return true;
    }
function articles_edit($connection, $id, $title, $text){
    $title = trim($title);
    $text = trim($text);
    $id = (int)$id;

    //Check
    if ($title == '')
        return false;

    //Get
    $sql ="UPDATE articles SET title= '%s', text='%s' WHERE id='%d'";
    $query = sprintf($sql,
        mysqli_real_escape_string($connection, $title),
        mysqli_real_escape_string($connection, $text),
        $id);

    $result = mysqli_query($connection, $query);

    if (!$result)
        die(mysqli_error($connection));

    return mysqli_affected_rows($connection);
}
function articles_delete($connection, $id){
    $id = (int)$id;
    //Check
    if ($id == 0)
        return false;
    // Get
    $query = sprintf("DELETE FROM articles WHERE id=$_GET[id]", $id);
    $result = mysqli_query($connection, $query);

    if(!$result)
        die(mysqli_error($connection));

    return mysqli_affected_rows($connection);
}

?>