<?php

return [
    'doc_serve' => [
        'path' => '/doc/serve/{segment_01}',
        'access' => 'public',
        'target' => \GeorgRinger\Doc\Controller\DocServeController::class . '::mainAction'
    ],
];
