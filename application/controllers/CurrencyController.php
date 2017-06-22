<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 26.05.17
 * Time: 13:27
 */
class CurrencyController extends Zend_Controller_Action
{
    protected function _getModel()
    {
        return new Application_Model_Currency();
    }

    public function getCurrencyListAction()
    {
        $currencyModel = $this->_getModel();
        $currencies = $currencyModel->getList();

        $this->_helper->json($currencies);
    }
}