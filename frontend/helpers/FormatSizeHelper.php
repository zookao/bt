<?php
namespace frontend\helpers;

use Yii;

class FormatSizeHelper{

    function formatBytes($size) {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2).$units[$i];
    }

}