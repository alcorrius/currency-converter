<?php
/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 1:47
 */
require_once 'init.php';

$ratesModel = new Application_Model_Rates();
$ratesModel->updateRates();

