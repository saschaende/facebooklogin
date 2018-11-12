<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Facebook Login',
    'description' => 'Login mit Facebook, schnelle Einrichtung, einfacher gehts kaum :)',
    'category' => 'plugin',
    'author' => 'Sascha Ende',
    'author_email' => 'sascha@sascha-ende.de',
    'author_company' => 'Filmmusic.io',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            't3helpers' =>  '0.9.18',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
