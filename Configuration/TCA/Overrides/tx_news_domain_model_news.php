<?php


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$fields = [
    'layout' => [
        'exclude' => true,
        'label' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:layout',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.layout', ''],
            ],
            'minitems' => 0,
            'maxitems' => 1,
            /*
            'fieldWizard' => [
                'selectIcons' => [
                    'disabled' => false,
                    //'renderType' => 'selectBigNewsLayoutIcons'
                    'renderType' => 'selectSingle'
                ],
            ],*/
        ],
    ],
];


ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'layout,', '', 'after:title');

/*
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['fal_media']['config']['overrideChildTca']['columns'] = array_merge_recursive(
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['fal_media']['config']['overrideChildTca']['columns'] ?? [],
    [
        'crop' => [
            'config' => [
                'cropVariants' => [
                    'default' => [
                        'title' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:crop.default',
                        'allowedAspectRatios' => [
                            'default' => 1,
                        ],
                    ],
                    'latest_square' => [
                        'title' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:crop.latest_square',
                        'allowedAspectRatios' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
                            'value' => 1,
                        ],
                    ],
                ],
            ],
        ],
    ]
);
*/
