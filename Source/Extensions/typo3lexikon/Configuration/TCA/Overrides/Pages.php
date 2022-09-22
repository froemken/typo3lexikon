<?php
defined('TYPO3_MODE') or die();

call_user_func(static function () {
    // Add pageTSconfig to hide Fields I don't need
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'typo3lexikon',
        'Configuration/PageTSconfig/SpecialConfiguration.ts',
        'Special Configuration'
    );
    // Add pageTSconfig for RTE configuration
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'typo3lexikon',
        'Configuration/PageTSconfig/CKEditor.ts',
        'CKEditor configuration'
    );
});
