<?php
// Set the ApplicationContext in this file, because it is not possible to set environment variables
// inside the .htaccess on domainFACTORY servers

$context = 'Production';

// detect application context by domain
if (array_key_exists('HTTP_HOST', $_SERVER)) {
    if ($_SERVER['HTTP_HOST'] === 'typo3lexikon.home') {
        $context = 'Development/DDevHome';
    } elseif ($_SERVER['HTTP_HOST'] === 'home-5008552505.app-ionos.space') {
        $context = 'Production/Ionos';
    } elseif (preg_match('@^.*\.ddev\.site$@', $_SERVER['HTTP_HOST'])) {
        $context = 'Development/DDev';
    }
}

putenv('TYPO3_CONTEXT=' . $context);
