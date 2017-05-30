<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 10:08
 */
class Application_Model_Converter extends Application_Model_Abstract_AbstractModel
{
    public function convert($params)
    {
        if(!is_numeric($params['amount'])) {
            return null;
        }
        $amount = floatval($params['amount']);
        $currencyIn = htmlspecialchars($params['currencyIn']);
        $currencyOut = htmlspecialchars($params['currencyOut']);

        $ratesModel = new Application_Model_Rates();
        $rate = floatval($ratesModel->getRateForPair($currencyIn, $currencyOut)[$currencyOut]);

        return $currencyIn . ' ' . $amount . ' -> ' . $rate*$amount . ' ' . $currencyOut;
    }
}