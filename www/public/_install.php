<?php

/**
 * Install script
 */

$symlinks = [
    'storage/app/public' => 'public/storage',
];

$basePath = realpath(__DIR__ . '/../');

$res = [];

foreach ($symlinks as $target => $link) {

    $fullTarget = $basePath . '/' . $target;
    $fullLink = $basePath . '/' . $link;
    if (!file_exists($fullTarget)) {
        $res[$target] = 'target is not a file or directory';
        continue;
    }

    if (!file_exists(dirname($fullLink))) {
        mkdir(dirname($fullLink), 0755, true);
    }
    $res[$target] = makeSymbolicLink($fullTarget, $fullLink);
}

// ====================================================================================================================

echo 'RESULT:';

echo('<pre>'.print_r($res, true).'</pre>');

echo '<br>' . $basePath;

// ====================================================================================================================

/**
 * [windows_os description]
 *
 * @return [type] [description]
 */
function windows_os()
{
    return strtolower(substr(PHP_OS, 0, 3)) === 'win';
}

/**
 * [makeSymbolicLink description]
 *
 * @param [type] $target [description]
 * @param [type] $link   [description]
 *
 * @return [type] [description]
 */
function makeSymbolicLink($target, $link)
{
    $res = '';
    $reo = ' :: ' . $target . ' -> ' . $link;

    $create = true;

    if (file_exists($link)) {
        if (isset($_GET['force'])) {
            if (! windows_os()) {
                @unlink($link);
                $res .= ' [force delete]';
                $create = true;
            } else {
                @exec("rmdir /q \"{$link}\"");
                $res .= ' [force delete by windows]';
                $create = true;
            }
        } else {
            $res .= ' [link exists]';
            $create = false;
        }
    }

    if (!$create) {
        return $res . '<br>' . $reo . '<br>';
    }

    if (! windows_os()) {
        $r = @symlink($target, $link) ? ' [created]' : ' [failure]';
        $res .= $r;
    } else {
        $mode = is_dir($target) ? 'J' : 'H';
        @exec("mklink /{$mode} \"{$link}\" \"{$target}\"");
        $res .= ' [probably created by windows]';
    }

    return $res . '<br>' . $reo . '<br>';
}
