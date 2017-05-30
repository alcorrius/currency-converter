<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 0:54
 */
class ConverterController extends Zend_Controller_Action
{
    protected function _getModel()
    {
        return new Application_Model_Converter();
    }

    public function convertAction()
    {
        $params = $this->getRequest()->getParams();
        $result = $this->_getModel()->convert($params);

        $this->_helper->json($result, true);
    }
}