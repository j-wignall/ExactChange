<?php
return array(
    'controllers' => array(
        'factories' => array(
            'ExactChange\Controller\ExactChange' => 'ExactChange\Factory\Controller\ExactChangeControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'exact-change' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/exact-change[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'ExactChange\Controller\ExactChange',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'exact-change' => __DIR__ . '/../view',
        ),
    ),
);