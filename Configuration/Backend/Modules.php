<?php

use GeorgRinger\Doc\Controller\DocModuleController;


return [
    'doc' => [
        'parent' => 'help',
        'position' => ['after' => ''],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/doc',
        'labels' => 'LLL:EXT:doc/Resources/Private/Language/locallang_mod.xlf',
        'icon' => 'EXT:doc/Resources/Public/Icons/module-doc.svg',
        'extensionName' => 'doc',
        'controllerActions' => [
            DocModuleController::class => [
                'main',
            ],
        ],
    ],
];
