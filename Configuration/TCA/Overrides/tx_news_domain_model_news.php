<?php


$fields = [
    'layout' => [
        'exclude' => true,
        'label' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:layout',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.backend_layout.default', ''],
            ],
            'minitems' => 0,
            'maxitems' => 1,
            'fieldWizard' => [
                'selectIcons' => [
                    'disabled' => false,
                    'renderType' => 'selectBigNewsLayoutIcons'
                ],
            ],
        ],
    ],
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'layout,', '', 'after:title');
