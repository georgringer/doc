<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use GeorgRinger\Doc\Utility\PathUtility as DocPathUtility;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Page\JavaScriptModuleInstruction;
use TYPO3\CMS\Core\Page\PageRenderer;
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

        $documentationName = $settings['documentationName'] ?? 'Documentation';
        $docRootPath = DocPathUtility::getDocRootPath();
        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uri = (string)$uriBuilder->buildUriFromRoute('ajax_doc_serve', ['path' => $docRootPath]);
//var_dump($uri);die;
        $templatePathAndFilename = GeneralUtility::getFileAbsFileName('EXT:doc/Resources/Private/Templates/Module.html');

        $html =
            <<<HTML
<script>
        var docRootPath = '$uri';
        var documentationName = '$documentationName';
        
    </script>
HTML;


        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->assignMultiple([
            'html' => $html,
            'docRootPath' => $uri,
            'documentationName' => $documentationName,
            'darkMode' => $settings['darkMode'] ?? false,
        ]);
        return $view;
    }

    public function processRequest(RequestInterface $request): ResponseInterface
    {
        $view = $this->getStandaloneView();
        return new HtmlResponse($view->render());
    }
}
