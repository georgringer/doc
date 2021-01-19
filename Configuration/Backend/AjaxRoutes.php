<?php

use TYPO3\CMS\Backend\Controller;

return [

    'doc_serve' => [
        'path' => '/doc/serve',
        'access' => 'public',
        'target' => \GeorgRinger\Doc\Controller\DocServeController::class . '::mainAction'
    ],
];
