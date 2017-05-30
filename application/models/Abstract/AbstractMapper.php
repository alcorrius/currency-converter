<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 26.05.17
 * Time: 15:07
 */
class Application_Model_Abstract_AbstractMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
}