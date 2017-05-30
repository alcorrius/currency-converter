<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 10:00
 */
class Application_Model_Rates extends Application_Model_Abstract_AbstractModel
{
    protected $_id;
    protected $_currencyIn;
    protected $_AUD;
    protected $_ARS;
    protected $_BZD;
    protected $_BYR;
    protected $_CAD;
    protected $_CNY;
    protected $_CZK;
    protected $_EUR;
    protected $_GBP;
    protected $_HKD;
    protected $_INR;
    protected $_ISK;
    protected $_JPY;
    protected $_MXN;
    protected $_NOK;
    protected $_NZD;
    protected $_RUB;
    protected $_SGD;
    protected $_UAH;
    protected $_ZWD;


    public function __construct($mapper = null)
    {
        if (is_null($mapper)) $this->_mapper = new Application_Model_Mapper_RatesMapper();
        else $this->_mapper = $mapper;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setCurrencyIn($currencyIn)
    {
        $this->_currencyIn = (string) $currencyIn;
        return $this;
    }

    public function getCurrencyIn()
    {
        return $this->_currencyIn;
    }

    public function updateRates()
    {
        return $this->_mapper->updateRates();
    }

    public function getRateForPair($currencyIn, $currencyOut)
    {
        return $this->_mapper->getRateForPair($currencyIn, $currencyOut);
    }
}