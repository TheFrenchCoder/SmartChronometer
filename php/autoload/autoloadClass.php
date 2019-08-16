<?php

$path['main'] = $_SERVER["DOCUMENT_ROOT"]."/php";

// CLASS AUTOLOAD SYSTEM
spl_autoload_register(function($className) {
    $fileName = stream_resolve_include_path('classes/' . $className . '.php');
    if ($fileName !== false) {
        include $fileName;
    }
});

// TRAIT AUTOLOAD SYSTEM
spl_autoload_register(function($traitName) {
    $fileName = stream_resolve_include_path('traits/' . $traitName . '.php');
    if ($fileName !== false) {
        include $fileName;
    }
});