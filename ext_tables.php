<?php


/* add backend css */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['newslayouts'] = 'EXT:newslayouts/Resources/Public/CSS/Backend/';


ExtensionManagementUtility::addStaticFile('newslayouts', 'Configuration/TypoScript', 'News article layouts');
