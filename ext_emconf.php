<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Facebook Login',
    'description' => 'Login mit Facebook, schnelle Einrichtung, einfacher gehts kaum. Noch nicht existierende Nutzer erhalten automatisch einen neuen Account :)',
    'category' => 'plugin',
    'author' => 'Filmmusic.io',
    'author_email' => 'info@filmmusic.io',
    'author_company' => 'Filmmusic.io',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            't3helpers' =>  '0.9.18',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
