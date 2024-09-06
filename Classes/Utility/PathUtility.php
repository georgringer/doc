<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Utility;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PathUtility
{

    public static function getDocRootPath()
    {
        $settings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('doc');

        $docRootPath = $settings['documentationRootPath'] ?? '';
        if (!$docRootPath) {
            throw new \UnexpectedValueException('Documentation root path not set', 1609235458);
        }
        return $docRootPath;
    }
}