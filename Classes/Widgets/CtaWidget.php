<?php

declare(strict_types=1);

namespace GeorgRinger\Doc\Widgets;

use TYPO3\CMS\Core\Page\JavaScriptModuleInstruction;
use TYPO3\CMS\Dashboard\Widgets\AdditionalJavaScriptInterface;

class CtaWidget extends \TYPO3\CMS\Dashboard\Widgets\CtaWidget implements AdditionalJavaScriptInterface
{

    public function getJsFiles(): array
    {
        return [
            'EXT:doc/Resources/Public/JavaScript/widget-cta.js',
        ];
    }
}