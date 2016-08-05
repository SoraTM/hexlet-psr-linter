<?php

namespace Linter\File;

use \Linter\Exceptions\FileException;

function getContent($file)
{
    if (file_exists($file) && is_readable($file)) {
        return file_get_contents($file);
    } else {
        throw new FileException("Unable to read file or not exist");
    }
}

function writeContent($string, $fileName)
{
    file_put_contents($fileName, $string);
}
