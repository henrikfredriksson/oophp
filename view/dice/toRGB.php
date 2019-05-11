<?php

function toRGB(int $val)
{

    $red = 0;
    $green = 0;
    if ($val >= 50) {
        $red = 255 - round((($val - 50) / 50) * 255);
        $green = 255;
    } else {
        $red = 255;
        $green = round(($val / 50) * 255);
    }

    return "rgb(" . $red . "," . $green . ",0)";
}
