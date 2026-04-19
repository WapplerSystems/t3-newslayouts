<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Layouts for news articles',
    'description' => 'Extends EXT:news plugins and records with individual layout settings. Supports bootstrap css framework.',
    'category' => 'plugin',
    'author' => 'Sven Wappler',
    'author_email' => 'typo3YYYY@wappler.systems',
    'author_company' => 'WapplerSystems',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '14.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.0.0-14.4.99',
            'news' => '9.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
