<?php
declare(strict_types=1);

namespace GeorgRinger\Doc;

use GeorgRinger\Doc\Widgets\Provider\ExtDocButtonProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use TYPO3\CMS\Dashboard\Dashboard;
use TYPO3\CMS\Dashboard\Widgets\CtaWidget;

return static function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    $services = $configurator->services();

    if ($containerBuilder->hasDefinition(Dashboard::class)) {
        $services->set('dashboard.widget.gotoProjectDocumentation')
            ->class(CtaWidget::class)
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg('$buttonProvider', new Reference(ExtDocButtonProvider::class))
            ->arg('$options', ['text' => 'LLL:EXT:doc/Resources/Private/Language/locallang.xlf:widget.text'])
            ->tag('dashboard.widget', [
                'identifier' => 'gotoProjectDocumentation',
                'groupNames' => 'documentation',
                'title' => 'LLL:EXT:doc/Resources/Private/Language/locallang.xlf:widget.title',
                'description' => 'LLL:EXT:doc/Resources/Private/Language/locallang.xlf:widget.description',
                'iconIdentifier' => 'content-widget-text',
                'height' => 'small'
            ])
        ;

        $services->set('GeorgRinger\Doc\Widgets\Provider\ExtDocButtonProvider')
            ->arg('$title', 'LLL:EXT:doc/Resources/Private/Language/locallang.xlf:widget.buttonText')
        ;

    }

};
