<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Directive;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Mutation;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\MutationCollection;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\MutationMode;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\Scope;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\SourceScheme;
use TYPO3\CMS\Core\Security\ContentSecurityPolicy\UriValue;
use TYPO3\CMS\Core\Type\Map;

return Map::fromEntries([
    Scope::backend(),

    new MutationCollection(
        new Mutation(
            MutationMode::Extend,
            Directive::FontSrc,
            SourceScheme::https,
            new UriValue('https://fonts.gstatic.com/s/robotomono/')
        ),
        new Mutation(
            MutationMode::Extend,
            Directive::StyleSrc,
            SourceScheme::https,
            new UriValue('https://fonts.googleapis.com/css')
        ),
    )
]);