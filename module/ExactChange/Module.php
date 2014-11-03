<?php
namespace ExactChange;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'exactChangeWidget' => 'ExactChange\Factory\View\Helper\ExactChangeWidgetFactory',
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'ExactChange\Form\ExactChangeForm' => 'ExactChange\Form\ExactChangeForm',
                'exact_change_service' => 'ExactChange\Service\ExactChange',
            ),
            'factories' => array(
                'exact_change_module_options' => 'ExactChange\Factory\ModuleOptionsFactory',
                'exact_change_form' => 'ExactChange\Factory\Form\ExactChangeFormFactory',
            ),
        );
    }

}