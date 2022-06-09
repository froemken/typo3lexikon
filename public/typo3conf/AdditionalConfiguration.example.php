<?php

if (getenv('DEBUG')) {
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
} else {
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = false;
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = false;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 0;
}

$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['driver'] = getenv('DB_CONNECTION');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = getenv('DB_DATABASE');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = getenv('DB_HOST');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = getenv('DB_PASSWORD');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['port'] = getenv('DB_PORT');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = getenv('DB_USERNAME');


$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor'] = 'ImageMagick';
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path'] = '/usr/bin/';
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path_lzw'] = '/usr/bin/';

$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'smtp';
