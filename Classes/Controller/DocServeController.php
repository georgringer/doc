<?php
declare(strict_types=1);

namespace GeorgRinger\Doc\Controller;

use GuzzleHttp\Psr7\MimeType;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class DocServeController
{
    protected readonly Array $extensionConfiguration ;

    public function __construct(ExtensionConfiguration $extensionConfiguration)
    {
        $this->extensionConfiguration = $extensionConfiguration->get('doc');
    }

    /**
     * @param ServerRequestInterface $request the current request
     * @return ResponseInterface the response with the content
     */
    public function mainAction(ServerRequestInterface $request): ResponseInterface
    {
        $routing = $request->getAttribute('routing');
        $fileName = $routing['segment_01'];
        $response = new Response();
        $file = $this->getFile($fileName ?? '');
        if ($file) {
            $content = file_get_contents($file);

            $body = new Stream('php://temp', 'rw');
            $body->write($content);
            $response = $response->withBody($body)
                ->withAddedHeader('content-length', (string)filesize($file))
                ->withStatus(200);

            $mime = MimeType::fromFilename($file);
            if ($mime === null && str_ends_with(strtolower($file), '.md')) {
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

    private function getFile(string $fileName): string
    {
        $path = PathUtility::getCanonicalPath($this->extensionConfiguration['documentationRootPath'] . $fileName);
        if (!str_starts_with($path, $this->extensionConfiguration['documentationRootPath'] ?? '')) {
            return '';
        }

        $fileInfo = pathinfo($path);
        if (!in_array(strtolower($fileInfo['extension']), ['png', 'svg', 'gif', 'md', 'doc', 'docx', 'jpeg', 'jpg'], true)) {
            return '';
        }

        $file = GeneralUtility::getFileAbsFileName($path);
        if (!is_file($file)) {
            return '';
        }

        return $file;
    }
}
