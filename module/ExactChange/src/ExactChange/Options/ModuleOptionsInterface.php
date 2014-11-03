<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 03/11/2014
 * Time: 03:50
 */

namespace ExactChange\Options;


interface ModuleOptionsInterface {

    public function getExactChangeEntityClass();

    public function setExactChangeEntityClass($exactChangeEntityClass);

    public function getExactChangeWidgetViewTemplate();

    public function setExactChangeWidgetViewTemplate($exactChangeWidgetViewTemplate);

    public function isStrictMode();

    public function setStrictMode($_strictMode__);

    public function getExactChangeRedirectRoute();

    public function setExactChangeRedirectRoute($exactChangeRedirectRoute);

    public function isUseRedirectParameterIfPresent();

    public function setUseRedirectParameterIfPresent($useRedirectParameterIfPresent);
}