<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Widgets\Provider;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;

/**
 * Provide link for project documentation.
 * Check whether EXT:doc is enabled and add link to module.
 * No link is returned if not enabled.
 */
class ExtDocButtonProvider implements ButtonProviderInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $target;

    public function __construct(string $title, string $target = '')
    {
        $this->title = $title;
        $this->target = $target;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLink(): string
    {
        if (ExtensionManagementUtility::isLoaded('doc')) {
            return 'javascript:top.goToModule(' . GeneralUtility::quoteJSvalue('help_doc') . ');';
        }

        return '';
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}
