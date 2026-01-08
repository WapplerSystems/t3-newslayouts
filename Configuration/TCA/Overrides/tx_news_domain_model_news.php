<?php


use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$fields = [
    'layout' => [
        'exclude' => true,
        'label' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.layout',
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
    'gallery' => [
        'exclude' => true,
        'label' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.gallery',
        'config' => [
            'type' => 'file',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
            'appearance' => [
                'createNewRelationLinkTitle' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.fal_media.add',
                'showPossibleLocalizationRecords' => true,
                'showAllLocalizationLink' => true,
                'showSynchronizationLink' => true,
            ],
            'overrideChildTca' => [
                'types' => [
                    File::FILETYPE_UNKNOWN => [
                        'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette',
                    ],
                    File::FILETYPE_IMAGE => [
                        'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette',
                    ],
                    File::FILETYPE_VIDEO => [
                        'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;videoOverlayPalette,
                                    --palette--;;filePalette',
                    ],
                    File::FILETYPE_APPLICATION => [
                        'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette',
                    ],
                ],
            ],
            'allowed' => 'common-media-types',
        ],
    ],
];


ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'layout,', '', 'after:title');
ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'gallery,', '', 'after:fal_media');
