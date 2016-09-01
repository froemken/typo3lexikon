<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// register eID Script for jquery-console
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['typo3lexikon_console'] = \StefanFroemken\Typo3lexikon\Ajax\Console::class . '::processRequest';
