<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;


class DocModuleController
{


    /**
     * @param ServerRequestInterface $request the current request
     * @return ResponseInterface the response with the content
     */
    public function mainAction(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->getStandaloneView();
        return new HtmlResponse($view->render());
    }

    private function getStandaloneView(): StandaloneView
    {
        $settings = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('doc');
        $docRootPath = $settings['documentationRootPath'] ?? '';
        if (!$docRootPath) {
            throw new \UnexpectedValueException('Documentation root path not set', 1609235458);
        }

        $documentationName = $settings['documentationName'] ?? '';

        $publicResourcesPath = '../../' . PathUtility::getRelativePathTo(ExtensionManagementUtility::extPath('doc')) . 'Resources/Public/docsify/';


        $templatePathAndFilename = GeneralUtility::getFileAbsFileName('EXT:doc/Resources/Private/Templates/Module.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->assignMultiple([
            'path' => $publicResourcesPath,
            'docRoothPath' => $docRootPath,
            'documentationName' => $documentationName,
            'darkMode' => $settings['darkMode'] ?? false
        ]);
        return $view;
    }
}
