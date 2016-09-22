<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:typo3lexikon/Resources/Private/Language/locallang_db.xlf:tx_typo3lexikon_answer',
        'label' => 'question_key',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('typo3lexikon') . 'Resources/Public/Icons/tx_typo3lexikon_answer.gif',
    ),
    'interface' => array(
        'showRecordFieldList' => 'question_key, value',
    ),
    'columns' => array(
        'question_key' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:typo3lexikon/Resources/Private/Language/locallang_db.xlf:tx_typo3lexikon_answer.question_key',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'required'
            ),
        ),
        'value' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:typo3lexikon/Resources/Private/Language/locallang_db.xlf:tx_typo3lexikon_answer.value',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'required'
            ),
        ),
    ),
    'types' => array(
        '1' => array('showitem' => 'question_key, value'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);
