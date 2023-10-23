<?php
include('config.php');
include('pagination.php');
include('generate_static_pages.php')
?>

<!DOCTYPE html>
<html>
<head>
    <title>News Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function submitForm() {
            document.getElementById("itemsPerPageForm").submit();
        }
    </script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea'
      });
    </script>
</head>
<body>
    <h1>News Articles</h1>
    
    <!-- Display the number of items per page selection -->
    <form id="itemsPerPageForm" action="index.php" method="get">
        Show:
        <select name="itemsPerPage" onchange="submitForm()">
            <option value="5" <?php if ($itemsPerPage == 5) echo "selected"; ?>>5</option>
            <option value="10" <?php if ($itemsPerPage == 10) echo "selected"; ?>>10</option>
            <option value="25" <?php if ($itemsPerPage == 25) echo "selected"; ?>>25</option>
            <option value="50" <?php if ($itemsPerPage == 50) echo "selected"; ?>>50</option>
            <option value="100" <?php if ($itemsPerPage == 100) echo "selected"; ?>>100</option>
            <option value="all" <?php if ($itemsPerPage == 'all') echo "selected"; ?>>All</option>
        </select>
    </form>

    <form method="post" action="process_news.php">
        <label for="news_title">News Title:</label>
        <input type="text" name="news_title" id="news_title"><br><br>
        <label for="news_content">News Content:</label>
        <textarea name="news_content" id="news_content"></textarea><br><br>
        <input type="submit" value="Submit News">
    </form>


    <ul>
        <?php 
        // Database query to retrieve news articles
        $query = "SELECT * FROM news ORDER BY publish_date DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $mysqli->query($query);
        
        while ($row = $result->fetch_assoc()) : 
        ?>
            <li>
                <h2><a href="static_pages/<?php echo generateStaticPageFilename($row['id'], $row['title']); ?>"><?php echo $row['title']; ?></a></h2>
                <p><?php echo truncateText($row['content'], 50); ?></p>
                <p><em>Published on: <?php echo $row['publish_date']; ?></em></p>
                <form method="get" action="process_news.php">
                    <input type="hidden" name="news_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" id="editButton">Edit News Post </button>
                </form>
            </li>
            
            
            <?php
            // After displaying the news article on the page, call generateStaticPage to create the static page
            generateStaticPage($row['id'], $row['title'], $row['content'], $row['publish_date']);
            ?>

        <?php endwhile; ?>
    </ul>

    <div class="pagination">
        <a href='?page=<?php echo $prevPage; ?>&itemsPerPage=<?php echo $itemsPerPage; ?>' class="<?php echo $prevDisabled; ?>">Previous</a>
        <?php
        // Generate links for page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i&itemsPerPage=$itemsPerPage'";
            if ($i === $currentpage) {
                echo " class='current'";
            }
            echo ">$i</a> ";
        }
        ?>
        <a href='?page=<?php echo $nextPage; ?>&itemsPerPage=<?php echo $itemsPerPage; ?>' class="<?php echo $nextDisabled; ?>">Next</a>
    </div>
</body>
</html>

