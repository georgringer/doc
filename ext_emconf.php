<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Markdown docs for everybody',
    'description' => 'Render documentation based on markdown files directly in the backend',
    'category' => 'be',
    'version' => '1.0.0',
    'state' => 'beta',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.9-11.6.99',
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
