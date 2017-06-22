<?php

use Phinx\Migration\AbstractMigration;

class AddCurrencies extends AbstractMigration
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
        $rows = [
            [
                'id'    => 1,
                'name'  => 'AUD'
            ],
            [
                'id'    => 2,
                'name'  => 'ARS'
            ],
            [
                'id'    => 3,
                'name'  => 'BZD'
            ],
            [
                'id'    => 4,
                'name'  => 'BYR'
            ],
            [
                'id'    => 5,
                'name'  => 'CAD'
            ],
            [
                'id'    => 6,
                'name'  => 'CNY'
            ],
            [
                'id'    => 7,
                'name'  => 'CZK'
            ],
            [
                'id'    => 8,
                'name'  => 'EUR'
            ],
            [
                'id'    => 9,
                'name'  => 'GBP'
            ],
            [
                'id'    => 10,
                'name'  => 'HKD'
            ],
            [
                'id'    => 11,
                'name'  => 'INR'
            ],
            [
                'id'    => 12,
                'name'  => 'ISK'
            ],
            [
                'id'    => 13,
                'name'  => 'JPY'
            ],
            [
                'id'    => 14,
                'name'  => 'MXN'
            ],
            [
                'id'    => 15,
                'name'  => 'NOK'
            ],
            [
                'id'    => 16,
                'name'  => 'NZD'
            ],
            [
                'id'    => 17,
                'name'  => 'RUB'
            ],
            [
                'id'    => 18,
                'name'  => 'SGD'
            ],
            [
                'id'    => 19,
                'name'  => 'UAH'
            ],
            [
                'id'    => 20,
                'name'  => 'USD'
            ],
            [
                'id'    => 21,
                'name'  => 'ZAR'
            ]
        ];

        $this->insert('currency', $rows);
    }
}
