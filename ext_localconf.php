<?php


$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'newslayouts';


$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1508619825] = [
    'nodeName' => 'selectBigNewsLayoutIcons',
    'priority' => '70',
    'class' => \WapplerSystems\Newslayouts\Backend\Form\FieldWizard\SelectBigIcons::class,
];
