<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ControllerInterface;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;



class DocModuleController implements ControllerInterface

{
    /**
     * @param ServerRequestInterface $request the current request
     * @return ResponseInterface the response with the content
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->mainAction($request);
    }

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

        $documentationName = $settings['documentationName'] ?? 'Documentation';

        $publicResourcesPath = '../../' . PathUtility::getRelativePathTo(ExtensionManagementUtility::extPath('doc')) . 'Resources/Public/docsify/';

        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uri = $uriBuilder->buildUriFromRoute('ajax_doc_serve', ['path' => $docRootPath]);

        $templatePathAndFilename = GeneralUtility::getFileAbsFileName('EXT:doc/Resources/Private/Templates/Module.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->assignMultiple([
            'path' => $publicResourcesPath,
            'docRoothPath' => $uri,
            'documentationName' => $documentationName,
            'darkMode' => $settings['darkMode'] ?? false
        ]);
        return $view;
    }

    public function processRequest(RequestInterface $request): ResponseInterface
    {
        $view = $this->getStandaloneView();
        return new HtmlResponse($view->render());
    }
}
