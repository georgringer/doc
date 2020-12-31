<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
    'help',
    'doc',
    '',
    '',
    [
        'routeTarget' => \GeorgRinger\Doc\Controller\DocModuleController::class . '::mainAction',
        'access' => 'group,user',
        'name' => 'help_doc',
        'icon' => 'EXT:doc/Resources/Public/Icons/module-doc.svg',
        'labels' => 'LLL:EXT:doc/Resources/Private/Language/locallang_mod.xlf'
    ]
);
