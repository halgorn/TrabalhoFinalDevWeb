<?php

function __autoload(string $className): void
{
    $extensions = ['.php'];
    $sep = DIRECTORY_SEPARATOR;

    $folders = [
        'adapters' . $sep,
        'adapters' . $sep . 'contracts' . $sep,
        'config' . $sep,
        'config' . $sep . 'db' . $sep,
        'controllers' . $sep . 'users' . $sep,
        'dtos' . $sep,
        'errors' . $sep . 'users' . $sep,
        'factories' . $sep . 'adapters' . $sep,
        'factories' . $sep . 'users' . $sep . 'controllers' . $sep,
        'factories' . $sep . 'users' . $sep . 'repositories' . $sep,
        'models' . $sep,
        'repositories' . $sep . 'users' . $sep . 'contracts' . $sep,
        'repositories' . $sep . 'users',
        'utils' . $sep,
    ];

    foreach ($folders as $folder) {
        foreach ($extensions as $extension) {
            $path = $folder . $sep . $className . $extension;

            if ($folder == '') {
                $path = $folder . $className . $extension;
            }

            if (is_readable($path)) {
                include_once $path;
            }
        }
    }
}
