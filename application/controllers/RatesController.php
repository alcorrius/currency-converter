<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 9:51
 */
class RatesController extends Zend_Controller_Action
{
    protected function _getModel()
    {
        return new Application_Model_Rates();
    }

    public function getLastUpdateTimeAction() {
        $result = $this->_getModel()->getLastUpdateTime();

        $this->_helper->json($result, true);
    }
}