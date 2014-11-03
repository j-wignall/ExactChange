<?php

namespace ExactChange\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ExactChange\Form;
use ExactChange\Options;
use ExactChange\View\Helper\ExactChangeWidget;

class ExactChangeWidgetFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $pluginManager)
    {
        $serviceManager = $pluginManager->getServiceLocator();

        $options = $serviceManager->get('exact_change_module_options');

        $viewTemplate = $options->getExactChangeWidgetViewTemplate();

        $exactChangeForm = $serviceManager->get('exact_change_form');

        $viewHelper = new ExactChangeWidget();

        $viewHelper
            ->setViewTemplate($viewTemplate)
            ->setExactChangeForm($exactChangeForm)
        ;

        return $viewHelper;
    }
}