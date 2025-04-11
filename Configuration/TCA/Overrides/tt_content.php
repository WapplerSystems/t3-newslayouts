<?php


use TYPO3\CMS\Core\Resource\FileType;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$additionalColumns = [
    'tx_newslayouts_dummyimage' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:newslayouts/Resources/Private/Language/locallang_db.xlf:tt_content.tx_newslayouts_dummyimage',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'overrideChildTca' => [
                'types' => [
                    FileType::IMAGE->value => [
                        'showitem' => '
                        --palette--;;imageoverlayPalette,
                        --palette--;;filePalette
                    ',
                    ],
                ],
                'columns' => [
                    'crop' => [
                        'config' => [
                            'cropVariants' => [
                                'default' => [
                                    'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
                                    'allowedAspectRatios' => [
                                        'NaN' => [
                                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
                                            'value' => 0.0
                                        ],
                                    ],
                                    'selectedRatio' => 'NaN',
                                    'cropArea' => [
                                        'x' => 0.0,
                                        'y' => 0.0,
                                        'width' => 1.0,
                                        'height' => 1.0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'maxitems' => 1,
            'minitems' => 0,

        ],
    ],
];
ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);

ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'tx_newslayouts_dummyimage', 'news_pi1', 'after:pi_flexform');
