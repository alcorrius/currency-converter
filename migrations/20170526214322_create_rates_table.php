<?php

use Phinx\Migration\AbstractMigration;

class CreateRatesTable extends AbstractMigration
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
        $table = $this->table('rates');
        $table->addColumn('currencyIn', 'string')
            ->addColumn('date', 'string')
            ->addColumn('AUD', 'string')
            ->addColumn('ARS', 'string')
            ->addColumn('BZD', 'string')
            ->addColumn('BYR', 'string')
            ->addColumn('CAD', 'string')
            ->addColumn('CNY', 'string')
            ->addColumn('CZK', 'string')
            ->addColumn('EUR', 'string')
            ->addColumn('GBP', 'string')
            ->addColumn('HKD', 'string')
            ->addColumn('INR', 'string')
            ->addColumn('ISK', 'string')
            ->addColumn('JPY', 'string')
            ->addColumn('MXN', 'string')
            ->addColumn('NOK', 'string')
            ->addColumn('NZD', 'string')
            ->addColumn('RUB', 'string')
            ->addColumn('SGD', 'string')
            ->addColumn('UAH', 'string')
            ->addColumn('ZAR', 'string')
            ->create();
    }
}
