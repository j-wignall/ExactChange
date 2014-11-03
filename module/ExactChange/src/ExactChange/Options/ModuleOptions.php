<?php
namespace ExactChange\Options;
use Zend\Stdlib\AbstractOptions;

//class ModuleOptions extends AbstractOptions implements ExactChangeControllerOptionsInterface, UserServiceOptionsInterface
class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    protected $useRedirectParameterIfPresent = true;

    protected $exactChangeRedirectRoute = 'exact-change';

    protected $exactChangeEntityClass = 'ExactChange\Entity\ExactChange';

    protected $exactChangeWidgetViewTemplate = 'exact-change/exact-change/index.phtml';

    public function getExactChangeEntityClass()
    {
        return $this->exactChangeEntityClass;
    }

    public function setExactChangeEntityClass($exactChangeEntityClass)
    {
        $this->exactChangeEntityClass = $exactChangeEntityClass;
        return $this;
    }

    public function getExactChangeWidgetViewTemplate()
    {
        return $this->exactChangeWidgetViewTemplate;
    }

    public function setExactChangeWidgetViewTemplate($exactChangeWidgetViewTemplate)
    {
        $this->exactChangeWidgetViewTemplate = $exactChangeWidgetViewTemplate;
        return $this;
    }

    public function isStrictMode()
    {
        return $this->__strictMode__;
    }

    public function setStrictMode($_strictMode__)
    {
        $this->__strictMode__ = $_strictMode__;
        return $this;
    }

    public function getExactChangeRedirectRoute()
    {
        return $this->exactChangeRedirectRoute;
    }

    public function setExactChangeRedirectRoute($exactChangeRedirectRoute)
    {
        $this->exactChangeRedirectRoute = $exactChangeRedirectRoute;
        return $this;

    }

    public function isUseRedirectParameterIfPresent()
    {
        return $this->useRedirectParameterIfPresent;
    }

    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent)
    {
        $this->useRedirectParameterIfPresent = $useRedirectParameterIfPresent;
        return $this;
    }
}