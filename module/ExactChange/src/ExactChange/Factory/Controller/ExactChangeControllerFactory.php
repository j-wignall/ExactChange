<?php
namespace ExactChange\Factory\Controller;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ExactChange\Controller\ExactChangeController;

class ExactChangeControllerFactory implements FactoryInterface
{
    /**
     * Create controller
     *
     * @param ControllerManager $serviceLocator
     * @return ExactChangeController
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        $exactChangeService = $serviceLocator->get('exact_change_service');
        $exactChangeForm = $serviceLocator->get('exact_change_form');
        $options = $serviceLocator->get('exact_change_module_options');
        $controller = new ExactChangeController($exactChangeService, $options, $exactChangeForm);
        return $controller;
    }
}