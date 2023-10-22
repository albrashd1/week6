<?php
include 'db.php';
include 'paginator.php';

$selectedItemsPerPage = $_GET['itemsPerPage'];
$paginator = new Paginator();
$paginator->itemsPerPage = $selectedItemsPerPage;

$CountNews = "SELECT COUNT(id) AS count FROM news";
$result = $conn->query($CountNews);

$row = $result->fetch_assoc();


$count = $row['count'];

$paginator->total = $count; 
$paginator->paginate($itemsPerPage = $selectedItemsPerPage);

$offset = ($paginator->currentPage - 1 ) * $paginator->itemsPerPage;
print_r($paginator->itemsPerPage);
print_r("---");
print_r($offset);
$query = "SELECT * FROM news LIMIT $offset , " . $paginator->itemsPerPage;
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['content'] . "</p>";
    echo "<hr>";
}
?>