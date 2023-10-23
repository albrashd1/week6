<?php
// db data
$host = 'localhost'; 
$database = 'week6'; 
$username = 'root'; 
$password = ''; 


$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // inserts into db

    $news_title = $_POST['news_title'];
    $news_content = $_POST['news_content'];
    $news_content = str_replace('&nbsp;' ,'', $news_content);


    $sql = "INSERT INTO news (title, content) VALUES (:title, :content)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':title', $news_title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $news_content, PDO::PARAM_STR);
    $stmt->execute();

    // redirect back to same page
    header("Location: index.php");
    exit;
}
else
{
    if (isset($_GET['news_id'])) 
    {
        // grabs from database for editing
        $id = $_GET['news_id'];
        $sql = "SELECT title, content FROM news WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $title = $row['title'];
            $content = $row['content'];
        }

    }

}
header("Location: edit_news.php?param1=$title&param2=$content");


?>