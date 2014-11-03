<?php
namespace ExactChange\Service;

use Zend\Form\FormInterface as Form;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use ZfcBase\EventManager\EventProvider;

use ExactChange\Options\ModuleOptions as ServiceOptions;

class ExactChange extends EventProvider implements ServiceManagerAwareInterface
{
    protected $exactChangeForm;
    protected $serviceManager;
    protected $options;

    protected $coinsString = array();
    protected $initialValue = null;
    protected $totalCoins = null;
    protected $minNumCoins = null;
    protected $result = null;

    protected $rep = array('£2.00','£1.00','50p','20p','10p','5p','2p','1p');

    public function process($monetaryAmount) {
        $normalizedValue = $this->prepareValueForCalculation($monetaryAmount);
        $this->setInitialValue($monetaryAmount);
        $this->result = $this->calculateMinimumCoins($normalizedValue);
        $this->setMinNumCoins(array_sum($this->result));
        $this->setCoinsString($this->result);
        return $this;
    }

    public function prepareValueForCalculation($val) {
        $val = str_replace('$', '', $val);
        $val = str_replace('£', '', $val);
        $val = str_replace('.', '', $val);
        $val = str_replace(',', '', $val);
        $val = str_replace('p', '', $val);
//        $validator = new \Zend\Validator\Digits();
//        $validator->isValid($val);
        return $val;
    }

    public function calculateMinimumCoins($val) {
        $s0  = floor($val / 200);
        $r200   = $val  - (floor($s0) * 200);
        $s1  = floor($r200 / 100);
        $r100   = $r200 - (floor($s1) * 100);
        $s2  = floor($r100 / 50);
        $r50    = $r100 - (floor($s2) * 50);
        $s3  = floor($r50 / 20);
        $r20    = $r50 - (floor($s3) * 20);
        $s4  = floor($r20 / 10);
        $r10    = $r20 - (floor($s4) * 10);
        $s5  = floor($r10 / 5);
        $r5     = $r10 - (floor($s5) * 5);
        $s6  = floor($r5 / 2);
        $r2     = $r5 - (floor($s6) * 2);
        $s7  = floor($r2 / 1);
        $r1     = $r2 - (floor($s7) * 1);

        return array($s0, $s1, $s2, $s3, $s4, $s5, $s6, $s7);
    }

    public function getInitialValue()
    {
        return $this->initialValue;
    }

    public function setInitialValue($initialValue)
    {
        $this->initialValue = $initialValue;
    }

    public function setCoinsString($coinsString)
    {
        $str = "";
        foreach ($coinsString as $key => $val) {
            if (!$val == 0) {
                $str .= " "
                    . $coinsString[$key]
                    . " "
                    . "x"
                    . " "
                    . $this->rep[$key]
                    . ",";
            }
        }
        $str = rtrim($str, ",");
        $str .= ".";
        $this->coinsString = $str;
        return $str;

    }

    public function getCoinsString()
    {
        return $this->coinsString;
    }

    public function setMinNumCoins($minNumCoins)
    {
        $this->minNumCoins = $minNumCoins;
    }

    public function getMinNumCoins()
    {
        return $this->minNumCoins;
    }

    public function getExactChangeForm()
    {
        if (null === $this->exactChangeForm) {
            $this->setExactChangeForm($this->serviceManager->get('exact_change_form'));
        }
        return $this->exactChangeForm;
    }

    public function setExactChangeForm(Form $exactChangeForm)
    {
        $this->exactChangeForm = $exactChangeForm;
    }

    public function getOptions()
    {
        if (!$this->options instanceof ServiceOptions) {
            $this->setOptions($this->serviceManager->get('exact_change_module_options'));
        }
        return $this->options;
    }

    public function setOptions(ServiceOptions $options)
    {
        $this->options = $options;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}