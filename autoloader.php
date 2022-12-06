<?php
    function __autoload($class) {
        /** directories are containing a php class */
        $directories = [
            'controller/',
            'model/',
            'view/',
            'lib/'
        ];

        /** find a class in all directories */
        foreach ($directories as $directory) {
            $file = __DIR__.'/'.$directory.$class.'.php';
            if(file_exists($file)) {
                require_once($file);
                break;
            }
        }
    }