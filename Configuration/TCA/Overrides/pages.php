<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

ExtensionManagementUtility::registerPageTSConfigFile(
    'newslayouts',
    'Configuration/TsConfig/Page/config.tsconfig',
    'Example news layouts'
);
