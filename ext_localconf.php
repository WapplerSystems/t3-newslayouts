<?php


use TYPO3\CMS\Backend\Form\FormDataProvider\InlineOverrideChildTca;
use TYPO3\CMS\Backend\Form\FormDataProvider\PageTsConfig;

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'newslayouts';

/*
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1508619825] = [
    'nodeName' => 'selectBigNewsLayoutIcons',
    'priority' => '70',
    'class' => \WapplerSystems\Newslayouts\Backend\Form\FieldWizard\SelectBigIcons::class,
];
*/

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][WapplerSystems\Newslayouts\Backend\Form\FormDataProvider\PageTsConfigOverrideChildTca::class] = [
    'depends' => [
        PageTsConfig::class,
    ],
    'before' => [
        InlineOverrideChildTca::class
    ]
];
