<?php
/**
 * Compress Your PHP code,support whole project compression
 * How to use: Copy this file to the project root directory for execution
 * Author: Panco
 * Github: https://github.com/panco95
 * Email: 1129443982@qq.com
 */


$dirArray = array();
scanDirs(__DIR__, scandir(__DIR__), $dirArray);
if (is_array($dirArray) && count($dirArray) > 0) {
    foreach ($dirArray as $dir) {
        $files = scandir($dir);
        if (!is_array($files) || count($files) < 1) continue;
        foreach ($files as $file) {
            if (is_dir($file) || $file === '.' || $file === '..') continue;
            $file = $dir . DIRECTORY_SEPARATOR . $file;
            $fileInfo = pathinfo($file);
            if (!isset($fileInfo['extension']) || $fileInfo['extension'] != 'php') continue;
            file_put_contents($file, php_strip_whitespace($file));
        }
    }
}

function scanDirs($path, $dirs, &$dirArray)
{
    if (!is_array($dirs) || count($dirs) < 1) return;

    foreach ($dirs as $dir) {
        if ($dir === '.' || $dir === '..') continue;

        $dir = $path . DIRECTORY_SEPARATOR . $dir;
        if (is_dir($dir)) {
            array_push($dirArray, $dir);
            scanDirs($dir, scandir($dir), $dirArray);
        }
    }
}
