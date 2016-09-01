<?php
defined('TYPO3_MODE') or die();

call_user_func(
    function ($extKey) {
        // Add static TypoScript Template
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            $extKey,
            'Configuration/TypoScript/',
            'TS Template for PAGE'
        );
    },
    'typo3lexikon'
);
