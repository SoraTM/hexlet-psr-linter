<?php

namespace Linter\File;

function getContent($file)
{
    if (file_exists($file) && is_readable($file)) {
        return file_get_contents($file);
    } else {
        throw new \Exception("Unable to read file or not exist");
    }
}

function writeContent($string, $fileName)
{
    file_put_contents($fileName, $string);
}
