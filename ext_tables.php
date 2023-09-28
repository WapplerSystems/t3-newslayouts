<?php


/* add backend css */
$GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['newslayouts'] = 'EXT:newslayouts/Resources/Public/CSS/Backend/';


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('newslayouts', 'Configuration/TypoScript', 'News article layouts');
