<?php

namespace ExactChange\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ExactChange\Form\ExactChangeForm;
use Zend\View\Model\ViewModel;

class ExactChangeWidget extends AbstractHelper
{

    protected $exactChangeForm;

    protected $viewTemplate;

    public function __invoke($options = array())
    {
        $options += array(
            'render' => true,
            'redirect' => false,
        );

        $vm = new ViewModel(array(
            'exactChangeForm' => $this->getExactChangeForm(),
            'redirect' => $options['redirect'],
        ));

        $vm->setTemplate($this->viewTemplate);
        if ($options['render']) {
            return $this->getView()->render($vm);
        }
        return $vm;
    }

    public function getExactChangeForm()
    {
        return $this->exactChangeForm;
    }

    public function setExactChangeForm(ExactChangeForm $exactChangeForm)
    {
        $this->exactChangeForm = $exactChangeForm;
        return $this;
    }

    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }
}