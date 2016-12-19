<?php
require 'decoder.php';
require 'page_title.php';
if ($_REQUEST['url']) {
    $url = "";
    if ($_GET['url']) {
        $url = base32_decode($_GET['url']);
    } else {
        $url = $_POST['url'];
    }


    $random = rand();
    $file_url = "/var/www/html/pdfs/output$random.pdf";
    set_time_limit(500);
    $command = "wkhtmltopdf -q \"" . $url . "\" $file_url";
    exec($command);
    if (file_exists($file_url)) {
        //File Download magic
        $pageTitle = page_title($url);
        if ($pageTitle == "" || $pageTitle == null)
            $pageTitle = "output";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$pageTitle.".pdf\"");
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
        <input type="submit"/>
        </form>
        </body>
        </html>';
}
?>
