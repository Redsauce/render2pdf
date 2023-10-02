<?php
require 'decoder.php';
require 'page_title.php';
if (array_key_exists('url', $_REQUEST)) {

    // Get the url if exists
    $url = "";
    if (array_key_exists('url', $_GET)) {
        $url = base32_decode($_GET['url']);
    } else {
        $url = $_POST['url'];
    }

    // Get filename if exist
    $fileName = "";
    if (array_key_exists('filename', $_GET)) {
        $fileName = $_GET['filename'];
    }
    if (array_key_exists('filename', $_POST)) {
        $fileName = $_POST['filename'];
    }

    // Get the content in a temporal random file
    $random = rand();
    $file_url = "/var/www/html/pdfs/output$random.pdf";
    set_time_limit(500);
    $command = "wkhtmltopdf -q \"" . $url . "\" $file_url";
    exec($command);

    // If the random file exists
    if (file_exists($file_url)) {

        // Set the final fileName
        if ($fileName == ""){
            $fileName = page_title($url);
            if ($fileName == "" || $fileName == null)
                $fileName = "output";
        }

        // Create the attachment
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$fileName.".pdf\"");
        readfile($file_url);
        unlink($file_url);

    } else {
        echo "hubo un error! :(";
    }
} else {
    echo '<html>
        <body>';
    echo '<form action="" method="POST">
        <input type="text" name="url" placeholder="http://someplace.com"/>
        <input type="submit"/></br>
        <input type="text" name="filename" placeholder="output"/>
        </form>
        </body>
        </html>';
}
?>
