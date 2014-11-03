<?php
namespace ExactChange\Factory\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ExactChange\Form\ExactChangeForm;
use ExactChange\Form\ExactChangeFilter;
use ExactChange\Options;

class ExactChangeFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $options = $serviceManager->get('exact_change_module_options');

        $inputFilter = new ExactChangeFilter($options);

        $form = new ExactChangeForm(null, $options);

        $form->setInputFilter($inputFilter);

        return $form;
    }
}