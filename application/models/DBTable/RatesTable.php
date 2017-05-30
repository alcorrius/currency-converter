<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 26.05.17
 * Time: 15:19
 */
class Application_Model_DBTable_RatesTable extends Zend_Db_Table_Abstract
{
    protected $_name = 'rates';
    protected $_primary = 'id';
}