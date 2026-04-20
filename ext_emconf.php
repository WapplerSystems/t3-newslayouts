<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'News Layouts',
    'description' => 'Extends EXT:news with individual layout settings per plugin and record. Adds image format options, metadata display controls (date, category, tags, author), and Bootstrap-ready templates.',
    'category' => 'plugin',
    'author' => 'Sven Wappler',
    'author_email' => 'typo3YYYY@wappler.systems',
    'author_company' => 'WapplerSystems',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '14.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '14.0.0-14.4.99',
            'news' => '9.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
