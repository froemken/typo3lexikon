<?php
defined('TYPO3_MODE') or die();

call_user_func(
    function ($extKey) {
        // Add pageTSconfig to hide Fields I don't need
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
            $extKey,
            'Configuration/PageTSconfig/SpecialConfiguration.ts',
            'Special Configuration'
        );
        // Add pageTSconfig for RTE configuration
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
            $extKey,
            'Configuration/PageTSconfig/CKEditor.ts',
            'CKEditor configuration'
        );
    },
    'typo3lexikon'
);
