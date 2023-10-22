<?php
// Number of items per page
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 5;

// Current page
$currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the database query
$offset = ($currentpage - 1) * $itemsPerPage;

// Calculate total number of pages based on the selected items per page
$totalNews = $mysqli->query('SELECT COUNT(*) FROM news')->fetch_row()[0];
$totalPages = ($itemsPerPage === 'all') ? 1 : ceil($totalNews / $itemsPerPage);

// Determine if "Next" and "Previous" should be disabled
$prevPage = ($currentpage > 1) ? $currentpage - 1 : 1;
$nextPage = ($currentpage < $totalPages) ? $currentpage + 1 : $totalPages;

$prevDisabled = ($currentpage <= 1) ? "disabled" : "";
$nextDisabled = ($currentpage >= $totalPages || $itemsPerPage === 'all') ? "disabled" : "";
?>
