<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 27.05.17
 * Time: 10:43
 */
class Application_Model_Mapper_RatesMapper extends Application_Model_Abstract_AbstractMapper
{
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DBTable_RatesTable');
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

    /*
     *
     */
    private function getCurrencyPairs()
    {
        $currencyPairs = array();
        $currenctyModel = new Application_Model_Currency();
        $currencies = $currenctyModel->getList();
        foreach ($currencies as $currencyIn) {
            $currencyPairs[$currencyIn] = '';
            foreach ($currencies as $currencyOut) {
                if($currencyIn != $currencyOut) {
                    $currencyPairs[$currencyIn] .= '"' . $currencyIn . $currencyOut . '"' . ',';
                }
            }
            $currencyPairs[$currencyIn] = rtrim($currencyPairs[$currencyIn], ',');
        }
        return $currencyPairs;
    }

    private function getYahooCurrencyRates($currencyPairs)
    {
        $uri = "https://query.yahooapis.com/v1/public/yql?q=select%20Name%2CRate%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%currencypairs%)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
        $uri = str_replace("%currencypairs%", urlencode($currencyPairs), $uri);
        $client = new Zend_Http_Client($uri, array(
            'maxredirects' => 0,
            'timeout'      => 30));
        try {
            $response = $client->request();
        } catch (Zend_Http_Client_Adapter_Exception $e) {
            error_log("Zend_Http_Client_Adapter_Exception");
        } catch (Exception $e) {
            error_log("Exception");
        }
        if(isset($response)){
            return json_decode($response->getBody());
        }
        return null;
    }

    private function setCurrencyRates($currencyIn, $rates)
    {
        $currentDate = date('Y-m-d H:i:s');
        $data = array(
            'currencyIn' => $currencyIn,
            'date' => $currentDate
        );

        foreach ($rates as $rate) {
            $currency = explode('/', $rate->Name);
            $value = $rate->Rate;
            $data[$currency[1]] = $value;
        }
        $this->getDbTable()->update($data, array('currencyIn = ?' => $currencyIn));

    }

    public function updateRates()
    {
        $rates = null;
        $currencyPairs = $this->getCurrencyPairs();
        foreach ($currencyPairs as $key => $value) {
            $rates = $this->getYahooCurrencyRates($value);
            if(is_object($rates) ) {
                $this->setCurrencyRates($key, $rates->query->results->rate);
            }
        }

        if(is_object($rates) ) {
            return $rates->query->results->rate;
        }
        return null;

    }

    //get convertion rates for currency pair
    public function getRateForPair($currencyIn, $currencyOut)
    {
        $table = $this->getDbTable();
        $select = $table->select();
        $select->from($table, array($currencyOut))
            ->where('currencyIn = ?', $currencyIn);

        $rows = $table->fetchRow($select);
        return $rows;
    }

}