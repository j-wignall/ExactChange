<?php
namespace ExactChange\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ExactChange\Model\ExactChange;


class ExactChangeController extends AbstractActionController
{
    protected $exactChangeService;
    protected $options;
    protected $exactChangeForm;

    public function __construct($exactChangeService, $options, $exactChangeForm) {
        $this->exactChangeService = $exactChangeService;
        $this->options = $options;
        $this->exactChangeForm = $exactChangeForm;
    }

    public function indexAction()
    {
        $service = $this->exactChangeService;
        $form = $this->exactChangeForm;
        $form->get('submit')->setValue('Enter');

        $request = $this->getRequest();

        if ($request->isPost()) {

            $change = new ExactChange();
            $form->setInputFilter($change->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $change->exchangeArray($form->getData());
                $service->process($change->monetaryAmount);

                return array(
                    'form' => $form,
                    'initialValue' => $service->getInitialValue(),
                    'minNumCoins' => $service->getMinNumCoins(),
                    'coinsString' => $service->getCoinsString()
                );
            }
        }
        return array(
            'form' => $form,
        );

    }
}