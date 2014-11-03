<?php
namespace ExactChange\Form;

use ExactChange\Options\ModuleOptionsInterface;
use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class ExactChangeFilter extends ProvidesEventsInputFilter
{
    public function __construct(ModuleOptionsInterface $options)
    {
        $identityParams = array(
            'name' => 'identity',
            'required' => true,
            'validators' => array()
        );

        $this->add($identityParams);

         $this->add(array(
            'name'     => 'id',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name'     => 'monetaryAmount',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'ExactChange\Validator\MonetaryAmount',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 100,
                    ),
                )
            ),
        ));

        $this->getEventManager()->trigger('init', $this);
    }
}