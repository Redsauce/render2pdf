<?php
    // function to get the HTML title from a URL
    // if there not exist the <title> tag, or title is empty, return output
    function page_title($url) {
        $fp = file_get_contents($url);
        if (!$fp)
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res)
            return "output";

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        if $title == ""
            return "output";

        return $title;
    }
?>
