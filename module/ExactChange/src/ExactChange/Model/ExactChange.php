<?php
namespace ExactChange\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ExactChange implements InputFilterAwareInterface
{
    public $id;
    public $monetaryAmount;
    public $minNumberOfCoins;
    public $exactCoins;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id               = (isset($data['id']))     ? $data['id']     : null;
        $this->monetaryAmount   = (isset($data['monetaryAmount'])) ? $data['monetaryAmount'] : null;
        $this->minNumberOfCoins   = (isset($data['minNumberOfCoins'])) ? $data['minNumberOfCoins'] : null;
        $this->exactCoins   = (isset($data['exactCoins'])) ? $data['exactCoins'] : null;
    }

    // Add content to this method:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
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
                        ),
                    )
                    ),

                )
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}