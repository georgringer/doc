<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Markdown docs for everybody',
    'description' => 'Render documentation based on markdown files directly in the backend',
    'category' => 'be',
    'version' => '3.0.0',
    'state' => 'beta',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
