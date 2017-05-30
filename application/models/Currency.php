<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 26.05.17
 * Time: 13:27
 */
class Application_Model_Currency extends Application_Model_Abstract_AbstractModel
{
    protected $_id;
    protected $_name;
    protected $_mapper;

    public function __construct($mapper = null)
    {
        if (is_null($mapper)) $this->_mapper = new Application_Model_Mapper_CurrencyMapper();
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

    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getList()
    {
        return $this->_mapper->fetchList();
    }

}