<?php
/* Smarty version 4.3.4, created on 2023-10-23 18:55:00
  from 'C:\xampp\htdocs\html\week6\templates\news.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6536a5640af545_27749842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7253a049260558a9fb88f237cea827e69415e392' => 
    array (
      0 => 'C:\\xampp\\htdocs\\html\\week6\\templates\\news.tpl',
      1 => 1698029477,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 1,
),true)) {
function content_6536a5640af545_27749842 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
            <option value="5" selected>5</option>
            <option value="10" >10</option>
            <option value="25" >25</option>
            <option value="50" >50</option>
            <option value="100" >100</option>
            <option value="all" >All</option>
        </select>
    </form>

    <ul>
                    <li>
                <h2><a href="static_pages/news_2_test.html">test</a></h2>
                <p>hi is this work</p>
                <p><em>Published on: 2023-10-22 12:26:23</em></p>
            </li>
                    <li>
                <h2><a href="static_pages/news_5_test.html">test</a></h2>
                <p>hi is this work</p>
                <p><em>Published on: 2023-10-22 12:26:23</em></p>
            </li>
                    <li>
                <h2><a href="static_pages/news_7_test.html">test</a></h2>
                <p>NATE</p>
                <p><em>Published on: 2023-10-22 12:26:23</em></p>
            </li>
                    <li>
                <h2><a href="static_pages/news_8_test.html">test</a></h2>
                <p>NATE2</p>
                <p><em>Published on: 2023-10-22 12:26:23</em></p>
            </li>
                    <li>
                <h2><a href="static_pages/news_9_test.html">test</a></h2>
                <p>NATE7</p>
                <p><em>Published on: 2023-10-22 12:26:23</em></p>
            </li>
            </ul>

    <div class="pagination">
        <a href='?page=1&itemsPerPage=5' class="disabled">Previous</a>
                    <a href='?page=1&itemsPerPage=5' class='current'>1</a>
                    <a href='?page=2&itemsPerPage=5' >2</a>
                <a href='?page=2&itemsPerPage=5' class="">Next</a>
    </div>
</body>
</html>
<?php }
}
