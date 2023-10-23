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
</head>
<body>
    <h1>News Articles</h1>
    
    <!-- Display the number of items per page selection -->
    <form id="itemsPerPageForm" action="index.php" method="get">
        Show:
        <select name="itemsPerPage" onchange="submitForm()">
            <option value="5" {if $itemsPerPage == 5}selected{/if}>5</option>
            <option value="10" {if $itemsPerPage == 10}selected{/if}>10</option>
            <option value="25" {if $itemsPerPage == 25}selected{/if}>25</option>
            <option value="50" {if $itemsPerPage == 50}selected{/if}>50</option>
            <option value="100" {if $itemsPerPage == 100}selected{/if}>100</option>
            <option value="all" {if $itemsPerPage == 'all'}selected{/if}>All</option>
        </select>
    </form>

    <ul>
        {foreach from=$newsItems item=row}
            <li>
                <h2><a href="static_pages/{$row.filename}">{$row.title}</a></h2>
                <p>{$row.truncatedContent}</p>
                <p><em>Published on: {$row.publish_date}</em></p>
            </li>
        {/foreach}
    </ul>

    <div class="pagination">
        <a href='?page={$prevPage}&itemsPerPage={$itemsPerPage}' class="{$prevDisabled}">Previous</a>
        {foreach from=$pageNumbers item=pageNumber}
            <a href='?page={$pageNumber}&itemsPerPage={$itemsPerPage}' {if $pageNumber == $currentpage}class='current'{/if}>{$pageNumber}</a>
        {/foreach}
        <a href='?page={$nextPage}&itemsPerPage={$itemsPerPage}' class="{$nextDisabled}">Next</a>
    </div>
</body>
</html>
