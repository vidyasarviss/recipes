<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 *
 */
class ItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'item_name' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'purchase_unit' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sell_unit' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usage_unit' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sell_unit_qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usage_unit_qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_purchase_unit_id' => ['type' => 'index', 'columns' => ['purchase_unit'], 'length' => []],
            'fk_sell_unit_id' => ['type' => 'index', 'columns' => ['sell_unit'], 'length' => []],
            'fk_usage_unit_id' => ['type' => 'index', 'columns' => ['usage_unit'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_purchase_unit_id' => ['type' => 'foreign', 'columns' => ['purchase_unit'], 'references' => ['units', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_sell_unit_id' => ['type' => 'foreign', 'columns' => ['sell_unit'], 'references' => ['units', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_usage_unit_id' => ['type' => 'foreign', 'columns' => ['usage_unit'], 'references' => ['units', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'item_name' => 'Lorem ipsum dolor sit amet',
                'purchase_unit' => 1,
                'sell_unit' => 1,
                'usage_unit' => 1,
                'sell_unit_qty' => 1,
                'usage_unit_qty' => 1
            ],
        ];
        parent::init();
    }
}
