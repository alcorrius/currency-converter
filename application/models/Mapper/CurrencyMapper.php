<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 26.05.17
 * Time: 15:08
 */
class Application_Model_Mapper_CurrencyMapper extends Application_Model_Abstract_AbstractMapper
{

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DBTable_CurrencyTable');
        }
        return $this->_dbTable;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Currency();
            $entry->setId($row->id)
                ->setName($row->name);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function fetchList()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = $row->name;
            $entries[] = $entry;
        }
        return $entries;
    }
}