<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Edit News</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        //var param1Value = urlParams.get('param1');
        var param2Value = urlParams.get('param2');
        //document.getElementById('news_title').value = param1Value;

        tinymce.init({
            selector: 'textarea',
            setup: function (editor) {
                editor.on('init', function () {
                    tinymce.activeEditor.setContent(param2Value);

                })
            }
        });
    </script>
</head>

<body>
    <h1>Editing</h1>
    <form method="post" action="process_news.php">
        <label for="news_title">News Title:</label>
        <input type="text" name="news_title" id="news_title"><br><br>
        <label for="news_content">News Content:</label>
        <textarea name="news_content" id="news_content"></textarea><br><br>
        <input type="submit" value="Submit Edited News">
    </form>

    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var param1Value = urlParams.get('param1');
        document.getElementById('news_title').value = param1Value;
    </script>
</body>

</html>