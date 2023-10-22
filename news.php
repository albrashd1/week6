<?php
include 'db.php';
include 'paginator.php';

// Get the total number of news articles
$totalRecords = 0; // Replace with your SQL query to count news articles

$paginator = new Paginator();
$paginator->total = $totalRecords;
$paginator->paginate();

// Get a specific range of news articles
$offset = ($paginator->currentPage - 1) * $paginator->itemsPerPage;
$query = "SELECT * FROM news LIMIT $offset, " . $paginator->itemsPerPage;
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>News Website</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>News</h1>

<!-- Form to select the number of items per page -->
<label for="itemsPerPage">Items per page:</label>
<select id="itemsPerPage">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
</select>

<div id="news-container">
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<hr>";
    }
    ?>
</div>

<div class="pagination">
    <?php echo $paginator->pageNumbers(); ?>
</div>

<script>
$(document).ready(function() {
    // Handle changes in the number of items per page
    $("#itemsPerPage").change(function() {
        var selectedItemsPerPage = $(this).val();
        // Use AJAX to retrieve and update news content
        $.ajax({
            url: 'load_news.php', // Create a new PHP file for AJAX content loading
            type: 'GET',
            data: { itemsPerPage: selectedItemsPerPage },
            success: function(response) {
                // Update the content with the response from the server
                $("#news-container").html(response);
            }
        });
    });
});
</script>

</body>
</html>
