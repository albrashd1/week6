<?php
$host = 'localhost'; // Replace with the host of your database
$database = 'week6'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Number of items per page
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 5;

// Current page
$currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the database query
$offset = ($currentpage - 1) * $itemsPerPage;

// Database query to retrieve news articles
$query = "SELECT * FROM news ORDER BY publish_date DESC LIMIT $itemsPerPage OFFSET $offset";
$result = $mysqli->query($query);

// Output the HTML page
?>

<!DOCTYPE html>
<html>
<head>
    <title>News Page</title>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }
        .pagination a {
            margin: 5px;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f2f2f2;
        }
        .pagination .current {
            font-weight: bold;
            background-color: #007BFF;
            color: #fff;
        }
        .pagination .disabled {
            pointer-events: none;
            color: #aaa;
            background-color: #eee;
        }
    </style>
    <script>
        function submitForm() {
            document.getElementById("itemsPerPageForm").submit();
        }
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

    <ul>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <li>
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['content']; ?></p>
                <p><em>Published on: <?php echo $row['publish_date']; ?></em></p>
            </li>
        <?php endwhile; ?>
    </ul>
    
   
        <?php
        // Calculate total number of pages based on the selected items per page
        $totalNews = $mysqli->query('SELECT COUNT(*) FROM news')->fetch_row()[0];
        $totalPages = ($itemsPerPage === 'all') ? 1 : ceil($totalNews / $itemsPerPage);

        // Determine if "Next" and "Previous" should be disabled
        $prevPage = ($currentpage > 1) ? $currentpage - 1 : 1;
        $nextPage = ($currentpage < $totalPages) ? $currentpage + 1 : $totalPages;
        
        $prevDisabled = ($currentpage <= 1) ? "disabled" : "";
        $nextDisabled = ($currentpage >= $totalPages || $itemsPerPage === 'all') ? "disabled" : "";
        ?>
        
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