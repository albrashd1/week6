<?php
include('config.php');
include('pagination.php');
include('generate_static_pages.php');

// Create a unique cache ID based on parameters that determine the content
$cache_id = "news_page_" . $currentpage . "_items_" . $itemsPerPage;

// Check if the template is already cached
if (!$smarty->isCached('news.tpl', $cache_id)) {
    // Assign variables to Smarty
    $smarty->assign('itemsPerPage', $itemsPerPage);
    $smarty->assign('currentpage', $currentpage);
    $smarty->assign('prevPage', $prevPage);
    $smarty->assign('nextPage', $nextPage);
    $smarty->assign('prevDisabled', $prevDisabled);
    $smarty->assign('nextDisabled', $nextDisabled);
    
    // Database query to retrieve news articles
    $query = "SELECT * FROM news ORDER BY publish_date DESC LIMIT $itemsPerPage OFFSET $offset";
    $result = $mysqli->query($query);

    $newsItems = [];
    while ($row = $result->fetch_assoc()) {
        $row['filename'] = generateStaticPageFilename($row['id'], $row['title']);
        $row['truncatedContent'] = truncateText($row['content'], 50);
        
        // Generate the static pages for each article
        generateStaticPage($row['id'], $row['title'], $row['content'], $row['publish_date']);
        
        $newsItems[] = $row;
    }

    $smarty->assign('newsItems', $newsItems);

    // Generate links for page numbers
    $pageNumbers = [];
    for ($i = 1; $i <= $totalPages; $i++) {
        $pageNumbers[] = $i;
    }
    $smarty->assign('pageNumbers', $pageNumbers);
}

// Display the template. If it's cached, it'll pull from cache, otherwise, it'll display and cache it.
$smarty->display('news.tpl', $cache_id);
?>
