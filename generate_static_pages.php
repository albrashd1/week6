<?php
// Function to truncate text to a specified number of words
function truncateText($text, $maxWords, $ellipsis = '...') {
    $words = preg_split('/\s+/', $text);
    if (count($words) > $maxWords) {
        $words = array_slice($words, 0, $maxWords);
        $text = implode(' ', $words) . $ellipsis;
    }
    return $text;
}

// Define a function to generate static pages (e.g., save as HTML files)
function generateStaticPage($news_id, $title, $content, $publish_date) {
    // Define the path where you want to save the static pages
    $staticPagePath = 'static_pages/';
    // Create the filename for the static page using a function (see step 3)
    $filename = generateStaticPageFilename($news_id, $title);
    // Combine the path and filename
    $filepath = $staticPagePath . $filename;
    // Create the static page content
    $staticPageContent = "<html><head><title>$title</title></head><body><h1>$title</h1><p><em>Published on: $publish_date</em></p><p>$content</p></body></html>";
    // Save the content to the file
    file_put_contents($filepath, $staticPageContent);
}

// Define a function to generate static page filenames
function generateStaticPageFilename($news_id, $title) {
    // Remove spaces and special characters, and use the ID and title in the filename
    $filename = "news_" . $news_id . "_" . strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $title)) . ".html";
    return $filename;
}
?>