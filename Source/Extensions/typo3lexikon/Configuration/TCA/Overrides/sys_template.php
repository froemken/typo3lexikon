<?php
defined('TYPO3_MODE') or die();

call_user_func(static function () {
    // Add static TypoScript Template
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'typo3lexikon',
        'Configuration/TypoScript/',
        'TS Template for PAGE'
    );
});
