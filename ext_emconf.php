<?php

$EM_CONF['newslayouts'] = [
    'title' => 'Layouts for news articles',
    'description' => 'Extends EXT:news records with individual layout settings',
    'category' => 'plugin',
    'author' => 'Sven Wappler',
    'author_email' => 'typo3YYYY@wappler.systems',
    'author_company' => 'WapplerSystems',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.0.0-11.9.99',
            'news' => '9.0.0-9.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
