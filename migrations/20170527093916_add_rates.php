<?php

use Phinx\Migration\AbstractMigration;

class AddRates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $rows = array();
        $keys = array('AUD','ARS','BZD','BYR','CAD','CNY','CZK','EUR','GBP','HKD','INR','ISK','JPY','MXN','NOK','NZD','RUB','SGD','UAH','ZAR');
        foreach ($keys as $key)
        {
            $rows[] = array(
                'currencyIn' => $key,
                'AUD' => 1,
                'ARS' => 1,
                'BZD' => 1,
                'BYR' => 1,
                'CAD' => 1,
                'CNY' => 1,
                'CZK' => 1,
                'EUR' => 1,
                'GBP' => 1,
                'HKD' => 1,
                'INR' => 1,
                'ISK' => 1,
                'JPY' => 1,
                'MXN' => 1,
                'NOK' => 1,
                'NZD' => 1,
                'RUB' => 1,
                'SGD' => 1,
                'UAH' => 1,
                'ZAR' => 1
            );
        }

        $this->insert('rates', $rows);
    }
}
