<?php
namespace ExactChange\Form;

use ExactChange\Options\ModuleOptions;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class ExactChangeForm extends ProvidesEventsForm
{
    protected $options;

    public function __construct($name = null, ModuleOptions $options)
    {
        $this->options = $options;
        parent::__construct($name);

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'monetaryAmount',
            'type' => 'text',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Enter',
                'id' => 'submitbutton',
            ),
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

}