<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use GuzzleHttp\Psr7\MimeType;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;


class DocServeController
{

    protected $extensionConfiguration = [];

    public function __construct()
    {
        try {
            $this->extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('doc');
        } catch (\Exception $e) {
            // do nothing
        }
    }


    /**
     * @param ServerRequestInterface $request the current request
     * @return ResponseInterface the response with the content
     */
    public function mainAction(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $file = $this->getFile($request->getQueryParams()['path'] ?? '');
        if ($file) {
            $content = file_get_contents($file);

            $body = new Stream('php://temp', 'rw');
            $body->write($content);
            $response = $response->withBody($body)
                ->withAddedHeader('content-length', (string)filesize($file))
                ->withStatus(200);

            $mime = MimeType::fromFilename($file);
            if ($mime === null && StringUtility::endsWith(strtolower($file), '.md')) {
                $mime = 'text/markdown';
            }
            if ($mime) {
                $response = $response->withAddedHeader('content-type', $mime);
            }

        } else {
            $response = new Response('php://temp', 404);
        }
        return $response;
    }

    private function getFile(string $path): string
    {
        $path = PathUtility::getCanonicalPath($path);
        if (!StringUtility::beginsWith($path, $this->extensionConfiguration['documentationRootPath'] ?? '')) {
            return '';
        }

        $fileInfo = pathinfo($path);
        if (!in_array(strtolower($fileInfo['extension']), ['png', 'svg', 'gif', 'md', 'doc', 'docx', 'jpeg', 'jpg'], true)) {
            return '';
        }

        $file = Environment::getPublicPath() . $path;
        if (!is_file($file)) {
            return '';
        }

        return $file;
    }

    private function getStandaloneView(): StandaloneView
    {
        $settings = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('doc');
        $docRootPath = $settings['documentationRootPath'] ?? '';
        if (!$docRootPath) {
            throw new \UnexpectedValueException('Documentation root path not set', 1609235458);
        }

        $publicResourcesPath = '../../' . PathUtility::getRelativePathTo(ExtensionManagementUtility::extPath('doc')) . 'Resources/Public/docsify/';


        $templatePathAndFilename = GeneralUtility::getFileAbsFileName('EXT:doc/Resources/Private/Templates/Module.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->assignMultiple([
            'path' => $publicResourcesPath,
            'docRoothPath' => $docRootPath,
            'darkMode' => $settings['darkMode'] ?? false
        ]);
        return $view;
    }
}
