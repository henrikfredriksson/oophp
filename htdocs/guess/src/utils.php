<?php

function console_log($data)
{
    $output = $data;

    if (is_array($output) == true) {
        $output = implode(',', $output);
    }

    echo "<script>console.log('" . $output . "' );</script>";
}
