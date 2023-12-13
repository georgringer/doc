<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ControllerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class DocModuleController implements ControllerInterface
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->mainAction($request);
    }

    public function mainAction(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->getStandaloneView();
        return new HtmlResponse($view->render());
    }

    private function getStandaloneView(): StandaloneView
    {
        $settings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('doc');
        $docRootPath = $settings['documentationRootPath'] ?? '';
        if(!$docRootPath) {
            throw new \UnexpectedValueException('Documentation root path not set', 1609235458);
        }

        $documentationName = $settings['documentationName'] ?? 'Documentation';

        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uri = $uriBuilder->buildUriFromRoute(
            'doc_serve',
            ['path' => $docRootPath, 'segment_01' => 'placeholder']
        );

        $templatePathAndFilename = GeneralUtility::getFileAbsFileName('EXT:doc/Resources/Private/Templates/Module.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->assignMultiple([
            'docRootPath' => $uri,
            'documentationName' => $documentationName,
            'darkMode' => $settings['darkMode'] ?? false,
            'themeColor' => $settings['themeColor'] ?? '#1e46b9'
        ]);

        return $view;
    }

    public function processRequest(ServerRequestInterface $request): ResponseInterface
    {
        $view = $this->getStandaloneView();
        return new HtmlResponse($view->render());
    }
}
