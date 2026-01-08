<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Layouts for news articles',
    'description' => 'Extends EXT:news records with individual layout settings',
    'category' => 'plugin',
    'author' => 'Sven Wappler',
    'author_email' => 'typo3YYYY@wappler.systems',
    'author_company' => 'WapplerSystems',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '12.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.4.99',
            'news' => '9.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
